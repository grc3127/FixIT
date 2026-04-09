<?php
include '../src/handlers/inventory_mgmt_data.php';
?>


<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Inventory Management</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addItemModal">
                        <i class="bi bi-plus-circle"></i> Add New Item
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <?php if (!empty($inventoryData)): ?>
                <?php foreach ($inventoryData as $deviceName => $items): 
                    // Create a unique ID for each category to handle the collapse logic
                    $collapseId = 'collapse_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $deviceName);
                ?>
                    
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-secondary text-white" 
                                role="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#<?php echo $collapseId; ?>" 
                                aria-expanded="false" 
                                style="cursor: pointer;">
                            
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0"><?php echo htmlspecialchars($deviceName); ?></h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-light text-dark rounded-pill me-2"><?php echo count($items); ?></span>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>

                        </div>

                        <!-- Items content -->
                        <div id="<?php echo $collapseId; ?>" class="collapse">
                            <div class="card-body p-0"> 
                                <div class="list-group list-group-flush">
                                    <?php foreach ($items as $item): ?>
                                        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <i class="bi bi-cpu fs-3 text-secondary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($item['article']); ?></h6>
                                                    <small class="text-muted d-block">
                                                        Property #: <?php echo htmlspecialchars($item['property_num']); ?> | 
                                                        S/N: <?php echo htmlspecialchars($item['serial_num']); ?>
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="text-end d-flex align-items-center">
                                                <div class="me-4 text-center">
                                                    <span class="d-block fw-bold"><?php echo $item['quantity']; ?></span>
                                                    <small class="text-uppercase text-muted" style="font-size: 10px;">In Stock</small>
                                                </div>
                                                
                                                <div class="btn-group">
                                                    <?php if (in_array($item['status_id'], [1, 3])): ?>
                                                        <button class="btn btn-outline-secondary btn-sm edit-item-btn" 
                                                                title="Edit Item"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#editItemModal"
                                                                data-item='<?php echo json_encode($item, JSON_HEX_APOS); ?>'>
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                    <?php endif; ?>

                                                    <?php if ($item['status_id'] == 4): ?>
                                                        <button class="btn btn-outline-danger btn-sm delete-item-btn" 
                                                                title="Delete Item"
                                                                data-id="<?php echo $item['item_id']; ?>"
                                                                data-article="<?php echo htmlspecialchars($item['article']); ?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning">No assets found in the database.</div>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addItemForm">
                <input type="hidden" name="action" value="add">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Article/Model Name</label>
                        <input type="text" name="article" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Device Category</label>
                        <select name="device_id" class="form-select" required>
                            <option value="">Select Category</option>
                            <?php foreach ($devices as $device): ?>
                                <option value="<?php echo $device['device_id']; ?>"><?php echo htmlspecialchars($device['device_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Property #</label>
                            <input type="text" name="property_num" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Serial #</label>
                            <input type="text" name="serial_num" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Status</label>
                            <select name="status_id" class="form-select" required>
                                <?php foreach ($itemStatuses as $status): ?>
                                    <option value="<?php echo $status['status_id']; ?>"><?php echo htmlspecialchars($status['status_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Acquired</label>
                        <input type="date" name="date_acquired" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editItemForm">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="item_id" id="edit_item_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Article/Model Name</label>
                        <input type="text" name="article" id="edit_article" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Device Category</label>
                        <select name="device_id" id="edit_device_id" class="form-select" required>
                            <?php foreach ($devices as $device): ?>
                                <option value="<?php echo $device['device_id']; ?>"><?php echo htmlspecialchars($device['device_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Property #</label>
                            <input type="text" name="property_num" id="edit_property_num" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Serial #</label>
                            <input type="text" name="serial_num" id="edit_serial_num" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" id="edit_quantity" class="form-control" min="1" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Status</label>
                            <select name="status_id" id="edit_status_id" class="form-select" required>
                                <?php foreach ($itemStatuses as $status): ?>
                                    <option value="<?php echo $status['status_id']; ?>"><?php echo htmlspecialchars($status['status_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Acquired</label>
                        <input type="date" name="date_acquired" id="edit_date_acquired" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handler for Add/Edit Form submissions
    const forms = ['addItemForm', 'editItemForm'];
    forms.forEach(formId => {
        const form = document.getElementById(formId);
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('../src/handlers/inventory_mgmt_data.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            });
        }
    });

    // Populate Edit Modal
    document.querySelectorAll('.edit-item-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const item = JSON.parse(this.dataset.item);
            document.getElementById('edit_item_id').value = item.item_id;
            document.getElementById('edit_article').value = item.article;
            document.getElementById('edit_device_id').value = item.device_id;
            document.getElementById('edit_property_num').value = item.property_num;
            document.getElementById('edit_serial_num').value = item.serial_num;
            document.getElementById('edit_quantity').value = item.quantity;
            document.getElementById('edit_status_id').value = item.status_id;
            document.getElementById('edit_date_acquired').value = item.date_acquired || '';
        });
    });

    // Delete Item
    document.querySelectorAll('.delete-item-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const article = this.dataset.article;
            if (confirm(`Are you sure you want to delete "${article}"?`)) {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('item_id', id);
                fetch('../src/handlers/inventory_mgmt_data.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        });
    });
});
</script>