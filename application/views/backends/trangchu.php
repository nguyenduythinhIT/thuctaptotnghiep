<?php 
$role=new role_model();
$rolename=$role->searchbyID($_SESSION['role']);
$role_page=new role_page_model();
?>
<p style='width:90%;margin:10px auto;'> XIN CHÀO 
    <b class='text-danger'><?php echo $_SESSION['name']; ?></b></p>
<p style='width:90%;margin:10px auto;'>BẠN LÀ 
    <b class='text-primary'><?php if(count($rolename)>0) echo $rolename[0]['name']?></b></p>