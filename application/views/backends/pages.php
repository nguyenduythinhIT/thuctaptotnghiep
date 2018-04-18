<?php 
$page=new page_model();
$list_page=$page->getall();
?>
        <table class='table'><tr>
        <th style='width:300px'>Trang</th>
        <th style='width:300px'>Tính năng</th>
        <th style='width:300px'>Thao tác</th>
        </tr></table>
    <?php 
    foreach($list_page as $k=>$v)
    {
     ?>

        <?php if($_SESSION['role']==0) {?><form class='form-group' action="<?php echo base_url();?>backends/pages/update"  method="post"> <?php } ?>
        <table class='table'>
        <tr>
            <td style='width:300px'><input type='text' class='form-control' name='name' value='<?php echo $v['name'];?>' readonly></td>
            <td style='width:300px'><input type='text' class='form-control' name='optional' value='<?php echo $v['optional'];?>' ></td>
            <?php if($_SESSION['role']==0) {?><td style='width:300px'><input type='submit' class='btn btn-primary' value='Update option'></td><?php } ?>
        </tr>
        </table>
        <?php if($_SESSION['role']==0) {?> </form><?php } ?>
     <?php   
    }
    ?>