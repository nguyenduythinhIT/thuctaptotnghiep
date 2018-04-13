<?php
class Topic_model extends CI_Model {

    public function getall()
    {
        $query=$query = $this->db->get('topics');
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `topics`");
        return $query->result_array();
    }
}
?>