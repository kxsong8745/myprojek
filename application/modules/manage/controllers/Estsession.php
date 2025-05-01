<?php

class Estsession extends Admin_Controller{

    public function __construct() {
        parent::__construct();  
        session_start();  
    }

    function index()
	{		
		echo "Welcome to Dashboard Controller <br><br>";

        $id_staf = strtoupper($_SESSION['UID']);
        $nama = strtoupper($_SESSION['STAFF']);

		echo "<br>Login as =>".$id_staf;
        echo "<br>Name as =>".$nama;

        // print_r ($_SESSION);
        $created_by = $_SESSION["UID"];
        // $data = [
        //     "T01_CREATED_BY" => $created_by,
        //     "T01_STATUS" => 1
        // ];
    
        // $this->mymodel->insert($data);
        $logged_user =
            $this->db
            ->where("ID_WARGA", $created_by)
            ->get("MYUSER") ->row();

        echo "<br>Query name from tables =>".$logged_user->NAMA;
	}
}