<?php
class Staff_model extends CI_Model {

    public function getall()
    {
        $query=$query = $this->db->get('staff');
        return $query->result_array();
    }
    public function login($username,$password)
    {
        $pass=md5(sha1($username.$password));
        $sql="SELECT * FROM staff WHERE `password`=?";
        $arr=array();
        $arr[]=$pass;
        $query=$query = $this->db->query($sql,$arr);
        return $query->result_array();
    }
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `staff`");
        return $query->result_array();
    }
}
?>