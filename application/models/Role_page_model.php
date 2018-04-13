<?php
class Role_page_model extends CI_Model {

    public function getall()
    {
       $query = $this->db->get('role_pages');
        return $query->result_array();
    }
    public function count()
    {
        $query = $this->db->query("SELECT COUNT(`name`) AS amount FROM `role_pages`");
        return $query->result_array();
    }
    public function searchbyRoleID($id)
    {
        $query = $this->db->query("SELECT page_name AS name FROM `role_pages` WHERE role_id=? ",array($id));
        foreach( $query->result_array() as $k => $v)
        {

        }
    }
    public function searchRolePages($id,$name)
    {
        $query = $this->db->query("SELECT page_name FROM `role_pages` WHERE role_id=? AND page_name=? ",array($id,$name));
        if(count($query->result_array()) > 0)
            return 1;
        return 0;
    }
    public function insert($id,$name)
    {
        if(!$this->searchRolePages($id,$name))
        {
            $sql="INSERT INTO role_pages(role_id,page_name) VALUES (?,?)";
            $arr=array($id,$name);
            try {$query=$this->db->query($sql,$arr);}
            catch(exception $e){
                echo $e;
            }
        }
        else
        {
            echo "Phân quyền này đã tồn tại không cần thêm";
            echo "<br><a href='".base_url()."backends/".$_SESSION['pre_page']."' Quay về</a>";
        }
    }
    public function delete($id,$name)
    {
        if($this->searchRolePages($id,$name))
        {
            $sql="DELETE FROM role_pages WHERE role_id=? AND page_name=?";
            $arr=array($id,$name);
            try {$query=$this->db->query($sql,$arr);}
            catch(exception $e){
                echo $e;
            }
        }
        else
        {
            echo "Phân quyền này đã tồn tại không cần thêm";
            echo "<br><a href='".base_url()."backends/".$_SESSION['pre_page']."' Quay về</a>";
        }
    }
}
?>