<?php
$role=new role_model();
$rolename=$role->searchbyID($id);

$role_page=new role_page_model();
$page=new page_model();
$list_page=$page->getall();
$arr_page=array();
foreach($list_page as $k=>$v)
{
    $arr_page[]=$v['name'];
}
?>
<pre style='margin:10px auto; width:80%;' class='text-primary'><?php echo $rolename[0]['name'];?>: Phân quyền</pre>
<?php
if($id==0)
{
    echo "<p style='width:80%;margin:10px auto' class='text-danger'><b>Administrator không thể tùy chỉnh phân quyền</b></p>";
}
else if($id==1)
{
    echo "<p style='width:80%;margin:10px auto' class='text-danger'><b>Sinh viên     không thể tùy chỉnh phân quyền</b></p>";
}
else{
    ?>
        <table class='table' style='width:80%;margin:10px auto;'>
        <tr><th style='width:30%'>Tên trang</th><th style='width:40%'>Chức năng</th><th style='width:30%'>Thao tác</th></tr>
        </table>
        <?php
            foreach($list_page as $k => $v)
            {
            ?>
                <form method='post' action="<?php echo base_url();?>backends/phanquyen_chitiet/<?php if(!$role_page->searchRolePages($id,$v['name'])) {echo "add/$id";} else {echo "delete/$id";} ?>">
                <table class='table' style='width:80%;margin:10px auto;'>
                <tr>
                    <td style='width:30%'><input type='text' class='form-control' value=<?php echo $v['name']; ?> name='page_name' readonly></td>
                    <td style='width:40%'><?php echo $v['optional']; ?></td>
                    <td style='width:30%'><input type="submit" class='<?php if(!$role_page->searchRolePages($id,$v['name'])) {echo 'btn btn-primary';} else {echo 'btn btn-danger';} ?>' value='<?php if(!$role_page->searchRolePages($id,$v['name'])) {echo 'Thêm Page';} else {echo 'Xóa Page';} ?>'>
                    </td>
                </tr>
                </table>
                </form>
            <?php
            }
}
?>

