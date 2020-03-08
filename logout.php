<?php
/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 2/14/20
 * Time: 11:57
 */
session_start();
require_once "./config/utils.php";
unset($_SESSION[AUTH]);
header('location: ' . BASE_URL);
