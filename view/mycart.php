<?php
//RFish 2014
include_once('../function/configDB.php');
//include_once('../function/lock.php');
session_start();

if(isset($_SESSION['user_id'])) {

    $userID = $_SESSION['user_id'];

    $sql = "SELECT product.`pid` , product.`name`,product.`price`,cart.`nums` FROM `cart` left join `product` on cart.`pid` = product.`pid` where `uid`='".$userID."'";
    $result = mysql_query($sql);
    $rows = mysql_num_rows($result);
    $no_data_flag = false;

    if($result) {
        if($rows == 0){ // No data in the cart
            $no_data_flag = true;
        } else {
            $no_data_flag = false;
            $index = 0;
            while($row = mysql_fetch_array($result)) {
                //$form[$index]['pid'] = $row["pid"];
                //$form[$index]['name'] = $row["name"];
                //$form[$index]['price'] = $row["price"];
                //$form[$index]['nums'] = $row["nums"];
                $form[$index] = $row;
                $index += 1;
            }
        }
    }

} else {
    echo '<script>alert("Please Login First! Back to ProductList!");</script>';
    echo' <script>document.location.href="../productList.php";</script>' ;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Shopping Cart</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <button class="go_list" onclick="location='../productList.php';">Go to ProductList</button>

    <h1>My Cart</h1>
    <hr/>
    <div>
        <table class="cart_table">
            <tr class="title">
                <td class="title">商品名稱</td>
                <td class="title">價格(NTD)</td>
                <td class="title">數量</td>
            </tr>
            
            <?php if($no_data_flag):?>
                <tr class="title">
                    <td class="title" colspan="3">No DATA!</td>    
                </tr>
            <?php else: ?>
                <?php foreach($form as $product):?>
                <tr class="buy_row">
                    <td class="name"><?=$product['name']?></td>
                    <td class="price" ><?=$product['price']?>元</td>
                    <td>
                        <select class="num">
                            <?php for($value=1; $value <=10; $value++): ?>
                                <?php if($value == $product['nums'] ):?>                
                                    <option value=<?=$value?> selected="selected"><?=$value?></option>
                                <?php else: ?>                
                                    <option value=<?=$value?>><?=$value?></option>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td class="del_btn">
                        <button id="delete">Delete</button>
                    </td>
                    <td>
                        <span id='edit_hint' class='hidden'>選取欲修改的數量</span>
                        <span id='uid' class='hidden'><?=$userID?></span>
                        <span id='pid' class='hidden'><?=$product['pid']?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
    <br/>
    <p>
        <h2>總計:
            <label class="total">0</label> NTD
        </h2>
    </p>
    <button>next</button>
    
    
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="../asset/js/all.js"></script>
</body>
</html>