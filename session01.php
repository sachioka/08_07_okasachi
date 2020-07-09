<?php
// session変数を定義して値を入れよう
session_start();
$_SESSION['num'] = 100;
var_dump($_SESSION['num']);
exit();
