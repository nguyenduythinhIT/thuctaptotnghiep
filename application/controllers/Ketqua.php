<?php
class Ketqua extends CI_Controller {
    public function add()
    {
        $topic=new topic_model();
        $eva=new evaluation_criteria_model();
        $evaform=new evaluation_form_model();
        $result=new evaluation_result_model();
        $se=new semester_model();
        $semester=$se->getall();
        if(count($semester)>1) {$semester=end($semester);}
        else if(count($semester)==1) {$semester=$semester[0];}
        else {
            $semester=array('id' => 0);
        }
        if($evaform->isform($_SESSION['id'],$semester['id']))
        {
            echo "FORM đã tồn tại không thể thêm";
        }
        else
        {
            $total=$topic->parentMaxscore();
            foreach($_POST as $k=>$v)
            {
                $eva_cr=explode("-",$k)[1];
                $pr=$eva->searchbyID($eva_cr)[0]['topic_id'];
                echo $total[$pr]['score']+=$v;
                if( $total[$pr]['score'] > $total[$pr]['max_score']) {
                    $total[$pr]['score'] =  $total[$pr]['max_score'];
                }
            }
            $t=0;
            $evaform->insert($t,$semester['id'],$_SESSION['id']);
            $eva_fr=$evaform->search($_SESSION['id'],$semester['id']);
            $eva_fr=$eva_fr[0]['id'];
            foreach($_POST as $k=>$v)
            {
                $eva_cr=explode("-",$k)[1];
                $result->insert($v,$eva_cr,$eva_fr);
            }
            }
            redirect(base_url(""."ketqua"),'location');
    }
    public function update()
    {
        $topic=new topic_model();
        $eva=new evaluation_criteria_model();
        $evaform=new evaluation_form_model();
        $result=new evaluation_result_model();
        $se=new semester_model();
        $semester=$se->getall();
        $rs=new evaluation_result_model();
        if(count($semester)>1) {$semester=end($semester);}
        else if(count($semester)==1) {$semester=$semester[0];}
        else {
            $semester=array('id' => 0);
        }
        if($evaform->isform($_SESSION['id'],$semester['id']))
        {
            $fr_id=$evaform->search($_SESSION['id'],$semester['id'])[0]['id'];
            foreach($_POST as $k=>$v)
            {
                $cr_id=explode("-",$k)[1];
                $rs->updatebySTU($v,$cr_id,$fr_id);
            }
        }
        else
        {
            echo "FORM Không tồn tại không thể Update";
        }
        redirect(base_url(""."ketqua"),'location');
    }
    public function updatebyMON($id)
    {
        $topic=new topic_model();
        $eva=new evaluation_criteria_model();
        $evaform=new evaluation_form_model();
        $result=new evaluation_result_model();
        $se=new semester_model();
        $semester=$se->getall();
        $rs=new evaluation_result_model();
        if(count($semester)>1) {$semester=end($semester);}
        else if(count($semester)==1) {$semester=$semester[0];}
        else {
            $semester=array('id' => 0);
        }
        if($evaform->isform($id,$semester['id']))
        {
            $fr_id=$evaform->search($id,$semester['id'])[0]['id'];
            foreach($_POST as $k=>$v)
            {
                $cr_id=explode("-",$k)[1];
                $rs->updatebyMON($_SESSION['id'],$v,$cr_id,$fr_id);
            }
        }
        else
        {
            echo "FORM Không tồn tại không thể Update";
        }
        redirect(base_url(""."backends/ketqua"),'location');
    }
}