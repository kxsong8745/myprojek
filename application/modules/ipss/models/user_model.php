<?php

class User_model extends CI_Model
{
    public function createUser($data_to_insert)
    {
        $this->db->insert("IPSS_USER", $data_to_insert);

        return $this->db->affected_rows() > 0;
    }

    public function checkLogin($username, $password)
{
    $this->db->where('USERNAME', $username);
    $this->db->where('USERPW', $password);
    $query = $this->db->get('IPSS_USER');

    if ($query->num_rows() == 1) {
        $user = $query->row();

        // Check the user's role
        if ($user->ROLE == 'doctor') {
            return (object) ['user' => $user, 'role' => 'doctor'];
        } elseif ($user->ROLE == 'staff') {
            return (object) ['user' => $user, 'role' => 'staff'];
        } else {
            return false;
        }
    } else {
        return false;
    }
}

    public function getUserById($user_id)
    {
        $this->db->select('USER_ID, USERNAME, EMAIL, R_NAME, ROLE');
        $this->db->from('IPSS_USER');
        $this->db->where('USER_ID', $user_id);

        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->row() : null;
    }

    public function getUserByUsername($username)
    {
        $this->db->select('USER_ID, USERNAME, EMAIL, R_NAME, ROLE');
        $this->db->from('IPSS_USER');
        $this->db->where('USERNAME', $username);

        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->row() : null;
    }
}
