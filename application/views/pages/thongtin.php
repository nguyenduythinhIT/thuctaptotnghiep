<?php
if($_SESSION['id']=="")
{
    ?>
    <p style='color:red;font-weight:bold;text-align:center'>
    HÃY ĐĂNG NHẬP TRƯỚC KHI THỰC HIỆN THAO TÁC NÀY</p>
    <?php 
}
else{
    if($_SESSION['role']==1)
    {
        $student=new student_model();
        $student->show($_SESSION['id']);
        $student->changePass($_SESSION['id']);
    }
    else
    {
        $staff=new staff_model();
        $staff->show($_SESSION['id']);
        $staff->changePass($_SESSION['id']);
    }
}
?>