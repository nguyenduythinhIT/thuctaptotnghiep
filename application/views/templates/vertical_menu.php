<style>
.content_left{
    width:198px;
    background:rgb(51,122,183);
    color:white;
    text-align:left;
    padding:0;
    margin-left:5px;
    margin-bottom:20px;
    border:1px solid grey;
    border-radius:3px;
    float:left;
}
.content_right{
    min-height:300px;
    width:calc(100% - 210px);
    color:black;
    text-align:left;
    padding:0;
    margin-left:5px;
    float:left;
}
.content_right pre{
    background:rgb(52,122,187);
    margin:0;
    font-size:16px;
    color:white;
}
.content_left pre{
    background:rgb(52,122,187);
    margin:0;
    font-size:16px;
}
.content_left pre:hover{
    background:rgb(92,162,227);;
}
.content_left pre a{
    display:block;
    text-decoration:none;
    color:white;
}
@media screen and (max-width: 800px){
    .content_left{
        float:none;
        width:90%;
        margin:10px auto;
    }
    .content_right{
        float:none;
        width:99%;
        margin:10px auto;
    }
}
</style>
<?php $role_page=new role_page_model();?>
<div class="content_left">
<?php if($role_page->searchRolePages($_SESSION['role'],"trangchu") || $_SESSION['role']==0){ ?><pre><a href="<?php echo base_url(); ?>backends">Trang Chủ</a></pre><?php } ?>
<?php if($role_page->searchRolePages($_SESSION['role'],"thongbao") || $_SESSION['role']==0){ ?><pre><a href="<?php echo base_url(); ?>backends/thongbao">Thông báo</a></pre><?php } ?>
<?php if($role_page->searchRolePages($_SESSION['role'],"danhmuc") || $_SESSION['role']==0){ ?><pre><a href="<?php echo base_url(); ?>backends/danhmuc">Danh mục</a></pre><?php } ?>
<?php if($role_page->searchRolePages($_SESSION['role'],"sinhvien") || $_SESSION['role']==0){ ?><pre><a href="<?php echo base_url(); ?>backends/sinhvien">Sinh Viên</a></pre><?php } ?>
<?php if($role_page->searchRolePages($_SESSION['role'],"canbo") || $_SESSION['role']==0){ ?><pre><a href="<?php echo base_url(); ?>backends/canbo">Cán bộ</a></pre><?php } ?>
<?php if($role_page->searchRolePages($_SESSION['role'],"bangdanhgia") || $_SESSION['role']==0){ ?><pre><a href="<?php echo base_url(); ?>backends/bangdanhgia">Đánh giá rèn luyện</a></pre><?php } ?>
<?php if($role_page->searchRolePages($_SESSION['role'],"ketqua") || $_SESSION['role']==0){ ?><pre><a href="<?php echo base_url(); ?>backends/ketqua">Kết quả đánh giá</a></pre><?php } ?>
<?php if($role_page->searchRolePages($_SESSION['role'],"phanquyen") || $_SESSION['role']==0){ ?><pre><a href="<?php echo base_url(); ?>backends/phanquyen">Phân quyền</a></pre><?php } ?>
<?php if($role_page->searchRolePages($_SESSION['role'],"pages") || $_SESSION['role']==0){ ?><pre><a href="<?php echo base_url(); ?>backends/pages">Pages</a></pre><?php } ?>
        
</div>
<div class="content_right"> 
