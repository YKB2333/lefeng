<?php
    include "1.linkDB.php";
    //location.href传id,到数据库获取详细信息,渲染
    $id = isset($_GET["id"])?$_GET["id"]:"";
    $sql = "select * from goodslist where id=$id";
    $con = $conn->query($sql);
    $res = $con->fetch_all(MYSQLI_ASSOC);
    echo json_encode($res,JSON_UNESCAPED_UNICODE);
?>