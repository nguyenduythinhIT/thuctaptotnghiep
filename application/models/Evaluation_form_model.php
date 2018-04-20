<?php
class Evaluation_form_model extends CI_Model {

    public function getall()
    {
        $query = $this->db->get('evaluation_forms');
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
    public function formdanhgia($id)
    {
        $stu=new student_model();
        $sv=$stu->searchbyID($id);
        $topic=new topic_model();
        $eva=new evaluation_criteria_model();
        $se=new semester_model();
        if(count($sv)==1){ $sv=$sv[0]; }
        ?>
        <form action='<?php echo base_url();?>ketqua/add' class='from-group' method='post'>
        <table class='table' style='width:80%;margin:10px auto;'>
        <tr>
            <th colspan=3 style='text-align:center;'>BẢNG ĐÁNH GIÁ RÈN LUYỆN</th>
        </tr>
        <tr>
            <td>Sinh viên: <?php echo $sv['name']; ?></td>
            <td>Mã sinh viên: <?php echo $_SESSION['id']; ?></td>
            <td>
            <?php
                $list=$se->getall();
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
                    echo "</table>";
                    echo "</td>";
                    echo "<td style='padding:5px;'>".$v2['mark_range_from']."đ - ".$v2['mark_range_to']."đ";
                    echo "</td>";
                    echo "<td><input value=0 type='number' min=".$v2["mark_range_from"]." max=".$v2['mark_range_to']." style='width:100px' class='form-control' name='eva-".$v2['id']."'></td>";
                    echo "</td></tr>";
                    
                }
            ?>
            <tr><th colspan=3 style='padding:5px;'>&nbsp&nbsp
            <?php
                foreach($topic->searchbyPARENT($value['id']) as $k=>$v)
                {
                    echo $v['title']."(Tối đa: ".$v['max_score']."đ )</th></tr>";
                    foreach($eva->getparentbyTOPIC($v['id']) as $k2=>$v2)
                    {
                        echo "<tr><td>&nbsp&nbsp&nbsp&nbsp".$v2['content'];

                        echo "</td></tr>";
                    }
                }
            ?>
            
            <?php
        }
        ?>
        <tr>
        </tr>
        </table>
        <input type='submit' class='btn btn-primary' value='Xác nhận' style='margin:10px 10%'>
        </form>
        <?php
    }
}
?>