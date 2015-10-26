
<?php
//this piece of code must be the first thing
// on the page to make this a protected page
require ('CheckIfLoggedIn.php');
checkIfLoggedIn();


require_once("ConnectAss1.php");
$conn = getDbConnection();

$searchquery = $_POST['searchquery'];



?>





<!DOCTYPE html>
<html>




<link rel="stylesheet" type="text/css" href="Styles.css">

<title>Employee Search</title>

<style>
    table, th, tr, td { border: solid 2px black;}
</style>

<head >


    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input id="Search" type="text" placeholder="Search" name = " searchquery" value="<?php echo $searchquery; ?>">
        <input id="submit" type="Submit" value="Search">
    </form>




    <?php

    if(isset($_GET["sq"])){
        $sq = preg_replace('#[^a-z 0-9?!]#i', '', $_GET['sq']);
        $_POST['searchquery'] = $sq;
    }

    if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
        //echo $_POST['searchquery'];
    } else {

    }

?>



    </head>

<header>






    <img id = "headerP" src="employee-icon.jpg">

</header>

<body>

<?php
// Search Query 1
$paginationDisplay = "";
$search_output = "";

if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
    $searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']);

    $sqlCommand = "SELECT emp_no,first_name,last_name,gender,hire_date,birth_date FROM employees WHERE first_name LIKE '%$searchquery%' OR last_name LIKE '%$searchquery%' ORDER BY emp_no DESC ";


$query = mysqli_query($conn, $sqlCommand) ;
$count = mysqli_num_rows($query);

    $i  = 0;
    if($count > 1){
$search_output .= "<h3 class='title'>$count Results for $searchquery</h3><br>
                           <h3 class='title'><span class='icon-cancel-1'></span><a href='EmpSearch.php' target='_self'>Clear Search</a> </h3>";

$sqll = "SELECT emp_no,first_name,last_name,gender,hire_date,birth_date FROM employees WHERE first_name LIKE '%$searchquery%' OR last_name LIKE '%$searchquery%'ORDER BY emp_no DESC ";


$sql = mysqli_query($conn, $sqll) ;


$nr = mysqli_num_rows($sql); // Get total of Num rows from the database query



if (isset($_GET['pn'])) { // Get pn from URL vars if it is present
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); // filter everything but numbers for security(new)

} else { // If the pn URL variable is not present force it to be value of page number 1
    $pn = 1;
}
//This is where we set how many database items to show on each page
$itemsPerPage = 25;
// Get the value of the last page in the pagination result set
$lastPage = ceil($nr / $itemsPerPage);

if ($pn < 1) {
    $pn = 1;
} else if ($pn > $lastPage) { // if it is greater than $lastpage
    $pn = $lastPage; // force it to be $lastpage's value
}

$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
if ($pn == 1) {
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&sq=' . $searchquery . '">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&sq=' . $searchquery . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '&sq=' . $searchquery . '">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&sq=' . $searchquery . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&sq=' . $searchquery . '">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '&sq=' . $searchquery . '">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '&sq=' . $searchquery . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '&sq=' . $searchquery . '">' . $add1 . '</a> &nbsp;';
}

$limit = 'LIMIT ' . ($pn - 1) * $itemsPerPage . ',' . $itemsPerPage;

$sql22 = "SELECT emp_no,first_name,last_name,gender,hire_date,birth_date FROM employees WHERE first_name LIKE '%$searchquery%' OR last_name LIKE '%$searchquery%' ORDER BY emp_no DESC $limit";


$sql2 = mysqli_query($conn, $sql22) ;


//////////////////////////Pagination Logic ////////////////////////////////////////////////////////////////////////////////

$paginationDisplay = ""; // Initialize the pagination output variable
// This code runs only if the last page variable is ot equal to 1, if it is only 1 page we require no paginated links to display
if ($lastPage != "1") {
    // This shows the user what page they are on, and the total number of pages
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage . '&nbsp;  &nbsp;  &nbsp; ';

    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .= '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '&sq=' . $searchquery . '">Previous</a> &nbsp; &nbsp; ';
    }

    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
    // If we are not on the very last page we can place the Next button
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .= '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '&sq=' . $searchquery . '">Next</a> &nbsp; &nbsp; ';
    }
}
/////////////////////////////////////Pagination Display Setup ///////////////////////////////////////////////////////////////////////////

$outputList = "";

if (!$sql2) {
    die("Unable to Retrieve records: " . mysqli_error($conn));
}
?>

<div id="TS">

    <div class="heading">

        <table class="ResultTable1" border="1">
            <thead>
            <th>Emp #</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Hire Date</th>
            <th><img id="edit" src="file_edit.png"></th>
            </thead>

            <?php



            while ($row = mysqli_fetch_assoc($sql2)):
                ?>
                <tr>
                    <td><?php echo $row['emp_no'] ?></td>
                    <td><?php echo $row['first_name'] ?></td>
                    <td><?php echo $row['last_name'] ?></td>
                    <td><?php echo $row['gender'] ?></td>
                    <td><?php echo $row['hire_date'] ?></td>
                    <td> <form action='EditEmp.php' method='POST'>
                    <input type='hidden' name='tempId' value="<?=$row['emp_no']?>"/>
                    <input type='submit' name='submit-btn' value='View/Update Details' /></form></td></tr>





            <?php
            endwhile;
            }

            }

            mysqli_close($conn);
            ?>


            </tbody>


        </table>



        <div class = "hscroll" >

            <div id = "Scroll"><?php echo $paginationDisplay; ?></div>
            <div style="margin-left:64px; margin-right:64px;"><?php print "$outputList"; ?></div>

        </div>


</div>
    </div>





        </body>
        <footer>

        </footer>
        </html>



