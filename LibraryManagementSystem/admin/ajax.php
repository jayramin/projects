<?php
include("conn.php");
if($_REQUEST['do']=='getsemister')
{
    $deptId=$_REQUEST['dept_id'];
    $query="select * from sem where department_id=".$deptId."";
    $rs=$conn->query($query);
     $HTML = '';
      $HTML .= '<option value="">--Select Semister--</option>';
     while($r=$rs->fetch_object()){ 
       
                    $HTML .= '<option value="' . $r->sem_id. '">' .$r->sem . '</option>';
            }  
    echo $HTML;   
}elseif($_REQUEST['do']=='getdivision')
{
   $sem_id=$_REQUEST['sem_id'];
    $query="select * from division where sem_id=".$sem_id."";
    $rs=$conn->query($query);
     $HTML = '';
      $HTML .= '<option value="">--Select Devision--</option>';
     while($r=$rs->fetch_object()){ 
                    $HTML .= '<option value="' . $r->div_id. '">' .$r->division . '</option>';
            }  
    echo $HTML;  
}elseif($_REQUEST['do']=='getstudents')
{
   $dept_id=$_REQUEST['dept_id'];
  echo  $query="select * from registration where department_id=".$dept_id."";
    $rs=$conn->query($query);
     $HTML = '';
      $HTML .= '<option value="">--Select User--</option>';
     while($r=$rs->fetch_object()){ 
      
                    $HTML .= '<option value="' . $r->regist_id. '">' .$r->name . '</option>';
            }  
    echo $HTML;  
}
?>