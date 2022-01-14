<?php

$db = mysqli_connect("localhost","root","","securit___entreprise");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>