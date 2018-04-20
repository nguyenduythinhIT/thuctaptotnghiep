<?php
class Topic_model extends CI_Model {

    public function getall()
    {
        $query = $this->db->get('topics');
        return $query->result_array();
    }
    public function parentMaxscore()
    {
        $query = $this->db->query("SELECT id,max_score FROM `topics`");
        $ds=array();
        foreach($query->result_array() as $k=>$v)
        {
            $ds[$v['id']]=array('max_score' => $v['max_score'],'score' => 0);
        } 
        return $ds;
    }
    public function count()
    {
        $query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `topics`");
        return $query->result_array();
    }
    public function searchbyID($id)
    {
        $query = $this->db->query("SELECT * FROM topics WHERE id=?",array($id));
        return $query->result_array();
    }
    public function searchbyPARENT($id)
    {
        $query = $this->db->query("SELECT * FROM topics WHERE parent_id=?",array($id));
        return $query->result_array();
    }
    public function show($id)
    {
        $ex=$this->searchbyID($id);
        if(count($ex)==1){
            ?>
            <table border='1'>
            <tr>
                <th colspan='4'><?php $ex[0]['title']." (".$ex[0]['max_score'].")";?></th>
            </tr>
            </table>
            <?php
        }
    }
    public function getParent()
    {
        $query = $this->db->query("SELECT * FROM topics WHERE parent_id is NULL");
        return $query->result_array();
    }
    public function addform()
    {   
        $list=$this->getall();
        ?>
        <form action='bangdanhgia/add' method='post' class='form-group'>
        <table class='table' style='width:80%;margin:10px auto;'>
            <tr><th colspan=3>Thêm Chủ đề:</th></tr>
            <tr>
                <th>Tiêu đề</th>
                <th>Điểm tối đa</th>
            </tr>
            <tr>
                <td style='width:75%'><input type='text' name='title' class='form-control'></td>
                <td><input type='number' name='max_score' class='form-control' value=0></td>
            </tr>
            <tr>
                <th>Thuộc chủ đề: 
                    <select name='parent_id' class='form-control'>
                        <option value=0> Không có </option>
                        <?php
                            foreach($list as $k=>$v)
                            {
                                echo "<option value=".$v['id'].">".$v['title']."</option>";
                            }
                        ?>
                    </select>
                </th>
            </tr>
            <tr>
                <td>
                    <input type='submit' class='btn btn-primary' value='Thêm chủ đề'>
                </td>
            </tr>
        </table>
        <?php
    }
    public function showall()
    {
        $list=$this->getall();
        $eva=new evaluation_criteria_model();
        print_r($eva->getbyParent(2));
        ?>
        <table border="1" style='width:80%;margin:10px auto;background:white'>
            <?php
                foreach($list as $k=>$v)
                {
                    echo "<tr><th colspan=2>".$v['title']."- Điểm tối đa".$v['max_score']."</th></tr>";
                    foreach($eva->getparentbyTOPIC($v["id"]) as $key=>$value)
                    {
                        echo "<tr><td style='padding-left:10px'>-".$value['content'].":(".$value['mark_range_from']."đ -".$value['mark_range_to']."đ )";
                        echo "<table border=1><tr>";
                        foreach($eva->getbyParent($value['id']) as $kk => $vv)
                        {
                            echo "<td>".$vv['content']."</td>";
                        }
                        echo "</tr><tr>";
                        foreach($eva->getbyParent($value['id']) as $kk => $vv)
                        {
                            echo "<td style='text-align:center'>".$vv['mark_range_from']."đ - </td>";
                        }
                        echo "</tr>";
                        echo"</table></td></tr>";
                    }
                }
            ?>
        </table>
        <?php
    }
}
?>