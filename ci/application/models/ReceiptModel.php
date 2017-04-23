<?php
class ReceiptModel extends CI_Model {

  function receipt_post($receipt_path, $user_email) {
      $this->load->database();

      $query = "INSERT INTO Receipt (email, image) VALUES (?, ?)";
      $params = array($user_email, $receipt_path);
      $result = $this->db->query($query, $params);
      if ($this->db->affected_rows() == 1) {
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
          $data[] = array(
            'receipt_id' = $row['receipt_id'];
            'image' = $row['image'];
            'date_time_stamp' = $row['date_time_stamp'];
          );
        }
      } else {
        $data = "No user receipts exist";
      }
      return $data;
  }

}
