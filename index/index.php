<?php
include 'library/auth.php';

if(isset($_COOKIE['username']) and isset($_COOKIE['token'])){
	$username = $_COOKIE['username'];
	$token = $_COOKIE['token'];

	if(verify_session($username, $token)){
		header("Location: ./home.php");
	} else{
		header("Location: ./signin.php");
	}
} else{
	header("Location: ./signin.php");
}