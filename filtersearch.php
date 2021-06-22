<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = $_POST['gender'];

    getrowdata($gender);
}
?>