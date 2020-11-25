<?php
session_start();

require '../controllers/'.$_POST['objeto'].'.php';
$objeto = new $_POST['objeto']();
echo json_encode($objeto->{$_POST['metodo']}($_POST['datos']));