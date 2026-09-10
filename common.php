<?php
//common.php
session_start();
	if(isset($_GET['lang'])){
		$lang = $_GET['lang'];
		$_SESSION['lang'] = $lang;
	}else if(isset($_SESSION['lang'])){
		$lang = $_SESSION['lang'];
	}else{
		$lang = 'kh'; 
	}
	switch($lang) {
  		case 'en':
  		$lang_file = 'lang_en.php';
  		break;

  		case 'kh':
  		$lang_file = 'lang_kh.php';
  		break;
  
 		default:
  		$lang_file = 'lang_kh.php'; 
	}
  include  'language/'.$lang_file;
?>
