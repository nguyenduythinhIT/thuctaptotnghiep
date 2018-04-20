<?php
if($_SESSION['id']=="")
{
    ?>
    <p style='color:red;font-weight:bold;text-align:center'>HÃY ĐĂNG NHẬP TRƯỚC KHI THỰC HIỆN THAO TÁC NÀY</p>
<?php 
}
else{
    if($_SESSION['role']==1 || $_SESSION['role']==2)
    {
        $result=new evaluation_form_model();
        $result->formdanhgia($_SESSION['id']);
    }
    else
    {
        ?>
    <p style='color:red;font-weight:bold;text-align:center'>BẠN THÔNG THỂ THỰC HIỆN THAO TÁC NÀY</p>
        <?php
    }
}
?>