<?php
class Pages extends CI_Controller {

    public function views($page = "trangchu")
    {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        $this->session->set_userdata('pre_page', $page);
        $data['title'] = 'Cổng thông tin STU';
        $data['test'] = 'Đăng Nhập';
        $this->load->helper('url');
        $this->load->view('templates/header', $data);;
        $this->load->view('templates/bs-navbar', $data);
        $this->load->view('templates/dangnhap', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);

    }
    
}
?>  