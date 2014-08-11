<?php
//RFish 2014
//include_once('configDB.php');
session_start();

if ( !isset($_SESSION['user_id']) ) {
    echo '<script>alert("Please 2 Login First! Back to ProductList!");</script>';
    echo' <script>document.location.href="../productList.php";</script>' ;
    //header("Location: ../productList.php");
}


