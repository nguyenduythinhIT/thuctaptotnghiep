<?php
class Phanquyen extends CI_Controller {

    public function add()
        {
            if(isset($_POST['name']))
            {
                $name=$_POST['name'];
                if($name != "")
                {
                    $role=new role_model();
                    if($role->searchbyNAME($name))
                    {}
                    else if($role->insert($name)==0)
                    {
                        echo "<h3 class='text-danger'>Lỗi Insert database</h3>";
                        echo "<a href='".base_url()."backends/".$_SESSION['pre_page']."'><button>Quay về</button></a>";
                    }
                    else{
                        redirect(base_url(""."backends/".$_SESSION['pre_page']),'location');
                    }
                }
                else{
                    echo "<h3 class='text-danger'>Phải nhập tên chức vụ</h3>";
                    echo "<a href='".base_url()."backends/".$_SESSION['pre_page']."'><button>Quay về</button></a>";
                }
            }
            else 
            {
                show_404();
            }
        }
    public function delete($id)
        {
            $role=new role_model();
            if($role->delete($id))
            {
                redirect(base_url(""."backends/".$_SESSION['pre_page']),'location');
            }
            else
            {
                echo "<h3 class='text-danger'>Lỗi DELETE database</h3>";
                echo "<a href='".base_url()."backends/".$_SESSION['pre_page']."'><button>Quay về</button></a>";
            }
        }
    public function role_page_add()
        {
            echo "r p a";
        }
}
?>