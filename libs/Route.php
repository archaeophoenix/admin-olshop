<?php

// namespace libs;

$base_url = (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

$method = $_SERVER['REQUEST_METHOD'];

$request = parse_url($_SERVER['REQUEST_URI']);
$request = str_replace('/keuangan' ,'' ,$request);
$path = $request['path'];

$file = str_replace('/' ,'' ,$path);
$segment = explode('/', $path);
// array_shift($segment);
$route = $segment[0] . '/' . $segment[1];

for ($q = 0; $q < 10; $q++) {
  ${'segment'}[$q] = (isset($segment[$q])) ? $segment[$q] : '' ;
}

// echo "<pre>"; print_r($_GET);print_r($segment);die();