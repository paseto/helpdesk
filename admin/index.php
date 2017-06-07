<?php
error_reporting(E_ALL & ~E_NOTICE);
@session_start();
session_set_cookie_params(12600, '/');

require_once "../lib/db.php";
require_once "../lib/global.php";
$pdo_conn = pdo_conn();
$redirect_page = get_settings("Redirect_Page");

// langague variables
require '../public/language/english.php';

// if not logged in
if (!isset($_SESSION['a']['aauid']) || ($_SESSION['a']['aaurole'] < 1)) {
	
	// load password reset	
	if (isset($_GET['p'])) {
		
		require 'view/v-pwreset.php';
		
	} else {
		
		require 'view/v-login.php';
		
		// on attempting to log in
		if(isset($_POST['aali'])) {
			
			require 'model/m-login.php';
			
			if(aaGetUser($_POST['user'], $_POST['pass'], "a")) {
				// set langauge
				aaSetLangauge ($_POST['lang']);
				@header('Location: '.$redirect_page);
			} else {
				@header('Location: index.php');
			}
			
		}
	
	}
	
} else {
	
	// if index page then redirect to tickets	
	if(!isset($_GET['p'])) {
		@header('Location: '.$redirect_page);
	} else {
		require 'view/v-'.$_GET['p'].'.php';
	}
	
}
?>