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
                    <button class="btn btn-primary btn-sm">
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
                                                    <button class="btn btn-outline-secondary btn-sm" title="Edit Item">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger btn-sm" title="Mark as Defective">
                                                        <i class="bi bi-exclamation-triangle"></i>
                                                    </button>
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