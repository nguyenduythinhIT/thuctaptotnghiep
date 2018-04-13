<?php
class Notification_student_model extends CI_Model {

    public function getall()
    {
        $query=$query = $this->db->get('notification_students');
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `notification_students`");
        return $query->result_array();
    }
}
?>