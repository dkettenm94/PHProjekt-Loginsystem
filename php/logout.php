<?php
session_start();
session_destroy();
header('Location: ../html/login_form.html');

mysqli_report(MYSQLI_REPORT_ERROR); 
error_reporting(-1);
?>