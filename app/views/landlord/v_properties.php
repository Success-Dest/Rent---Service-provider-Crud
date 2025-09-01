<?php require APPROOT . '/views/inc/landlord_header.php'; ?>

<!-- Page Header -->
<div class="page-header">
    <div class="header-left">
        <h1 class="page-title">My Properties</h1>
        <p class="page-subtitle">Manage your property listings</p>
    </div>
    <div class="header-actions">
        <a href="<?php echo URLROOT; ?>/landlord/add_property" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Property
        </a>
    </div>
</div>

<!-- Filters -->
<div class="filters">
    <div class="filter-row">
        <div class="filter-group">
            <label class="form-label">Search Properties</label>
            <input type="text" class="form-control" placeholder="Search by address, tenant name..." id="propertySearch">
        </div>
        <div class="filter-group">
            <label class="form-label">Status</label>
            <select class="form-control" id="statusFilter">
                <option value="">All Properties</option>
                <option value="occupied">Occupied</option>
                <option value="vacant">Vacant</option>
                <option value="maintenance">Under Maintenance</option>
            </select>
        </div>
        <div class="filter-group">
            <label class="form-label">Property Type</label>
            <select class="form-control" id="typeFilter">
                <option value="">All Types</option>
                <option value="apartment">Apartment</option>
                <option value="house">House</option>
                <option value="condo">Condo</option>
            </select>
        </div>
        <div class="filter-group">
            <button class="btn btn-secondary" onclick="resetFilters()">Reset Filters</button>
        </div>
    </div>
</div>

