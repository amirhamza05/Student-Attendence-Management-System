<?php

if($courseId == "" || $startDate == "" || $endDate == "")exit;


$data = report()->get([
	'student_id' => $studentId,
	'course_id' => $courseId,
	'start_date' => $startDate,
	'end_date' => $endDate
]);

$studentNames = $data['studentNames'];
$attendenceStat = $data['attendenceState'];
$attendences = $data['reportData'];

$course = course()->get($courseId);

?>

<div style="text-align: center;">
	<h2><?php echo $course['course_name']." (".$course['course_code'].")"; ?> <h2>
	<h3>Section: <?php echo $course['section_name']; ?></h3>
	<h3>Semester: <?php echo $course['semester']; ?></h3>
</div>

<hr/>


<?php foreach ($attendences as $year => $monthData) { ?>

<?php foreach ($monthData as $month => $students) { 
	$monthName = date('F', mktime(0, 0, 0, $month, 10)); 
?>

<center>
	<h3><?php echo $monthName." - ".$year; ?></h3>
</center>
<?php 
	$days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
?>

<table width="100%" style="background-color: #ffffff; margin-bottom: 30px;" >
	<thead style="border-width: 0px;">
	<tr class="attend_tr">
		<td class="attend_td1" style="width: 70px">ID</td>
		<td class="attend_td1" style="width: 140px">Name</td>
		<?php for($i=1; $i<=$days; $i++){ ?>
		<td class="attend_td1" style="width: 15px"><?php echo "$i"; ?></td>
	    <?php } ?>
	    <td class="attend_td1" style="width: 25px">T.P.</td>
	    <td class="attend_td1" style="width: 25px">T.A.</td>		
	</tr>
	</thead>

	<tbody>
		<?php
       
      foreach ($students as $key => $student) {
      	$studentId=$key;
      	$studentName=$studentNames[$studentId];
        
       	?>

		<tr class="attend_tr">
			<td class="attend_td2" style="width: 70px;background-color: #f7f7f7;color: #000000"><b><?php echo "$studentId"; ?></b></td>
			<td class="attend_td2" style="width: 130px;background-color: #f7f7f7;color: #000000"><b><?php echo "$studentName"; ?></b></td>
			<?php 
             
            $present=0;
            $absent=0;
			for($i=1; $i<=$days; $i++){

                $att_cls="";
                $att="";

                $status="";
               
                if(isset($student[$i])){
                  $status=$student[$i];
                }
                
                
                if($status == "absent"){
                    $absent++;
                	$att_cls="absent_class";
                	$att="A";
                }
                else if($status== "")$pr="";
                else {
                	$present++;
                	$att_cls="present_class";
                	$att="P";
                }
			 ?>
			<td class="attend_td2 <?php echo $att_cls; ?>" style=""><b><?php echo "$att"; ?></b></td>
	    	<?php } ?>
	    	<td class="attend_td2" style="width: 10px; background-color: #f7f7f7;color: #000000"><b><?php echo "$present"; ?></b></td>
	    	<td class="attend_td2" style="width: 10px; background-color: #f7f7f7;color: #000000"><b><?php echo "$absent"; ?></b></td>		
		</tr>
		<?php } ?>

	</tbody>
</table>

<?php } } ?>



<table class="table table-bordered b-report" style="margin-top: 60px;width: 50%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student Name</th>
      <th scope="col">Total Present</th>
      <th scope="col">Total Absent</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach ($attendenceStat as $key => $stat) { ?>
  		<tr>
      		<th scope="row"><?php echo $stat['student_id']; ?></th>
      		<td><?php echo $studentNames[$stat['student_id']]; ?></td>
      		<td><?php echo $stat['present']; ?></td>
      		<td><?php echo $stat['absent']; ?></td>
    	</tr>
	<?php } ?>
    
  </tbody>
</table>

<style type="text/css">

.attend_area{
		background-color: #ffffff;
		padding: 15px;
		border-radius: 5px;
	}
	.report_title{
 	font-size: 18px;
 	color: #1A2229;
 	font-family: Verdana, Geneva, sans-serif;
 }
 .report_description{
 	color: #1A2229;
 	font-size: 14px;
 	font-family: Verdana, Geneva, sans-serif;
 }  
	.attend_table{

	}
	.attend_td1{
		padding: 8px 0px 8px 0px;
		background-color: #EFF0F2;
		color: #000000;
		font-weight: bold;
		border: 1px solid #C6C9D1;
		font-size: 12px;
		text-align: center;
	}
	.attend_td2{
		padding: 6px 2px 6px 2px;
		text-align: center;
		font-size: 10px;
		color: #5C6765;
		border: 1px solid #C6C9D1;
		font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
	}
	.present_class{
       background-color: #CDFFD8;

	}
	.absent_class{
		background-color: #FFDCE0;
	}
	@page {
  		size: landscape;
	}

	.b-report td{
		border: 1px solid #eeeeee!important;
		padding: 5px;
	}

	@media print
{
  table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
}

</style>
