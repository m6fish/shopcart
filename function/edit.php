<?php
//RFish 2014
include_once('configDB.php');

if(isset($_POST['pid']) && isset($_POST['uid']) && isset($_POST['newNum']) ){
    $uid = $_POST['uid'];
    $pid = $_POST['pid'];
    $newNum = $_POST['newNum'];
}

$sql = 'UPDATE `shopcar`.`cart` SET `nums` = "'.$newNum.'" WHERE `cart`.`uid` = '.$uid.' AND `cart`.`pid` = '.$pid.';';
$query = mysql_query($sql);

if($query) {
    $result['errorCode'] = '0';
    $result['errorMessage'] = 'edit success';
} else {
    $result['errorCode'] = '1';
    $result['errorMessage'] = 'edit fail';
}



//echo json_encode($_POST);
echo json_encode($result);
