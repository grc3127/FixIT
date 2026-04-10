<?php
include '../src/handlers/inventory_request_data.php';
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="mb-0">Inventory Requests</h2>
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
            <div class="col">
                <div class="card h-100">
                    <div class="card-header  bg-white">
                        <h3>Daily Statistics</h3>
                    </div>
                    <div class="card-body">
                        <div class="row h-100">
                            <div class="col-md-4">
                                <div class="small-box text-bg-danger p-3 rounded-3 h-100">
                                    <h4 class="fw-bold"><?php echo   $countNew ?></h4>
                                    <p class="m-0" style="font-size: 1.5vw;">New Inventory<br>Requests</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="small-box text-bg-warning p-3 rounded-3 text-white h-100">
                                    <h4 class="fw-bold"><?php echo   $countPending ?></h4>
                                    <p class="m-0" style="font-size: 1.5vw;">Pending Inventory<br>Requests</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="small-box text-bg-success p-3 rounded-3 h-100">
                                    <h4 class="fw-bold"><?php echo   $countFinished ?></h4>
                                    <p class="m-0" style="font-size: 1.5vw;">Finished Inventory<br>Requests</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIVE ITEM REQUEST -->
            <!-- <div class="col-md-5">
                <?php if (!empty($activeItemRequest)):

                    $aProfilePic = !empty($activeItemRequest['profile_pic']) ? htmlspecialchars($activeItemRequest['profile_pic']) : 'dist/img/user-default.jpg';
                    $aFullName   = htmlspecialchars($activeItemRequest['first_name'] . ' ' . $activeItemRequest['last_name']);
                    $aDate       = date('M d, Y @ h:ia', strtotime($activeItemRequest['date_borrowed']));
                    $aDept       = htmlspecialchars($activeItemRequest['dept_name']);
                    $aArticle       = htmlspecialchars($activeItemRequest['article']);
                    $aDesc       = htmlspecialchars($activeItemRequest['description']);
                ?>

                <div class="card shadow-sm h-100 d-flex flex-column">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="m-0">Current Item Request</h3>
                            </div>
                            <div class="col-auto text-end">
                                <button type="submit" id="irReturnBtn" class="btn btn-success rounded-pill">RETURN</button>
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
                                <p><strong>Item: <?php echo  $aArticle ?></strong></p>
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
            </div> -->

        </div>
        <!-- END ROW -->

        <?php } ?>

        <br>

        <!-- ITEM REQUEST LIST -->
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
                   
            ?>

                
                <div class="card mb-2 border shadow-none position-relative">
                    <div class="card-body d-flex justify-content-between align-items-center" 
                        role="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapse-<?php echo $ticketID ?>" 
                        aria-expanded="false" 
                        style="cursor: pointer;">
                        
                        <div class="d-flex align-items-center col">
                            <img src="<?php echo $profilePic ?>" class="rounded-circle border me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <strong><?php echo $fullName ?></strong>
                        </div>
                        
                        <div class=" px-3 text-muted">
                            <i class="bi <?php echo $row['status_id'] == 1 ? 'bi bi-box-arrow-left' : 'bi bi-box-arrow-in-right'; ?>"></i>
                        </div>
                    </div>

                    <div class="collapse" id="collapse-<?php echo $ticketID ?>">
                        <div class="card-footer bg-white border-top p-3">
                            
                            <div class="row mb-2 align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-calendar3"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Date and Time</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?php echo $formattedDateTime ?></div>
                            </div>
                            <div class="row mb-2 align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-building"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Department</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?php echo $deptName ?></div>
                            </div>
                            <div class="row mb-2 align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-box-seam"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Item</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><strong><?php echo $article ?></strong></div>
                            </div>
                            <div class="row mb-3 align-items-baseline">
                                <div class="col-auto text-muted" style="width: 30px;"><i class="bi bi-chat-left-text"></i></div>
                                <div class="col-auto px-1" style="width: 120px;"><strong>Description</strong></div>
                                <div class="col-auto px-1">:</div>
                                <div class="col"><?php echo $description ?></div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <?php if($row['status_id'] == 1): ?>
                                        <button class="btn btn-success w-100 py-2" 
                                                onclick="event.stopPropagation(); acceptInventory(<?php echo (int)$row['i_ticket_id']; ?>)">
                                            <i class="bi bi-check-lg me-1"></i> Accept
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-primary w-100 py-2" 
                                                onclick="event.stopPropagation(); returnInventory(this, <?php echo (int)$row['i_ticket_id']; ?>)">
                                            <i class="bi bi-arrow-left-right me-1"></i> Return
                                        </button>
                                    <?php endif; ?>
                                </div>
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