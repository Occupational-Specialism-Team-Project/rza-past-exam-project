<?php
  require_once "include/utils.php";

  if (! isset($_SESSION["user"])) {
    redirect("index.php");
  }

  session_unset();
  session_destroy();
  redirect("index.php?logout");