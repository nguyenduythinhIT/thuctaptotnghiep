<?php
class Form extends CI_Controller {
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if($username==DH51401281)
        $this->session->set_userdata('id', $username);
        else
        $this->session->set_userdata('error','Lỗi đăng nhập');
        $page=$_SESSION['pre_page'];
        $this->load->helper('URL');
        redirect(base_url("".$page),'location');
    }
    public function logout()
    {
        $this->session->set_userdata('id', '');
        $this->session->set_userdata('error','');
        $page=$_SESSION['pre_page'];
        $this->load->helper('URL');
        redirect(base_url("".$page),'location');
    }
}
?>