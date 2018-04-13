<?php
class Evaluation_form_model extends CI_Model {

    public function getall()
    {
        $query=$query = $this->db->get('evaluation_forms');
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `evaluation_forms`");
        return $query->result_array();
    }
}
?>