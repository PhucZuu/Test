<?php
include_once('connect.php');
    $tenThucPham='';
    $hinhAnh='';
    $id_DanhMuc='';
    $soLuong='';
    if(isset($_POST['submit'])){
        $tenThucPham=$_POST['tenThucPham'];
        $hinhAnh=$_FILES['hinhAnh'];
        $id_DanhMuc=$_POST['id_DanhMuc'];
        $soLuong=$_POST['soLuong'];

        $filename=$hinhAnh['name'];
        $filename=time().$filename;
        $dir='uploads/'.$filename;
        if(move_uploaded_file($hinhAnh['tmp_name'],$dir)){
            $sql="INSERT INTO thucpham(tenThucPham,hinhAnh,id_DanhMuc,soLuong) 
            VALUES ('$tenThucPham','$filename','$id_DanhMuc','$soLuong')";
            $result=$connect->query($sql);
            if($result){
                header('Location: index.php');
            }else{
                echo 'ERROR';
            }
        }
    }
?>
<form action="add.php" method='post' enctype="multipart/form-data">
    <label for="">tenThucPham</label>
    <input type="text" name='tenThucPham' value="<?= $tenThucPham?>"><br>
    <label for="">hinhAnh</label>
    <input type="file" name='hinhAnh' value="<?= $hinhAnh?>"><br>
    <label for="">DanhMuc</label>
    <select name="id_DanhMuc" id="">
    <?php
        $sql="SELECT * FROM danhmuc";
        $result=$connect->query($sql);
        $opt='';
        if($result){
            $listDM=$result->fetchAll(PDO::FETCH_ASSOC);
            if($listDM){
                foreach($listDM as $val){
                    $opt.='<option value="'.$val['id_DanhMuc'].'">'.$val['tenDanhMuc'].'</option>';
                }
            }
        }
        echo $opt;
    ?>
        
    </select><br>
    <label for="">soLuong</label>
    <input type="text" name='soLuong' value="<?= $soLuong?>"><br>
    <input type="submit" name='submit'>
</form>