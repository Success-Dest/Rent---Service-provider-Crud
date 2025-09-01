<?php require APPROOT . '/views/inc/admin_header.php'; ?>

<div class="page-content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <h2>Properties Management</h2>
            <p>Manage, approve, and oversee all property listings</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="search-filter-section">
        <div class="search-filter-content">
            <div class="search-input-wrapper">
                <input type="text" class="form-input" placeholder="Search properties..." id="searchProperties">
            </div>
            <div class="filter-dropdown-wrapper">
                <select class="form-select" id="filterProperties">
                    <option value="">All Properties</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Property Listings Table -->
    <div class="dashboard-section">
        <div class="section-header">
            <h3>Property Listings (4)</h3>
        </div>

        <div class="table-container">
            <table class="data-table properties-table">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Location</th>
                        <th>Owner</th>
                        <th>Manager</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Property 1 - Luxury Apartment Downtown -->
                    <tr>
                        <td>
                            <div class="property-name">Luxury</div>
                            <div class="property-name">Apartment</div>
                            <div class="property-name">Downtown</div>
                        </td>
                        <td>
                            <div>Downtown,</div>
                            <div>City Center</div>
                        </td>
                        <td>
                            <div>John</div>
                            <div>Smith</div>
                        </td>
                        <td>
                            <div>Sarah</div>
                            <div>Wilson</div>
                        </td>
                        <td>Apartment</td>
                        <td>Rs 25,500/month</td>
                        <td><span class="status-badge approved">Approved</span></td>
                        <td>
                            <div class="property-actions">
                                <button class="btn btn-sm btn-danger" title="Remove" onclick="removeProperty('P001')">
                                    Remove
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Property 2 - Family House Suburbs -->
                    <tr>
                        <td>
                            <div class="property-name">Family House</div>
                            <div class="property-name">Suburbs</div>
                        </td>
                        <td>
                            <div>Westside,</div>
                            <div>Suburbs</div>
                        </td>
                        <td>Jane Doe</td>
                        <td>
                            <div>Mike</div>
                            <div>Brown</div>
                        </td>
                        <td>House</td>
                        <td>Rs 45,500/month</td>
                        <td><span class="status-badge pending">Pending</span></td>
                        <td>
                            <div class="property-actions property-actions-pending">
                                <button class="btn-action btn-approve" title="Approve" onclick="approveProperty('P002')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn-action btn-reject" title="Reject" onclick="rejectProperty('P002')">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" title="Remove" onclick="removeProperty('P002')">
                                    Remove
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Property 3 - Studio Near University -->
                    <tr>
                        <td>
                            <div class="property-name">Studio Near</div>
                            <div class="property-name">University</div>
                        </td>
                        <td>
                            <div>University</div>
                            <div>District</div>
                        </td>
                        <td>
                            <div>Mike</div>
                            <div>Johnson</div>
                        </td>
                        <td>Lisa Davis</td>
                        <td>Studio</td>
                        <td>Rs 55,500/month</td>
                        <td><span class="status-badge approved">Approved</span></td>
                        <td>
                            <div class="property-actions">
                                <button class="btn btn-sm btn-danger" title="Remove" onclick="removeProperty('P003')">
                                    Remove
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Property 4 - Modern Condo -->
                    <tr>
                        <td>
                            <div class="property-name">Modern Condo</div>
                        </td>
                        <td>Midtown</td>
                        <td>Anna Lee</td>
                        <td>
                            <div>Tom</div>
                            <div>Garcia</div>
                        </td>
                        <td>Condo</td>
                        <td>Rs 35,500/month</td>
                        <td><span class="status-badge rejected">Rejected</span></td>
                        <td>
                            <div class="property-actions">
                                <button class="btn btn-sm btn-danger" title="Remove" onclick="removeProperty('P004')">
                                    Remove
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php require APPROOT . '/views/inc/admin_footer.php'; ?>