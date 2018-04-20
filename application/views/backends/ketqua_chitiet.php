<?php   
        $frid=0;
        $stu=new student_model();
        $sv=$stu->searchbyID($_GET['id']);
        $topic=new topic_model();
        $eva=new evaluation_criteria_model();
        $se=new semester_model();
        $rs=new evaluation_result_model();
        $list=$se->getall();
        $crse=end($list)['id'];
        $fr=new evaluation_form_model();
        if(count($fr->search($_GET['id'],$crse))==1) $frid=$fr->search($_GET['id'],$crse)[0]['id'];
        if(count($sv)==1){ $sv=$sv[0]; }
        
        ?>
        <form action='<?php echo base_url();?>backends/ketqua/<?php if($frid==0) echo "add";else echo "updatebyMON/".$_GET['id'];?>' class='from-group' method='post'>
        <table class='table' style='width:80%;margin:10px auto;'>
        <tr>
            <th colspan=3 style='text-align:center;'>BẢNG ĐÁNH GIÁ RÈN LUYỆN</th>
        </tr>
        <tr>
            <td>Sinh viên: <?php echo $sv['name']; ?></td>
            <td>Mã sinh viên: <?php echo $sv['id']; ?></td>
            <td>
            <?php
                echo end($list)['year']." - học kỳ ".end($list)['term'];
            ?>
            </td>
        </tr>
        </table>
        <table style='width:80%;margin:10px auto;background:white' border="1">
        <tr>
            <th style='padding:5px;'>Chủ đề</th>
            <th style='padding:5px;width:15%;'>Điểm</th>
            <th style='padding:5px;width:15%;'>Phần đánh giá của sinh viên</th>
            <th style='padding:5px;width:15%;'>Phần đánh giá của Đại diện</th>
        </tr>
        <?php
        foreach($topic->getParent() as $key=>$value)
        {
            ?>
            <tr><th colspan=4 style='padding:5px;'><?php echo $value['title']."(Tối đa:".$value['max_score']."đ )"; ?></th></tr>
            <?php
                foreach($eva->getparentbyTOPIC($value['id']) as $k2=>$v2)
                {
                    echo "<tr><td style='padding:5px;'>&nbsp&nbsp&nbsp&nbsp".$v2['content'];
                    
                    echo "<table style='margin:10px auto;' border='1'><tr>";
                    foreach($eva->getbyParent($v2['id']) as $k3=>$v3)
                    {
                        echo "<td style='padding:5px;'>".$v3['content']."</td>";
                    }
                    echo "</tr><tr>";
                    foreach($eva->getbyParent($v2['id']) as $k3=>$v3)
                    {
                        echo "<td style='padding:5px;'>".$v3['mark_range_to']."đ</td>";
                    }
                    echo "</tr></table>";
                    echo "</td>";
                    echo "<td style='padding:5px;'>".$v2['mark_range_from']."đ - ".$v2['mark_range_to']."đ";
                    echo "</td><td>";
                    if($frid==0) echo 0;
                    else
                    {
                        echo $rs->searchbyFR_CR($frid,$v2['id'])[0]['score'];
                    }
                    echo "</td>";
                    echo "<td><input value='";
                    if($frid==0) echo 0;
                    else
                    {
                        if($rs->searchbyFR_CR($frid,$v2['id'])[0]['monitor_score'] == "") echo '0';
                        else 
                        echo $rs->searchbyFR_CR($frid,$v2['id'])[0]['monitor_score'];
                    }
                    echo "' type='number' min=".$v2["mark_range_from"]." max=".$v2['mark_range_to']." style='width:100px' class='form-control' name='eva-".$v2['id']."'></td>";
                    echo "</td></tr>";
                    
                }
            ?>
            <?php
                foreach($topic->searchbyPARENT($value['id']) as $k=>$v)
                {
                    ?>
                    <tr><th colspan=4 style='padding:5px;'>&nbsp&nbsp<?php echo $v['title']."(Tối đa:".$value['max_score']."đ )"; ?></th></tr>
                    <?php
                    foreach($eva->getparentbyTOPIC($v['id']) as $k2=>$v2)
                {
                    echo "<tr><td style='padding:5px;'>&nbsp&nbsp&nbsp&nbsp".$v2['content'];
                    
                    echo "<table style='margin:10px auto;' border='1'><tr>";
                    foreach($eva->getbyParent($v2['id']) as $k3=>$v3)
                    {
                        echo "<td style='padding:5px;'>".$v3['content']."</td>";
                    }
                    echo "</tr><tr>";
                    foreach($eva->getbyParent($v2['id']) as $k3=>$v3)
                    {
                        echo "<td style='padding:5px;'>".$v3['mark_range_to']."đ</td>";
                    }
                    echo "</tr></table>";
                    echo "</td>";
                    echo "<td style='padding:5px;'>".$v2['mark_range_from']."đ - ".$v2['mark_range_to']."đ";
                    echo "</td><td>";
                    if($frid==0) echo 0;
                    else
                    {
                        echo $rs->searchbyFR_CR($frid,$v2['id'])[0]['score'];
                    }
                    echo "</td>";
                    echo "<td><input value='";
                    if($frid==0) echo 0;
                    else
                    {
                        if($rs->searchbyFR_CR($frid,$v2['id'])[0]['monitor_score'] == "") echo '0';
                        else 
                        echo $rs->searchbyFR_CR($frid,$v2['id'])[0]['monitor_score'];
                    }
                    echo "' type='number' min=".$v2["mark_range_from"]." max=".$v2['mark_range_to']." style='width:100px' class='form-control' name='eva-".$v2['id']."'></td>";
                    echo "</td></tr>";
                    
                }
                }
            ?>
            
            <?php
        }
        ?>
        </table>
        <input type='submit' class='btn btn-primary' value='<?php if($frid==0) echo "Xác nhận"; else echo "Cập nhật"?>' style='margin:10px 10%'>
        </form>