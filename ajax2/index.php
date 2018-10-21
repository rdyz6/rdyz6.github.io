<?php

include('connection.php');

$major = '';
$query = "SELECT DISTINCT major FROM student ORDER BY major ASC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
 $major .= '<option value="'.$row['major'].'">'.$row['major'].'</option>';
}
$gpa = '';
$query_gpa = "SELECT DISTINCT gpa FROM student ORDER BY gpa ASC";
$statement_gpa = $connect->prepare($query_gpa);
$statement_gpa->execute();
$result_gpa = $statement_gpa->fetchAll();
foreach($result_gpa as $row)
{
 $gpa .= '<option value="'.$row['gpa'].'">'.$row['gpa'].'</option>';
}
?>

<html>
 <head>
  <title>Custom Search in jQuery Datatables using PHP Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fill_datatable();
  
  function fill_datatable(filter_gender = '', filter_major = '', filter_gpa = '')
  {
   var dataTable = $('#student_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "searching" : false,
    "ajax" : {
     url:"fetch.php",
     type:"POST",
     data:{
      filter_gender:filter_gender, filter_major:filter_major, filter_gpa:filter_gpa
     }
    }
   });
  }
  
  $('#filter').click(function(){
   var filter_gender = $('#filter_gender').val();
   var filter_major = $('#filter_major').val();
   var filter_gpa = $('#filter_gpa').val();
   if(filter_gender != '' && filter_major != '' && filter_gpa != '')
   {
    $('#student_data').DataTable().destroy();
    fill_datatable(filter_gender, filter_major, filter_gpa);
   }
   else
   {
    alert('Please fullfill all options.');
    $('#select_data').DataTable().destroy();
    fill_datatable();
   }
  });
  
  
 });
 
</script>
 </head>
 <body>
  <div class="container box">
   <h3 align="center">Searching student's information</h3>
   <br />
   <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
     <div class="form-group">
      <select name="filter_gender" id="filter_gender" class="form-control" required>
       <option value="">Select Gender</option>
       <option value="Male">Male</option>
       <option value="Female">Female</option>
      </select>
     </div>
     <div class="form-group">
      <select name="filter_major" id="filter_major" class="form-control" required>
       <option value="">Select major</option>
       <?php echo $major; ?>
      </select>
     </div>
     <div class="form-group">
      <select name="filter_gpa" id="filter_gpa" class="form-control" required>
       <option value="">Select gpa</option>
       <?php echo $gpa; ?>
      </select>
     </div>
     <div class="form-group" align="center">
      <button type="button" name="filter" id="filter" class="btn btn-info">Scan</button>
     </div>
    </div>
    <div class="col-md-4"></div>
   </div>
   <div class="table-responsive">
    <table id="student_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="20%">ID</th>      
       <th width="20%">Name</th>
       <th width="10%">Gender</th>
       <th width="25%">Address</th>
       <th width="15%">Major</th>
       <th width="15%">GPA</th>
      </tr>
     </thead>
    </table>
    <br />
    <br />
    <br />
   </div>
  </div>
 </body>
</html>


