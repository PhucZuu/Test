<?php
    include_once('connect.php');
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        if($id){
            $sql="SELECT * FROM thucpham WHERE id_ThucPham=$id";
            $result=$connect->query($sql);
            if($result){
                $food=$result->fetch(PDO::FETCH_ASSOC);
                if($food){
                    $sql="DELETE FROM thucpham WHERE id_ThucPham=$id";
                    $result=$connect->query($sql);
                    if($result){
                        header('Location: index.php');
                    }else{
                        echo 'ERROR';
                    }
                }
            }
        }
    }
?>