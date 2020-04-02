<?php
session_start();
require_once '../../config/utils.php';
$begin_point = $_POST['begin_point'];

$checkRoutesQuery = "select * from routes where begin_point = '$begin_point'";

$routes = queryExecute($checkRoutesQuery, true);
echo count($routes) == 0 ? "true" : "false";