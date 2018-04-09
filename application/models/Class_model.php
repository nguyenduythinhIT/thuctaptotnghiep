<?php
class Class_model extends CI_Model {
    public $id;
    public $name;
    public $faculty_id;
    public $education_adviser_id;
    public $created_at;
    public $updated_at;

    public function newClass($id,$name,$faculty_id,$education_adviser_id,$created_at,$updated_at)
    {
        $this->$id=$id;
        $this->$name=$name;
        $this->$faculty_id=$faculty_id;
        $this->$education_adviser_id=$education_adviser_id;
        $this->$created_at=$created_at;
        $this->$updated_at=$updated_at;
    }
    public function getall()
    {
        $this->load->database('default');
        $query=$query = $this->db->query('SELECT * from classes');
        return $query->result_array();
    }
}
?>