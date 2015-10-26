<?php
//this piece of code must be the first thing
// on the page to make this a protected page
require ('CheckIfLoggedIn.php');
checkIfLoggedIn();


require_once("ConnectAss1.php");
$conn = getDbConnection();

$date = date('Y-m-d');



?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="Styles.css">

<title>Login</title>

<style>
    table, th, tr, td { border: solid 2px black;}
</style>

<head >
    <script src ="FormVal.js" type = "text/javascript"></script>


</head>

<header>






    <img id = "headerP" src="employee-icon.jpg">


</header>

<body >

<form action="AddEmp.php" method="POST" name="MyForm" id = "MyForm"  onsubmit="return checkForm()">

    <input id="FirstName" type="text" placeholder="FirstName" name = "FirstName"><br>

    <input id="LastName" type="text" placeholder="LastName" name = "LastName"><br>

    <input id="BirthDate"  type="date" value="YYYY-MM-DD"  name = "BirthDate"><br>

    <input id="HireDate"   type="date" value="YYYY-MM-DD"  name = "HireDate"><br>

    <input id="Gender" type="text" placeholder="Gender" name = "Gender"><br>

    <input id="submit" type="submit" value="Add">
</form>



<?php
$dat = $_POST['HireDate'];



if (!empty($_POST['FirstName']) && !empty($_POST['LastName'])&& !empty($_POST['BirthDate'])&& !empty($_POST['HireDate'])&& !empty($_POST['Gender'])) {

    $sql = "SELECT emp_no FROM employees ORDER BY emp_no DESC LIMIT 0, 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['emp_no'] + 1;




    $sql1 = "INSERT first_name,last_name,gender,hire_date,birth_date INTO employees VALUES ('";
    $sql1 .= "', first_name = '";
    $sql1 .= $_POST['FirstName'];
    $sql1 .= "', last_name = '";
    $sql1 .= $_POST['LastName'];
    $sql1 .= "', gender = '";
    $sql1 .= $_POST['Gender'];
    $sql1 .= "', hire_date = '";
    $sql1 .= $_POST['HireDate'];
    $sql1 .= "', birth_date = '";
    $sql1 .= $_POST['BirthDate'];
    $sql1 .= "', emp_no = '";
    $sql1 .= $_POST['id'];
    $sql1 .= ";";

    $result = mysqli_query($conn, $sql1);
    if (!$result) {
        die("Unable to insert Record: " . mysqli_error($conn));

    }

    echo("Employee Record is Stored");
}
mysqli_close($conn);
?>






</body >





</html>

