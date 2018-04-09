<pre style="width:100%; margin:15px 0;">
<?php
    $this->load->model('Class_model');
    $class= new Class_model;
    $ds_class=$class->getall();
    print_r($ds_class);
?>