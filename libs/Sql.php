<?php
// namespace libs;

class Sql extends PDO{

  function __construct(){
    require_once 'config.php';
    require_once 'constants.php';
    extract($connect);
    parent::__construct("mysql:host=$host;dbname=$dbname", "$user", "$password");
  }

  function menu(){
    return json_decode(MENU, true);
  }

  function expedition(){
    return json_decode(EXP, true);
  }

  function stacus(){
    return json_decode(STACUS, true);
  }

  function stapri(){
    return json_decode(STAPRI, true);
  }

  function bank(){
    return json_decode(BANK, true);
  }

  function location($uniq = null){
    $subdistrict = json_decode(SUBDISTRICT, true);
    return (empty($uniq)) ? $subdistrict : array_intersect_key($subdistrict, array_unique(array_column($subdistrict, $uniq)));
  }

  function province(){
    $province = $this->location('province_id');
     usort($province, function ($a, $b) {
      return $a['province_id'] - $b['province_id'];
    });
    return $province;
  }

  function selected($col, $id, $selected = true){
    $data = $this->location();
    $data = $this->filterBy($data, $col, $id, $selected);

    $data = ($selected) ? array_pop($data) : $data;

    return $data;
  }

  function filterBy($data, $col, $id, $selected = true){
    $result = array_filter($data, function ($var) use ($col, $id, $selected) {
      return ($selected) ? ($var[$col] == $id) : preg_match('~' . strtolower($id) . '~', strtolower($var[$col]));
    });

    if ($selected) {
      usort($result, function ($a, $b) use ($col){
        return $a[$col] - $b[$col];
      });
    }

    return $result;
  }

  function cities($province_id = null){
    $cities = $this->location('city_id');
    if (!empty($province_id)){
      $cities = $this->filterBy($cities, 'province_id', $province_id);
    }
    return $cities;
  }

  function subdistrict($city_id = 0){
    $subdistrict = $this->location();
    $subdistrict = $this->filterBy($subdistrict, 'city_id', $city_id);
    return $subdistrict;
  }

  /*Fungsi untuk mengexecute Query Describe*/
  function field($table){
    $exe=$this->prepare("DESCRIBE ".$table);
    $exe->execute();
    $result=$exe->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  function pagination($table, $pages = ['limit' => 10, 'page' => 1], $condition = null, $fields = "*"){
    $page = ($pages['page'] - 1) * $pages['limit'];
    $limit = ' LIMIT ' . $page . ' , ' . $pages['limit'];
    $total = $this->one($table, $condition, 'COUNT(' . $table . '.id) total');

    $data['page'] = $pages['page'];
    $data['pages'] = ceil($total['total'] / $pages['limit']);
    $data['data'] = $this->read($table, $condition . $limit, $fields);

    return $data;
  }

  /*Fungsi untuk mengexecute Query Insert
  **
  **  Parameter
  **  $table sebagai nama table
  **  $data sebagai field beserta data yang dimasukkan contoh ($data = ['colom' => 'value'])
  **
  **/
  function create($table,$data=array()){
    $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    if(empty($data)){
      $Field=$this->field($table);
      foreach($Field as $Fields){
        if($Fields['Type']!='timestamp'){
          $data[$Fields['Field']] = $_REQUEST[$Fields['Field']];
        }
      }
    }
    $fields = implode(", ", array_keys($data));
    $values = ":".implode(", :", array_keys($data));
    $val = implode(", ", $data);
    $sql = "INSERT INTO $table($fields) VALUES($val)";
    $exe = $this->prepare("INSERT INTO $table($fields) VALUES($values)");
    if(!$exe){
      $message = $this->errorInfo();
      echo $message[2]."<br>please check this query &rArr; ".$sql;
      die();
    } else {
      foreach ($data as $key => $value) {
        $exe->bindValue(":$key", $value);
      }
      $exe->execute();
      return $this->lastInsertId();
    }
  }

  /*Fungsi untuk mengexecute Query Select
  **
  **  Parameter
  **  $table sebagai nama table
  **  $condition sebagai query setelah FROM
  **  $fields sebagai colom tabel yang akan ditampilkan
  **/
  function read($table, $condition = null, $fields = "*"){
    $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = "SELECT $fields FROM $table $condition";
    $exe = $this->prepare($sql);
    if(!$exe){
      $message = $this->errorInfo();
      echo $message[2]."<br>please check this query &rArr; ".$sql;
      die();
    } else {
      $exe->execute();
      $result = $exe->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
  }

  /*Fungsi untuk mengexecute Query Update
  **
  **  Parameter
  **  $table sebagai nama table
  **  $where sepabagai parameter where contoh ($where = 'id = 1')
  **  $data sebagai field beserta data yang dimasukkan contoh $data = ['colom' => 'value']
  **
  **/
  function update($table,$where,$data=array()){
    if(empty($data)){
      $Field=$this->field($table);
      foreach($Field as $Fields){
        if($Fields['Type']!='timestamp'){
          $value[]=$Fields['Field']." = :".$Fields['Field'];
          $data[$Fields['Field']] = $_REQUEST[$Fields['Field']];
        }
      }
    } else {
      foreach($data as $key => $val ){
        $value[]=$key." = :".$key;
        // $datas[]=$key." = ".$val;
      }
    }
    $values=implode(", ",$value);
    // echo "UPDATE $table SET ".implode(" ,",$datas)." WHERE $where <br/>"
    $exe=$this->prepare("UPDATE $table SET $values WHERE $where");
    if(!$exe){
      $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $message = $this->errorInfo();
      echo $message[2];
      die();
    } else {
      foreach ($data as $key => $value) {
        $exe->bindValue(":$key", $value);
        // echo $key."=>".$value;
      }
      // die;
      $exe->execute();
    }
  }

  /*Fungsi untuk mengexecute Query Delete
  **
  **  Parameter
  **  $table sebagai nama table
  **  $where sepabagai parameter where contoh ($where = 'id = 1')
  **
  **/
  function delete($table,$where){
    $this->exec("DELETE FROM $table WHERE $where");
  }

  /*Fungsi untuk mengexecute upload
  **
  **  $data sebagai nama field input file
  **  $url alokasi penempatan file
  **  $rename untuk custom rename file
  **
  **/
  function upload($data,$url,$rename=NULL){
    $files=$_FILES[$data];
    $name=$files['name'];
    move_uploaded_file($files['tmp_name'],"$url/".$name);
    if (!is_null($rename)) {
      $tipe=explode(".",$name);
      $rename=$rename.".".end($tipe);
      rename("$url/".$name,"$url/".$rename);
      $files['name']=$rename;
      $name=$rename;
    }
    chmod("$url/".$name, 0777);
    return $files;
  }

  /*Fungsi untuk mengexecute Query Select menghasilkan data satu baris
  **
  **  Parameter
  **  $table sebagai nama table
  **  $condition sebagai query setelah FROM
  **  $fields sebagai colom tabel yang akan ditampilkan
  **/
  function one($table, $condition = null, $fields = "*"){
    $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = "SELECT $fields FROM $table $condition";
    $exe = $this->prepare($sql);
    if(!$exe){
      $message = $this->errorInfo();
      echo $message[2]."<br>please check this query &rArr; ".$sql;
      die();
    } else {
      $exe->execute();
      $result = $exe->fetch(PDO::FETCH_ASSOC);
      return $result;
    }
  }

  /*Fungsi untuk redirect kehalaman*/
  function redirect($url){
    echo '<meta http-equiv="refresh"  content="0; url='.$url.'" />';
  }

  function redirects($url){
    header("Location: $url");
    die();
  }
}
