<?php 
$this->load->model("Notification_model");
$noti=new Notification_model();
$noti->getNotibyID();
$role_page=new role_page_model();
?>
