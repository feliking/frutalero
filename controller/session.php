<?php
session_start();
session_destroy();
print "<script>window.location='../views/segurity.php';</script>";
?>