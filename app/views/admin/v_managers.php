<?php require APPROOT . '/views/inc/admin_header.php'; ?>

<div class="page-content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <h2>Property Managers</h2>
            <p>Manage property manager registrations and assignments</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="addManager()">
                <i class="fas fa-plus"></i> Add Manager
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-number">3</h3>
                <p class="stat-label">Registered Managers</p>
                <span class="stat-change">Total Managers</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-number">1</h3>
                <p class="stat-label">Awaiting Review</p>
                <span class="stat-change">Pending Approvals</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-check"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-number">2</h3>
                <p class="stat-label">Currently Approved</p>
                <span class="stat-change">Active Managers</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-number">1</h3>
                <p class="stat-label">Properties Assigned</p>
                <span class="stat-change">Property Assignments</span>
            </div>
        </div>
    </div>

    <!-- Tabs Container -->
    <div class="managers-content">
        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <button class="tab-btn active" onclick="switchTab('applications')" id="applications-btn">
                Manager Applications
            </button>
            <button class="tab-btn" onclick="switchTab('assignments')" id="assignments-btn">
                Property Assignments
            </button>
        </div>

        <!-- Manager Applications Tab -->
        <div class="tab-content active" id="applications-tab">
            <!-- Search and Filter -->
            <div class="search-filter-row">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search managers..." id="searchManagers">
                </div>
                <div class="filter-container">
                    <select class="filter-select" id="filterManagers">
                        <option value="">All Managers</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <!-- Manager Applications Table -->
            <div class="table-section">
                <h3 class="table-title">Manager Applications (3)</h3>
                <div class="table-container">
                    <table class="managers-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Experience</th>
                                <th>Properties</th>
                                <th>Join Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="manager-name">Sarah Wilson</td>
                                <td>sarah.wilson@email.com</td>
                                <td>+1 234 567 8901</td>
                                <td>5 years</td>
                                <td>12</td>
                                <td>15/01/2024</td>
                                <td><span class="status-badge approved">Approved</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view-btn" onclick="viewManager('SW001')">View</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="manager-name">Mike Brown</td>
                                <td>mike.brown@email.com</td>
                                <td>+1 234 567 8902</td>
                                <td>2 years</td>
                                <td>0</td>
                                <td>01/07/2024</td>
                                <td><span class="status-badge pending">Pending</span></td>
                                <td>
                                    <div class="action-buttons manager-actions-pending">
                                        <button class="action-btn approve-btn" onclick="approveManager('MB001')" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="action-btn reject-btn" onclick="rejectManager('MB001')" title="Reject">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="manager-name">Lisa Davis</td>
                                <td>lisa.davis@email.com</td>
                                <td>+1 234 567 8903</td>
                                <td>3 years</td>
                                <td>8</td>
                                <td>10/03/2024</td>
                                <td><span class="status-badge approved">Approved</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view-btn" onclick="viewManager('LD001')">View</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Property Assignments Tab -->
        <div class="tab-content" id="assignments-tab">
            <div class="assignments-content">
                <!-- Assignment Stats -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding: 1rem; background-color: var(--light-color); border-radius: 0.5rem;">
                    <div>
                        <span style="margin-right: 2rem;"><strong>Available Properties:</strong> 2</span>
                        <span><strong>Approved Managers:</strong> 2</span>
                    </div>
                    <button class="btn btn-primary" onclick="openAssignModal()">
                        <i class="fas fa-user-plus"></i> Assign Property
                    </button>
                </div>

                <!-- Current Assignments Table -->
                <div class="table-section">
                    <h3 class="table-title assignments-title">Current Property Assignments (1)</h3>
                    <div class="table-container">
                        <table class="managers-table assignments-table">
                            <thead>
                                <tr>
                                    <th>Property Name</th>
                                    <th>Property Address</th>
                                    <th>Assigned Manager</th>
                                    <th>Assignment Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="manager-name">Sunset Apartments</td>
                                    <td>123 Main St, City A</td>
                                    <td>Sarah Wilson</td>
                                    <td>20/01/2024</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn reject-btn" onclick="unassignProperty('ASSIGN001')">
                                                Unassign
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/admin_footer.php'; ?>