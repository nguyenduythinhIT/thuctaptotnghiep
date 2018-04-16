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
<div class="content_left">
        <pre><a href="<?php echo base_url(); ?>backends">Trang Chủ</a></pre>
        <pre><a href="<?php echo base_url(); ?>backends/thongbao">Thông báo</a></pre>
        <pre><a href="<?php echo base_url(); ?>backends/danhmuc">Danh mục</a></pre>
        <pre><a href="<?php echo base_url(); ?>backends/sinhvien">Sinh Viên</a></pre>
        <pre><a href="<?php echo base_url(); ?>backends/canbo">Cán bộ</a></pre>
        <pre><a href="<?php echo base_url(); ?>backends/bangdanhgia">Đánh giá rèn luyện</a></pre>
        <pre><a href="<?php echo base_url(); ?>backends/ketqua">Kết quả đánh giá</a></pre>
        <pre><a href="<?php echo base_url(); ?>backends/phanquyen">Phân quyền</a></pre>
        <pre><a href="<?php echo base_url(); ?>backends/pages">Pages</a></pre>
        
</div>
<div class="content_right"> 
