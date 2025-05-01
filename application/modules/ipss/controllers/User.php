<?php

class User extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
    }

    public function login(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        try {
            $loginResult = $this->user_model->checkLogin($username, $password);

            if ($loginResult) {
                $user = $loginResult->user;  // Access as object
                $role = $loginResult->role;  // Access as object

                // Redirect based on the role
                if ($role == 'doctor') {
                    redirect(module_url("prepdisp/prepList_pdf"));
                } elseif ($role == 'staff') {
                    redirect(module_url("drug/listDrugs"));
                }
            } else {
                // Redirect to the login form if credentials are invalid
                redirect(module_url("user/loginForm"));
            }
        } catch (Exception $e) {
            // Redirect to the login form on error
            redirect(module_url("user/loginForm"));
        }
    }



    public function register()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $email = $this->input->post("email");
        $name = $this->input->post("name");
        $role = $this->input->post("role");

        try {
            $data_to_insert = [
                "USERNAME" => $username,
                "USERPW" => $password,
                "EMAIL" => $email,
                "R_NAME" => $name,
                "ROLE" => $role
            ];

            $this->user_model->createUser($data_to_insert);

            // Redirect to the user profile after successful registration
            redirect(module_url("user/userProfile/" . $username));
        } catch (Exception $e) {
            // Redirect to the registration form on error
            redirect(module_url("user/registerForm"));
        }
    }

    public function userProfile($username)
    {
        try {
            $user = $this->user_model->getUserByUsername($username);

            if (!$user) {
                // Redirect to login form if the user does not exist
                redirect(module_url("user/loginForm"));
                return;
            }

            $this->template->title("User Profile");
            $this->template->set("user", $user);
            $this->template->render();
        } catch (Exception $e) {
            // Redirect to login form on error
            redirect(module_url("user/loginForm"));
        }
    }

    public function loginForm()
    {
        $this->template->title("Login");
        $this->template->render();
    }

    public function registerForm()
    {
        $this->template->title("Register");
        $this->template->render();
    }
} 


// class User extends Admin_Controller {

//     public function __construct() {
//         parent::__construct();
//         $this->load->model("user_model");
//         $this -> load->library("session");
//     }

//     public function login() {
//         $username = $this->input->post("username");
//         $password = $this->input->post("password");

//         // Debug: Log input data
//         log_message('debug', 'Login attempt with username: ' . $username);

//         try {
//             $user = $this->user_model->checkLogin($username, $password);

//             if ($user) {
//                 log_message('debug', 'User found: ' . print_r($user, true));

//                 $user_data = [
//                     'user_id' => $user->USER_ID,
//                     'username' => $user->USERNAME,
//                     'email' => $user->EMAIL,
//                     'name' => $user->R_NAME,
//                     'role' => $user->ROLE,
//                     'logged_in' => TRUE
//                 ];

//                 $this->session->set_userdata($user_data);

//                 // Debug: Log session data after setting
//                 log_message('debug', 'Session data after login: ' . print_r($this->session->userdata, true));

//                 // $this->session->set_flashdata('success', 'Login successful');
//                 redirect(module_url("user/userProfile"));
//             } else {
//                 log_message('error', 'Invalid login credentials for username: ' . $username);

//                 $this->session->set_flashdata('error', 'Invalid username or password');
//                 redirect(module_url("user/loginForm"));
//             }
//         } catch (Exception $e) {
//             log_message('error', 'Login failed: ' . $e->getMessage());

//             $this->session->set_flashdata('error', 'Login failed: ' . $e->getMessage());
//             redirect(module_url("user/loginForm"));
//         }
//     }

//     public function register() {
//         $username = $this->input->post("username");
//         $password = $this->input->post("password");
//         $email = $this->input->post("email");
//         $name = $this->input->post("name");
//         $role = $this->input->post("role");

//         // Debug: Log registration data
//         log_message('debug', 'Registration data: ' . json_encode([
//             'username' => $username,
//             'email' => $email,
//             'name' => $name,
//             'role' => $role
//         ]));

//         try {
//             $data_to_insert = [
//                 "USERNAME" => $username,
//                 "USERPW" => $password,
//                 "EMAIL" => $email,
//                 "R_NAME" => $name,
//                 "ROLE" => $role
//             ];

//             $this->user_model->createUser($data_to_insert);
//             log_message('debug', 'User registered successfully');

//             $this->session->set_flashdata('success', 'User registered successfully');
//             redirect(module_url("user/userProfile"));
//         } catch (Exception $e) {
//             log_message('error', 'Registration failed: ' . $e->getMessage());

//             $this->session->set_flashdata('error', 'Registration failed: ' . $e->getMessage());
//             redirect(module_url("user/registerForm"));
//         }
//     }

//     public function userProfile() {
//         $logged_in_user_id = $this->session->userdata('user_id');

//         // Debug: Log session data to ensure user_id is present
//         log_message('debug', 'Session data on userProfile access: ' . print_r($this->session->userdata, true));

//         // if (!$logged_in_user_id) {
//         //     log_message('error', 'No user ID found in session, redirecting to login');

//         //     echo 'Session data after login: ' . htmlspecialchars(print_r($this->session->userdata, true)) . '<br>';

//         //     $this->session->set_flashdata('error', 'You must be logged in to view your profile');
//         //     redirect(module_url("user/loginForm"));
//         // }

//         $user = $this->user_model->getUserById($logged_in_user_id);
// // Debug: Log user data fetched from the database
//         log_message('debug', 'User data fetched for user_id ' . $logged_in_user_id . ': ' . print_r($user, true));

//         $this->template->title("User Profile");
//         $this->template->set("user", $user);
//         $this->template->render();
//     }

//     public function loginForm() {
//         $this->template->title("Login");
//         $this->template->render();
//     }

//     public function registerForm() {
//         $this->template->title("Register");
//         $this->template->render();
//     }
// }