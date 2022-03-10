<?php
require "class.php";

$index = new Index();

// If $_POST["submit"] isset
if (isset($_POST["submit"])) {
    $index->store($_POST);
    $data = $index->fetchData();
    header("Location: ../index.php?success=true");
}
