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
        $query = $this->db->query("SELECT * FROM evalution_criterias WHERE id=?", array($id));
        return $query->result_array();
    }
    public function searchbyTOPIC($id)
    {
        $query = $this->db->query("SELECT * FROM evalution_criterias WHERE topic_id=?", array($id));
        return $query->result_array();
    }
    public function show($id)
    {
        $ev=$this->searchbyID($id);
        if(count($ev)==1)
        {
            ?>
            <table border='1'>
            <tr>
                <td>
                asd
                </td>
            </tr>
            </table>
            <?php
        }
    }
}
?>