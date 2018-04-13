<?php
class Role_model extends CI_Model {
    public $id;
    public $name;

    public function init($name)
    {
        $this->$name=$name;
    }
    public function getall()
    {
        $query=$query = $this->db->get('roles');
        return $query->result_array();
    }
    public function count()
    {
        $query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `roles`");
        return $query->result_array();
    }
    public function searchbyID($id)
    {
        $query = $this->db->query("SELECT `name` FROM `roles` WHERE `id` = ?",array($id));
        return $query->result_array();
    }
    public function searchbyNAME($id)
    {
        $query = $this->db->query("SELECT `name` FROM `roles` WHERE `name` = ?",array($id));
        return $query->result_array();
    }
    public function showall()
    {
        $list=$this->getall();
        echo "<table class='table' style='width:80%;margin:10px auto;'>";
        echo "<tr><th>ID</th><th>Tên</th><th>Chức năng</th></tr>";
        foreach($list as $k =>$v)
        {
            ?>
            <tr>
                <td><?php echo $v['id']; ?></td>
                <td><?php echo $v['name']; ?></td>
                <td><a href="<?php echo base_url();?>backends/phanquyen_chitiet/<?php echo $v['id']; ?>"><button class='btn btn-primary'>Xem</button></a>
            <?php if(!in_array($v['id'],array(0,1,2,3))) { ?><a href="<?php echo base_url();?>backends/phanquyen/delete/<?php echo $v['id']; ?>"><button class='btn btn-danger'>Xóa</button></a>
            <?php } 
            ?>
            </td>
            </tr>
            <?php
        }
        echo "</table>";
    }
    public function addform()
    {
        ?>  
        <form action="<?php echo base_url(); ?>backends/phanquyen/add" method="post" class='form-group'>
            <table class='table' style='width:80%;margin:10px auto;'>
                <tr><th colspan=2>Thêm Chức vụ</th></tr>
                <tr><td>Tên chức vụ:</td><td><input type='text' class='form-control' name='name'></td></tr>
                <tr><td colspan=2><input type='submit' class='btn btn-primary' value='Thêm chức vụ'></td></tr>
            </table>
        </form>
        <?php
    }
    public function insert($name)
    {
        $sql="INSERT INTO roles(name,created_at) VALUES(?,NOW())";
        $arr=array($name);
        try {
            return $query = $this->db->query($sql,$arr);
        }
        catch(exception $e)
        {
            return 0;
        }
    }
    public function delete($id)
    {
        $sql="DELETE FROM roles WHERE id=?";
        $arr=array($id);
        try {
            return $query = $this->db->query($sql,$arr);
        }
        catch(exception $e)
        {
            return 0;
        }
    }
}
?>