<?php

function is_logged_in() {
  // $CI =& get_instance();
  // $user = $CI->session->userdata();
  // $logged_in = $CI->session->userdata('logged_in');
  if (isset($_SESSION['logged_in'])) {
    var_dump($_SESSION['logged_in']);
    return TRUE;
  } else {
    return FALSE;
  }

}

 ?>
