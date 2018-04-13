<?php
class Form extends CI_Controller {
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $student= new student_model;
        $staff=new staff_model();
        $ex=$student->login($username,$password);
        if(count($ex) == 1){
            $this->session->set_userdata('id',$ex[0]['id']);
            $this->session->set_userdata('name',$ex[0]['name']);
            $this->session->set_userdata('role',$ex[0]['role_id']);
        }
        else{
            $ex=$staff->login($username,$password);
            if(count($ex)==1)
            {
                $this->session->set_userdata('id',$ex[0]['id']);
                $this->session->set_userdata('name',$ex[0]['name']);
                $this->session->set_userdata('role',$ex[0]['role_id']);
            }
            else
            {
                $this->session->set_userdata('error','Lỗi đăng nhập');
            }
            
        }
            
        $page=$_SESSION['pre_page'];
        $this->session->set_userdata('pre_page', 'login');
        $this->load->helper('URL');
        redirect(base_url("".$page),'location');
    }
    public function logout()
    {
        $this->session->set_userdata('id', "");
        $this->session->set_userdata('name', "");
        $this->session->set_userdata('error','');
        $this->session->set_userdata('role',-1);
        $page=$_SESSION['pre_page'];
        $this->load->helper('URL');
        redirect(base_url(""."trangchu"),'location');
    }
}
?>