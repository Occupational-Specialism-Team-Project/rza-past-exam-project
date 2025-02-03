<?php
  session_start();
  session_unset();
  session_destroy();
//   we can then send the user back to the front page using location
?>