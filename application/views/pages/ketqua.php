<p style='color:red;font-weight:bold;text-align:center'>KẾT QUẢ ĐÁNH GIÁ RÈN LUYỆN</p>
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
        $result=new evaluation_result_model();
        $fr=new evaluation_form_model();
        $se=new semester_model();
        ?>
        <table class='table' style='width:80%;margin:10px auto'>
        <tr><th>Học kì</th><th>Đánh giá của sinh viên</th><th>Đánh giá của lớp trưởng</th><th>Đánh giá của cố vấn</th><th>Kết quả</th></tr>
        <?php
            foreach($fr->searchbySTU($_SESSION['id']) as $k=>$v)
            {
                $rs=array('stu'=> 0, 'mon'=>0,'adv'=>0,'fac'=>0,'cus'=>0);
                foreach($result->searchbyFR($v['id']) as $k2=>$v2)
                {
                    $rs['stu']+=$v2['score'];
                    if($v2['monitor_score']!="") $rs['mon']+=$v2['monitor_score'];
                    if($v2['education_adviser_score']!="") $rs['adv']+=$v2['education_adviser_score'];
                    if($v2['faculty_score']!="") $rs['fac']+=$v2['faculty_score'];
                    if($v2['custom_score']!="") $rs['cus']+=$v2['custom_score'];
                }
                $semester=$se->searchbyID($v['semester_id'])[0];
                echo "<tr>";
                echo "<td>".$semester['year']." - Học kỳ".$semester['term']."</td>";
                echo "<td>".$rs['stu']."</td>"."<td>".$rs['mon']."</td>"."<td>".$rs['fac']."</td>"."<td>".$rs['cus']."</td>";
                if($rs['mon']==0 && $rs['adv']==0 && $rs['cus']==0)
                echo "</tr>";
            }
        ?>
        </table>
        <?php
    }
    else
    {
        ?>
    <p style='color:red;font-weight:bold;text-align:center'>BẠN KHÔNG THỂ THỰC HIỆN THAO TÁC NÀY</p>
        <?php
    }
}
?>