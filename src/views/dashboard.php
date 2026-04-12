<!--begin::App Main (STATISTICS and CARDS 1 Layer)-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h2 class="mb-0">Dashboard</h2>
        </div>
      </div>

      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content Header-->

  <!--begin::App Content (STATISTICS and CARDS here)-->
  <div class="app-content">
    <div class="container-fluid">
        <?php
        $request_overtime = $APP->get('request_overtime');
        $request_overtime_safe = htmlspecialchars($request_overtime, ENT_QUOTES, 'UTF-8');
        $current_date = date("l, F j, Y");

        // --- ADMIN & TECHNICIAN VIEW (Roles 1 and 2) ---
        if (isset($_SESSION['role_id']) && in_array($_SESSION['role_id'], [1, 2], true)): 
        ?>
            <div class="row">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="fw-bold fs-5">Total completed requests: <?php echo  $request_overtime_safe ?></span> 
                                <span><?php echo  $current_date ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="position-relative mb-4">
                            <div id="sales-chart1"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner"><h3>150</h3><p>New Orders</p></div>
                        <i class="small-box-icon bi bi-cart"></i>
                        <a href="#" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner"><h3>53<sup class="fs-5">%</sup></h3><p>Bounce Rate</p></div>
                        <i class="small-box-icon bi bi-graph-up"></i>
                        <a href="#" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner"><h3>44</h3><p>User Registrations</p></div>
                        <i class="small-box-icon bi bi-person-add"></i>
                        <a href="#" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner"><h3>65</h3><p>Unique Visitors</p></div>
                        <i class="small-box-icon bi bi-pie-chart"></i>
                        <a href="#" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
            </div> -->

        <?php 
          // --- REGULAR EMPLOYEE VIEW ---
          else: 
              $loggedInEmployeeId = $_SESSION['employee_id']; 

              /**
               * 1. Fetch Latest Job Request 
               * - Filtered for status_id 1 or 2
               * - Joins employee table to get the name of the TECHNICIAN (taken_by_employee)
               */
              $stmtJob = $pdo->prepare("
                  SELECT jr.*, 
                        rs.status_name, 
                        CONCAT(e.first_name, ' ', e.last_name) as technician_name
                  FROM job_request jr
                  JOIN request_status rs ON jr.status_id = rs.status_id
                  LEFT JOIN employee e ON jr.taken_by_employee = e.employee_id
                  WHERE jr.requested_by_employee = ? 
                    AND jr.status_id IN (1, 2, 3)
                  ORDER BY jr.created_at DESC LIMIT 1
              ");
              $stmtJob->execute([$loggedInEmployeeId]);
              $job = $stmtJob->fetch(PDO::FETCH_ASSOC);

              /**
               * 2. Fetch Latest Inventory Request
               * - Filtered for status_id 1 or 2
               */
              $stmtInv = $pdo->prepare("
                  SELECT ir.*, 
                          rs.status_name, 
                          i.article AS item_name,
                          i.item_id
                          FROM inventory_request ir
                          JOIN request_status rs ON ir.status_id = rs.status_id
                          JOIN item i ON ir.item_id = i.item_id
                          WHERE ir.requested_by_employee = ? 
                            AND ir.status_id IN (1, 2, 3)
                          ORDER BY ir.i_ticket_id DESC LIMIT 1
                        ");
              $stmtInv->execute([$loggedInEmployeeId]);
              $inv = $stmtInv->fetch(PDO::FETCH_ASSOC);
          ?>
            <!-- <div id="responseAlert" class="mb-4 d-none alert alert-dismissible fade show" role="alert"></div> -->
              <div class="row g-4">
                <div class="col-12 col-md-6">
                    <?php 
                    // Logic: Status 3 is Pending Feedback
                    $needsFeedback = ($job && $job['status_id'] == 3);
                    $headerColor = $needsFeedback ? 'bg-info' : 'bg-primary';
                    ?>
                    <div class="card shadow-sm mb-4 h-100 border-0">
                        <div class="card-header <?php echo  $headerColor ?> text-white">
                            <h3 class="card-title mt-1">
                                <?php if ($needsFeedback): ?>
                                    <i class="bi bi-star-fill me-2"></i>Rate Our Service
                                <?php else: ?>
                                    <?php echo  $job ? "Job Request #" . $job['j_ticket_id'] : "Job Request" ?>
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class="card-body p-4 text-start">
                            <?php if ($needsFeedback): ?>
                                <form id="feedbackForm">
                                    <input type="hidden" name="form_type" value="feedback_submission">
                                    <input type="hidden" name="j_ticket_id" value="<?php echo  $job['j_ticket_id'] ?>">
                                    
                                    <div class="mb-3">
                                        <label class="fw-bold d-block text-muted small uppercase">Technician's Remarks</label>
                                        <div class="p-2 bg-light rounded border small fst-italic">
                                            "<?php echo  htmlspecialchars($job['remarks'] ?? 'No remarks provided.') ?>"
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="fw-bold d-block text-muted small uppercase mb-2">Rating</label>
                                        <div class="d-flex justify-content-between">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <label class="text-center">
                                                    <input type="radio" name="rating" value="<?php echo  $i ?>" class="btn-check" id="rate<?php echo  $i ?>" required>
                                                    <span class="btn btn-outline-info rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <?php echo  $i ?>
                                                    </span>
                                                </label>
                                            <?php endfor; ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="user_feedback" class="fw-bold d-block text-muted small uppercase mb-1">Your Comments</label>
                                        <textarea name="user_feedback" id="user_feedback" class="form-control form-control-sm" rows="2" placeholder="Tell us how it went..."></textarea>
                                    </div>

                                    <button id="" type="button" class="btn btn-info btn-sm w-100 text-white fw-bold" onclick="submitFeedback()">
                                        SUBMIT FEEDBACK & CLOSE TICKET
                                    </button>
                                </form>

                            <?php elseif ($job): ?>
                                <div class="mb-3">
                                    <label class="fw-bold d-block text-muted small uppercase">Status</label>
                                    <span class="badge bg-warning text-dark"><?php echo  $job['status_name'] ?></span>
                                </div>
                                
                                <?php if (!empty($job['taken_by_employee'])): ?>
                                    <div class="mb-3">
                                        <label class="fw-bold d-block text-muted small uppercase">Taken By</label>
                                        <p class="fs-5 mb-0 text-primary">
                                            <i class="bi bi-person-check-fill me-1"></i>
                                            <?php echo  htmlspecialchars($job['technician_name'] ?? 'Assigned') ?>
                                        </p>
                                    </div>
                                <?php else: ?>
                                    <div class="mb-3">
                                        <label class="fw-bold d-block text-muted small uppercase">Assigned To</label>
                                        <p class="text-muted italic small">Waiting for technician...</p>
                                    </div>
                                <?php endif; ?>

                                <hr>
                                <div>
                                    <label class="fw-bold d-block text-muted small uppercase">Description</label>
                                    <p class="fs-6 mt-2"><?php echo  htmlspecialchars($job['description']) ?></p>
                                </div>

                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="bi bi-clipboard-x fs-1 text-muted"></i>
                                    <p class="text-muted mt-2">No active job requests (Pending/Approved).</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                  <div class="col-12 col-md-6">
                      <div class="card shadow-sm mb-4 h-100 border-0">
                          <div class="card-header bg-success text-white">
                              <h3 class="card-title mt-1">Inventory Request</h3>
                          </div>
                          <div class="card-body p-4 text-start">
                              <?php if ($inv): ?>
                                  <div class="mb-3">
                                      <label class="fw-bold d-block text-muted small uppercase">Ticket ID</label>
                                      <p class="fs-5 mb-0">#<?php echo  $inv['i_ticket_id'] ?></p>
                                  </div>
                                  <div class="mb-3">
                                      <label class="fw-bold d-block text-muted small uppercase">Item Requested</label>
                                      <p class="fs-5 mb-0 text-success fw-bold"><?php echo  htmlspecialchars($inv['item_name']) ?></p>
                                  </div>
                                  <div class="mb-3">
                                      <label class="fw-bold d-block text-muted small uppercase">Status</label>
                                      <span class="badge bg-success"><?php echo  $inv['status_name'] ?></span>
                                  </div>
                                  <hr>
                                  <div>
                                      <label class="fw-bold d-block text-muted small uppercase">Purpose</label>
                                      <p class="fs-6 mt-2"><?php echo  htmlspecialchars($inv['description']) ?></p>
                                  </div>
                              <?php else: ?>
                                  <div class="text-center py-4">
                                      <i class="bi bi-box-seam fs-1 text-muted"></i>
                                      <p class="text-muted mt-2">No active inventory requests.</p>
                                  </div>
                              <?php endif; ?>
                          </div>
                      </div>
                  </div>
              </div>

          <?php endif; ?>

        <?php 

        // --- SHARED FEEDBACK SECTION (Admin Only) ---
        if (isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1): 
        ?>
            <div class="row">
                    <div class="card direct-chat direct-chat-primary ">
                        <?php include 'feedback.php'; ?>
                    </div>
            </div>
        <?php endif; ?>

    </div>
</div>
  <!--end::App Content-->
</main>
<!--end::App Main-->


<?php 

// --- SHARED FEEDBACK SECTION (Admin Only) ---
if (isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1): 
?>
    <script>
    let chart;
    function updateChartData() {
        fetch('data/get_chart_data.php')
        .then(res => res.json())
        .then(data => {
            if (chart) {
                chart.updateSeries([
                    { name: 'Job Requests', data: data.jobs },
                    { name: 'Inventory Requests', data: data.inventory }
                ]);
            } else {
                initChart(data);
            }
        })
        .catch(err => console.error("Fetch error:", err));
    }

    function initChart(data) {
        const chart_options = {
            series: [
                { name: 'Job Requests', data: data.jobs },
                { name: 'Inventory Requests', data: data.inventory }
            ],
            chart: {
                type: 'bar',
                height: 200,
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            colors: ['#0d6efd', '#20c997'],
            xaxis: {
                categories: ['Monthly', 'Weekly', 'Daily'],
            },
            tooltip: {
            y: {
                formatter: function(val) {
                return val + ' requests';
                },
            },
            }
        };

        chart = new ApexCharts(document.querySelector('#sales-chart1'), chart_options);
        chart.render();
}
updateChartData();
setInterval(updateChartData, 30000); 
<?php endif; ?>






</script>