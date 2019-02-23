<?php
    include "1.linkDB.php";
    $type = isset($_GET["type"])?$_GET["type"]:"auto";
    $page = isset($_GET["page"])?$_GET["page"]:1;
    $qty = isset($_GET["qty"])?$_GET["qty"]:4;
    $pageIdx = ($page-1)*$qty;

    //查询数据库有多少条信息
    $sqlAll = "select * from index_goodslist2";
    $conAll = $conn->query($sqlAll);
    $resAll = $conAll->fetch_all(MYSQLI_ASSOC);
    $len = $conAll->num_rows;

    if($type=="auto"){
        $sql = "select * from index_goodslist2 limit $pageIdx,$qty";
    }else if($type=="up"){//排序
        $sql = "select * from index_goodslist2 order by price limit $pageIdx,$qty";
    }else if($type=="down"){
        $sql = "select * from index_goodslist2 order by price desc  limit $pageIdx,$qty";
    }
    $con = $conn->query($sql);
    $res = $con->fetch_all(MYSQLI_ASSOC);
    $arr = array(
        "res"=>$res,
        "len"=>$len,
        "pageIdx"=>$pageIdx,
        "qty"=>$qty,
        "page"=>$page,
    );
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    
?>