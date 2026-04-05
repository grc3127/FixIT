<?php
require "../db.php";



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>I-SeRVE | Dashboard</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="I-SeRVE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />


    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="css/index.css"
        crossorigin="anonymous"
        media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="css/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="css/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->

    <link rel="stylesheet" href="css/apexcharts.css" />
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
<!--begin::App Main (STATISTICS and CARDS 1 Layer)-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Dashboard</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content Header-->

  <!--begin::App Content (STATISTICS and CARDS here)-->
  <div class="app-content"><!--NEW CONTENT place inside div container fluid-->
    <div class="container-fluid"><!--THEN SEPARATE each content by div class row-->
                <div class="row">
            <!-- START OF JOB REQUEST STATISTICS  -->
            <div class="card mb-4">
              <div class="card-header">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="fw-bold fs-5">{$request_overtime}</span> <span>Requests Overtime</span>
                  </p>
                  <p class="ms-auto d-flex flex-column text-end">
                    <span class="text-success"> <i class="bi bi-arrow-up"></i> 33.1% </span>
                    <span class="text-secondary">Since Past Year</span>
                  </p>
                </div>
              </div>
              <div class="card-footer">
                <div class="position-relative mb-4">
                  <div id="sales-chart1"></div>
                </div>
                <div class="d-flex flex-row justify-content-end">
                  <!-- <span class="me-2">
                    <i class="bi bi-square-fill text-primary"></i> This year
                  </span>
                  <span> <i class="bi bi-square-fill text-secondary"></i> Last year </span> -->
                </div>
              </div>
            </div>
            <!-- END OF JOB REQUEST STATISTICS  -->
          </div>
          <div class="row">
            <!-- START OF JOB REQUEST STATISTICS CARDS  -->
            <!--begin::Col-->
            <div class="col-lg-3 col-6">
              <!--begin::Small Box Widget 1-->
              <div class="small-box text-bg-primary">
                <div class="inner">
                  <h3>150</h3>
                  <p>New Orders</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                  aria-hidden="true">
                  <path
                    d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                  </path>
                </svg>
                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                  More info <i class="bi bi-link-45deg"></i>
                </a>
              </div>
              <!--end::Small Box Widget 1-->
            </div>
            <!--end::Col-->
            <div class="col-lg-3 col-6">
              <!--begin::Small Box Widget 2-->
              <div class="small-box text-bg-success">
                <div class="inner">
                  <h3>53<sup class="fs-5">%</sup></h3>
                  <p>Bounce Rate</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                  aria-hidden="true">
                  <path
                    d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                  </path>
                </svg>
                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                  More info <i class="bi bi-link-45deg"></i>
                </a>
              </div>
              <!--end::Small Box Widget 2-->
            </div>
            <!--end::Col-->
            <div class="col-lg-3 col-6">
              <!--begin::Small Box Widget 3-->
              <div class="small-box text-bg-warning">
                <div class="inner">
                  <h3>44</h3>
                  <p>User Registrations</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                  aria-hidden="true">
                  <path
                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                  </path>
                </svg>
                <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                  More info <i class="bi bi-link-45deg"></i>
                </a>
              </div>
              <!--end::Small Box Widget 3-->
            </div>
            <!--end::Col-->
            <div class="col-lg-3 col-6">
              <!--begin::Small Box Widget 4-->
              <div class="small-box text-bg-danger">
                <div class="inner">
                  <h3>65</h3>
                  <p>Unique Visitors</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                  aria-hidden="true">
                  <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                  </path>
                  <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z">
                  </path>
                </svg>
                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                  More info <i class="bi bi-link-45deg"></i>
                </a>
              </div>
              <!--end::Small Box Widget 4-->
            </div>
            <!--end::Col-->
            <!-- START OF JOB REQUEST STATISTICS CARDS  -->
          </div>
          <div class="row">
          </div>


    </div>
  </div>
  <!--end::App Content-->
</main>
<!--end::App Main-->
<!--begin::Footer-->
<footer class="app-footer">
  <!--begin::To the end-->
  <div class="float-end d-none d-sm-inline">MIT Project</div>
  <!--end::To the end-->
  <!--begin::Copyright-->
  <strong>
    BFAR
  </strong>
  <!--end::Copyright-->
</footer>
<!--end::Footer-->

<!--begin::Script-->
  




  
  <!-- apexcharts -->
  <script src="js/apexcharts.min.js"></script>
  <!-- ChartJS -->
  <script>
  const chart_options = {
      series: [
        { name: 'Job Requests', data: [] },
        { name: 'Inventory Requests', data: [] }
      ],
      chart: {
        type: 'bar',
        height: 200,
        animations: {
          enabled: false // This often stops the "attribute d" error if data is swapping quickly
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '40%',
          borderRadius: 1
        }
      },
      legend: {
        show: true,
      },
      colors: ['#0d6efd', '#20c997'],
      dataLabels: {
        enabled: false,
      },
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
  }


  const chart = new ApexCharts(
      document.querySelector('#sales-chart1'),
      chart_options,
  );
  chart.render();

  function updateDashboard() {
  fetch('get_chart_data.php')
    .then(response => response.json())
    .then(data => {
      // ✅ Fallback to [0, 0, 0] if data is missing or malformed
      const jobs = (data && Array.isArray(data.jobs)) ? data.jobs : [0, 0, 0];
      const inventory = (data && Array.isArray(data.inventory)) ? data.inventory : [0, 0, 0];

      // ✅ Force check: If parseInt fails, return 0. This stops "NaN" strings.
      const cleanJobs = jobs.map(x => {
        const val = parseInt(x, 10);
        return isNaN(val) ? 0 : val;
      });
      
      const cleanInventory = inventory.map(x => {
        const val = parseInt(x, 10);
        return isNaN(val) ? 0 : val;
      });

      chart.updateSeries([
        { name: 'Job Requests', data: cleanJobs },
        { name: 'Inventory Requests', data: cleanInventory }
      ]);
    })
    .catch(err => {
      console.error('Fetch Error:', err);
      chart.updateSeries([
        { name: 'Job Requests', data: [0, 0, 0] },
        { name: 'Inventory Requests', data: [0, 0, 0] }
      ]);
    });   
  }
  
  setInterval(updateDashboard, 5000);  
</script>
</body>
</html>