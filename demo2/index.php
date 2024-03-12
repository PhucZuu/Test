<?php
    session_start();
    if(isset($_SESSION['username'])){
        echo '<a href="logout.php"><button>LOGOUT</button></a>';
        echo '<a href="add.php"><button>ADD</button></a>';
        include_once('connect.php');
        $item_per_page=!empty($_GET['per_page'])?$_GET['per_page']:4;
        $current_page=!empty($_GET['page'])?$_GET['page']:1;
        $offset=($current_page-1)* $item_per_page;
        $sql="SELECT COUNT(tenThucPham) as soLuongDoAn from thucpham";
        $result=$connect->query($sql);
        $soLuong=$result->fetch(PDO::FETCH_ASSOC);
        $soLuongDoAn=$soLuong['soLuongDoAn'];
        // echo '<pre>';
        //         print_r($soLuong);
        $sql="SELECT id_ThucPham,tenThucPham,hinhAnh,thucpham.id_DanhMuc,danhmuc.tenDanhMuc,soLuong 
        FROM thucpham INNER JOIN danhmuc ON thucpham.id_DanhMuc=danhmuc.id_DanhMuc LIMIT $item_per_page OFFSET $offset";
        $result=$connect->query($sql);
        $totalPage=$soLuongDoAn/$item_per_page;
        $food='';
        if($result){
            $listFoods=$result->fetchAll(PDO::FETCH_ASSOC);
            if($listFoods){
                // echo '<pre>';
                // print_r($listFoods);
                foreach($listFoods as $key=>$val){
                    $food.='
                    <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$val['tenThucPham'].'</td>
                        <td><img style="width: 150px" src="uploads/'.$val['hinhAnh'].'" alt=""></td>
                        <td>'.$val['tenDanhMuc'].'</td>
                        <td>'.$val['soLuong'].'</td>
                        <td><a href="edit.php?id='.$val['id_ThucPham'].'"><button>EDIT</button></a></td>
                        <td><a onclick="return confirm(\'Ban co chac khong\')" href="delete.php?id='.$val['id_ThucPham'].'"><button>DELETE</button></a></td>
                    </tr>
                    ';
                }
            }
        }
    }else{
        echo '<a href="login.php"><button>LOGIN</button></a>';
    }


?>


<table border>
    <thead>
        <th>Số thứ tự</th>
        <th>Tên thực phẩm</th>
        <th>Hình ảnh sản phẩm</th>
        <th>Danh mục sản phẩm</th>
        <th>Số lượng trong kho</th>
    </thead>
    <tbody>
        <?php
            if(isset($_SESSION['username'])){
                echo $food;
            }else{
                echo '<h1>Bạn cần đăng nhập để xem sản phẩm</h1>';
            }
        ?>
    </tbody>
</table>
<?php
    if(isset($_SESSION['username'])){
        include "./phantrang.php";
    }
?>