<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

class UserAccountModel extends CI_Model {

    // Load the database for every call
    function __construct() {
      parent::__construct();
      $this->load->database();
    }

    // Get info for every user
    function get_users() {

  		$query = $this->db->query('SELECT * from UserAccount');

  		foreach ($query->result_array() as $row) {
        $data[] = array(
  				'email' => $row['email'],
  				'first_name' => $row['first_name'],
          'last_name' => $row['last_name'],
          'is_enabled' => $row['is_enabled'],
          'is_admin' => $row['is_admin']
				);
  		}
      // Pass back the data
    	return $data;
    }

    // Get all enabled user accounts
    function get_enabled_users() {

      $query = $this->db->query('SELECT * from UserAccount WHERE is_enabled=1');
      if ($query->num_rows() > 0) {
        foreach ($query->result_array() as $row) {
          $data[] = array(
            'email' => $row['email'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'is_admin' => $row['is_admin']
          );
        }
      } else { $data = "Error: could not retrieve list of enabled accounts."; }
      return $data;
    }

    // Get all disabled user accounts
    function get_disabled_users() {

      $query = $this->db->query('SELECT * from UserAccount WHERE is_enabled=0');
      // Check if any results are returned from the query
      if ($query->num_rows() > 0) {
        foreach ($query->result_array() as $row) {
          $data[] = array(
            'email' => $row['email'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'is_admin' => $row['is_admin']
          );
        }
      } else { $data = "Error: could not retrieve list of disabled accounts."; }
      // Pass back the data
      return $data;
    }

    // Get all user info for the logged in account
    function get_user($email) {

      $query = "SELECT * FROM UserAccount WHERE email = ?";

	    $result = $this->db->query($query, $email);

      foreach ($result->result_array() as $row) {
			$data[] = array(
				'email' => $row['email'],
				'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'is_enabled' => $row['is_enabled'],
        'is_admin' => $row['is_admin']
			);
  		}
      // Pass back the data
    	return $data;
    }

    // Register a user account
    function post_registration($email, $hash_pass, $first_name, $last_name){

      // Build the query to create a user account
      $query = "INSERT INTO UserAccount (email, hash_pass, first_name, last_name) VALUES (?,?,?,?)";

      // Create an array of the parameters for paramater binding
      $params = array($email, $hash_pass, $first_name, $last_name);

      // Execute the query
      if ($this->db->query($query, $params)){
        $data['registration'] = "Much success! Account created. Go login.\n";
      } else {
        $data['registration'] = "Error! Account registration failed.\n";
      }
      // Pass back the data
      return $data;
    }

    // Login a user
    function post_login($email){

      // Build the query to check for account with an email provided by the user
      $query = "SELECT hash_pass, is_enabled, is_admin FROM UserAccount WHERE email=?";

      // Execute the query
      $result = $this->db->query($query, $email);

      if (count($result->result_array()) == 0){
        $data['response'] = "Incorrect email or password.";
      } else {
        // Insert the associated hash_pass into the data array
        foreach ($result->result_array() as $row) {
          $data['hash_pass'] = $row['hash_pass'];
          $data['is_enabled'] = $row['is_enabled'];
          $data['is_admin'] = $row['is_admin'];
        }
      }
      // Pass back the data
      return $data;
  }

  // Disable a users account
  function disable_user($email) {

    // Build the query
    $query = "UPDATE UserAccount SET enabled=0 WHERE email = ?";
    // Execute the query
    $result = $this->db->query($query, $email);
    // Check if the row was affected
    if ($this->db->affected_rows() == 1) {
      $message = "Success: account disabled.";
    } else {
      $message = "Error: failed to disable account.";
    }
    // Return the result message
    return $message;
  }

  // Enable a user account
  function enable_user($email) {

    // Build the query
    $query = "UPDATE UserAccount SET enabled=1 WHERE email = ?";
    // Execute the query
    $result = $this->db->query($query, $email);
    // Check if the row was affected
    if ($this->db->affected_rows() == 1) {
      $message = "Success: account enabled.";
    } else {
      $message = "Error: failed to enable account.";
    }
    // Return the result message
    return $message;
  }

}
