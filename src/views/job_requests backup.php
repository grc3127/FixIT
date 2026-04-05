<?php


// Assuming $_SESSION['user_id'] holds the employee_id of the person logged in
$currentUserId = $_SESSION['employee_id'];

include '../src/handlers/job_request_data.php';

// Check if this technician already has a job "In Progress" (Status 2 in most systems)
$checkSql = "SELECT COUNT(*) FROM job_request 
             WHERE taken_by_employee = :eid 
             AND status_id = 2"; // Adjust '2' to your 'In Progress' ID
$checkStmt = $pdo->prepare($checkSql);
$checkStmt->execute(['eid' => $currentUserId]);
$hasActiveTask = ($checkStmt->fetchColumn() > 0);
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                <h3 class="mb-0">Job Request</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <?php
                if (isset($_SESSION['role_id']) &&
                    in_array($_SESSION['role_id'], [1, 2], true)
                ){
                    echo <<<HTML
                       
                        <!-- start of main row div -->
                        <div class="row g-4">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header bg-white">
                                        <h4>Daily Statistics</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="small-box text-bg-danger p-3 rounded-3">
                                                    <div class="inner">
                                                        <h4 class="fw-bold">3</h4>
                                                        <p class="m-0" style="font-size: 1rem;">New Job<br>Requests</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="small-box text-bg-warning p-3 rounded-3">
                                                    <div class="inner text-white">
                                                        <h4 class="fw-bold">1</h4>
                                                        <p class="m-0" style="font-size: 1rem;">Pending Job<br>Requests</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="small-box text-bg-success p-3 rounded-3">
                                                    <div class="inner">
                                                        <h4 class="fw-bold">12</h4>
                                                        <p class="m-0" style="font-size: 1rem;">Finished Job<br>Requests</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of row of cards -->
                                    </div>
                                    <!-- end of card-body -->
                                </div>
                                <!-- end of card -->
                            </div>
                            <!-- end of col -->
                    HTML;
                            if ($activeJob) {
                                if ($activeJob) {
                                // Prepare variables
                                $aProfilePic = !empty($activeJob['profile_pic']) ? htmlspecialchars($activeJob['profile_pic']) : 'dist/img/user-default.jpg';
                                $aFullName = htmlspecialchars($activeJob['first_name'] . ' ' . $activeJob['last_name']);
                                $aDate = date('M d, Y @ h:ia', strtotime($activeJob['created_at']));
                                $aDept = htmlspecialchars($activeJob['dept_name']);
                                $aDesc = htmlspecialchars($activeJob['description']);
                                $aTicketId = $activeJob['j_ticket_id'];

                            }else {
                                // What to show if the technician has no active job
                                echo <<<HTML
                                <div class="col-md-5">
                                    <div class="card shadow-sm h-100 d-flex flex-column border-dashed">
                                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-muted py-5">
                                            <i class="bi bi-clipboard-x fs-1 mb-3"></i>
                                            <h5>No Current Task</h5>
                                            <p class="small">Accept a request from the list to get started.</p>
                                        </div>
                                    </div>
                                </div>
                                HTML;
                            }


                            // <!-- <div class="col-md-5">
                            //     <div class="card shadow-sm h-100 d-flex flex-column" >
                            //         <div class="card-header">
                            //             <div class="row align-items-center">
                            //                 <div class="col">
                            //                     <h4 class="m-0">Current Job Request</h4>
                            //                 </div>
                                            
                            //                 <div class="col-auto text-end">
                            //                     <button type="submit" class="btn btn-success rounded-pill">DONE</button>
                            //                 </div>
                            //             </div>
                            //         </div>    
                            //         <div class="card-body">
                            //             <div class="row align-items-center">
                            //                 <div class="col-auto">
                            //                     <img src="path-to-your-image.jpg" class="rounded-circle" alt="User Image" style="width: 100px; height: 100px; object-fit: cover;">
                            //                 </div>

                            //                 <div class="col">
                            //                     <div class="small">
                            //                         <p class="mb-2"><strong>Name:</strong> Rachel Green</p>
                            //                         <p class="mb-2"><strong>Request Type:</strong> Digital</p>
                            //                         <p class="mb-2"><strong>Date and Time:</strong> Feb 03, 2026 @ 08:27am</p>
                            //                         <p class="mb-2"><strong>Department:</strong> Human Resources</p>
                            //                         <p class="mb-2"><strong>Description:</strong> There are no productivity tools in my unit</p>
                            //                     </div>
                            //                 </div>
                            //             </div>
                            //         </div>
                            //     </div>
                            // </div> -->
                        
                        echo <<<HTML
                            </div>
                            <!-- end of main row div -->
                        HTML;
                }
            ?>
            <br>
            <!-- start -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">New Job Requests</h3>
                </div>
                <!-- <div class="card-body p-3">
                    <div class="card mb-2 border shadow-none">    
                        <div class="card-body d-flex align-items-center justify-content-between py-2 px-3" 
                            role="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#requestDetails1" 
                            aria-expanded="false" 
                            aria-controls="requestDetails1">
                            
                            <div class="d-flex align-items-center">
                                <img src="rachel.jpg" class="rounded-circle border me-3" alt="User" style="width: 50px; height: 50px; object-fit: cover;">
                            </div>
                            <div class="col">
                                <span class="fw-bold">Rachel Green &rarr; Tablet</span>
                            </div>

                            <div class="col-auto text-end">
                                <div class="border rounded p-2 text-success" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-check-lg fs-4"></i>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="requestDetails1">
                            <div class="card-footer bg-white border-top p-3">
                                <div class="row mb-2 align-items-baseline">
                                    <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-calendar3"></i></div>
                                    <div class="col-auto px-1" style="width: 120px;"><strong>Date and Time</strong></div>
                                    <div class="col-auto px-1">:</div>
                                    <div class="col">February 08, 2026</div>
                                </div>

                                <div class="row mb-2 align-items-baseline">
                                    <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-building"></i></div>
                                    <div class="col-auto px-1" style="width: 120px;"><strong>Department</strong></div>
                                    <div class="col-auto px-1">:</div>
                                    <div class="col">Human Resources</div>
                                </div>

                                <div class="row align-items-baseline">
                                    <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-chat-left-text"></i></div>
                                    <div class="col-auto px-1" style="width: 120px;"><strong>Description</strong></div>
                                    <div class="col-auto px-1">:</div>
                                    <div class="col">There are not productive tools in my unit </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="card-body p-3">
                <?php
                if (empty($requests)) {
                    echo '<p class="text-center text-muted">No new job requests found.</p>';
                } else {
                    foreach ($requests as $row) {
                        $profilePic = !empty($row['profile_pic']) ? htmlspecialchars($row['profile_pic']) : 'dist/img/user-default.jpg';
                        $fullName = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
                        $requestCategory = "Digital Service"; 
                        $ticketID = "jobDetails" . $row['j_ticket_id'];
                        $formattedDate = date('F d, Y', strtotime($row['created_at']));
                        $deptName = htmlspecialchars($row['dept_name']);
                        $description = htmlspecialchars($row['description']);
                        $ticketID = "jobDetails" . $row['j_ticket_id'];

                        if ($hasActiveTask) {
                            // If they have a task, disable the button visually and functionally
                            $buttonClass = "border rounded p-2 text-muted opacity-50";
                            $buttonStyle = "width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: not-allowed;";
                            $buttonAction = ""; // Prevent click or trigger a 'You are busy' alert
                        } else {
                            // Normal state
                            $buttonClass = "border rounded p-2 text-success";
                            $buttonStyle = "width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer;";
                            $buttonAction = "onclick='acceptJob({$row['j_ticket_id']})'"; 
                        }

                        echo <<<HTML
                        <div class="card mb-2 border shadow-none">
                            <div class="card-body d-flex align-items-center justify-content-between py-2 px-3" 
                                role="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#$ticketID">
                                
                                <div class="d-flex align-items-center">
                                    <img src="$profilePic" class="rounded-circle border me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                </div>
                                <div class="col">
                                    <span class="fw-bold">$fullName &rarr; $requestCategory</span>
                                </div>
                                <div class="col-auto text-end">
                                    <div class="$buttonClass" style="$buttonStyle" $buttonAction>
                                        <i class="bi bi-check-lg fs-4"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse" id="$ticketID">
                                <div class="card-footer bg-white border-top p-3">
                                    <div class="row mb-2 align-items-baseline">
                                        <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-calendar3"></i></div>
                                        <div class="col-auto px-1" style="width: 120px;"><strong>Date and Time</strong></div>
                                        <div class="col-auto px-1">:</div>
                                        <div class="col">$formattedDate</div>
                                    </div>
                                    <div class="row mb-2 align-items-baseline">
                                        <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-building"></i></div>
                                        <div class="col-auto px-1" style="width: 120px;"><strong>Department</strong></div>
                                        <div class="col-auto px-1">:</div>
                                        <div class="col">$deptName</div>
                                    </div>
                                    <div class="row align-items-baseline">
                                        <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-chat-left-text"></i></div>
                                        <div class="col-auto px-1" style="width: 120px;"><strong>Description</strong></div>
                                        <div class="col-auto px-1">:</div>
                                        <div class="col">$description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    HTML;
                    }
                }
                ?>
                </div> 
            </div><!-- start --> 
                     
        </div>
    </div>
</main>