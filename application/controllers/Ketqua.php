<?php
class Ketqua extends CI_Controller {
    public function add()
    {
        print_r($_POST);
        echo md5(sha1('DH01234567DH01234567'));
    }
}