<!-- Properties Grid -->
<div class="property-grid">
    <div class="property-card" data-status="occupied" data-type="apartment">
        <img src="https://via.placeholder.com/300x200?text=Property+Image" alt="Property" class="property-image">
        <div class="property-info">
            <h3 class="property-title">123 Main Street, Apt 1A</h3>
            <div class="property-details">
                <p><strong>Type:</strong> 2BR/1BA Apartment</p>
                <p><strong>Rent:</strong> Rs 25,500/month</p>
                <p><strong>Status:</strong> <span class="badge badge-success">Occupied</span></p>
                <p><strong>Tenant:</strong> John Doe</p>
            </div>
            <div class="property-actions">
                <button class="btn btn-outline btn-sm view-property" data-property-id="1">
                    <i class="fas fa-eye"></i> View Details
                </button>
                <button class="btn btn-primary btn-sm edit-property" data-property-id="1">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
        </div>
    </div>

    <div class="property-card" data-status="vacant" data-type="house">
        <img src="https://via.placeholder.com/300x200?text=Property+Image" alt="Property" class="property-image">
        <div class="property-info">
            <h3 class="property-title">456 Oak Avenue</h3>
            <div class="property-details">
                <p><strong>Type:</strong> 3BR/2BA House</p>
                <p><strong>Rent:</strong> Rs 25,500/month</p>
                <p><strong>Status:</strong> <span class="badge badge-warning">Vacant</span></p>
                <p><strong>Available:</strong> March 1, 2024</p>
            </div>
            <div class="property-actions">
                <button class="btn btn-outline btn-sm view-property" data-property-id="2">
                    <i class="fas fa-eye"></i> View Details
                </button>
                <button class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> List Property
                </button>
            </div>
        </div>
    </div>

    <div class="property-card" data-status="occupied" data-type="condo">
        <img src="https://via.placeholder.com/300x200?text=Property+Image" alt="Property" class="property-image">
        <div class="property-info">
            <h3 class="property-title">789 Pine St, Unit 12</h3>
            <div class="property-details">
                <p><strong>Type:</strong> 1BR/1BA Condo</p>
                <p><strong>Rent:</strong> Rs 25,500/month</p>
                <p><strong>Status:</strong> <span class="badge badge-success">Occupied</span></p>
                <p><strong>Tenant:</strong> Sarah Wilson</p>
            </div>
            <div class="property-actions">
                <button class="btn btn-outline btn-sm view-property" data-property-id="3">
                    <i class="fas fa-eye"></i> View Details
                </button>
                <button class="btn btn-primary btn-sm edit-property" data-property-id="3">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
        </div>
    </div>

    <div class="property-card" data-status="maintenance" data-type="apartment">
        <img src="https://via.placeholder.com/300x200?text=Property+Image" alt="Property" class="property-image">
        <div class="property-info">
            <h3 class="property-title">321 Elm Drive, Apt 5B</h3>
            <div class="property-details">
                <p><strong>Type:</strong> 2BR/2BA Apartment</p>
                <p><strong>Rent:</strong> Rs 25,500/month</p>
                <p><strong>Status:</strong> <span class="badge badge-danger">Maintenance</span></p>
                <p><strong>Issue:</strong> Plumbing repair needed</p>
            </div>
            <div class="property-actions">
                <button class="btn btn-outline btn-sm view-property" data-property-id="4">
                    <i class="fas fa-eye"></i> View Details
                </button>
                <button class="btn btn-warning btn-sm">
                    <i class="fas fa-tools"></i> Schedule Repair
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize filter functionality
        initFilter('#statusFilter', '.property-card', '.badge');
        initFilter('#typeFilter', '.property-card', null, 'data-type');

        // Search functionality
        const searchInput = document.getElementById('propertySearch');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const propertyCards = document.querySelectorAll('.property-card');

                propertyCards.forEach(card => {
                    const title = card.querySelector('.property-title').textContent.toLowerCase();
                    const details = card.querySelector('.property-details').textContent.toLowerCase();

                    if (title.includes(searchTerm) || details.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }

        // Button click handlers
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.textContent.trim();
                const propertyId = this.dataset.propertyId;

                switch (action) {
                    case 'View Details':
                        showNotification(`Opening details for property ${propertyId}`, 'info');
                        break;
                    case 'Edit':
                        showNotification(`Opening editor for property ${propertyId}`, 'info');
                        break;
                    case 'List Property':
                        showNotification('Opening property listing form', 'info');
                        break;
                    case 'Schedule Repair':
                        showNotification('Opening maintenance scheduling', 'info');
                        break;
                }
            });
        });
    });

    function resetFilters() {
        document.getElementById('statusFilter').value = '';
        document.getElementById('typeFilter').value = '';
        document.getElementById('propertySearch').value = '';

        document.querySelectorAll('.property-card').forEach(card => {
            card.style.display = 'block';
        });

        showNotification('Filters reset', 'info');
    }

    // Helper function for filter functionality
    function initFilter(selectId, cardClass, badgeClass = null, dataAttr = null) {
        const filterSelect = document.querySelector(selectId);
        if (filterSelect) {
            filterSelect.addEventListener('change', function() {
                const selectedValue = this.value.toLowerCase();
                const cards = document.querySelectorAll(cardClass);

                cards.forEach(card => {
                    if (selectedValue === '') {
                        card.style.display = 'block';
                    } else {
                        let cardValue;
                        if (dataAttr) {
                            cardValue = card.getAttribute(dataAttr);
                        } else if (badgeClass) {
                            const badge = card.querySelector(badgeClass);
                            cardValue = badge ? badge.textContent.toLowerCase() : '';
                        }

                        if (cardValue && cardValue.includes(selectedValue)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        }
    }

    // Notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;

        Object.assign(notification.style, {
            position: 'fixed',
            top: '20px',
            right: '20px',
            padding: '1rem 1.5rem',
            borderRadius: '0.5rem',
            color: 'white',
            fontWeight: '500',
            zIndex: '9999',
            opacity: '0',
            transform: 'translateY(-20px)',
            transition: 'all 0.3s ease'
        });

        const colors = {
            success: '#10b981',
            warning: '#f59e0b',
            error: '#ef4444',
            info: '#3b82f6'
        };
        notification.style.backgroundColor = colors[type] || colors.info;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateY(0)';
        }, 100);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
</script>

<?php require APPROOT . '/views/inc/landlord_footer.php'; ?>