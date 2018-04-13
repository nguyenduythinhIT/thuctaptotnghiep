<?php
class Comment_model extends CI_Model {
    private $id;
    private $title;
    private $content;
    private $created_by;

    public function getall()
    {
        $query=$query = $this->db->get('comments');
        return $query->result_array();
    }
    public function getStudentComment($id_student)
    {
        $sql="SELECT * FROM `commemts` WHERE `created_by`=?";
        $arr=array();
        $arr[]=$id_student;
        $query=$query = $this->db->query($sql,$arr);
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `students`");
        return $query->result_array();
    }
}
?>