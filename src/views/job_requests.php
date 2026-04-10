<?php
include '../src/handlers/job_request_data.php'; 
// echo "Debug: Logged in ID is: " . $currentUserId . " | Has Active Task: " . ($hasActiveTask ? 'YES' : 'NO');
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="mb-0">Job Request</h2>
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
                        <h3>Daily Statistics</h3>
                    </div>
                    <div class="card-body">
                        <div class="row h-100">
                            <div class="col-md-4">
                                <div class="small-box text-bg-danger p-3 rounded-3 h-100">
                                    <h4 class="fw-bold"><?php echo   $countNew ?></h4><br>
                                    <p class="m-0" style="font-size: 2vw;">New Job<br>Requests</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="small-box text-bg-warning p-3 rounded-3 text-white h-100">
                                    <h4 class="fw-bold"><?php echo   $countPending ?></h4><br>
                                    <p class="m-0" style="font-size: 2vw;">Pending Job<br>Requests</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="small-box text-bg-success p-3 rounded-3 h-100">
                                    <h4 class="fw-bold"><?php echo   $countFinished ?></h4><br>
                                    <p class="m-0" style="font-size: 2vw;">Finished Job<br>Requests</p>
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
                    $aType       = htmlspecialchars($activeJob['request_type']);
                ?>

                <div class="card shadow-sm h-100 d-flex flex-column">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="">Current Job Request</h3>
                            </div>
                            <div class="col-auto text-end">
                                <button type="submit" id="jrFinishRequest" class="btn btn-success rounded-pill">DONE</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex">
                            <img src="<?php echo  $aProfilePic ?>" class="rounded-circle me-3" style="width:80px;height:80px;object-fit:cover;">
                            <div>
                                <p><strong>Name:</strong> <?php echo  $aFullName ?></p>
                                <p><strong>Date:</strong> <?php echo  $aDate ?></p>
                                <p><strong>Department:</strong> <?php echo  $aDept ?></p>
                                <p><strong>Department:</strong> <?php echo  $aType ?></p>
                                <p><strong>Description:</strong> <?php echo  $aDesc ?></p>
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
                <h3 class="card-title">New Job Requests</h3>
            </div>

            <div class="card-body p-3 h-100">

            <?php
            if (empty($jobRequests)) {
                echo '<p class="text-center text-muted">No new job requests found.</p>';
            } else {
                foreach ($jobRequests as $row) {
                    
                    $profilePic = !empty($row['profile_pic']) ? htmlspecialchars($row['profile_pic']) : '/img/profile_pic/nicolai.png';
                    $fullName   = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
                    $ticketID   = "jobDetails" . $row['j_ticket_id'];
                    $formattedDate = date('F d, Y', strtotime($row['created_at']));
                    $deptName   = htmlspecialchars($row['dept_name']);
                    $rType   = htmlspecialchars($row['request_type']);
                    $description= htmlspecialchars($row['description']);

                    if ($hasActiveTask) {
                        $buttonClass = "border rounded p-2 text-muted opacity-50";
                        $buttonStyle = "cursor:not-allowed;width:40px;height:40px;display:flex;align-items:center;justify-content:center;";
                        $onclick = "";
                    } else {
                        $buttonClass = "border rounded p-2 text-success";
                        $buttonStyle = "cursor:pointer;width:40px;height:40px;display:flex;align-items:center;justify-content:center;";
                        $onclick = "onclick='event.stopPropagation(); acceptJob({$row['j_ticket_id']})'";
                    }
            ?>

                <div class="card mb-2 border shadow-none">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <!-- <div class="d-flex align-items-center"> -->
                            <div class="d-flex align-items-center" 
                                role="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#<?php echo  $ticketID ?>">
                            <img src="<?php echo  $profilePic ?>" class="rounded-circle border me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                        <div class="col">
                            <strong><?php echo  $fullName ?></strong>
                        </div>
                        <div class="<?php echo  $buttonClass ?>" style="<?php echo  $buttonStyle ?>" <?php echo  $onclick ?>>
                            <i class="bi bi-check-lg"></i>
                        </div>
                    </div>

                    <div class="collapse" id="<?php echo  $ticketID ?>">

                        <div class="card-footer bg-white border-top p-3">
                            <div class="row mb-2 align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-calendar3"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Date and Time</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?php echo  $formattedDate ?></div>
                            </div>
                            <div class="row mb-2 align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-building"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Department</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?php echo  $deptName ?></div>
                            </div>
                            <div class="row mb-2 align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-building"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Type</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?php echo  $rType ?></div>
                            </div>
                            <div class="row align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-chat-left-text"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Description</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?php echo  $description ?></div>
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

<script>
    // DEFINE THIS FIRST before the rest of the logic
    const currentActiveJobTicketId = "<?php echo isset($activeJob['j_ticket_id']) ? (int)$activeJob['j_ticket_id'] : ''; ?>";
    console.log("Active Ticket ID set to:", currentActiveJobTicketId); // Debugging line
</script>