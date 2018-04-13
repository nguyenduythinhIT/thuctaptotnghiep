<?php
class Notification_model extends CI_Model {

    public function getall()
    {
        $query=$query = $this->db->get('notifications');
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `notofications`");
        return $query->result_array();
    }
}
?>