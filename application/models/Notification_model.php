<?php
class Notification_model extends CI_Model {
	private $id;
	private $title;
	private $content;
	private $created_by;
	private $created_at;
	private $updated_at;
	 public function init($id,$title,$content,$created_by,$created_at,$updated_at)
    {
        $this->$id=$id;
        $this->$title=$title;
        $this->$content=$content;
        $this->$created_by = $created_by;
        $this->$created_at = $created_at;
        $this->$updated_at = $updated_at;
    }
	
    public function count()
    {
        $query=$query = $this->db->query("SELECT COUNT(`id`) AS amount FROM `notifications`");
        return $query->result_array();
    }

    public function getNotibyID()
    {
        $this->load->database('default');
        $sql = "SELECT * from notifications";
        $query = $this->db->query($sql);
        $noti = $query->result_array();
        echo "<div id='noti-box'>";
        foreach($noti as $key => $value)
        {
            
            echo "<div class = 'noti-box-item'>";
            echo "<div class='noti-box-item-img'>";
            echo "<img src='".base_url()."img/noti-1.jpg' height=250 width=350 />";
            echo "</div>";
            echo "<p class='p-noti-title'>".$value['title']."</p>";     
            echo "<p class='p-noti-create-by'>Được đăng bởi :".$value['created_by']."</p>";
            echo "<p class='p-noti-update-at'>Đăng vào ngày :".$value['updated_at']."</p>";
            echo "<p class='p-noti-content'>".$value['content']."</p>"; 
            echo "<p class='p-noti-more'><button class='btn btn-default' style='margin-right:5px;'>Xem Thêm</button ></p>";  
            echo "</div>";
            
        }
        echo "</div>";
    }
}
?>