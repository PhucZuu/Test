<?php
    $localhost = 'localhost';
    $databaseName ='db_doan';
    $username='root';
    $password='';
    $connect= new PDO("mysql:host=$localhost;dbname=$databaseName", $username, $password);
    if($connect){
        // echo "Kết nối thành công";
        
    }else{
        echo "Kết nối thất bại";
    }
?>