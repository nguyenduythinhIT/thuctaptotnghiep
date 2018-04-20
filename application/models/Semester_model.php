<?php
class Semester_model extends CI_Model {

    public function getall()
    {
        $query = $this->db->get('semesters');
        return $query->result_array();
    }
    public function searchbyID($id)
    {
        $query = $this->db->get('semesters');
        return $query->result_array();
    }
    public function count()
    {
        $query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `semesters`");
        return $query->result_array();
    }
    public function addform()
    {
        ?>
        <form action="<?php echo base_url();?>backends/hocki/add" class='form-group' method='post'>
        <table class='table' style='width:80%;margin:10px auto;'>
        <tr><th colspan=2>Thêm học kỳ</th></tr>
        <tr><th>Năm học:</th><td><input type='text' class='form-control' name='year' value="<?php echo date("Y");?>"></td></tr>
        <tr><th>Học kỳ:</th><td><select name='term'>
        <option value=1>Học kỳ 1</option>
        <option value=2>Học kỳ 2</option>
        </select></td></tr>
        <tr><td><input type='submit' class='btn btn-primary' value='Thêm học kỳ'></td></tr>
        </table>
        </form>
        <?php
    }
    public function show($id)
    {

    }
    public function showall()
    {
        $list=$this->getall();
        echo "<table class='table' style='width:80%;margin:10px auto'>'";
        echo "<tr><th colspan=3>Danh sách</th></tr>";
        echo "<tr><th style='width:30%'>Năm học</th><th style='width:30%'>Học kỳ</th><th style='width:40%;text-align:right'>Thao tác</th></tr>";
        echo "</table>";
        foreach($list as $key=>$value)
        {
            ?>
            <table class='table' style='width:80%;margin:10px auto'>
            <tr>
                <td style='width:30%'><?php echo $value['year']; ?></td>
                <td style='width:30%'><?php echo $value['term']; ?></td>
                <td style='width:40%'>
                    <a href="<?php echo base_url();?>backends/hocki/delete/<?php echo $value['id']; ?>"><button style='float:right; margin-left:5px' class='btn btn-danger'>Xóa</button></a>
                    <a href="<?php echo base_url();?>backends/danhmuc/hocki_chitiet"><button style='float:right; margin-left:5px' class='btn btn-primary'>Xem</button></a>
                </td>
            </tr>
            </table>
            <?php
        }
    }
}
?>