<?php

  function is_logged_in() {
    // $CI =& get_instance();
    // $user = $CI->session->userdata();
    // $logged_in = $CI->session->userdata('logged_in');
    $logged_in = $_SESSION['logged_in'];
    var_dump($logged_in);
    // var_dump($user);
    if (!isset($logged_in)) {
      return false;
    } else {
      return true;
      }
    }

 ?>
