<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

class HealthAccount extends REST_Controller {

  // RESTful api to get the HSA accounts for a user by the email address
  // Send GET requests to https://capstone.td9175.com/ci/index.php/HealthAccount/hsa
  // GET variable: email
  function hsa_get() {
    // Check if a user is logged in
    //is_logged_in();
    $this->load->model('HealthAccountModel');

    if(!$this->get('email')){
      $this->response(NULL, 400);
    }

    $decoded_email = urldecode($this->get('email'));

    $response = $this->HealthAccountModel->get_hsa_info($decoded_email);

    $this->response($response, 200); // 200 Success

  }

  // RESTful api to post an HSA account for a user into the database
  // Send POST requests to https://capstone.td9175.com/ci/index.php/HealthAccount/hsa
  // POST variables: account_number, email
  function hsa_post() {
    // Check if a user is logged in
    //is_logged_in();
    $this->load->model('HealthAccountModel');

    if(!$this->post('account_number')){
      $this->response(NULL, 400);
    } elseif ($this->post('email')) {
      $this->response(NULL, 400);
    }

    $params = array($this->post('account_number'), $this->post('email'));

    $response = $this->HealthAccountModel->post_hsa_info($params);

    $this->response($response, 200); // 200 Success
  }

  // RESTful api to get the FSA accounts for a user by the email address
  // Send GET requests to https://capstone.td9175.com/ci/index.php/HealthAccount/fsa
  // GET variable: email
  function fsa_get() {
    // Check if a user is logged in
    //is_logged_in();
    $this->load->model('HealthAccountModel');

    if(!$this->get('email')){
      $this->response(NULL, 400);
    }

    $decoded_email = urldecode($this->get('email'));

    $response = $this->HealthAccountModel->get_fsa_info($decoded_email);

    $this->response($response, 200); // 200 Success
  }

  // RESTful api to post an FSA account for a user into the database
  // Send POST requests to https://capstone.td9175.com/ci/index.php/HealthAccount/fsa
  // POST variables: account_number, email
  function fsa_post() {
    // Check if a user is logged in
    //is_logged_in();
    $this->load->model('HealthAccountModel');

    if(!$this->post('account_number')){
      $this->response(NULL, 400);
    } elseif ($this->post('email')) {
      $this->response(NULL, 400);
    }

    $params = array($this->post('account_number'), $this->post('email'));

    $response = $this->HealthAccountModel->post_fsa_info($params);

    $this->response($response, 200); // 200 Success
  }


}
