<div class='text-danger' style='width:80%;margin:10px auto'>
*Chú ý:<br>
-Administrator, Sinh viên, Đại diện lớp, Cố vấn học tập là những phân quyền cơ bản không thể thay đổi.
</div>
<?php
$role=new role_model();
$role->addform();
$role->showall();
?>
