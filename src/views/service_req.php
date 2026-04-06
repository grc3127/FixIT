<?php

$devices = [
    ['id' => 1, 'name' => 'Desktop Computer'],
    ['id' => 2, 'name' => 'Laptop'],
    ['id' => 3, 'name' => 'Tablet'],
    ['id' => 4, 'name' => 'Monitor'],
    ['id' => 5, 'name' => 'Keyboard'],
    ['id' => 6, 'name' => 'Mouse'],
    ['id' => 7, 'name' => 'Printer'],
];

echo <<<HTML
<main class="app-main">
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-0 fw-light">Request Management Portal</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-xl-6">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mt-1">Job Request</h3>
                        </div>
                        <form method="get">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label d-block fw-bold fs-5">Request Type</label>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" name="jobType" id="typePhysical" value="Physical" checked>
                                        <label class="form-check-label fs-5" for="typePhysical">Physical</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jobType" id="typeDigital" value="Digital">
                                        <label class="form-check-label fs-5" for="typeDigital">Digital</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jobRequestInput" class="form-label fw-bold fs-5">Detailed Description</label>
                                    <textarea 
                                        id="jobRequestInput"
                                        name="jobDescription"
                                        class="form-control form-control-lg py-3 fs-4" 
                                        rows="6"
                                        placeholder="Enter full job details here..." 
                                        required
                                    ></textarea>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0 p-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fs-5">Submit Job Request</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-header bg-success text-white">
                            <h3 class="card-title mt-1">Inventory Request</h3>
                        </div>
                        <form method="get">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label for="invDevice" class="form-label fw-bold fs-5">Device Type</label>
                                    <select class="form-select form-select-lg py-3 fs-5" id="invDevice" required>
                                        <option selected disabled value="">Select Device from Inventory...</option>
HTML;
                                        foreach ($devices as $device) {
                                            echo "<option value='{$device['id']}'>{$device['name']}</option>";
                                        }
echo<<<HTML
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="articleSelect" class="form-label fw-bold fs-5">2. Available Articles</label>
                                    <select id="articleSelect" class="form-select form-select-lg border-2 py-3" disabled>
                                        <option value="">Please select a device first...</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="invDescription" class="form-label fw-bold fs-5">Additional Details</label>
                                    <textarea 
                                        id="invDescription"
                                        name="invDescription"
                                        class="form-control form-control-lg py-3 fs-4" 
                                        rows="2"
                                        placeholder="Serial numbers, specific models, etc." 
                                        required
                                    ></textarea>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0 p-4">
                                <button type="submit" class="btn btn-success btn-lg w-100 py-3 fs-5">Submit Inventory Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> </div>
    </div>
</main>
HTML;
?>