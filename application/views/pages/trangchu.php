<?php 
$this->load->model("class_model");
$class=new class_model();
$class->showformclass(1);
$student=new student_model();
$student->showall($student->getall());
?>
