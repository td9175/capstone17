<?php
header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

class HealthAccount extends REST_Controller {

  // RESTful api to get the HSA accounts for a user by the email address
  // Send GET requests to https://capstone.td9175.com/ci/index.php/HealthAccount/hsa
  // GET variable: email
  function hsa_get() {
    $this->load->model('HealthAccountModel');

    if(!$this->get('email')){
      $this->response(NULL, 400);
    }

    $decoded_email = urldecode($this->get('email'));

    $user = $this->HealthAccountModel->get_hsa_info($decoded_email);

    if($user) {
      $this->response($user, 200); // 200 being the HTTP response code
    } else {
      $this->response(NULL, 404);
    }
  }

  // RESTful api to post an HSA account for a user into the database
  // Send POST requests to https://capstone.td9175.com/ci/index.php/HealthAccount/hsa
  // POST variables: account_number, email
  function hsa_post() {
    $this->load->model('HealthAccountModel');

    if(!$this->post('account_number')){
      $this->response(NULL, 400);
    } elseif ($this->post('email')) {
      $this->response(NULL, 400);
    }

    $params = array($this->post('account_number'), $this->post('email'));

    $response = $this->HealthAccountModel->post_hsa_info($params);

    if($response) {
      $this->response($response, 200); // 200 Success
    } else {
      $this->response(NULL, 404);
    }
  }

  // RESTful api to get the FSA accounts for a user by the email address
  // Send GET requests to https://capstone.td9175.com/ci/index.php/HealthAccount/fsa
  // GET variable: email
  function fsa_get() {
    $this->load->model('HealthAccountModel');

    if(!$this->get('email')){
      $this->response(NULL, 400);
    }

    $decoded_email = urldecode($this->get('email'));

    $user = $this->HealthAccountModel->get_fsa_info($decoded_email);

    if($user) {
      $this->response($user, 200); // 200 Success
    } else {
      $this->response(NULL, 404);
    }
  }

  // RESTful api to post an FSA account for a user into the database
  // Send POST requests to https://capstone.td9175.com/ci/index.php/HealthAccount/fsa
  // POST variables: account_number, email
  function fsa_post() {
    $this->load->model('HealthAccountModel');

    if(!$this->post('account_number')){
      $this->response(NULL, 400);
    } elseif ($this->post('email')) {
      $this->response(NULL, 400);
    }

    $params = array($this->post('account_number'), $this->post('email'));

    $response = $this->HealthAccountModel->post_fsa_info($params);

    if($response) {
      $this->response($response, 200); // 200 Success
    } else {
      $this->response(NULL, 404);
    }
  }


}
