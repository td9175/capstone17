<?php
class ReceiptModel extends CI_Model {

    function get_receipts_by_user_id($id) {
        //http://capstone.td9175.com/ci/index.php/rest/receipts/1

        $this->load->database();

            $query = 'SELECT * from Receipt WHERE user_id = ?';
            $result = $this->db->query($query, $id);

            if($result !== FALSE && $result->num_rows() > 0){
                foreach ($result->result_array() as $row) {

                    $data[] = array(
                        'receipt_id' => $row['receipt_id'],
                        'user_id' => $row['user_id'],
                        'image' => $row['image'],
                        'amount' => $row['amount'],
                        'date_time_stamp' => $row['date_time_stamp']
                        );
                }
            } else{
                    $data = 'There are no receipts at this user id.';
            }

            return $data;
    }

    function get_receipt_by_id($id) {
    	//http://capstone.td9175.com/ci/index.php/rest/receipt/1

    	$this->load->database();

    	$query = 'SELECT * FROM Receipt WHERE receipt_id = ?';
        $result = $this->db->query($query, $id);

        if($result !== FALSE && $result->num_rows() > 0){
            foreach ($result->result_array() as $row) {
                $data[] = array(
                    'receipt_id' => $row['receipt_id'],
                    'user_id' => $row['user_id'],
                    'image' => $row['image'],
                    'amount' => $row['amount'],
                    'date_time_stamp' => $row['date_time_stamp']
                );
            }
        } else {
                $data = 'There is no receipt at this id.';
        }

    	return $data;
    }

  function receipt_post($receipt_path, $user_email) {
      $this->load->database();

      $query = "INSERT INTO Receipt (email, image) VALUES (?, ?)";
      $result = $this->db->query($query, $user_email, $receipt_path);
      if ($result->affected_rows() == 1) {
        $data = "Receipt recorded in database.";
      } else {
        $data = "Error: receipt not recorded in database. Try again.";
      }
      return $data;
    }

  function user_receipts_get($email) {
      $this->load->database();

      $query = "SELECT * FROM Receipt WHERE email = ?";
      $result = $this->db->query($query, $email);
      if ($result->num_rows() > 0) {
        foreach ($result->result_array() as $row) {
          $data['receipt_id'] = $row['receipt_id'];
          $data['email'] = $row['email'];
          $data['image'] = $row['image'];
          $data['date_time_stamp'] = $row['date_time_stamp'];
        }
      } else {
        $data = "No user receipts exist";
      }
      return $data;
  }

}
