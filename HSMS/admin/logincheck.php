<?php
$username=$_POST["name"];
$pwd=$_POST["password"];
$usermsg=0;
$pwdmsg=0;
$result;


// 创建连接
$db=@new mysqli('127.0.0.1','root','123456');
if ($db->connect_error)
    die('链接错误: '. $db->connect_error);
$db->select_db('supply') or die('不能连接数据库');
$sql = 'SELECT * FROM su_adminuser WHERE userid='."'{$username}'AND password="."'$pwd';";
    $result = $db->query($sql);
    $num_users = $result->num_rows;//在数据库中搜索到符合的用户
    if ($num_users != 0)
    {//搜索到该用户
        $usermsg = $pwdmsg = 1;
        setcookie("username", "$username", time() + 60 * 1000);
    }



echo json_encode(array("usermsg"=>$usermsg,"pwdmsg"=>$pwdmsg));

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
