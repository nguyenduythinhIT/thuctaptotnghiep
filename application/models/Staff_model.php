<?php
class Staff_model extends CI_Model {

    public function getall()
    {
        $query=$query = $this->db->get('staff');
        return $query->result_array();
    }
    public function login($username,$password)
    {
        $pass=md5(sha1($username.$password));
        $sql="SELECT * FROM staff WHERE `password`=?";
        $arr=array();
        $arr[]=$pass;
        $query=$query = $this->db->query($sql,$arr);
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `staff`");
        return $query->result_array();
    }
    public function searchbyID($id)
    {
        $query = $this->db->query("SELECT * FROM staff WHERE id=?",array($id));
        return $query->result_array();
    }
    public function show($id)
    {
        $role_page=new role_page_model();
        $sv=$this->searchbyID($id);
        if(count($sv)==1)
        {
            if($role_page->searchRolePages($_SESSION['role'],"staff/update") || $_SESSION['role']==0){
                echo "<form class='form-group' action='".base_url()."backends/sinhvien/update' method='post'>";
            }
            echo "<table class='table' style='width:80%;margin:10px auto'>";
            ?>
            <tr><td>Mã:</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['id'];?>' readonly></td></tr>
            <tr><td>Tên:</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['name'];?>' ></td></tr>
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
            <tr><td>Phân quyền:</td><td><input type='text' class='form-control' name='id' value='<?php echo $sv[0]['role_id'];?>' ></td></tr>
            <tr><td>Tạo ngày:</td><td><?php echo $sv[0]['created_at'];?></td></tr>
            <tr><td>Cập nhật lần cuối</td><td><?php echo $sv[0]['updated_at'];?></td></tr>
        <?php if($role_page->searchRolePages($_SESSION['role'],"sinhvien/update") || $_SESSION['role']==0) { ?><tr><td><input type='submit' class='btn btn-primary' value='Cập nhật'></td><td></td></tr> <?php } ?>
            <?php
            echo "</form></table>";
        }

    }
    public function changePass($id)
    {
        ?>
        <form class='form-group' action="<?php echo base_url();?>staff/update" method="post">
        <table class='table' style='width:80%;margin:10px auto;'>
        <tr><th>Mật khẩu mới:</th><td><input type='password' class='form-control' name='new_pass'></td><tr>
        <tr><th>Mật khẩu cũ:</th><td><input type='password' class='form-control' name='new_pass'></td><tr>
        <tr><td><input type='submit' value="Đổi mật khẩu" class='btn btn-primary' name='new_pass'></td><td><td><tr>
        </table>
        <form>
        <?php
    }
}
?>