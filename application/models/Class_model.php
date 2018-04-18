<?php
class Class_model extends CI_Model {
    private $id;
    private $name;
    private $faculty_id;
    private $education_adviser_id;
    public function init($name,$faculty_id,$education_adviser_id)
    {
        $this->$name=$name;
        $this->$faculty_id=$faculty_id;
        $this->$education_adviser_id=$education_adviser_id;
    }
    public function showall()
    {
        $this->load->database('default');
        $sql="SELECT classes.id,classes.name AS `class_name`,faculties.name AS `faculty_name`,staff.name AS `staff_name` 
        FROM classes
        LEFT JOIN staff ON staff.id=classes.education_adviser_id
        LEFt JOIN faculties ON faculties.id=classes.faculty_id";
        $query= $this->db->query($sql);
        $class= $query->result_array();
        echo "<table class='table' style='width:80%;margin:10px auto;'>";
        echo "<tr><th>Lớp</th><th>Khoa</th><th>Cố vấn học tập</th><th>Thao tác</th></tr>";
        foreach($class as $key => $value)
        {
            echo "<tr>";
            echo "<td>".$value['class_name']."</td><td>".$value['faculty_name']."</td><td>".$value['staff_name']."</td>";
            echo "<td><a href='".base_url()."backends/'><button class='btn btn-primary' style='margin-right:5px;'>Xem</button ></a><a href=''><button class='btn btn-danger'>Xóa</button></a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    public function showclass($id)
    {

        $role_page=new role_page_model();
        $sql1="SELECT classes.id,classes.name AS `class_name`,classes.faculty_id,faculties.name AS `faculty_name`,classes.education_adviser_id,staff.name AS `staff_name`, classes.created_at,classes.updated_at 
        FROM classes
        LEFT JOIN staff ON staff.id=classes.education_adviser_id
        LEFt JOIN faculties ON faculties.id=classes.faculty_id
        WHERE classes.id=?";
        $sql2="SELECT id,name FROM  faculties";
        $sql3="SELECT id,name FROM  staff WHERE role_id=3";
        $sql4="SELECT * FROM students WHERE class_id=?";
        $arr=array();
        $arr[]=$id;
        try{
            $query= $this->db->query($sql1,$arr);
            $class= $query->result_array();
            $query= $this->db->query($sql2);
            $faculty= $query->result_array();
            $query= $this->db->query($sql3);
            $staff= $query->result_array();
            $query= $this->db->query($sql4,$arr);
            $student= $query->result_array();
            if(count($class)==1)
            {
                $value=$class[0];
                ?>

                <form style="width:80%;margin:10px auto;" action="<?php echo base_url();?>backends/class/update" method="post" >
                <table class="table">
                    <tr><th colspan=2><h2 style='margin:10px auto;width:100%;color:rgb(52,72,182)'>Thông tin lớp <?php echo $value['class_name']; ?></h2></th></tr>
                    <tr><td>Tên lớp: </td><td><input type="text" class="form-control" id="class_name" value="<?php echo $value["class_name"];?>" ></td></tr>
                    <tr><td>Khoa: </td><td>
                    <select class="custom-select" name="faculty_id">
                    <?php
                    foreach($faculty as $k =>$v)
                    {
                        echo "<option value=".$v['id'];
                        if($v['id']== $value["faculty_id"])
                        echo " selected ";
                        echo ">".$v['name']."</option>";
                    }
                    ?>
                    </select></td></tr>
                    <tr><td>Cố vấn học tập: </td><td>
                    <select class="custom-select" name="education_adviser_id">
                    <?php
                    foreach($staff as $k =>$v)
                    {
                        echo "<option value=".$v['id'];
                        if($v['id']== $value["education_adviser_id"])
                        echo " selected ";
                        echo ">".$v['name']."</option>";
                    }
                    ?>
                    </select></td></tr>
                    <tr><td>Khởi tạo lúc:</td><td><?php echo $value['created_at']; ?></td></tr>
                    <tr><td>Update lần cuối:</td><td><?php echo $value['updated_at']; ?></td></tr>
                    <tr><td><input type='submit' class='btn btn-primary' value="Cập nhật"></td><td></td></tr>
                </table>
                </form>
                <form action='<?php echo base_url();?>backends/class/delete' method='post'>
                <table class='table' style="width:80%;margin:10px auto;">
                    <tr><td><button onclick='return checkdeleteclass()' class='btn btn-danger'>Xóa lớp <?php echo $value["class_name"];?></button></td><td></td></tr>
                </table>
                </form>
                    <table class='table' style='width:80%; margin:10px auto;'>
                    <tr><th>DANH SÁCH SINH VIÊN</th></tr>
                    </table>
                    <?php 
                     $stu=new student_model();
                     $stu->showall($student);
                    ?>
                <?php
            }
            else{
                echo "không tìm thấy lớp có mã ".$id;
            }
        }
        catch(exception $e)
        {
            echo "không tìm thấy lớp có mã ".$id;
        }
        
    }
    public function getall()
    {
        $query=$query = $this->db->get('classes');
        return $query->result_array();
    }
    public function getclassbyID($id)
    {
        $sql="SELECT * FROM `classes` WHERE `id`=?";
        $arr=array();
        $arr[]=$id;
        $query=$query = $this->db->query($sql,$arr);
        return $query->result_array();
    }
    public function getclassbyNAME($name)
    {
        $sql="SELECT * FROM `classes` WHERE `name`=?";
        $arr=array();
        $arr[]=$name;
        $query=$query = $this->db->query($sql,$arr);
        return $query->result_array();
    }
    public function getclassbyFACULTY_ID($faculty_id)
    {
        $sql="SELECT * FROM `classes` WHERE `faculty_id`=?";
        $arr=array();
        $arr[]=$faculty_id;
        $query=$query = $this->db->query($sql,$arr);
        return $query->result_array();
    }
    public function getclassbyEDUCATION_ADVISER_ID($education_adviser_id)
    {
        $sql="SELECT * FROM `classes` WHERE `education_adviser_id`=?";
        $arr=array();
        $arr[]=$education_adviser_id;
        $query=$query = $this->db->query($sql,$arr);
        return $query->result_array();
    }
    public function insert()
    {
        $sql="INSERT INTO `classes`(`name`,`faculty_id`,`education_adviser_id`,`created_at`) VALUES(?,?,?,CURREN_TIMESTAMP)";
        $arr=array();
        $arr[]=$this->$name;
        $arr[]=$this->$faculty_id;
        $arr[]=$this->$education_adviser_id;
        try {
            $query=$query = $this->db->query($sql,$arr);
            return $query->result_array();
        }
        catch(exception $e)
        {
            echo $e;
        }
    }
    public function count()
    {
        $sql="SELECT COUNT(id) AS amount FROM `classes`";
        $query=$query = $this->db->query($sql);
        return $query->result_array();
    }
}
?>