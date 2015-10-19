<?php

//this piece of code must be the first thing
// on the page to make this a protected page


require ('CheckIfLoggedIn.php');
checkIfLoggedIn();

require_once("ConnectAss1.php");
$conn = getDbConnection();















