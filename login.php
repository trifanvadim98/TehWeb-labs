<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "actor";

$id = "";
$firstname = "";
$lastname = "";
$password = "";

try {
	$connect = mysqli_connect($host, $user, $password, $database);
} catch (Exception $ex) { 
	echo 'Error';
}

function getPosts(){
	$posts = array();
	$posts = $_POST['id'];
	$posts = $_POST['firstname'];
	$posts = $_POST['lastname'];
	$posts = $_POST['password'];
	return $posts;
}

if(isset($_POST['search']))
{
	$data = getPosts();

	$search_Query = "SELECT * FROM Users WHERE id = $data[0]";

	$search_Result = mysqli_query($connect, $search_Query);

if($search_Result)
{
	if(mysqli_num_rows($search_Result))
	{
		while($row = mysql_fetch_array($search_Result))
		{
			$id = $row['id'];
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$password = $row['password'];

		}
	}else{
		echo 'No Data For This Id';
	}
}else {
	echo 'Result Error';
}
}

if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `Users`( `fname`, `lname`, `password`) VALUES ('$data[1]','$data[2]',$data[3])";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Inserted';
            }else{
                echo 'Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();
    $delete_Query = "DELETE FROM `Users` WHERE `id` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Deleted';
            }else{
                echo 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query = "UPDATE `Users` SET `fname`='$data[1]',`lname`='$data[2]',`age`=$data[3] WHERE `id` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Updated';
            }else{
                echo 'Data Not Updated';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}

// $mysqli = false;
// function connectDB () {
// 	global $mysqli;
// 	$mysqli = new mysqli("localhost", "root", "", "login");
// 	$mysqli->query("SET NAMES 'utf-8'");
// }
// function closeDB () {
// 	global $mysqli;
// 	$mysqli->close ();
// }
?> 


<!DOCTYPE html>
<html>
	<head>
			<link href="style.css" rel="stylesheet">
		<title>Login Page</title>
	</head>
	<body>
		<div class="back">
		<div id="frm">
<form action="login.php" method="POST">

	<input type="number" name="id" placeholder="Id" value="<?php echo $id;?>"><br><br>
	<input type="text" name="fname" placeholder="First Name" value="<?php echo $firstname;?>><br><br>
	<input type="text" name="lname" placeholder="Last Name" value="<?php echo $lastname;?>><br><br>
	<input type="text" name="password" placeholder="Password" value="<?php echo $password;?>><br><br>

<div>
	<input type="submit" name="insert" value="Add">
	<input type="submit" name="update" value="Update">
	<input type="submit" name="delete" value="Delete">
	<input type="submit" name="search" value="Find">

</div>
</form>
		</div>
		</div>
	</body>
</html>