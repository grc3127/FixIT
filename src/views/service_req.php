<?php
$noDisplay = true;
include(dirname(__DIR__,2) . "/public/data/service_req_data.php");

// Prepare the JSON map safely
$jsonArticleMap = json_encode($articleMap ?? [], JSON_FORCE_OBJECT);
?>

<main class="app-main">
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <h2 class="mb-0 fw-light">Request Management Portal</h2>
        </div>

        
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div id="responseAlert" class="mb-4 d-none alert alert-dismissible fade show" role="alert"></div>

            <div class="row g-4">
                <!-- Job Request -->
                <div class="col-12 col-xl-6">
                    <div class="card h-100 shadow-sm border-0 text-start <?= $hasActiveJob ? 'opacity-75' : '' ?>">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <div class="col">
                                <h3 class="card-title mt-1">Job Request</h3>
                            </div>
                            <div>
                                <?php if ($hasActiveJob): ?>
                                    <span class="badge bg-warning text-dark">Request Ongoing</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <form id="jobRequestForm">
                            <fieldset <?= $hasActiveJob ? 'disabled' : '' ?>> <input type="hidden" name="form_type" value="job_request">
                                <div class="card-body p-2">
                                    <?php if ($hasActiveJob): ?>
                                        <div class="alert alert-info py-2 small">
                                            <i class="bi bi-info-circle me-1"></i>You have a pending job request. Please wait for it to be completed before submitting a new one.
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-4 text-start">
                                        <span class="form-label d-block fw-bold fs-5">Request Type</span>
                                        <div class="form-check form-check-inline mt-2">
                                            <input class="form-check-input" type="radio" name="jobType" id="typePhysical" value="Physical" checked>
                                            <label class="form-check-label fs-5" for="typePhysical">Physical</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jobType" id="typeDigital" value="Digital">
                                            <label class="form-check-label fs-5" for="typeDigital">Digital</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="jobRequestInput" class="form-label fw-bold fs-5">Detailed Description</label>
                                        <textarea id="jobRequestInput" name="jobDescription" class="form-control form-control-lg py-3 fs-4" rows="6" placeholder="Enter full details" required></textarea>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top-0 p-2">
                                    <button type="button" class="btn btn-primary btn-lg w-100 py-3 fs-5" 
                                            onclick="confirmSubmission('job')" 
                                            <?= $hasActiveJob ? 'disabled' : '' ?>>
                                        <?= $hasActiveJob ? 'Submission Locked' : 'Submit Job Request' ?>
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>

                <!-- Inventory Request -->
                <div class="col-12 col-xl-6">
                    <div class="card h-100 shadow-sm border-0 text-start <?= $hasActiveInv ? 'opacity-75' : '' ?>">
                        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                            <div class="col">
                                <h3 class="card-title mt-1">Inventory Request</h3>
                            </div>
                            <div>
                                <?php if ($hasActiveInv): ?>
                                <span class="badge bg-warning text-dark">Request Ongoing</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <form id="inventoryRequestForm">
                            <fieldset <?= $hasActiveInv ? 'disabled' : '' ?>>
                                <input type="hidden" name="form_type" value="inventory_request">
                                <div class="card-body p-2">
                                    <?php if ($hasActiveInv): ?>
                                        <div class="alert alert-info py-2 small">
                                            <i class="bi bi-info-circle me-2"></i>You have a pending inventory request.
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-4 text-start">
                                        <label for="deviceSelect" class="form-label fw-bold fs-5">Device Type</label>
                                        <select id="deviceSelect" name="device_id" class="form-select form-select-lg border-2 py-3" onchange="updateArticles()" required>
                                            <option selected disabled value="">Select Device...</option>
                                            <?php foreach ($devices as $device): ?>
                                                <option value="<?= $device['device_id'] ?>"><?= $device['device_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4 text-start">
                                        <label for="articleSelect" class="form-label fw-bold fs-5">Available Articles</label>
                                        <select id="articleSelect" name="article_name" class="form-select form-select-lg border-2 py-3" disabled required>
                                            <option selected disabled value="">Select device first</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="invDescription" class="form-label fw-bold fs-5">Purpose</label>
                                        <textarea id="invDescription" name="invDescription" class="form-control form-control-lg py-3 fs-4" rows="2" placeholder="Enter purpose" required></textarea>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top-0 p-4">
                                    <button type="button" class="btn btn-success btn-lg w-100 py-3 fs-5" 
                                            onclick="confirmSubmission('inventory')"
                                            <?= $hasActiveInv ? 'disabled' : '' ?>>
                                        <?= $hasActiveInv ? 'Submission Locked' : 'Submit Inventory Request' ?>
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        
        </div>
    </div>

    
</main>

