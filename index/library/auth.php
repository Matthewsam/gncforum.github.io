<?php
$SALT = "kjhfhfuhjfhweifhejfkuehfhkgh";

$db_conn = NULL;
$db_servername = "sql102.epizy.com";
$db_username = "epiz_31761674";
$db_password = "p1CqVTgrQCg5uL1";
$db_name = "epiz_31761674_lahtp";


function get_db_connection(){
	global $db_conn;
	global $db_servername;
	global $db_username;
	global $db_password;
	global $db_name;

	if($db_conn != NULL){
		return $db_conn;
	} else{
		$db_conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);
		if(!$db_conn){
			 die("Connection failed: " . mysqli_connect_error());
		} else {
			return $db_conn;
		}
	}
}
/*
1. save the deatils to the database
2. password has to be hashed.
3. OTP has to be generated and saved
*/

function get_hashed_passwd($password){
	global $SALT;
	return md5(strrev($password.$SALT));
}

function do_signup($username, $password){
	$hashed_passwd = get_hashed_passwd($password);
	$otp = rand(100000, 999999);
	$query ="INSERT INTO `epiz_31761674_lahtp`.`authentication` (`username`, `password`, `otp`) VALUES ('$username', '$hashed_passwd', '$otp');";
		$db_conn = get_db_connection();
		if (mysqli_query($db_conn, $query)) {
   		return 1; 
		} else {
  			return mysqli_error($db_conn);
		}
}
/*
1. we check if the opt is same as we saved in the database.
2. if otp is correct, change active to 1.
*/

function do_verify_signup($username, $otp){
	$query = "SELECT * FROM epiz_31761674_lahtp.authentication WHERE username ='$username';";
	$db_conn = get_db_connection();
	$result = mysqli_query($db_conn, $query);
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		if($row['otp'] == $otp){
			return activate($username);
		} else{ 
			return 0;
		}
	} else {
		return 0;
	}
}

/*
1. Set active to 1.
*/
function activate($username){
	$query = "UPDATE `epiz_31761674_lahtp`.`authentication` SET `active` = '1' WHERE (`username` = '$username');";
	$db_conn = get_db_connection();
	return mysqli_query($db_conn, $query);
}

/*
1. check if user exists in the database
2. if user exists, check if the the password is right
3. 
*/
function do_login($username, $password){
	$hashed_passwd = get_hashed_passwd($password);
	$query = "SELECT * FROM epiz_31761674_lahtp.authentication WHERE username ='$username';";
	$db_conn = get_db_connection();
	$result = mysqli_query($db_conn, $query);
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		if($row['password'] == $hashed_passwd){
			$token = get_hashed_passwd(rand(100000,999999));
			$expiry = time()+(60*60);
			return add_session($username, $token, $expiry);
		} else{ 
			return 0;
		}
	} else {
		return 0;
	}
}

/*
1. on successful login, we generated a $token and add it to the session
2. set the proper expiry time for the same as the cookie
*/
function add_session($username, $token, $expiry){
	$mysqltime = date('Y-m-d H:i:s', $expiry); 
	$query = "INSERT INTO `epiz_31761674_lahtp`.`session` (`username`, `token`, `expiry`) VALUES ('$username', '$token', '$mysqltime');";
	$db_conn = get_db_connection();
		if (mysqli_query($db_conn, $query)) {
			setcookie('username', $username , $expiry, '/','sql102.epizy.com');
			setcookie('token', $token , $expiry, '/','sql102.epizy.com');
   			return 1;
		} else {
  			return mysqli_error($db_conn);
		}


}
/*
1. Everytime when a user access any page, we check the $username and $token combo from
$_COOKIE to ensure that the session is still valid and not expired.
2. if valid, let him through.
3. if not, invalidate the session and send him to login.
*/

function verify_session($username, $token){
	
	$query = "SELECT * FROM epiz_31761674_lahtp.session WHERE username ='$username' AND token = '$token';";
	
	$db_conn = get_db_connection();
	$result = mysqli_query($db_conn, $query);
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		if((int)$row['active'] == 1){
			$expiry = strtotime($row['expiry']);
			if($expiry > time()){
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	} else {
		return 0;
	}
}


/*
1. set the expiry to current time and set the active to 0.

2.log out
*/

function invalidate_session($username, $token){

	$query = "UPDATE `epiz_31761674_lahtp`.`session` SET `active` = '0' WHERE `username` = '$username' AND `token` = '$token';";
	$db_conn = get_db_connection();
	setcookie('username', $username ,time()-3600 , '/','sql102.epizy.com');
	setcookie('token', $token ,time()-3600 , '/','sql102.epizy.com');
	return mysqli_query($db_conn, $query);	
}
function get_current_username(){
	if(verify_session($_COOKIE['username'], $_COOKIE['token'])){
		return $_COOKIE['username'];
	} else{
		return NULL;
	}
}