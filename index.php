<?php
/*use \libs\Route;
use \libs\Sql;
$sql = new Sql();*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'libs/Sql.php';
require 'libs/Route.php';

$sql = new Sql();

if ($method == 'PUT') {
  /*filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED);
  file_get_contents('php://input');
  parse_str(file_get_contents("php://input"));*/
}

if ($method == 'POST') {
  switch ($route) {
    case '/commission' :
      $stacom['status'] = 'Tidak Aktif';
      $sql->update('commission', 'status = "Aktif"', $stacom);
      $sql->create('commission',$_POST);
      $sql->redirects($base_url . 'commission');
    break;

    case '/customer-form' :
      if (empty($_POST['id'])) {
        unset($_POST['id']);
        $_POST['account'] = implode(' - ', $_POST['account']);
        $sql->create('customer', $_POST);
      } else {
        $_POST['account'] = implode(' - ', $_POST['account']);
        $sql->update('customer', 'id = :id', $_POST);
      }
      $sql->redirects($base_url . 'customer');
    break;

    case '/item' :
      extract($_POST);
      $stapri['status'] = 'Tidak Aktif';
      if (empty($_POST['id'])) {

        $price['item_id'] = $sql->create('item', $item);

        $sql->update('price','item_id = ' . $price['item_id'], $stapri);

        $sql->create('price', $price);
      } else {
        if (empty($value)) {
          $sql->update('item','id = ' . $id, $item);
        } 
        $price['item_id'] = $id;
        $sql->update('price','item_id = ' . $id, $stapri);
        $sql->create('price', $price);
      }
      $sql->redirects($base_url . 'item');
    break;

    default:
      http_response_code(404);
      require 'views/404.php';
    break;
  }
}

