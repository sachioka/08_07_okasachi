<?php
// sessionに保存されている変数を取り出し，計算して表示しようsession_start();
session_start();
$_SESSION['num'] += 1;
var_dump($_SESSION['num']);
exit();
