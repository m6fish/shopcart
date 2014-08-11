<?php
//RFish 2014
include_once('function/configDB.php');
session_start();

//-----LogIn check
if(isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
} else {
    $uid = '-1';
}
//---------------------

if ($_GET ){
    $name = mysql_real_escape_string($_GET['name']);
    $kind = mysql_real_escape_string($_GET['kind']);
    $price = mysql_real_escape_string($_GET['price']);
} else {
    $name = '';
    $kind = '';
    $price = '';
}

$sql = 'SELECT `pid`,`name`, `kind`, `price` FROM `product` WHERE ' .
    ' `name` LIKE "%' . $name .
    '%" AND `kind` LIKE "%' . $kind .
    '%" AND `price` LIKE "%' . $price . '%" ORDER BY `pid` ASC;';

$result = mysql_query($sql);

if($result)
{
  while($row = mysql_fetch_array($result))
  {
    $pid = $row['pid'];
    
    $form[$pid]['name'] = $row["name"];
    $form[$pid]['kind'] = $row["kind"];
    $form[$pid]['price'] = $row["price"];
  }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopcar - List</title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
<div class="iconbar">
    <button class="back_cart" onclick="location='view/mycart.php';">back to MyCart</button>
    <?php if(!isset($_SESSION['user_id'])):?>
    <button id="login">LogIn</button>
    <button id="logout" class='hidden'>LogOut</button>
    <?php else:?>
    <button id="login" class='hidden'>LogIn</button>
    <button id="logout">LogOut</button>
    <?php endif;?>
</div>
<h1>商品目錄</h1>
<hr/>

<div id="searchbar">
    <form action="#" method="GET" name="search">
        <p>搜尋商品</p>
        <label for="">名稱</label><input type="text" name='name'></input>
        <label for="">品項</label><input type="text" name='kind'></input>
        <label for="">價格</label><input type="text" name='price'></input>
        <input type="submit" value='Submit'></input>
    </form>
</div>


<div id="productList">
<?php if(isset($form) ) :?>
    <?php foreach($form as $pid=>$product ): ?>
    <fieldset class="product">
        <table>
            <tr class="product">
                <td class="title"><?=$product['name']?></td>
                <td>
                    <span class='hidden' id='pid'><?=$pid?></span>
                    <span class='hidden' id='uid'><?=$uid?></span>
                </td>
            </tr>
            <tr class="contain">
                <td class="sub_title">品項:</td>
                <td class="kind"><?=$product['kind']?></td>
            </tr>
            <tr class="contain">
                <td class="sub_title">售價:</td>
                <td class="price"><?=$product['price']?>元</td>
            </tr>
        </table>
        <button class="detail" onclick="location='view/product.php?pid=<?=$pid?>';">Details</button>
        <button class="add">Add to cart</button>
    </fieldset>
    <?php endforeach;?>
<?php else :?>
    <h2>No matching search results!</h2>
<?php endif;?>
</div>

<div class="login_form hidden">
    <fieldset>
        <h1 class="formTitle">Login Info</h1>    
        <h2 class="formSubtitle">The info will be used to login!</h2>
        <input id='user_name' type="text" placeholder="UserID" name="user"/>
        <input id='user_pw' type="password" placeholder="PassWord" name="pw"/>
        
        <input type="button" class="login_btn" value="Sumbit"/>
    </fieldset>
</div>

    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="asset/js/all.js"></script>
</body>
</html>