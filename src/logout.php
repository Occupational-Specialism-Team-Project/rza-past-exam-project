<?php
  require_once "include/utils.php";
  session_unset();
  session_destroy();
  redirect("index.php");
?>