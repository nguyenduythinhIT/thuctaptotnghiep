<?php
class Student_model extends CI_Model {
    private $id;
    private $name;
    private $mail;
    private $password;
    private $gender;
    private $address;
    private $phone_number;
    private $birthday;
    private $role_id;
    private $class_id;
    private $remember_token;
    private $created_at;
    private $updated_at;

    public function getall()
    {
        $query = $this->db->get('students');
        return $query->result_array();
    }
    public function searchbyID($id)
    {
        $query = $this->db->query("SELECT * FROM students WHERE id=?",array($id));
        return $query->result_array();
    }
    public function login($username,$password)
    {
        $pass=md5(sha1($username.$password));
        $sql="SELECT * FROM students WHERE `password`=?";
        $arr=array();
        $arr[]=$pass;
        $query = $this->db->query($sql,$arr);
        return $query->result_array();
    }
    public function showall($list)
    {
        echo "<table class='table' style='width:80%;margin:10px auto'>";
        echo "<tr><th>Mã sinh viên</th><th>Họ tên</th><th style='text-align:right'>Thao tác</th></tr>";
        foreach($list as $k=>$v)
        {
            ?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['name']?></td>
                <td><a style='float:right' href='<?php echo base_url();?>backends/sinhvien/delete/<?php echo $v['id'];?>'><button style='margin-left:5px;' class='btn btn-danger'>Xóa</button></a><a style='float:right' href='<?php echo base_url();?>backends/sinhvien_chitiet/<?php echo $v['id'];?>'><button  class='btn btn-primary'>Xem</button></a></td>
            </tr>
            <?php
        }
        echo "</table>";
    }
    public function show($id)
    {
        $sv=$this->searchbyID($id);
        if(count($sv)==1)
        {
            echo "<table class='table' style='width:80%;margin:10px auto'>";
            ?>
            <tr><td>Mã sinh viên:</td><td><?php echo $sv[0]['id'];?></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <?php
            echo "</table>";
        }

    }
}
?>