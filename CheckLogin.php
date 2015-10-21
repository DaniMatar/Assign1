<?php

session_start();
ob_start();

require_once("ConnectAss1.php");
$conn = getDbConnection();

?>



<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="Styles.css">

<title>Check Login</title>

<style>
    table, th, tr, td { border: solid 2px black;}
</style>

<head >

</head>

<header>

    <img id = "headerP" src="employee-icon.jpg">

</header>

<body >

<?php

//***************************************************************POST USERNAME AND PASS
$UserName =     $_POST["UserName"];
$Password = $_POST["Password"];

//***************************************************************Perform strip
$UserName =     stripslashes( $UserName);
$Password = stripslashes($Password);
$UserName =     mysqli_real_escape_string($conn, $UserName);
$Password = mysqli_real_escape_string($conn,$Password);

//***************************************************************Hash the password

$hashedPassword =  hash("sha512",$Password);




//get username and password to see if they are a combo match in the database
$sqlStatement = "SELECT * FROM Web_Users WHERE Username='$UserName' and Password='$hashedPassword'";
$result = mysqli_query($conn,$sqlStatement);
$count = mysqli_num_rows($result);
if (!$result) {
    die('Could not retrieve record from the Employees Database: ' . mysqli_error($conn));
}

//************disconnect and close database************************************
mysqli_close($conn);


//************checks for valid user and password*******************************
if($count == 1) {
    $_SESSION['UserName'] = $UserName;
    $_SESSION['Password'] = $Password;
    header("location:LoggedIn.php");
} else {
    echo "<h1>Employee Database Login Error</h1>";
    echo "Wrong Username and/or Password!";
    echo "<br/>";
    echo "<br/>";
    echo '<a href="Login.php">Try Again</a>';
}

ob_end_flush(); //clears output buffer
?>

<img id = "BackG" src="Bg.jpg">

</body >





</html>
