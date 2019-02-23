<?php
    include "1.linkDB.php";
    $type = isset($_GET["type"])?$_GET["type"]:"auto";
    $page = isset($_GET["page"])?$_GET["page"]:1;
    $qty = isset($_GET["qty"])?$_GET["qty"]:4;
    $keyword = isset($_GET["keyword"])?$_GET["keyword"]:"";
    $id = isset($_GET["id"])?$_GET["id"]:"";
    $pageIdx = ($page-1)*$qty;

    //判断keyword,没有时默认全部,有时显示特定类目的商品
    //查询数据库有多少条信息
    $sqlAll = "select * from detailgoodslist";
    $conAll = $conn->query($sqlAll);
    $resAll = $conAll->fetch_all(MYSQLI_ASSOC);
    $len = $conAll->num_rows;

    //如果点击在售,查询另一个表,没做
    if($type=="auto"){
        $sql = "select * from detailgoodslist limit $pageIdx,$qty";
    }else if($type=="up"){//排序
        $sql = "select * from detailgoodslist order by price limit $pageIdx,$qty";
    }else if($type=="down"){
        $sql = "select * from detailgoodslist order by price desc  limit $pageIdx,$qty";
    }else if($type=="qtydown"){
        $sql = "select * from detailgoodslist order by oldPri desc  limit $pageIdx,$qty";
    }else if($type=="detail"){
        $sql = "select * from detailgoodslist where id=$id";
    }

    $con = $conn->query($sql);
    $res = $con->fetch_all(MYSQLI_ASSOC);
    $arr = array(
        "page"=> $page,
        "qty" => $qty,
        "len" => $len,
        "res" => $res
    );
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);

    //需要关闭一切内容,还没做
?>