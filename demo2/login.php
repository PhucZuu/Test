<?php
    session_start();
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $pass=$_POST['pass'];
        if($username=='admin' && $pass=='123456'){
            $_SESSION['username']=$username;
            header('Location: index.php');
        }else{
            echo 'Tai khoan hoac mat khau khong chinh xac';
        }
    }
?>
<form action="login.php" method='post'>
    <label for="">UserName</label>
    <input type="text" name='username'>
    <label for="">Pass</label>
    <input type="password" name='pass'>
    <input type="submit" name="submit" id="">
</form>