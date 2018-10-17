<?php
    $username = $_GET["username"];
    $pass = $_GET["password"];
    // 传入的用户名，如果存在,判断密码是否正确，如果正确，提示登录成功(跳转页面);
    // 如果用户名不存在，在数据中默认添加用户, 跳转页面
    // 如果用户名存在，密码错误，提示密码错误，且回到登录页面

    // 当查找用户名，查询成功后，我们只需要用户的密码做验证，其他信息不需要，所以只查询密码字段
    $sql = "select password from shop_user WHERE username = '$username'";
    $insertSql = "insert into shop_user (username, password, mark) values ('$username', '$pass', '网站自动注册')";
    // 连接数据库
    $coon = new mysqli('localhost', 'root', '', 'shop', '3306');
    // 设置字符集
    $coon -> query("set names 'utf8'");
    $coon -> query("set character set 'utf8'");
    // 执行sql语句
    $result = $coon -> query($sql);

    // 查找第一条数据
    // 找到返回关联数组， 找不到返回null
    $rows = $result -> fetch_assoc();
    if($rows) {
        //  用户名已经存在
        if($rows["password"] === $pass) {
            // 密码正确
            // header("Location: manager.html");

           echo "<script>
            location.href = 'manager.html?username=$username';
            </script>";
        } else {
            echo "<script>
            alert('密码输入错误');
            location.href = 'login.html';
            </script>";
        }
    } else {
        //  用户名不存在
    }



?>