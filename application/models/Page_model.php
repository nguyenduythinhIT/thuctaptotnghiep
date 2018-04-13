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
    public function searchbyNAME($name)
    {
        $query = $this->db->query("SELECT *  FROM `Pages` WHERE name=?",array($name));
        return $query->result_array();
    }
    public function update($name,$optional)
    {
        if(count($this->searchbyNAME($name))==1)
        {
            $sql="UPDATE pages SET optional=? WHERE name=?";
            $arr=array($optional,$name);
            try {$query=$this->db->query($sql,$arr);
                return 1;
            }
            catch(exception $e){return 0;}
        }
        else{
            return 0;
        }
    }
}
?>