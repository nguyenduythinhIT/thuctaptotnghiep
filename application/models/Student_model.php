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
        <td><?php $role_page=new role_page_model(); if($role_page->searchRolePages($_SESSION['role'],"sinhvien/delete") || $_SESSION['role']==0) { ?><a style='float:right' href='<?php echo base_url();?>backends/sinhvien/delete/<?php echo $v['id'];?>'><button style='margin-left:5px;' class='btn btn-danger'>Xóa</button></a><?php } ?><a style='float:right' href='<?php echo base_url();?>backends/sinhvien_chitiet/<?php echo $v['id'];?>'><button  class='btn btn-primary'>Xem</button></a></td>
            </tr>
            <?php
        }
        echo "</table>";
    }
    public function show($id)
    {
        $role_page=new role_page_model();
        $sv=$this->searchbyID($id);
        if(count($sv)==1)
        {
            if($role_page->searchRolePages($_SESSION['role'],"sinhvien/update") || $_SESSION['role']==0)
            {
                echo "<form class='form-group' action='".base_url()."backends/sinhvien/update' method='post'>";
            }
            
            echo "<table class='table' style='width:80%;margin:10px auto'>";
            ?>
            <tr><td>Mã sinh viên:</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['id'];?>' readonly></td></tr>
            <tr><td>Tên sinh viên:</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['name'];?>' ></td></tr>
            <tr><td>email:</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['email'];?>' ></td></tr>
            <tr><td>Giới tính:</td><td>
                <select class='form-control'>
                    <option value=1 <?php if($sv[0]['gender']) echo "selected"; ?>> Nam</option>
                    <option value=0 <?php if(!$sv[0]['gender'])  echo "selected";?>> Nữ</option>
                </select>
            </td></tr>
            <tr><td>Địa chỉ:</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['address'];?>' ></td></tr>
            <tr><td>Số DT:</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['phone_number'];?>' ></td></tr>
            <tr><td>Ngày sinh:</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['birthday'];?>' ></td></tr>
            <tr><td>Phân quyền:</td><td>Sinh viên</td></tr>
            <tr><td>Lớp</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['class_id'];?>' ></td></tr>
            <tr><td>Tạo ngày:</td><td><?php echo $sv[0]['created_at'];?></td></tr>
            <tr><td>Cập nhật lần cuối</td><td><?php echo $sv[0]['updated_at'];?></td></tr>
        <?php if($role_page->searchRolePages($_SESSION['role'],"sinhvien/update") || $_SESSION['role']==0) { ?><tr><td><input type='submit' class='btn btn-primary' value='Cập nhật'></td><td></td></tr>
        <?php }
            echo "</form></table>";
        }

    }
    public function changePass($id)
    {
        ?>
        <form class='form-group' action="<?php echo base_url();?>sinhvien/update" method="post">
        <table class='table' style='width:80%;margin:10px auto;'>
        <tr><th>Mật khẩu mới:</th><td><input type='password' class='form-control' name='new_pass'></td><tr>
        <tr><th>Mật khẩu cũ:</th><td><input type='password' class='form-control' name='new_pass'></td><tr>
        <tr><td><input type='submit' value="Đổi mật khẩu" class='btn btn-primary' name='new_pass'></td><tr>
        </table>
        <form>
        <?php
    }
}
?>