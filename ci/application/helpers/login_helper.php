<?php

function is_logged_in() {
  if (isset($_SESSION['logged_in'])) {
    return TRUE;
  } else {
    //die("Please log in.");
    echo "not logged in"; 
  }

}

 ?>
