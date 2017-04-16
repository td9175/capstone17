<?php

  function is_logged_in() {
    $CI =& get_instance();
    $user = $CI->session->userdata();
    var_dump($user);
    if (!isset($user)) {
      return false;
    } else {
      return true;
      }
    }

 ?>
