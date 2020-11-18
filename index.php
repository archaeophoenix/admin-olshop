<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'Sql.php';
require 'Route.php';

$sql = new Sql();

if ($method == 'POST') {
  switch ($route) {
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

    default:
      http_response_code(404);
      require '404.php';
    break;
  }
}

if ($method == 'GET') {
  switch ($route) {

    /*Data*/

    case '/customer-data':
      header("Content-Type: application/json; charset=UTF-8");

      $name = (isset($_GET['name'])) ? $_GET['name'] : '' ;
      $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10 ;
      $page = (isset($_GET['page'])) ? $_GET['page'] : 1 ;

      $where = 'WHERE name LIKE "%' . $name . '%" ';

      $bank = $sql->bank();
      $subdistrict = $sql->location();
      $data = $sql->pagination('customer', ['limit' => $limit, 'page' => $page], $where);

      foreach ($data['data'] as &$arr1) {

        $arr1['bank'] = '';

        if (!empty($arr1['account'])) {
          $account = explode(' - ', $arr1['account']);

          $matchb = array_filter($bank, function($v) use ($account){
            return $v['code'] == $account[0];
          });

          $matchb = array_pop($matchb);
          $arr1['bank'] = $matchb['bank'];
        }

        $subdistrict_id = $arr1['subdistrict_id'];

        $match = array_filter($subdistrict, function($v) use ($subdistrict_id){
          return $v['subdistrict_id'] == $subdistrict_id;
        });

        $match = array_pop($match);

        $arr1['province'] = $match['province'];
        $arr1['city_name'] = $match['city_name'];
        $arr1['type'] = $match['type'];
        $arr1['subdistrict_name'] = $match['subdistrict_name'];
      }

      echo json_encode($data);
    break;

    /*End Data*/

    case '/form' :
      require 'header.php';
      require 'form.php';
      require 'footer.php';
    break;

    case '/purchase-form' :
      require 'header.php';
      require 'form-purchase.php';
      require 'footer.php';
    break;

    case '/customer' :
      require 'header.php';
      require 'table-customer.php';
      require 'footer.php';
    break;

    case '/customer-form' :
      $id = $segment[2];
      $bank = $sql->bank();
      $statusc = $sql->status();
      $subdistrict = $sql->location();
      $data = (empty($id)) ? null : $sql->one('customer', 'WHERE id = ' . $id) ;

      require 'header.php';
      require 'form-customer.php';
      require 'footer.php';
    break;

    /*case $file :
      if (file_exists($file . '.php')) {
        require 'header.php';
        require $file . '.php';
        require 'footer.php';
      } else {
        goto pnf;
      }
    break;*/

    default:
      pnf:
        http_response_code(404);
        require '404.php';
    break;
  }
}