<?php
/**
 * Created by PhpStorm.
 * User: ZC
 * Date: 2018-3-7
 * Time: 12:29
 */
//1.判断是否保存COOKIE
if(!isset($_COOKIE['username'])||!isset($_COOKIE['auth'])){
    echo "<script>alert('请先登录！');window.location.href='index.html'</script>";
}
//2.拆分令牌，与库中id对比
$auth=$_COOKIE['auth'];
$autharr=explode(':',$auth);
$userid=end($autharr);
//3.连接数据库
try{
    $pdo=new PDO("mysql:host=localhost;dbname=cook",'root','azhang');
}catch (PDOException $e){
    die('连接数据库失败！'.$e->getMessage());
}

$sql="select * from cookie where id='{$userid}'";
//$sql="SELECT * from cookie where username='{$username}' && password='{$password}'";
$ro=$pdo->query($sql);
$row=$ro->fetch(PDO::FETCH_ASSOC);
//echo $row['username'];
//foreach ($pdo->query($sql) as $row){
//    echo  $row['id'];
//}
//4.判断令牌是否匹配成功
if($_COOKIE['username']=$row['username'] && $userid=$row['id']){
//        var_dump($autharr);
//    $sal='king';
//    $auth1=md5()
    $username=$row['username'];
    $password=$row['password'];
    $u='zhang';
    $auth1=md5($username.$password.$u);
    if($auth1!=$autharr[0]){
        echo "<script>alert('请先登录！');window.location.href='index.html'</script>";
    }
}
else{
    echo "<script>alert('请先登录！');window.location.href='index.html'</script>";
}
?>
<!DOCTYPE html>
<head>
    <title>欢迎登录</title>
</head>
<body>
<h1>欢迎登录JD<h1>
        <table>
            <tr><td>热门</td>&nbsp;<td>技术</td><td>欢迎用户<?php echo $row['username'];?></td></tr>
<!--            <tr><td>技术</td></tr>-->
<!--            <tr><td>欢迎用户--><?php //echo $row['username'];?><!--</td></tr>-->


        </table>
</body>
</html>