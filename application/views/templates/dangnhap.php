<style>
.navbar-right{
    margin-top:-15px;

}
#signin {
    float:right;
}
#login p{
    float:right;
    color:red;
}
</style>

<div id="login">
<?php 
if(!isset($_SESSION['id'])) $_SESSION['id']="";
if(!isset($_SESSION['error'])) $_SESSION['error']='';
if(!isset($_SESSION['role'])) $_SESSION['role']='-1';
if($_SESSION['id'] == "")
{
?>

<form id="signin" class="navbar-form navbar-right" role="form" method="post" action="<?php echo base_url(); ?>dangnhap">
    <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
       <input id="username" type="text" class="form-control" name="username" value="" placeholder="Tài khoản">                                        
    </div>

    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
       <input id="password" type="password" class="form-control" name="password" value="" placeholder="Mật khẩu">                                        
    </div>
    <button type="submit" class="btn btn-primary">Đăng nhập</button>
</form>
<p>
    <?php echo $_SESSION['error'];?> 
</p>
<?php
}
else{
?>
    <p>
    <?php if(isset($_SESSION['id'])) echo "Xin chào :".$_SESSION['name']." - Mã số:".$_SESSION['id'];?> 
    <a href="<?php echo base_url();?>Form/logout"><button class='btn btn-primary' style="color:black">Đăng xuất</button></a>
    <?php

        $role_page=new role_page_model();
        if($_SESSION['role']==0 || $role_page->searchRolePages($_SESSION['role'],"backends"))
        {
            ?><a href="<?php echo base_url()?>backends"><button class='btn btn-danger' style="color:black">Trang quản lí </button></a><?php
        } 
    ?>
    </p>
                   
<?php 
}
?>
</div>
<br style="clear:both">
<div style="width:100%;border:1px solid #BBB;background:#EEE;border-radius:5px;min-height:300px;">
