<?php
//Replace YourSession with one that will identify your site, less than 20 characteers, no spaces
session_name('Basketball');
session_start();
if (!isset($_SESSION['LoginId'])) {
header("Location: BasketballLogin.php?Msg=You must be logged in to access that page...");
$_SESSION['URLAfterLogIn'] = $_SERVER['REQUEST_URI'];
exit;
}
function AllowLoggedIn() {
if (!isset($_SESSION['LoginId'])) {
header("Location: BasketballLogin.php?Msg=You must be logged in to access that page...");
$_SESSION['URLAfterLogIn'] = $_SERVER['REQUEST_URI'];
exit;
}
}
function LoginAdvice($Links) {
return $_SESSION['FullName']
. " is logged in as " . $_SESSION['LoginId']
. " from " . $_SESSION['IPAddress']
. " $Links | <a href=\"BasketballLogOut.php\" >Log Out...</a>";
}
//Modify these to suit your site. They allow scripts to reference the organization's name appropriately
$OrganizationFullName = "NBA Clothings";
$OrganizationFullPossessive = "NBA Clothing's";
$OrganizationShortName = "Basketball";
$OrganizationShortPossessive = "Basketball's";

//Modfy the userid, password, and database name to reference your database
$DBCnxn = mysql_connect('localhost', 'mbryant', 'Myant') or die("Unable to connect to database");
$DB = mysql_select_db('mbryant', $DBCnxn) or die("Unable to select database at this time...");

?>
