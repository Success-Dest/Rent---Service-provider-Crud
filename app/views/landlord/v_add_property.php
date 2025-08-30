<?php require APPROOT . '/views/inc/landlord_header.php'; ?>

<!-- Page Header -->
<div class="page-header">
    <div class="header-left">
        <h1 class="page-title">Add New Property</h1>
        <p class="page-subtitle">List a new property for rent</p>
    </div>
    <div class="header-actions">
        <a href="<?php echo URLROOT; ?>/landlord/properties" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Properties
        </a>
    </div>
</div>

<!-- Add Property Form -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Property Information</h2>
    </div>
    <div class="card-body">
        <form id="addPropertyForm" method="POST" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <!-- Left Column -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Property Address *</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Property Type *</label>
                        <select class="form-control" name="type" required>
                            <option value="">Select Type</option>
                            <option value="apartment">Apartment</option>
                            <option value="house">House</option>
                            <option value="condo">Condo</option>
                            <option value="townhouse">Townhouse</option>
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label">Bedrooms *</label>
                            <select class="form-control" name="bedrooms" required>
                                <option value="">Select</option>
                                <option value="0">Studio</option>
                                <option value="1">1 Bedroom</option>
                                <option value="2">2 Bedrooms</option>
                                <option value="3">3 Bedrooms</option>
                                <option value="4">4+ Bedrooms</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bathrooms *</label>
                            <select class="form-control" name="bathrooms" required>
                                <option value="">Select</option>
                                <option value="1">1 Bathroom</option>
                                <option value="1.5">1.5 Bathrooms</option>
                                <option value="2">2 Bathrooms</option>
                                <option value="2.5">2.5 Bathrooms</option>
                                <option value="3">3+ Bathrooms</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Square Footage</label>
                        <input type="number" class="form-control" name="sqft" placeholder="e.g., 1200">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Monthly Rent *</label>
                        <input type="number" class="form-control" name="rent" required placeholder="e.g., 1500">
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Security Deposit</label>
                        <input type="number" class="form-control" name="deposit" placeholder="e.g., 1500">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Available Date</label>
                        <input type="date" class="form-control" name="available_date">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Parking</label>
                        <select class="form-control" name="parking">
                            <option value="">Select Parking</option>
                            <option value="none">No Parking</option>
                            <option value="street">Street Parking</option>
                            <option value="driveway">Driveway</option>
                            <option value="garage">Garage</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pet Policy</label>
                        <select class="form-control" name="pets">
                            <option value="no">No Pets</option>
                            <option value="cats">Cats Only</option>
                            <option value="dogs">Dogs Only</option>
                            <option value="both">Cats & Dogs</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Laundry</label>
                        <select class="form-control" name="laundry">
                            <option value="">Select Laundry</option>
                            <option value="none">No Laundry</option>
                            <option value="shared">Shared Laundry</option>
                            <option value="hookups">Washer/Dryer Hookups</option>
                            <option value="included">Washer/Dryer Included</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Property Description</label>
                <textarea class="form-control" name="description" rows="4" placeholder="Describe the property, amenities, neighborhood, etc."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Property Photos</label>
                <input type="file" class="form-control" name="photos" multiple accept="image/*">
                <small style="color: var(--text-secondary); font-size: 0.875rem;">Upload multiple photos (JPG, PNG, max 5MB each)</small>
            </div>

            <div class="form-group">
                <label class="form-label">Additional Documents</label>
                <input type="file" class="form-control" name="documents" multiple>
                <small style="color: var(--text-secondary); font-size: 0.875rem;">Upload lease templates, property documents, etc.</small>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                <button type="button" class="btn btn-outline" onclick="saveDraft()">
                    <i class="fas fa-save"></i> Save as Draft
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Property
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('addPropertyForm');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic form validation
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = 'var(--danger-color)';
                    isValid = false;
                } else {
                    field.style.borderColor = 'var(--border-color)';
                }
            });

            if (isValid) {
                // Simulate form submission
                showNotification('Property added successfully!', 'success');
                setTimeout(() => {
                    window.location.href = '<?php echo URLROOT; ?>/landlord/properties';
                }, 1500);
            } else {
                showNotification('Please fill in all required fields.', 'error');
            }
        });

        // File input validation
        const fileInputs = form.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const files = e.target.files;
                const maxSize = 5 * 1024 * 1024; // 5MB

                for (let file of files) {
                    if (file.size > maxSize) {
                        showNotification('File size must be less than 5MB', 'error');
                        e.target.value = '';
                        return;
                    }
                }

                if (files.length > 0) {
                    showNotification(`${files.length} file(s) selected`, 'success');
                }
            });
        });
    });

    function saveDraft() {
        // Simulate saving draft
        showNotification('Property saved as draft!', 'info');
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