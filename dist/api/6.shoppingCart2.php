<?php
    include "1.linkDB.php";
    $GLOBALS['id'] = isset($_GET["id"])?$_GET["id"]:"";
    $GLOBALS['qty'] = isset($_GET["qty"])?$_GET["qty"]:"1";
    $GLOBALS['type'] = isset($_GET["type"])?$_GET["type"]:"";

    

    if($type=="del"){
        $car_sql = "DELETE FROM shoppingcart where id=$id;";
        $conn->query($car_sql);
    }else{
        //查找购物车表中的商品
        $car_sql = "select * from shoppingcart where id=$id";
        $car_con = $conn->query($car_sql);
        $car_res = $car_con->fetch_all(MYSQLI_ASSOC);

        $list_sql = "select * from detailgoodslist where id=$id";
        $list_con = $conn->query($list_sql);
        $list_res = $list_con->fetch_all(MYSQLI_ASSOC);


        $curPri = $list_res[0]["curPri"];

        $allPri = mb_substr($curPri,1)*$qty;
        $keep_sql = "update shoppingcart set qty='$qty' where id='$id'";
        $keep_sql2 = "update shoppingcart set allPri='$allPri' where id='$id'";

        $conn->query($keep_sql);
        $conn->query($keep_sql2);
    }
?>