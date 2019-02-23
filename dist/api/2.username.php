<?php
    include "1.linkDB.php";
    $username = isset($_GET["username"])?$_GET["username"]:"";
    $sql = "select * from users where username='$username'";
    $res = $conn->query($sql);
    $cont = $res->fetch_all(MYSQLI_ASSOC);
    //查询数据库的这个名字的数组是不是存在
    if(empty($cont)){
        echo 0;
    }else{
        echo 1;
    }
?>
