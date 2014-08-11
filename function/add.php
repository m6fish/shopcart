<?php
//RFish 2014
include_once('configDB.php');

if(isset($_POST['pid']) && isset($_POST['uid']) ){
    $uid = $_POST['uid'];
    $pid = $_POST['pid'];
    $newNum = 1;
}


// 檢查購物車內是否已經有同樣商品
$sql = 'SELECT `uid`, `pid` FROM `cart` WHERE `uid`='. $uid .' and `pid` = '. $pid .';';
$query = mysql_query($sql);
$sql_nums = mysql_num_rows($query);

if ($sql_nums > 0) {
    //'already have this product';
    $result['errorCode'] = '1';
    $result['errorMessage'] = 'already have this product';
} else if ($sql_nums == 0) {
    //插入新商品
    $sql = 'INSERT INTO `shopcar`.`cart` (`uid`, `pid`, `nums`) VALUES ("'.$uid.'", "'. $pid .'", "'. $newNum .'");';
    $query = mysql_query($sql);

    if($query) {
        $result['errorCode'] = '0';
        $result['errorMessage'] = 'add success';
    } else {
        $result['errorCode'] = '1';
        $result['errorMessage'] = 'add fail';
    }
} else {
    $result['errorCode'] = '-1';
    $result['errorMessage'] = 'add fail, $sql_nums = '+ $sql_nums;
}

echo json_encode($result);

