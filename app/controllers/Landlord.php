<?php
require_once '../app/helpers/helper.php';

class Landlord extends Controller
{
    private $userModel; // Explicitly define the property

    public function __construct()
    {
        $this->userModel = $this->model('M_Users');
        // Check if user is logged in and is a landlord
        if (!isLoggedIn() || $_SESSION['user_type'] !== 'landlord') {
            redirect('users/login');
        }
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Landlord Dashboard',
            'page' => 'dashboard',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_dashboard', $data);
    }

    public function properties()
    {
        $data = [
            'title' => 'My Properties',
            'page' => 'properties',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_properties', $data);
    }

    public function add_property()
    {
        $data = [
            'title' => 'Add Property',
            'page' => 'add_property',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_add_property', $data);
    }

    public function maintenance()
    {
        $data = [
            'title' => 'Maintenance Requests',
            'page' => 'maintenance',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_maintenance', $data);
    }

    public function inquiries()
    {
        $data = [
            'title' => 'Tenant Inquiries',
            'page' => 'inquiries',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_inquiries', $data);
    }

    public function payment_history()
    {
        $data = [
            'title' => 'Payment History',
            'page' => 'payment_history',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_payment_history', $data);
    }

    public function feedback()
    {
        $data = [
            'title' => 'Tenant Feedback',
            'page' => 'feedback',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_feedback', $data);
    }

    public function notifications()
    {
        $data = [
            'title' => 'Notifications',
            'page' => 'notifications',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_notifications', $data);
    }

    public function settings()
    {
        $data = [
            'title' => 'Settings',
            'page' => 'settings',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_settings', $data);
    }

    public function income()
    {
        $data = [
            'title' => 'Income Reports',
            'page' => 'income',
            'user_name' => $_SESSION['user_name']
        ];
        $this->view('landlord/v_income', $data);
    }
}
