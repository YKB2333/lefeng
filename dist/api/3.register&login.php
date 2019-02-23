<?php
    include "1.linkDB.php";
    $type = isset($_POST["type"])?$_POST["type"]:"";
    $username = isset($_POST["username"])?$_POST["username"]:"";
    $psw = isset($_POST["psw"])?$_POST["psw"]:"";
    $reg = isset($_POST["reg"])?$_POST["reg"]:"";
    $user_sql = "select * from users where username='$username'";
    $user_res = $conn->query($user_sql);
    $user_cont = $user_res->fetch_all(MYSQLI_ASSOC);
    //查询数据库的这个名字的数组是不是存在

    if($type=="register"){
        $arr = array();
        if(empty($user_cont)){
            // var_dump($user_cont);
            $arr["result"] = 2;
            $arr["message"] = "该用户名可以注册";
            
            
        }else{
            $arr["result"] = 0;
            $arr["message"] = "用户名已存在";
        }
        if($psw){
            $arr["result"] = 2;
            $arr["message"] = "该密码可以注册";
        }
        if($reg){
            $reg_sql = "insert into users (username,password) values ('$username','$psw')";
            $reg_res=$conn->query($reg_sql);
            if ($reg_res) {
                $arr["result"] = 1;
                $arr["message"] = "注册成功";
             }
        }
    }else if($type=="login"){
        $arr = array();
        if(empty($user_cont)){//若用户名不存在
            $arr["result"] = 0;
            $arr["message"] = "用户名不存在";  
        }else{//若用户名存在
            $login_sql = "select * from users where username='$username'";
            $code_res=$conn->query($login_sql);
            $code_cont = $code_res->fetch_all(MYSQLI_ASSOC);
            if($code_cont[0]["password"]==$psw){//若密码相等
                $arr["result"] = 1;
                $arr["message"] = "成功登录";
                $uid = $code_cont[0]["uid"];
            }else{//若密码不相等
                $arr["result"] = 0;
                $arr["message"] = "密码错误";
                
            };
        }
    }
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
?>