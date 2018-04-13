<?php
class Faculty_model extends CI_Model {
    private $id;
    private $name;

    public function getall()
    {
        $query=$query = $this->db->get('faculties');
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `faculties`");
        return $query->result_array();
    }
}