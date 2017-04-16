<?php

  function is_logged_in() {
    $CI =& get_instance();
    $user = $CI->session->userdata();
    $logged_in = $CI->session->userdata('logged_in');
    var_dump($logged_in);
    // var_dump($user);
    if (!isset($user)) {
      return false;
    } else {
      return true;
      }
    }

 ?>
