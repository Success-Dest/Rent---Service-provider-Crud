<?php require APPROOT . '/views/inc/manager_header.php'; ?>

<div class="inspections-content">
    <div class="page-header">
        <div class="header-left">
            <h1 class="page-title">Pre-Inspection Reports</h1>
            <p class="page-subtitle">Manage inspection checklists and reports</p>
        </div>
        <div class="header-right">
            <button class="btn btn-primary" onclick="openScheduleInspectionModal()">
                <i class="fas fa-plus"></i>
                Schedule Inspection
            </button>
        </div>
    </div>

    <div class="tabs-container">
        <div class="tabs-nav">
            <button class="tab-button active" onclick="showInspectionTab('all-inspections')">All Inspections</button>
            <button class="tab-button" onclick="showInspectionTab('new-inspection')">New Inspection</button>
        </div>

        <!-- All Inspections Tab -->
        <div id="all-inspections-tab" class="tab-content active">
            <!-- Search and Filters -->
            <div class="dashboard-section">
                <div class="filters-grid">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search inspections..." id="inspectionSearch">
                    </div>
                    <select class="filter-select" id="typeFilter">
                        <option value="all">All Types</option>
                        <option value="move-in">Move-in</option>
                        <option value="move-out">Move-out</option>
                        <option value="annual">Annual</option>
                    </select>
                    <select class="filter-select" id="statusFilter">
                        <option value="all">All Status</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>

            <!-- Inspections Table -->
            <div class="dashboard-section">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>INSPECTION ID</th>
                                <th>PROPERTY</th>
                                <th>TYPE</th>
                                <th>INSPECTOR</th>
                                <th>SCHEDULED DATE</th>
                                <th>STATUS</th>
                                <th>SCORE</th>
                                <th>ISSUES</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-medium">INS-001</td>
                                <td>Oak Street Apt 2A</td>
                                <td>Move-in</td>
                                <td>John Smith</td>
                                <td>2024-01-20</td>
                                <td><span class="status-badge approved">Completed</span></td>
                                <td><span class="font-semibold text-success">85%</span></td>
                                <td><span class="status-badge pending">2</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i> View Report
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-medium">INS-002</td>
                                <td>Pine Avenue House</td>
                                <td>Annual</td>
                                <td>Sarah Wilson</td>
                                <td>2024-01-22</td>
                                <td><span class="status-badge pending">Scheduled</span></td>
                                <td><span class="text-muted">-</span></td>
                                <td><span class="text-muted">-</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-primary">Start</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-medium">INS-003</td>
                                <td>Maple Drive Apt 1B</td>
                                <td>Move-out</td>
                                <td>Mike Johnson</td>
                                <td>2024-01-18</td>
                                <td><span class="status-badge approved">In Progress</span></td>
                                <td><span class="text-muted">-</span></td>
                                <td><span class="status-badge pending">1</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i> View Report
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- New Inspection Tab -->
        <div id="new-inspection-tab" class="tab-content">
            <div class="dashboard-section">
                <div class="section-header">
                    <h3>Schedule New Inspection</h3>
                </div>
                <form class="inspection-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="inspectionProperty">Property</label>
                            <select id="inspectionProperty" name="inspectionProperty" required>
                                <option value="">Select property</option>
                                <option value="oak-street">Oak Street Apt 2A</option>
                                <option value="pine-avenue">Pine Avenue House</option>
                                <option value="maple-drive">Maple Drive Apt 1B</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inspectionType">Inspection Type</label>
                            <select id="inspectionType" name="inspectionType" required>
                                <option value="">Select type</option>
                                <option value="move-in">Move-in</option>
                                <option value="move-out">Move-out</option>
                                <option value="annual">Annual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inspector">Inspector</label>
                            <select id="inspector" name="inspector" required>
                                <option value="">Select inspector</option>
                                <option value="john-smith">John Smith</option>
                                <option value="sarah-wilson">Sarah Wilson</option>
                                <option value="mike-johnson">Mike Johnson</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="scheduledDate">Scheduled Date</label>
                            <input type="date" id="scheduledDate" name="scheduledDate" required>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calendar"></i>
                            Schedule Inspection
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/manager_footer.php'; ?>
