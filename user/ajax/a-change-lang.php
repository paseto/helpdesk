<?php

$lang = $_POST['p_lang'];

session_start();

$_SESSION['aa-user-lang'] = $lang;

?>