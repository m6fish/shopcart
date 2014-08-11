<?php
//RFish 2014
include_once('configDB.php');
session_start();

if(isset($_POST['logOut']) && $_POST['logOut'] == '0') {

    //Log Out correct
    if( isset($_SESSION['user_id']) &&
        (!empty($_SESSION['user_id']) || $_SESSION['user_id'] === '0' )  ) {
    
        $result['errorCode'] = '0';
        $result['errorMessage'] = 'Log Out Success!';
        
        unset($_SESSION['user_id']);

    //Not yet Log in
    } else if(!isset($_SESSION['user_id']) ) {
        $result['errorCode'] = '2';
        $result['errorMessage'] = 'LogOut fail, Not yet Log in';
        
    //Undefined error
    } else {
        $result['errorCode'] = '-1';
        $result['errorMessage'] = 'LogOut fail, Undefined error, P_[logOut] :' .
            $_POST['logOut']."/ SESSION :" . $_SESSION['user_id'];
    }
    
//Undefined error
} else {
    $result['errorCode'] = '-1';
    $result['errorMessage'] = 'LogOut fail, Undefined error';
}

echo json_encode($result);