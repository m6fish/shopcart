<?php
//RFish 2014
include_once('configDB.php');
session_start();

if(isset($_POST['user']) && isset($_POST['pw']) ){
    $escapedUser = mysql_real_escape_string($_POST['user']);
    $escapedPW = mysql_real_escape_string($_POST['pw']);
}

//自資料庫取得salt, PW+SALT = hashedPW
$saltSQL = 'SELECT `salt` FROM `user` WHERE `user` = "' . $escapedUser . '";';
$query = mysql_query($saltSQL);
$row = mysql_fetch_assoc($query);
$salt = $row['salt'];

$saltedPW =  $escapedPW . $salt;
$hashedPW = hash('sha256', $saltedPW);

// 檢查是否存在使用者,帳密是否符合
$sql = 'SELECT `id` FROM `user` WHERE `user` = "' . 
    $escapedUser . '" and `pw` = "' . $hashedPW . '"; ';
$query = mysql_query($sql);
$sql_nums = mysql_num_rows($query);
$row = mysql_fetch_assoc($query);

$uid = $row['id'];

//Log in correct
if ($sql_nums == 1) {
    $result['errorCode'] = '0';
    $result['errorMessage'] = 'Log in Success!';
    
    $_SESSION['user_id']=$uid;
    
//Log In data error
} else if ($sql_nums == 0) {
    $result['errorCode'] = '2';
    $result['errorMessage'] = 'Login fail, Log In data error';

//Undefined error
} else {
    $result['errorCode'] = '-1';
    $result['errorMessage'] = 'Login fail, $sql_nums = '. $sql_nums;
}

echo json_encode($result);