if ($method == 'GET') {

  $menu = $sql->menu();

  switch ($route) {

    /* ================================================================= Data ================================================================= */

    case '/commission-data':
      header("Content-Type: application/json; charset=UTF-8");

      $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10 ;
      $page = (isset($_GET['page'])) ? $_GET['page'] : 1 ;

      $data = $sql->pagination('commission', ['limit' => $limit, 'page' => $page], 'ORDER BY created_at DESC');
      echo json_encode($data);
    break;

    case '/item-data':
      header("Content-Type: application/json; charset=UTF-8");
 
      $name = (isset($_GET['term'])) ? str_replace('|', '', $_GET['term']) : '' ;
      $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10 ;
      $page = (isset($_GET['page'])) ? $_GET['page'] : 1 ;

      $col = 'item.id id, name, value, status, item.created_at created_at_item, item.updated_at updated_at_item, price.created_at created_at_price, price.updated_at updated_at_price';

      $join = 'LEFT JOIN price ON item.id = item_id ';
      $where = $join . 'WHERE `status` = "aktif" AND name LIKE "%' . $name . '%" ';

      $data = $sql->pagination('item', ['limit' => $limit, 'page' => $page], $where, $col);

      if (isset($_GET['term']) && strpos($_GET['term'], '|') == false) {
        unset($data['page']);
        unset($data['pages']);
        $data = array_pop($data);
      }

      echo json_encode($data);
    break;

    case '/subdistrict-data':
      header("Content-Type: application/json; charset=UTF-8");
      $data = $sql->selected('subdistrict_name', $_GET['term'], false);

      foreach ($data as &$arr1) {
        $arr1['value'] = $arr1['subdistrict_name'] . ' - ' . $arr1['type'] . ' ' .$arr1['city_name'];
        $arr1['label'] = $arr1['subdistrict_name'] . ' - ' . $arr1['type'] . ' ' .$arr1['city_name'];
      }

      echo json_encode($data);
    break;

    case '/customer-data':
      header("Content-Type: application/json; charset=UTF-8");

      $name = (isset($_GET['term'])) ? str_replace('|', '', $_GET['term']) : '' ;
      $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10 ;
      $page = (isset($_GET['page'])) ? $_GET['page'] : 1 ;

      $where = 'WHERE name LIKE "%' . $name . '%" ';

      $bank = $sql->bank();
      $subdistrict = $sql->location();

      $data = $sql->pagination('customer', ['limit' => $limit, 'page' => $page], $where);

      foreach ($data['data'] as &$arr1) {

        $arr1['bank'] = '';
        $arr1['code'] = '';

        if (!empty($arr1['account'])) {
          $account = explode(' - ', $arr1['account']);

          $matchb = array_filter($bank, function($v) use ($account){
            return $v['code'] == $account[0];
          });

          $matchb = array_pop($matchb);
          $arr1['bank'] = $matchb['bank'];

          $arr1['code'] = $account[0];
          $arr1['account'] = $account[1];
        }

        $subdistrict_id = $arr1['subdistrict_id'];

        $match = array_filter($subdistrict, function($v) use ($subdistrict_id){
          return $v['subdistrict_id'] == $subdistrict_id;
        });

        $match = array_pop($match);

        $arr1['status'] = (empty($arr1['status'])) ? 'Buyer' : 'Reseller' ;

        $arr1['value'] = $arr1['name'] . ' (' . $arr1['status'] . ')';
        $arr1['label'] = $arr1['name'] . ' (' . $arr1['status'] . ')';
        $arr1['province'] = $match['province'];
        $arr1['city_name'] = $match['city_name'];
        $arr1['type'] = $match['type'];
        $arr1['subdistrict_name'] = $match['subdistrict_name'];
      }

      if (isset($_GET['term']) && strpos($_GET['term'], '|') == false) {
        unset($data['page']);
        unset($data['pages']);
        $data = array_pop($data);
      }

      echo json_encode($data);
    break;

    /* ================================================================= End Data ================================================================= */

    case '/' :
      require 'views/header.php';
      require 'views/dashboard.php';
      require 'views/footer.php';
    break;

    case '/form' :
      require 'views/header.php';
      require 'views/form.php';
      require 'views/footer.php';
    break;

    case '/commission' :
      require 'views/header.php';
      require 'views/commission/commission.php';
      require 'views/footer.php';
    break;

    case '/item' :
      $id = $segment[2];
      $price = $segment[3];

      $col = 'item.id id, name, value, status';
      $join = 'JOIN price ON item_id = item.id';

      $data = (empty($id)) ? null : $sql->one('item', $join . ' WHERE item.id = ' . $id . ' AND status = "Aktif"', $col) ;

      $id = (empty($data['id'])) ? '' : $data['id'] ;
      $name = (empty($data['name'])) ? '' : $data['name'] ;
      $value = (empty($data['value'])) ? '' : $data['value'] ;
      $status = (empty($data['status'])) ? '' : $data['status'] ;

      require 'views/header.php';
      require 'views/item/item.php';
      require 'views/footer.php';
    break;

    case '/purchase-form' :
      $bank = $sql->bank();
      $exp = $sql->expedition();

      require 'views/header.php';
      require 'views/purchase/form-purchase.php';
      require 'views/footer.php';
    break;

    case '/customer' :
      require 'views/header.php';
      require 'views/customer/table-customer.php';
      require 'views/footer.php';
    break;

    case '/customer-form' :
      $id = $segment[2];
      $bank = $sql->bank();
      $stacus = $sql->stacus();
      $subdistrict = $sql->location();
      $data = (empty($id)) ? null : $sql->one('customer', 'WHERE id = ' . $id) ;

      $id = (empty($data['id'])) ? '' : $data['id'] ;
      $name = (empty($data['name'])) ? '' : $data['name'] ;
      $phone = (empty($data['phone'])) ? '' : $data['phone'] ;
      $status = (empty($data['status'])) ? '' : $data['status'] ;
      $address = (empty($data['address'])) ? '' : $data['address'] ;
      $subdistrict_id = (empty($data['subdistrict_id'])) ? '' : $data['subdistrict_id'] ;
      $subdistrict = (empty($data['subdistrict_id'])) ? '' : $sql->selected('subdistrict_id', $data['subdistrict_id']) ;
      $subdistrict = (empty($data['subdistrict_id'])) ? '' : $subdistrict['subdistrict_name'] . ' - ' . $subdistrict['type'] . ' ' .$subdistrict['city_name'] ;

      require 'views/header.php';
      require 'views/customer/form-customer.php';
      require 'views/footer.php';
    break;

    /*case $file :
      if (file_exists($file . '.php')) {
        require 'views/header.php';
        require $file . '.php';
        require 'views/footer.php';
      } else {
        goto pnf;
      }
    break;*/

    default:
      pnf:
        http_response_code(404);
        require 'views/404.php';
    break;
  }
}