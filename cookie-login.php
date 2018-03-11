<?php
/**
 * Created by PhpStorm.
 * User: ZC
 * Date: 2018-3-7
 * Time: 12:03
 */
    $username=$_POST['username'];
    $password=$_POST['password'];
    @$auto=$_POST['auto'];
//1.初步验证用户名和密码是否为空，不为空继续进行，为空则跳转回登录页面
if ($_POST['username']==''||$_POST['password']==''){
    echo"<script>alert('用户名和密码不能为空！');window.location.href='index.html'</script>";
    exit();
}
//2.连接数据库
    try{
        $pdo=new PDO("mysql:host=localhost;dbname=cook",'root','azhang');
//        print_r($pdo);
    }catch(PDOException $e){
       die("连接数据库失败！".$e->getMessage());
    }
    $sql="SELECT * from cookie where username='{$username}' && password='{$password}'";
    $ro=$pdo->query($sql);
    $row=$ro->fetch(PDO::FETCH_ASSOC);//返回影响条数
    if($row){
        if($auto==1){
            echo $row['id'];
            setcookie('username',$username,time()+7*24*60*60);
            $change='zhang';
            $auth=md5($username.$password.$change).':'.$row['id'];
            setcookie('auth',$auth,time()+7*24*60*60);
        }else{
            setcookie('username',$username);
        }
        exit("<script>alert('登录成功，正在跳转到主页面！');window.location.href='main.php'</script>");
//        foreach ($pdo->query($sql) as $row) {
//            echo $row['username'];
//        }
    }
    else {
        echo"<script>alert('用户名或密码错误，请重新输入！');window.location.href='index.html'</script>";
    }
//setcookie($_POST['username'],$_POST['password'],time()+7*24*60*60);
