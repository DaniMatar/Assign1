<!-- Now We are in index.php ---->
<?php
// Script and tutorial written by Adam Khoury @ developphp.com
// Line by line explanation : youtube.com/watch?v=T2QFNu_mivw
require_once("ConnectAss1.php");
$conn = getDbConnection();

require ('CheckIfLoggedIn.php');
checkIfLoggedIn();



?>




<!DOCTYPE html>

<html lang="eng">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Pagination</title>

</head>
<body>
<?php



//        display the results //
//step:8








$_POST['per_page'] = $_SESSION['per_page'];                      //number of results to shown per page
$_POST['num_links']=$_SESSION['num_links'] ;                        // how many links you want to show
$_POST['total_rows']=$_SESSION['total_rows'];
$_POST['cur_page']=$_SESSION['cur_page'];
$_POST['res']= $_SESSION['res'];


if (isset($res))// results from Step 7
{
    //creating table
    echo '<table style="width:600px; cell-padding:4px; cell-spacing:0; margin:auto;">';
    echo '<th>id</th><th>title</th><th>content</th></tr>';
    while ($result = mysqli_fetch_assoc($res)) {
        echo '<tr>';
        echo '<td>' . $result['id'] . '</td>' . '<td>' . $result['title'] . '</td>' . '<td>' . $result['content'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>

<!--//display pagination page numbers //
    //step:9
    -->
<div id="pagination">
    <div id="pagiCount">
        <?php
        if (isset($pages)) {
            if ($pages > 1) {
                if ($cur_page > $num_links)     // for taking to page 1 //
                {
                    $dir = "first";
                    echo '<span id="prev"> <a href="' . $_SERVER['PHP_SELF'] . '?page=' . (1) . '">' . $dir . '</a> </span>';
                }
                if ($cur_page > 1) {
                    $dir = "prev";
                    echo '<span id="prev"> <a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page - 1) . '">' . $dir . '</a> </span>';
                }

                for ($x = $start; $x <= $end; $x++) {

                    echo ($x == $cur_page) ? '<strong>' . $x . '</strong> ' : '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . $x . '">' . $x . '</a> ';
                }
                if ($cur_page < $pages) {
                    $dir = "next";
                    echo '<span id="next"> <a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page + 1) . '">' . $dir . '</a> </span>';
                }
                if ($cur_page < ($pages - $num_links)) {
                    $dir = "last";

                    echo '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . $pages . '">' . $dir . '</a> ';
                }
            }
        }


        ?>

    </div>
</div>







</body>
</html>