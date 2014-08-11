<?php
//RFish 2014
include_once('configDB.php');

if(isset($_POST['pid']) && isset($_POST['uid']) ){
    $uid = $_POST['uid'];
    $pid = $_POST['pid'];
}


// 檢查購物車內是否有商品
$sql = 'SELECT `uid`, `pid` FROM `cart` WHERE `uid`='. $uid .' and `pid` = '. $pid .';';
$query = mysql_query($sql);
$sql_nums = mysql_num_rows($query);

if ($sql_nums == 0) {
//'there is no this product';
    $result['errorCode'] = '1';
    $result['errorMessage'] = 'there is no this product';
} else if ($sql_nums > 0){
//刪除商品
    $sql = 'DELETE FROM `shopcar`.`cart` WHERE `cart`.`uid` = "'. $uid .'" AND `cart`.`pid` = "'. $pid .'";';
    $query = mysql_query($sql);
    
    if($query) {
        $result['errorCode'] = '0';
        $result['errorMessage'] = 'delete success';
    } else {
        $result['errorCode'] = '1';
        $result['errorMessage'] = 'delete fail';
    }
    
} else {
    $result['errorCode'] = '-1';
    $result['errorMessage'] = 'delete fail, $sql_nums = '+ $sql_nums;
}

echo json_encode($result);
