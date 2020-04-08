<?php
session_start();
require_once '../../config/utils.php';
$end_point = $_POST['end_point'];

$checkRoutesQuery = "select * from routes where end_point = '$end_point'";

$routes = queryExecute($checkRoutesQuery, true);
echo count($routes) == 0 ? "true" : "false";