<?php
class Admin extends Controller
{
    private $serviceProviderModel;

    public function __construct()
    {
        // Initialize service provider model
        $this->serviceProviderModel = $this->model('M_ServiceProviders');
    }

    // Main dashboard page
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard - Rentigo',
            'page' => 'dashboard'
        ];

        $this->view('admin/v_dashboard', $data);
    }

    // Properties management page
    public function properties()
    {
        $data = [
            'title' => 'Properties - Rentigo Admin',
            'page' => 'properties'
        ];

        $this->view('admin/v_properties', $data);
    }

    // Property managers page
    public function managers()
    {
        $data = [
            'title' => 'Property Managers - Rentigo Admin',
            'page' => 'managers'
        ];

        $this->view('admin/v_managers', $data);
    }

    // Documents management page
    public function documents()
    {
        $data = [
            'title' => 'Documents - Rentigo Admin',
            'page' => 'documents'
        ];

        $this->view('admin/v_documents', $data);
    }

    // Financial management page
    public function financials()
    {
        $data = [
            'title' => 'Financials - Rentigo Admin',
            'page' => 'financials'
        ];

        $this->view('admin/v_financials', $data);
    }

    // Service providers page - READ operation
    public function providers()
    {
        // Handle search/filter if provided
        $searchTerm = $_GET['search'] ?? '';
        $specialty = $_GET['specialty'] ?? '';
        $status = $_GET['status'] ?? '';

        if (!empty($searchTerm) || !empty($specialty) || !empty($status)) {
            $providers = $this->serviceProviderModel->searchProviders($searchTerm, $specialty, $status);
        } else {
            $providers = $this->serviceProviderModel->getAllProviders();
        }

        // Get provider counts for stats
        $counts = $this->serviceProviderModel->getProviderCounts();

        $data = [
            'title' => 'Service Providers - Rentigo Admin',
            'page' => 'providers',
            'providers' => $providers,
            'counts' => $counts,
            'search' => $searchTerm,
            'specialty_filter' => $specialty,
            'status_filter' => $status
        ];

        $this->view('admin/v_providers', $data);
    }

    // CREATE - Add new service provider
    public function addProvider()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'name' => trim($_POST['name']),
                'company' => trim($_POST['company']),
                'specialty' => $_POST['specialty'],
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'address' => trim($_POST['address']),
                'rating' => $_POST['rating'] ?? 0.00,
                'status' => $_POST['status'] ?? 'active'
            ];

            // Basic validation
            if (empty($data['name']) || empty($data['specialty'])) {
                // Handle validation error
                $data['error'] = 'Name and specialty are required';
                $this->view('admin/v_add_provider', $data);
                return;
            }

            // Create provider
            if ($this->serviceProviderModel->create($data)) {
                redirect('admin/providers');
            } else {
                $data['error'] = 'Something went wrong';
                $this->view('admin/v_add_provider', $data);
            }
        } else {
            // Show add provider form
            $data = [
                'title' => 'Add Service Provider - Rentigo Admin',
                'page' => 'providers'
            ];
            $this->view('admin/v_add_provider', $data);
        }
    }

    // UPDATE - Edit service provider
    public function editProvider($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'company' => trim($_POST['company']),
                'specialty' => $_POST['specialty'],
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'address' => trim($_POST['address']),
                'rating' => $_POST['rating'] ?? 0.00,
                'status' => $_POST['status'] ?? 'active'
            ];

            // Basic validation
            if (empty($data['name']) || empty($data['specialty'])) {
                $data['error'] = 'Name and specialty are required';
                $data['provider'] = $this->serviceProviderModel->getProviderById($id);
                $this->view('admin/v_edit_provider', $data);
                return;
            }

            // Update provider
            if ($this->serviceProviderModel->update($data)) {
                redirect('admin/providers');
            } else {
                $data['error'] = 'Something went wrong';
                $data['provider'] = $this->serviceProviderModel->getProviderById($id);
                $this->view('admin/v_edit_provider', $data);
            }
        } else {
            // Show edit form
            $provider = $this->serviceProviderModel->getProviderById($id);

            if (!$provider) {
                redirect('admin/providers');
            }

            $data = [
                'title' => 'Edit Service Provider - Rentigo Admin',
                'page' => 'providers',
                'provider' => $provider
            ];
            $this->view('admin/v_edit_provider', $data);
        }
    }

    // DELETE - Remove service provider
    public function deleteProvider($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->serviceProviderModel->delete($id)) {
                echo json_encode(['success' => true, 'message' => 'Provider deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete provider']);
            }
        } else {
            redirect('admin/providers');
        }
    }

    // UPDATE STATUS - Change provider status
    public function updateProviderStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $status = $_POST['status'];

            if ($this->serviceProviderModel->updateStatus($id, $status)) {
                echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update status']);
            }
        } else {
            redirect('admin/providers');
        }
    }

    // Policies management page
    public function policies()
    {
        $data = [
            'title' => 'Policies - Rentigo Admin',
            'page' => 'policies'
        ];

        $this->view('admin/v_policies', $data);
    }

    // Notifications page
    public function notifications()
    {
        $data = [
            'title' => 'Notifications - Rentigo Admin',
            'page' => 'notifications'
        ];

        $this->view('admin/v_notifications', $data);
    }
}
