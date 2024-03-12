<?php
    session_start();
    if(isset($_SESSION['username'])){
        unset($_SESSION['username']);
        header('Location: index.php');
    }else{
        echo 'Ban van chua dang nhap <a href="login.php"><button>LOGIN</button></a>';
    }
?>

