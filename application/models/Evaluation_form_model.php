<?php
class Evaluation_form_model extends CI_Model {

    public function getall()
    {
        $query = $this->db->get('evaluation_forms');
        return $query->result_array();
    }
    public function search($stuid,$se)
    {
        $query = $this->db->query("SELECT * FROM `evaluation_forms` WHERE student_id=? AND semester_id=?",array($stuid,$se));
        return $query->result_array();
    }
    public function count()
    {
        $query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `evaluation_forms`");
        return $query->result_array();
    }
    public function isform($stu_id,$se_id)
    {
        $query = $this->db->query("SELECT * FROM `evaluation_forms` WHERE student_id=? AND semester_id=?",array($stu_id,$se_id));
        if(count($query->result_array())==1)
        return true;
        return false;
    }
    public function searchbySTU($st)
    {
        $query = $this->db->query("SELECT * FROM `evaluation_forms` WHERE student_id=?",array($st));
        return $query->result_array();
    }
    public function insert($total,$se_id,$stu_id)
    {
        try {
            $query = $this->db->query("INSERT INTO `evaluation_forms`(total,semester_id,student_id,created_at) VALUES(?,?,?,NOW())",array($total,$se_id,$stu_id));
        }
        catch(exception $e){
            echo $e;
        }
    }
    public function formdanhgia($id)
    {
        $frid=0;
        $stu=new student_model();
        $sv=$stu->searchbyID($id);
        $topic=new topic_model();
        $eva=new evaluation_criteria_model();
        $se=new semester_model();
        $rs=new evaluation_result_model();
        $list=$se->getall();
        $crse=end($list)['id'];
        if(count($this->search($_SESSION['id'],$crse))==1) $frid=$this->search($_SESSION['id'],$crse)[0]['id'];
        if(count($sv)==1){ $sv=$sv[0]; }
        ?>
        <form action='<?php echo base_url();?>ketqua/<?php if($frid==0) echo "add";else echo "update";?>' class='from-group' method='post'>
        <table class='table' style='width:80%;margin:10px auto;'>
        <tr>
            <th colspan=3 style='text-align:center;'>BẢNG ĐÁNH GIÁ RÈN LUYỆN</th>
        </tr>
        <tr>
            <td>Sinh viên: <?php echo $sv['name']; ?></td>
            <td>Mã sinh viên: <?php echo $_SESSION['id']; ?></td>
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
        </tr>
        <?php
        foreach($topic->getParent() as $key=>$value)
        {
            ?>
            <tr><th colspan=3 style='padding:5px;'><?php echo $value['title']."(Tối đa:".$value['max_score']."đ )"; ?></th></tr>
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
                    echo "</td>";
                    echo "<td><input value=";
                    if($frid==0) echo 0;
                    else
                    {
                        echo $rs->searchbyFR_CR($frid,$v2['id'])[0]['score'];
                    }
                    echo " type='number' min=".$v2["mark_range_from"]." max=".$v2['mark_range_to']." style='width:100px' class='form-control' name='eva-".$v2['id']."'></td>";
                    echo "</td></tr>";
                    
                }
            ?>
            <?php
                foreach($topic->searchbyPARENT($value['id']) as $k=>$v)
                {
                    ?>
                    <tr><th colspan=3 style='padding:5px;'>&nbsp&nbsp<?php echo $v['title']."(Tối đa:".$v['max_score']."đ )"; ?></th></tr>
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
                    echo "</td>";
                    echo "<td><input value=";
                    if($frid==0) echo 0;
                    else
                    {
                        echo $rs->searchbyFR_CR($frid,$v2['id'])[0]['score'];
                    }
                    echo " type='number' min=".$v2["mark_range_from"]." max=".$v2['mark_range_to']." style='width:100px' class='form-control' name='eva-".$v2['id']."'></td>";
                    echo "</td></tr>";
                    
                }
                }
            ?>
            
            <?php
        }
        ?></tr>
        </table>
        <input type='submit' class='btn btn-primary' value='<?php if($frid==0) echo "Xác nhận"; else echo "Cập nhật"?>' style='margin:10px 10%'>
        </form>
        <?php
    }
}
?>