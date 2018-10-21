<?php

include('connection.php');

$column = array('id', 'name','gender', 'address', 'major','gpa');

$query = "
SELECT * FROM student 
";

if(isset($_POST['filter_gender'], $_POST['filter_major'], $_POST['filter_gpa']) && $_POST['filter_gender'] != '' && $_POST['filter_major'] != '' && $_POST['filter_gpa'] != '')
{
 $query .= '
 WHERE Gender = "'.$_POST['filter_gender'].'" AND major = "'.$_POST['filter_major'].'" AND gpa = "'.$_POST['filter_gpa'].'" 
 ';
}

if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();



$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['id'];
 $sub_array[] = $row['name'];
 $sub_array[] = $row['gender'];
 $sub_array[] = $row['address'];
 $sub_array[] = $row['major'];
 $sub_array[] = $row['gpa'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM student";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_POST["draw"]),
 "recordsTotal"   =>  count_all_data($connect),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data
);

echo json_encode($output);

?>