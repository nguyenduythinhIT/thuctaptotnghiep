<style>
.navbar-right{
    margin-top:-10px;

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
if(!isset($_SESSION['id'])) $_SESSION['id']='';
if(!isset($_SESSION['error'])) $_SESSION['error']='';
if($_SESSION['id']=="")
{
?>
<form id="signin" class="navbar-form navbar-right" role="form" method="post" action="dangnhap">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="username" type="text" class="form-control" name="username" value="" placeholder="ID">                                        
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" value="" placeholder="Password">                                        
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                   </form>
<?php
}
else{
?>
                   <p>
                    <?php if(isset($_SESSION['id'])) echo "Xin chào :".$_SESSION['id'];?> 
                    <a href="Form/logout"><button style="color:black">Đăng xuất</button></a>
                   </p>
                   
<?php 
}
?>
</div>
