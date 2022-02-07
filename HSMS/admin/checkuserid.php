<?php
$username=$_POST["username"];
$usermsg="0";


// 创建连接
$db=@new mysqli('127.0.0.1','root','123456','supply','3306');
if ($db->connect_error)
    die('链接错误: '. $db->connect_error);
$db->select_db('supply') or die('不能连接数据库');
mysqli_query($db,"set names 'utf8'");

$sql="select username from su_adminuser where userid='$username'";
$result = $db->query($sql);

$row = mysqli_fetch_array($result);


    $num_users = $result->num_rows;
    if ($num_users != 0) {//搜索到该用户
        $usermsg = 1;

    }


    echo json_encode(array("usermsg" => $usermsg, "result" => $row['username']));


    mysqli_close($db);


    /*
    $sql="select username from su_user where userid='$username'";
    $result = $db->query($sql);
     $num_users = $result->num_rows;//在数据库中搜索到符合的用户
        if ($num_users != 0) {//搜索到该用户
            $usermsg = 1;

            while ($row=mysqli_fetch_assoc($result)){
            }

        }


        echo json_encode(array("usermsg" => $usermsg,"result"=>$result));

    /*
    $user = "admin";
    $password = "1234321";
    $username = $_GET["name"];
    $pwd = $_GET["password"];
    $usermsg = 0;
    $pwdmsg = 0;
    if ($user == $username) {
        $usermsg = 1;
    }
    if ($password == $pwd) {
        $pwdmsg = 1;
    }
    echo json_encode(array("usermsg" => $usermsg, "pwdmsg" => $pwdmsg));
    */
?>