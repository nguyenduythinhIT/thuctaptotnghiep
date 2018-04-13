<?php
class Role_page_model extends CI_Model {

    public function getall()
    {
        $query=$query = $this->db->get('role_pages');
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`name`) AS amount FROM `role_pages`");
        return $query->result_array();
    }
    public function searchbyRoleID($id)
    {
        $query=$query = $this->db->query("SELECT page_name AS name FROM `role_pages` WHERE role_id=? ",array($id));
        foreach( $query->result_array() as $k => $v)
        {

        }
    }
    public function searchRolePages($id,$name)
    {
        $query=$query = $this->db->query("SELECT page_name FROM `role_pages` WHERE role_id=? AND page_name=? ",array($id,$name));
        if(count($query->result_array()) > 0)
            return 1;
        return 0;
    }
}
?>