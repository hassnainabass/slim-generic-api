<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

//fetch configurations
require_once 'config/auth.php';
require_once 'config/dbconnect.php';

//select all in table
$app->get('/api/{table}', function (Request $request, Response $response) {
    $table = $request->getAttribute('table');

	// Create connection
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);

	// Check connection
	if ($conn->connect_error)
	{
	    die("Connection failed: " . $conn->connect_error);
	}

    $sql = "select * from ".$table.";";
    $get_data = $conn->query($sql);
    if ($get_data->num_rows > 0)
    {
    	while ($row = $get_data->fetch_assoc())
	    {
	    	$data[] = $row;
	    }
	    header('Content-Type: application/json');
		echo json_encode($data);
    }
    else
    {
    	$data[] = "No data found";
    	header('Content-Type: application/json');
    	echo json_encode($data);
    }
    
    $conn->close();
});


//select according to column and value
$app->get('/api/{table}/{column}/{value}', function (Request $request, Response $response) {
    $table = $request->getAttribute('table');
    $value = $request->getAttribute('value');
    $column = $request->getAttribute('column');

	// Create connection
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);

	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	}

    $sql = 'select * from '.$table.' where '.$column.'="'.$value.'";';
    $get_data = $conn->query($sql);
    if ($get_data->num_rows > 0)
    {
    	while ($row = $get_data->fetch_assoc())
	    {
	    	$data[] = $row;
	    }
	    header('Content-Type: application/json');
		echo json_encode($data);
    }
    else
    {
    	$data[] = "No data found";
    	header('Content-Type: application/json');
    	echo json_encode($data);
    }
    
    $conn->close();
});


//Post data to table
$app->post('/api/{table}', function (Request $request, Response $response) {
	//echo $_REQUEST['name'];
	$table = $request->getAttribute('table');
	// Create connection
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);

	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	}

	$columns = "";
	$values = "";

	foreach($_REQUEST as $key => $value) {

	    $columns .=mysql_real_escape_string($key) . ", ";
	    $values .= "'" . mysql_real_escape_string($value) . "', ";
	}
	$columns = substr($columns, 0, -2);
	$values = substr($values, 0, -2);
	$sql = "INSERT INTO `".$table."` (".$columns.") VALUES (".$values.")";
	var_dump($sql);
    $get_data = $conn->query($sql);
    if($get_data)
	{
		echo "Success";
	}
	else
	{
		echo("Error description: " . mysqli_error($conn));
	}
	$conn->close();
});


//Update data in table
$app->post('/api/{table}/{column}/{value}', function (Request $request, Response $response) {

	$table = $request->getAttribute('table');
	$column_value = $request->getAttribute('value');
    $column = $request->getAttribute('column');

	// Create connection
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);

	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	}

	$key_values = "";

	foreach($_REQUEST as $key => $value)
	{

	    $key_values .=mysql_real_escape_string($key) . " = '". mysql_real_escape_string($value) ."', ";
	}

	$key_values = substr($key_values, 0, -2);
	
	$sql = "UPDATE `".$table."` SET ".$key_values." where ".$column."='".$column_value."';";

    $get_data = $conn->query($sql);
    if($get_data)
	{
		echo "Success";
	}
	else
	{
		echo("Error description: " . mysqli_error($conn));
	}
	$conn->close();
});

//Delete data in table
$app->post('/api/delete/{table}/{column}/{value}', function (Request $request, Response $response) {

	$table = $request->getAttribute('table');
	$column_value = $request->getAttribute('value');
    $column = $request->getAttribute('column');

	// Create connection
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);

	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "DELETE FROM `".$table."` where ".$column."='".$column_value."';";

    $get_data = $conn->query($sql);
    if($get_data)
	{
		echo "Success";
	}
	else
	{
		echo("Error description: " . mysqli_error($conn));
	}
	$conn->close();
});



//test fuction, copy and past this function to modify query or build more
$app->get('/api/add link name here/{param1}/{param2}/{param3}', function (Request $request, Response $response) {

	$param1 = $request->getAttribute('param1');
	$param2 = $request->getAttribute('param2');
    $param3 = $request->getAttribute('param3');
	// Create connection
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);

	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	}

    $sql = 'write your query here';

    $get_data = $conn->query($sql);
    if ($get_data->num_rows > 0)
    {
    	while ($row = $get_data->fetch_assoc())
	    {
	    	$data[] = $row;
	    }
	    header('Content-Type: application/json');
		echo json_encode($data);
    }
    else
    {
    	$data[] = "No data found";
    	header('Content-Type: application/json');
    	echo json_encode($data);
    }
    
    $conn->close();
});

$app->run();