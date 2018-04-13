<?php
class Semester_model extends CI_Model {

    public function getall()
    {
        $query=$query = $this->db->get('semesters');
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `semesters`");
        return $query->result_array();
    }
}
?>