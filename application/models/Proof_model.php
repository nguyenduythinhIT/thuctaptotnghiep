<?php
class Proof_model extends CI_Model {

    public function getall()
    {
        $query=$query = $this->db->get('proofs');
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `proofs`");
        return $query->result_array();
    }
}
?>