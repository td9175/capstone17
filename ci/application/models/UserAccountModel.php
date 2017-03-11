<?php
class UserAccountModel extends CI_Model {



    function get_users() {
    	$this->load->database();
        //$return_arr = array();

		 $query = $this->db->query('SELECT * from UserAccount');


		 foreach ($query->result_array() as $row) {

        	$data[] = array(
				'user_id' => $row['user_id'],
				'email' => $row['email'],
				'first_name' => $row['first_name']
				);

			}


    		return $data;


    }

    function get_user_id($id) {
    	//http://capstone.td9175.com/ci/index.php/rest/user/id/1
    	//request for a specfic id

    	$this->load->database();

    	$query = "SELECT * FROM UserAccount WHERE user_id = ?";

		 $result = $this->db->query($query, $id);
		foreach ($result->result_array() as $row) {
			$data[] = array(
				'user_id' => $row['user_id'],
				'email' => $row['email'],
				'first_name' => $row['first_name']
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
      $email = $this->db->escape($email);

      // Build the query to check for account with an email provided by the user
      // $query = "SELECT * FROM UserAccount WHERE email='?'";
      $query = "SELECT email, hash_pass FROM UserAccount WHERE email=?";

      echo "<script>console.log('Query = ' + $query)</script>";
      echo "<script>console.log('Email = ' + $email)</script>";
      echo "<script>console.log('Checkpoint 3')</script>";

      // Execute the query
      if ($result = $this->db->query($query, $email)){
        foreach ($result->result_array() as $row) {
    			$data[] = array(
    				'email' => $row['email'],
    				'hash_pass' => $row['hash_pass']
    			);
    		}

        // $data['login_result'] = $result;

      } else {

        // $data['login'] = "Email or password incorrect.";
        // $data['login_result'] = "Email not found";

      }

      // Pass back the data
      return $data;

    }


  }
?>
