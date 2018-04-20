<?php
class Evaluation_result_model extends CI_Model {

    public function getall()
    {
        $query = $this->db->get('evaluation_results');
        return $query->result_array();
    }
    public function searchbyFR($fr)
    {
        $query = $this->db->query("SELECT * FROM `evaluation_results` WHERE evaluation_form_id=?",array($fr));
        return $query->result_array();
    }
    public function searchbyFR_CR($fr,$cr)
    {
        $query = $this->db->query("SELECT * FROM `evaluation_results` WHERE evaluation_form_id=? AND evaluation_criterias_id=?",array($fr,$cr));
        return $query->result_array();
    }
    public function count()
    {
        $query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `evaluation_results`");
        return $query->result_array();
    }
    public function insert($score,$eva_cr,$eva_fr)
    {
        try{
            $query = $this->db->query("INSERT INTO `evaluation_results`(score,evaluation_criterias_id,evaluation_form_id,created_at) VALUES(?,?,?,NOW())",array($score,$eva_cr,$eva_fr));
        }
        catch(exception $e)
        {
            echo $e;
        }
    }
    public function updatebySTU($score,$cr_id,$fr_id)
    {
        try{
            $query = $this->db->query("UPDATE `evaluation_results` SET score=? WHERE evaluation_criterias_id=? AND evaluation_form_id=?",array($score,$cr_id,$fr_id));
        }
        catch(exception $e)
        {
            echo $e;
        }
    }
    public function updatebyMON($mon_id,$mon_score,$cr_id,$fr_id)
    {
        try{
            $query = $this->db->query("UPDATE `evaluation_results` SET monitor_id=? , monitor_score=? WHERE evaluation_criterias_id=? AND evaluation_form_id=?",array($mon_id,$mon_score,$cr_id,$fr_id));
        }
        catch(exception $e)
        {
            echo $e;
        }
    }
}
?>