<?php
if($_SESSION['role']==2)
{
    $stu=new student_model();
    $fr=new evaluation_form_model();
    $se=new semester_model();
    $result=new evaluation_result_model();
    $semester=$se->getall();
        if(count($semester)>1) {$semester=end($semester);}
        else if(count($semester)==1) {$semester=$semester[0];}
        else {
            $semester=array('id' => 0);
        }
    $student=$stu->searchbyID($_SESSION['id']);
    $class=$stu->searchbyClass($student[0]['class_id']);
    echo "<table class='table' style='margin:10px auto;width:80%'>";
    echo "<tr><th>Tên</th><th>Cá nhân</th><th>Lớp trưởng</th><th>Cố vấn</th><th>Đánh giá</th></tr>";
    foreach($class as $k=>$v){
        $frid=$fr->search($v['id'],$semester['id']);
        if(count($frid)>0){
            $frid=$frid[0]['id'];
        $rs=array('stu'=> 0, 'mon'=>0,'adv'=>0,'fac'=>0,'cus'=>0);
        foreach($result->searchbyFR($frid) as $k2=>$v2)
        {
            $rs['stu']+=$v2['score'];
            if($v2['monitor_score']!="") $rs['mon']+=$v2['monitor_score'];
            if($v2['education_adviser_score']!="") $rs['adv']+=$v2['education_adviser_score'];
            if($v2['faculty_score']!="") $rs['fac']+=$v2['faculty_score'];
            if($v2['custom_score']!="") $rs['cus']+=$v2['custom_score'];
        }
    ?>
        <tr>
        <td><?php echo $v['name'];?></td>
        <td><?php echo $rs['stu'];?></td>
        <td><?php echo $rs['mon'];?></td>
        <td><?php echo $rs['adv'];?></td>
        <td><?php if($fr->isform($v['id'],$semester['id']))
        {echo "<a href='".base_url()."backends/ketqua_chitiet?id=".$v['id']."'><button class='btn btn-primary'>Đánh giá</button></a>";} 
        else { echo "Chưa đánh giá";}?></td>
        </tr>
    <?php
    }
    else
    {
        echo "<tr><td>$v[name]</td><td colspan=3>Chưa đánh giá</td></tr>";
    }
    }
    echo "</table>";
}
else
{
    ?>
asd
    <?php
}
?>