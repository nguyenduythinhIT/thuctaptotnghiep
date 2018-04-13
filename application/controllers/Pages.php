<?php
class Pages extends CI_Controller {
    public function update(){
        if($_SESSION['role']!=0)
        {
            show_404();
        }
        if(isset($_POST['name']) && isset($_POST['optional']))
        {
            $page=new page_model();
            $page->update($_POST['name'],$_POST['optional']);
        }
        redirect(base_url(""."backends/".$_SESSION['pre_page']),'location');
    }

}
?>
