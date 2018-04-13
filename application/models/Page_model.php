<?php
class Page_model extends CI_Model {

    public function getall()
    {
        $query = $this->db->get('Pages');
        return $query->result_array();
    }
    public function count()
    {
        $query = $this->db->query("SELECT COUNT(`name`) AS amount FROM `Pages`");
        return $query->result_array();
    }
}
?>