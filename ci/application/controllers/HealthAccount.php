<?php
header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

class HealthAccount extends REST_Controller {

  // function hsa_get($id) {
  //   $this->load->model('HealthAccountModel');
  //
  //   if(!$this->get('id'))
  //   {
  //     $this->response(NULL, 400);
  //   }
  //
  //   $user = $this->HealthAccountModel->get_hsa_info($this->get('id') );
  //
  //   if($user)
  //   {
  //
  //     $this->response($user, 200); // 200 being the HTTP response code
  //   }
  //
  //   else
  //   {
  //     $this->response(NULL, 404);
  //   }
  // }

  function hsa_get() {
    $this->load->model('HealthAccountModel');

    if(!$this->get('email'))
    {
      $this->response(NULL, 400);
    }

    $user = $this->HealthAccountModel->get_hsa_info($this->get('email') );

    if($user)
    {

      $this->response($user, 200); // 200 being the HTTP response code
    }

    else
    {
      $this->response(NULL, 404);
    }
  }

  // function fsa_get($id) {
  //   $this->load->model('HealthAccountModel');
  //
  //   if(!$this->get('id'))
  //   {
  //     $this->response(NULL, 400);
  //   }
  //
  //   $user = $this->HealthAccountModel->get_fsa_info($this->get('id'));
  //
  //   if($user)
  //   {
  //     $this->response($user, 200); // 200 being the HTTP response code
  //   }
  //
  //   else
  //   {
  //     $this->response(NULL, 404);
  //   }
  // }

  function fsa_get() {
    $this->load->model('HealthAccountModel');

    if(!$this->get('email'))
    {
      $this->response(NULL, 400);
    }

    $user = $this->HealthAccountModel->get_fsa_info($this->get('email'));

    if($user)
    {
      $this->response($user, 200); // 200 being the HTTP response code
    }

    else
    {
      $this->response(NULL, 404);
    }
  }

}
