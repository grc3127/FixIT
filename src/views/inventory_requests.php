<?php
include '../src/handlers/inventory_request_data.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Inventory Requests</h3>
                </div>
            </div>
        </div>
    </div>
   <div class="app-content">
        <div class="container-fluid">

        <?php
        if (isset($_SESSION['role_id']) && in_array($_SESSION['role_id'], [1, 2], true)) {
        ?>

        <!-- MAIN ROW -->
        <div class="row g-4">

            <!-- DAILY STATS -->
            <div class="col-md-7">
                <div class="card h-100">
                    <div class="card-header  bg-white">
                        <h4>Daily Statistics</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="small-box text-bg-danger p-3 rounded-3 h-100">
                                    <h4 class="fw-bold"><?=  $countNew ?></h4>
                                    <p class="m-0" style="font-size: 1.5vw;">New Inventory<br>Requests</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="small-box text-bg-warning p-3 rounded-3 text-white h-100">
                                    <h4 class="fw-bold"><?=  $countPending ?></h4>
                                    <p class="m-0" style="font-size: 1.5vw;">Pending Inventory<br>Requests</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="small-box text-bg-success p-3 rounded-3 h-100">
                                    <h4 class="fw-bold"><?=  $countFinished ?></h4>
                                    <p class="m-0" style="font-size: 1.5vw;">Finished Inventory<br>Requests</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIVE JOB -->
            <div class="col-md-5">
                <?php if (!empty($activeJob)):

                    $aProfilePic = !empty($activeJob['profile_pic']) ? htmlspecialchars($activeJob['profile_pic']) : 'dist/img/user-default.jpg';
                    $aFullName   = htmlspecialchars($activeJob['first_name'] . ' ' . $activeJob['last_name']);
                    $aDate       = date('M d, Y @ h:ia', strtotime($activeJob['created_at']));
                    $aDept       = htmlspecialchars($activeJob['dept_name']);
                    $aDesc       = htmlspecialchars($activeJob['description']);
                ?>

                <div class="card shadow-sm h-100 d-flex flex-column">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="m-0">Current Job Request</h4>
                            </div>
                            <div class="col-auto text-end">
                                <button type="submit" class="btn btn-success rounded-pill">DONE</button>
                            </div>
                        </div>
                        
                        
                    </div>

                    <div class="card-body">
                        <div class="d-flex">
                            <img src="<?= $aProfilePic ?>" class="rounded-circle me-3" style="width:80px;height:80px;object-fit:cover;">
                            <div>
                                <p><strong>Name:</strong> <?= $aFullName ?></p>
                                <p><strong>Date:</strong> <?= $aDate ?></p>
                                <p><strong>Department:</strong> <?= $aDept ?></p>
                                <p><strong>Description:</strong> <?= $aDesc ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php else: ?>

                <div class="card shadow-sm h-100 border-dashed">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center text-muted">
                        
                        <i class="bi bi-clipboard-x fs-1 mb-3"></i>
                        <h5>No Current Task</h5>
                        <p class="small">Accept a request to get started.</p>

                    </div>
                </div>

                <?php endif; ?>
            </div>

        </div>
        <!-- END ROW -->

        <?php } ?>

        <br>

        <!-- JOB REQUEST LIST -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h3 class="card-title">New Inventory Requests</h3>
            </div>

            <div class="card-body p-3 h-100">

            <?php
            if (empty($inventoryRequests)) {
                echo '<p class="text-center text-muted">No new inventory requests found.</p>';
            } else {
                foreach ($inventoryRequests as $row) {

                    $profilePic = !empty($row['profile_pic']) ? htmlspecialchars($row['profile_pic']) : 'dist/img/user-default.jpg';
                    $fullName   = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
                    
                    // Use i_ticket_id for the collapse ID to ensure it's unique
                    $ticketID   = "invDetails" . $row['i_ticket_id']; 
                    
                    // Use updated_at (which we added back to the SELECT)
                    $formattedDateTime = date('M d, Y | h:i A', strtotime($row['updated_at']));
                    
                    $deptName    = htmlspecialchars($row['dept_name']);
                    $article     = htmlspecialchars($row['article']);
                    $description = htmlspecialchars($row['description']);

                    if ($hasActiveTask) {
                        $buttonClass = "border rounded p-2 text-muted opacity-50";
                        $buttonStyle = "cursor:not-allowed;width:40px;height:40px;display:flex;align-items:center;justify-content:center;";
                        $onclick = "";
                    } else {
                        $buttonClass = "border rounded p-2 text-success";
                        $buttonStyle = "cursor:pointer;width:40px;height:40px;display:flex;align-items:center;justify-content:center;";
                        $onclick = "onclick='event.stopPropagation(); acceptJob({$row['i_ticket_id']})'";
                    }
            ?>

                <div class="card mb-2 border shadow-none">

                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center" 
                            role="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#<?= $ticketID ?>">
                            <img src="<?= $profilePic ?>" class="rounded-circle border me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                        <div class="col">
                            <strong><?= $fullName ?></strong>
                        </div>
                        <div class="<?= $buttonClass ?>" style="<?= $buttonStyle ?>" <?= $onclick ?>>
                            <i class="bi bi-check-lg"></i>
                        </div>
                    </div>

                    <div class="collapse" id="<?= $ticketID ?>">

                        <div class="card-footer bg-white border-top p-3">
                            <div class="row mb-2 align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-calendar3"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Date and Time</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?= $formattedDateTime ?></div>
                            </div>
                            <div class="row mb-2 align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-building"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Department</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?= $deptName ?></div>
                            </div>
                            <div class="row align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-chat-left-text"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Description</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?= $description ?></div>
                            </div>

                        </div>
                    </div>

                </div>
                
            <?php
                }
            }
            ?>

            </div>
        </div>

        </div>
    </div>
</main>