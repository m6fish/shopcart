<?php
//RFish 2014
include_once('configDB.php');

// use whatever escaping function your db requires this is very important.
$escapedName = mysql_real_escape_string($_POST['name']);
$escapedPW = mysql_real_escape_string($_POST['password']);
/*
$escapedName = 'testA_I';
$escapedPW = 'test';
*/
// generate a random salt to use for this account
$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$saltedPW =  $escapedPW . $salt;
$hashedPW = hash('sha256', $saltedPW);


/*
    -- 記得檢查使用者名稱unique--
*/

$sql = 'INSERT INTO `user` (user, pw, salt) values ("' . 
    $escapedName . '", "' . $hashedPW . '", "' . $salt . '"); ';
$query = mysql_query($sql);
