<?php
class UserAccountModel extends CI_Model {



    function get_users() {

      $this->load->database();

  		$query = $this->db->query('SELECT * from UserAccount');

  		foreach ($query->result_array() as $row) {
        $data[] = array(
    			'user_id' => $row['user_id'],
  				'email' => $row['email'],
  				'first_name' => $row['first_name'],
          'last_name' => $row['last_name'],
          'enabled' => $row['enabled']
				);
  		}
    	return $data;

    }

    // Get all user info for the logged in account
    // Make a get request to http://capstone.td9175.com/ci/index.php/UserAccount/user
    function get_user($email) {
    	$this->load->database();

      $query = "SELECT * FROM UserAccount WHERE email = ?";

	    $result = $this->db->query($query, $email);

      foreach ($result->result_array() as $row) {
			$data[] = array(
				'user_id' => $row['user_id'],
				'email' => $row['email'],
				'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'enabled' => $row['enabled']
			);
		}
    	return $data;
    }

    function post_registration($email, $hash_pass, $first_name, $last_name){
    // Send a post request to http://capstone.td9175.com/ci/index.php/Rest/registration/email/value/hash_pass/value/first_name/value/last_name/value

      // Load the database
      $this->load->database();

      // Sanitize the user input
      // $email = $this->db->escape($email);
      // $hash_pass = $this->db->escape($hash_pass);
      // $first_name = $this->db->escape($first_name);
      // $last_name = $this->db->escape($last_name);

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

    function post_login($email){
    // Send a post request to http://capstone.td9175.com/ci/index.php/Rest/registration/email/value/hash_pass/value/first_name/value/last_name/value

      // Load the database
      $this->load->database();

      // Sanitize the user input
      // $email = $this->db->escape($email);

      // Build the query to check for account with an email provided by the user
      $query = "SELECT hash_pass FROM UserAccount WHERE email=?";

      // Execute the query
      $result = $this->db->query($query, $email);

      if (count($result->result_array()) == 0){
        $data['response'] = "Incorrect email or password.";
      } else {
        // Insert the associated hash_pass into the data array
        foreach ($result->result_array() as $row) {
          $data['response'] = $row['hash_pass'];
        }
      }
      // Pass back the data
      return $data;
  }

  // Disable a users account
  // Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/disable_user
  function disable_user($email) {
    // Load the database
    $this->load->database();
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
  // Make a get request to https://capstone.td9175.com/ci/index.php/UserAccount/enable_user
  function enable_user($email) {
    // Load the database
    $this->load->database();
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
