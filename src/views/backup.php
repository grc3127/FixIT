<div class="app-wrapper ">
    <main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            <h2 class="mb-0">Dashboard</h2>
            </div>
        </div>

        </div>
    </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card w-100">
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
        </div>
    </div>
</div>