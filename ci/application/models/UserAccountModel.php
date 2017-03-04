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

    function post_user($email, $hash_pass, $first_name, $last_name){

      // Load the database
      $this->load->database();

      // Sanitize the user input
      //$email = $this->db->escape($email);
      //$hash_pass = $this->db->escape($hash_pass);
      //$first_name = $this->db->escape($first_name);
      //$last_name = $this->db->escape($last_name);

      // Build the query to create a user account
      $query = "INSERT INTO UserAccount (email, hash_pass, first_name, last_name) VALUES (?,?,?,?)";

      //Create an array of the parameters for paramater binding
      $params = array($email, $hash_pass, $first_name, $last_name);

      // Execute the query
      if ($this->db->query($query, $params)){
        $data['registration'] = "Much success! User created.\n";
      } else {
        $data['registration'] = "Error! User registration failed.\n";
      }

      //Pass back the data
      return $data;

    }


  }
?>
