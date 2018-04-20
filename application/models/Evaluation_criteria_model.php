<?php
class Evaluation_criteria_model extends CI_Model {

    public function getall()
    {
        $query = $this->db->get('evaluation_criterias');
        return $query->result_array();
    }
    public function count()
    {
        $query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `evaluation_criterias`");
        return $query->result_array();
    }
    public function searchbyID($id)
    {
        $query = $this->db->query("SELECT * FROM evaluation_criterias WHERE id=?", array($id));
        return $query->result_array();
    }
    public function searchbyTOPIC($id)
    {
        $query = $this->db->query("SELECT * FROM evaluation_criterias WHERE topic_id=?", array($id));
        return $query->result_array();
    }
    public function getparent()
    {
        $query = $this->db->query("SELECT * FROM evaluation_criterias WHERE parent_id is NULL");
        return $query->result_array();
    }
    public function getparentbyTOPIC($id)
    {
        $query = $this->db->query("SELECT * FROM evaluation_criterias WHERE topic_id=? AND parent_id is NULL",array($id));
        return $query->result_array();
    }
    public function getbyParent($id)
    {
        $query = $this->db->query("SELECT * FROM evaluation_criterias WHERE parent_id=?",array($id));
        return $query->result_array();
    }

}
?>