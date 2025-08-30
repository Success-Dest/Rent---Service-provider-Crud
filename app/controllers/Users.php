<?php

class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('M_Users');
    }

    // STEP 1: User type selection page (v_usertype.php)
    public function usertype()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // User selected a type, validate and redirect to step 2
            $user_type = trim($_POST['user_type']);

            if (!empty($user_type) && in_array($user_type, ['admin', 'property_manager', 'tenant', 'landlord'])) {
                // Store user type in session temporarily
                $_SESSION['selected_user_type'] = $user_type;
                redirect('Users/register');
            } else {
                // Invalid user type, redirect back with error
                $data = ['user_type_err' => 'Please select a valid user type'];
                $this->view('users/v_usertype', $data);
            }
        } else {
            // Show user type selection page (Step 1)
            $data = ['user_type_err' => ''];
            $this->view('users/v_usertype', $data);
        }
    }

    // STEP 2: Registration details page (v_register.php)
    public function register()
    {
        // Check if user type is selected (must come from step 1)
        if (!isset($_SESSION['selected_user_type'])) {
            // Redirect back to step 1 if no user type selected
            redirect('Users/usertype');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process registration form

            // Validate the data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Get user type from session
            $user_type = $_SESSION['selected_user_type'];

            // Input data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'user_type' => $user_type,

                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'user_type_err' => ''
            ];

            // Validate each input

            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter a name';
            } elseif (strlen($data['name']) < 2) {
                $data['name_err'] = 'Name must be at least 2 characters';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter an email';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter a valid email';
            } else {
                // Check if email is already registered
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already registered';
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm the password';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Passwords do not match';
            }

            // Check if all validations passed
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user
                if ($this->userModel->register($data)) {
                    // Clear session user type
                    unset($_SESSION['selected_user_type']);

                    // Create success flash message
                    flash('reg_flash', 'Registration successful! You can now login with your credentials.');

                    redirect('Users/login');
                } else {
                    die('Something went wrong during registration');
                }
            } else {
                // Load view with errors
                $this->view('users/v_register', $data);
            }
        } else {
            // Show registration details form (Step 2)
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'user_type' => $_SESSION['selected_user_type'],

                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'user_type_err' => ''
            ];

            $this->view('users/v_register', $data);
        }
    }

    // User login (v_login.php)
    public function login()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter a valid email';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // If no validation errors, attempt login
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Check if user exists
                if ($this->userModel->findUserByEmail($data['email'])) {
                    // Authenticate user credentials
                    $loggedUser = $this->userModel->login($data['email'], $data['password']);

                    if ($loggedUser) {
                        // Create user session
                        $this->createUserSession($loggedUser);
                        $this->redirectBasedOnUserType($loggedUser->user_type);
                    } else {
                        $data['password_err'] = 'Password incorrect';
                        $this->view('users/v_login', $data);
                    }
                } else {
                    $data['email_err'] = 'No account found with that email';
                    $this->view('users/v_login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/v_login', $data);
            }
        } else {
            // Init data for GET request
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Load login view
            $this->view('users/v_login', $data);
        }
    }

    // Redirect user based on their type after successful login
    private function redirectBasedOnUserType($userType)
    {
        switch ($userType) {
            case 'admin':
                redirect('admin/index');
                break;
            case 'property_manager':
                redirect('manager/index');
                break;
            case 'tenant':
                redirect('tenant/index');
                break;
            case 'landlord':
                redirect('landlord/index');
                break;
            default:
                redirect('pages/index');
                break;
        }
    }

    // Store user data in session to keep them logged in across pages
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_type'] = $user->user_type;
    }

    // Clear user session data and log them out
    public function logout()
    {
        // Clear all session data
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_type']);
        unset($_SESSION['selected_user_type']);

        session_destroy();
        redirect('Users/login');
    }

    // Check if user is currently logged in
    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
}
