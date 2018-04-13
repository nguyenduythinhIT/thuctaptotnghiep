<?php
$class=new class_model();
$faculty=new faculty_model();
$semester=new semester_model();
?>
<table style="width:80%;margin:10px auto;" class='table'>
<tr><td><a href="<?php echo base_url(); ?>backends/danhmuc/khoa"><button class='btn btn-primary'>Xem danh sách Khoa</button></a></td><td>Hiện có <?php echo $faculty->count()[0]['amount'];?> Khoa trong danh sách</td></tr>
<tr><td><a href="<?php echo base_url(); ?>backends/danhmuc/lop"><button class='btn btn-primary'>Xem danh sách Lớp học</button></a></td><td>Hiện có <?php echo $class->count()[0]['amount'];?> Lớp trong danh sách</td></tr>
<tr><td><a href="<?php echo base_url(); ?>backends/danhmuc/hocki"><button class='btn btn-primary'>Xem danh sách Học kì</button></a></td><td>Hiện có <?php echo $semester->count()[0]['amount'];?> Học kì trong danh sách</td></tr>
</table>
