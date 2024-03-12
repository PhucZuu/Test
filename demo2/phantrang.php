<?php
    $trang='';
    for($i=1;$i<=$totalPage;$i++){
            $trang.='<a class="page_item" href="index.php?per_page='.$item_per_page.'&page='.$i.'">'.$i.'</a>';
    }
?>
<style>
    .page_item{
        text-decoration: none;
        font-size: 25px;
        color: black;
        border: solid 1px black;
        border-radius: 5px;
        padding: 5px 10px;
    }
</style>
<?= $trang;?>
