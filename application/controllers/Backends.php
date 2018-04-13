<?php
class Backends extends CI_Controller {

    public function views($page= "trangchu")
        {
            if ( ! file_exists(APPPATH.'views/backends/'.$page.'.php'))
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }

            $role_page=new role_page_model();
            if($_SESSION['role']==0 || $role_page->searchRolePages($_SESSION['role'],$page))
            {
                if($_SESSION['pre_page'] != 'login')
                {
                    $this->session->set_userdata('error', '');
                }
                $this->session->set_userdata('pre_page', $page);

                $data['pagename']='';
                if($page=='trangchu') $data['pagename']="Trang chủ";
                else if($page=='bangdanhgia') $data['pagename']="Quản lí bảng đánh giá rèn luyện";
                else if($page=='ketqua') $data['pagename']="Kết quả đánh giá rèn luyện";
                else if($page=='sinhvien') $data['pagename']="Quản lí sinh viên";
                else if($page=='canbo') $data['pagename']="Quản lí cán bộ";
                else if($page=='danhmuc') $data['pagename']="Thông tin năm học";
                else if($page=='thongbao') $data['pagename']="Thông báo";
                else if($page=='phanquyen') $data['pagename']="Phân quyền";
                else if($page=='pages') $data['pagename']="Các trang website";
                $data['title'] = 'Cổng thông tin STU';  

                $this->load->helper('url');
                $this->load->view('templates/header', $data);;
                $this->load->view('templates/bs-navbar', $data);
                $this->load->view('templates/dangnhap', $data);
                $this->load->view('templates/title_bar', $data);
                $this->load->view('templates/vertical_menu', $data);
                $this->load->view('backends/'.$page, $data);
                $this->load->view('templates/footer', $data); 
            }
            else{
                show_404();
            }
        }
    public function backview($page,$id)
        {
            $role_page=new role_page_model();
            if($_SESSION['role']==0 || $role_page->searchRolePages($_SESSION['role'],$page))
            {
                if($_SESSION['pre_page'] != 'login')
                {
                    $this->session->set_userdata('error', '');
                }
                $this->session->set_userdata('pre_page', $page."/".$id);
                $data['pagename']='';
                $data['title'] = 'Cổng thông tin STU';  
                $data['id']=$id;
                $this->load->helper('url');
                $this->load->view('templates/header', $data);;
                $this->load->view('templates/bs-navbar', $data);
                $this->load->view('templates/dangnhap', $data);
                $this->load->view('templates/title_bar', $data);
                $this->load->view('templates/vertical_menu', $data);
                $this->load->view('backends/'.$page, $data);
                $this->load->view('templates/footer', $data); 
            }
            else{
                show_404();
            }
        }
}
?>  