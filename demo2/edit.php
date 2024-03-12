<?php
    include_once('connect.php');
    $id='';
    $tenThucPham='';
    $hinhAnh='';
    $id_DanhMuc='';
    $soLuong='';

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        if($id){
            $sql="SELECT * FROM thucpham WHERE id_ThucPham=$id";
            $result=$connect->query($sql);
            if($result){
                $food=$result->fetch(PDO::FETCH_ASSOC);
                if($food){
                    // echo '<pre>';
                    // print_r($food);
                    $tenThucPham=$food['tenThucPham'];
                    $hinhAnh=$food['hinhAnh'];
                    $id_DanhMuc=$food['id_DanhMuc'];
                    $soLuong=$food['soLuong'];
                }
            }
        }
    }
    if(isset($_POST['submit'])){
        $id=$_POST['id'];
        $tenThucPham=$_POST['tenThucPham'];
        $hinhAnh=$_FILES['hinhAnh'];
        $id_DanhMuc=$_POST['id_DanhMuc'];
        $soLuong=$_POST['soLuong'];

        $filename=$hinhAnh['name'];
        if($filename){
            $filename=time().$filename;
            $dir='uploads/'.$filename;
            if(move_uploaded_file($hinhAnh['tmp_name'],$dir)){
                $sql="UPDATE thucpham SET 
                tenThucPham='$tenThucPham',
                hinhAnh='$filename',
                id_DanhMuc='$id_DanhMuc',
                soLuong='$soLuong' WHERE id_ThucPham=$id";
            }
        }else{
            $sql="UPDATE thucpham SET 
            tenThucPham='$tenThucPham',
            id_DanhMuc='$id_DanhMuc',
            soLuong='$soLuong' WHERE id_ThucPham=$id";
        }
        $result=$connect->query($sql);
        if($result){
            header('Location: index.php');
        }else{
            echo 'ERROR';
        }
    }
?>
<form action="edit.php" method='post' enctype="multipart/form-data">
    <input type="hidden" name='id' value='<?= $id?>'>
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
                    $opt.='<option '.($id_DanhMuc==$val['id_DanhMuc']? 'selected':'').' value="'.$val['id_DanhMuc'].'">'.$val['tenDanhMuc'].'</option>';
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