<?php
class Topic_model extends CI_Model {

    public function getall()
    {
        $query = $this->db->get('topics');
        return $query->result_array();
    }
    public function count()
    {
        $query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `topics`");
        return $query->result_array();
    }
    public function searchbyID($id)
    {
        $query = $this->db->query("SELECT * FROM topics WHERE id=?",array($id));
        return $query->result_array();
    }
    public function searchbyPARENT($id)
    {
        $query = $this->db->query("SELECT * FROM topics WHERE parent_id=?",array($id));
        return $query->result_array();
    }
    public function show($id)
    {
        $ec=new evaluation_criteria_model();
        $eva=$ec->searchbyTOPIC($id);
        $topic=$this->searchbyID($id);
        ?>
        <table style='width:80%;margin:0'>
            <tr>
                <th></th><th></th>
            <tr>
        </table>
        <?php
    }
}
?>