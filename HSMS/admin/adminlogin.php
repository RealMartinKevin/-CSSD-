<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>登录界面</title>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        h3{
            display: block;
            width: 100%;
            height: 50px;
            text-align: center;
            line-height: 10px;
            background-color: cornflowerblue;
            cursor: move;
        }
        #login{
            width: 500px;
            height: 400px;
            margin: 0 auto;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -250px;
            margin-top: -140px;
            border: 1px solid #6495ED;
            background-color: #FFFFFF;
            display: block;
            -moz-user-select: none;
            -ms-user-select: none;
            -webkit-user-select: none;
        }
        table{
            margin-top: 50px;
            position: absolute;
            top: 50px;
            left: 0;
            width: 100%;
            height: 150px;
            text-align:center;
        }
        tr,td{
            border: none;
        }
        tr{
            height: 50px;
        }
        td{
            padding: 0 5px 0 5px;
        }
        #bg{
            width: 100%;
            height: 100%;
            background-color:rgba(0,0,0,0.2);
            position: absolute;
            top: 0;
            left: 0;
        }
        span{
            width: 100px;
            height: 16px;
            display:block;
            margin-bottom: 12px;
        }
        body{
            width: 100%;
            height: 100%;
        }
        .inpt{
            width: 300px;
            height: 30px;
            outline: none;
            border: 1px solid darkturquoise;
        }
        .red{
            color: red;
            font-size: 12px;
        }
        .btn{448
        outline: none;
            width: 60px;
            height: 25px;
            border: 1px solid #00CED1;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../css/js/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(function checkuserid() {
            //给用户名输入框绑定 失去焦点事件blur
            $("#user").blur(function () {
                //获取文本框的值
                var user = $(this).val();

                //发送ajax请求。期望返回数据：{"usermsg":true,"msg":"用户名已存在"}；{"usermsg":false,"msg":"该用户名可用"}
                $.post("checkuserid.php",{username:user},
                    function (data) {
                        //获取s_username元素
                        var user = $("#user");
                        //判断usermsg值
                        if (data.usermsg==1){
                            //用户名存在

                            var txt=(data.result);
                            document.getElementById("usernameid").value=txt;


                        }else {
                            //用户名不存在
                            var txt="用户不存在,请核对工号或与管理员联系";
                            document.getElementById("usernameid").value=txt;
                        }
                    },"json");
            });
        });








        $(function () {
            // 定义变量
            var $mX;
            var $mY;
            var $move = true; // true是可以移动登录框
            // 鼠标按下事件
            $("h3").mousedown(function (event) {
                $("#login").css("opacity",0.5); // 改变透明度
                $move = true;
                // 得到鼠标与登录框原点之间的距离
                $mX = event.pageX-parseInt($("#login").css("left"));
                $mY = event.pageY-parseInt($("#login").css("top"));
            })
            // 鼠标移动事件
            $(document).mousemove(function (event) {
                // 得到登录框要移动的量
                var x = (event.pageX-$mX);
                var y = (event.pageY-$mY);
                console.log(x,y)
                if($move){
                    if(x>0&&y>0){
                        $("#login").css("left",x+"px")
                        $("#login").css("top",y+"px")
                    }

                }
            }).mouseup(function () {
                // 鼠标弹起事件
                $move = false;
                $("#login").css("opacity",1);
            })

//				异步请求
            $(":submit").click(function () {
                $.ajax({
                    type:"post",
                    url:"logincheck.php",
                    data:{"name":$("#user").val(),"password":$("#pwd").val()},
                    dataType:"json",
                    success:function (data) {
                        console.log("成功：",data);
                        /*if (data.usermsg==1&&data.pwdmsg==1) {
                            $(location).prop("href","index.php");
                        } else{
                            $("span").text("用户名或密码错误").prop("class","red");
                        }*/
                        if (data.usermsg==1&&data.pwdmsg==1) {
                            $(location).prop("href","index.php");
                        } else if(data.usermsg==0&&data.pwdmsg==0){
                            $("span").text("用户名或密码错误").prop("class","red");
                        } else if(data.usermsg==0&&data.pwdmsg==1){
                            $("span").text("该用户不存在").prop("class","red");
                            var txt="该用户不存在";
                            document.getElementById("usernameid").value=txt;
                        } else if(data.usermsg==1&&data.pwdmsg==0){
                            $("span").text("密码错误").prop("class","red");
                        }
                    },
                    error:function (err) {
                        console.log("失败",err);
                    }
                })
            })
            $(":reset").click(function () {
                $("span").text("");
            })

        })
    </script>

</head>
<body>
<div style="background-color: black" id="bg"></div>
<form action="javascript:;" id="login" method="post">
    <h3 a>供应室管理系统&nbsp后台登录</h3>
    <h6 align="center" style="color: red">请不要使用IE8以下版本的浏览器</h6>
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="right">工号：</td>
            <td align="left"><input type="text" class="inpt" id="user" name="userName" placeholder="请输入您的工号"/></td>
        </tr>

        <tr>
            <td align="right">姓名：</td>
            <td align="left"><input style="cursor: not-allowed" disabled type="text" class="inpt" id="usernameid" name="userNameid" disabled='disabled' placeholder="请输入工号，姓名将自动显示"/></td>
        </tr>

        <tr>
            <td align="right">密&nbsp&nbsp&nbsp码：</td>
            <td align="left"><input type="password" class="inpt" id="pwd" name="pwd" placeholder="请输入您的密码"/></td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <span></span>
                <a href="https://baidu.com">Chrome浏览器</a>&nbsp&nbsp&nbsp&nbsp
                <a href="../index/login.php">前台登录</a><br>
                <input type="submit" class="btn-sm btn-info" value="提交"/>
                &nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="reset" class="btn-sm btn-danger" value="重置"/>

            </td>
        </tr>
    </table>
</form>

</body>
<script src="../css/js/jquery-3.5.1.js"></script>
</html>

