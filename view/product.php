<?php
//RFish 2014
include_once('../function/configDB.php');
session_start();

if(isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
} else {
    $uid = '-1';
}

if(isset($_GET['pid'])){
    $sql = "SELECT * FROM `product` where pid='".$_GET['pid']."'";
    $result = mysql_query($sql);
    $rows = mysql_num_rows($result);
    
    if($result && $rows != 0) {
        while($row = mysql_fetch_array($result)) {

        $product['name'] = $row["name"];
        $product['kind'] = $row["kind"];
        $product['price'] = $row["price"];
        $product['deadline'] = $row["deadline"];
        $product['des'] = $row["des"];
        $product['pic'] = $row["pic"];
        }
    } else {
        echo '<script>alert("Product DOES NOT exist! Back to ProductList!");</script>';
        echo' <script>document.location.href="../productList.php";</script>' ;
    }
} else {
    echo '<script>alert("Choice A Product! Back to ProductList!");</script>';
    echo' <script>document.location.href="../productList.php";</script>' ;
    //header('Location: ../productList.php');
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Shopcar - Product</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <button class="back" onclick="location='../productList.php';">back to List</button>
    <button class="back_cart" onclick="location='mycart.php';">back to MyCart</button>
    
    <h1>商品詳細</h1>
    <hr/>
    <div class="product_detail">
        <table >
            <tr class="product">
                <td class="title" colspan="2"><?=$product['name']?></td>
            </tr>
            <tr class="contain">
                <td class="title">品項:</td>
                <td class="kink"><?=$product['kind']?></td>
            </tr>
            <tr class="contain">
                <td class="title">售價:</td>
                <td class="price"><?=$product['price']?>元</td>
            </tr>
            <tr class="contain">
                <td class="title">保存期限:</td>
                <td class="time"><?=$product['deadline']?></td>
            </tr>
            <tr class="contain">
                <td class="title">敘述:</td>
                <td class="describe"><?=$product['des']?></td>
            </tr>
            <tr class="contain">
                <td class="pic" colspan="2">照片區</td>
            </tr>
            <tr class="contain">
                <td class="pic" colspan="2"><?=$product['pic']?></td>
            </tr>
        </table>
        <br/>
        
        <span id="uid" class="hidden"><?=$uid?></span>
        <span id="pid" class="hidden"><?=$_GET['pid']?></span>
        <button class="add">Add to cart</button>
    </div>
    
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="../asset/js/all.js"></script>
</body>
</html>