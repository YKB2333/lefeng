<?php
    include "1.linkDB.php";
    $GLOBALS['type'] = isset($_GET["type"])?$_GET["type"]:"all";
    if($type=="all"){
        $car_sql = "select * from shoppingcart";
        $car_con = $conn->query($car_sql);
        // echo 666;
        $car_res = $car_con->fetch_all(MYSQLI_ASSOC);
        if(empty($car_res)){
            echo "0";
        }else{
            echo json_encode($car_res,JSON_UNESCAPED_UNICODE);
        }
    }else if($type=="one"){
        $GLOBALS['id'] = isset($_GET["id"])?$_GET["id"]:"";
        $GLOBALS['qty'] = isset($_GET["qty"])?$_GET["qty"]:"1";
        //查找购物车表中的商品
        $car_sql = "select * from shoppingcart where id=$id";
        $car_con = $conn->query($car_sql);
        $car_res = $car_con->fetch_all(MYSQLI_ASSOC);
        $list_sql = "select * from detailgoodslist where id=$id";
        $list_con = $conn->query($list_sql);
        $list_res = $list_con->fetch_all(MYSQLI_ASSOC);
        if(empty($car_res)){
            //获取id说在商品信息
            
            $title = $list_res[0]["title"];
            $curPri = $list_res[0]["curPri"];
            $oldPri = $list_res[0]["oldPri"];
            $imgurl = $list_res[0]["imgurl"];
            $allPri = mb_substr($curPri,1);

            //存入购物车
            $keep_sql = "insert into shoppingcart (id,title,qty,curPri,oldPri,imgurl,allPri) values ('$id','$title','$qty','$curPri','$oldPri','$imgurl','$curPri')";
            $conn->query($keep_sql);
        }else{
            $curPri = $list_res[0]["curPri"];
            $qty = $car_res[0]["qty"]*1+$qty;
            $allPri = mb_substr($curPri,1)*$qty;
            
            $keep_sql = "update shoppingcart set qty='$qty' where id='$id'";
            $keep_sql2 = "update shoppingcart set allPri='$allPri' where id='$id'";
            $conn->query($keep_sql);
            $conn->query($keep_sql2);
        }
        echo "加入购物车成功";
    }
    
?>