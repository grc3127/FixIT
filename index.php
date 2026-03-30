<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

require "db.php";

$routes = [
    'dashboard'          => [1, 2, 3],
    'job_requests'       => [1, 2],
    'inventory_requests' => [1, 2],
    'inventory_mgmt'     => [1, 2],
    'user_mgmt'          => [1, 2],
    'service_request'    => [3],
];

$page = $_GET['page'] ?? 'dashboard';
$role = $_SESSION['role_id'];
$template = "pages/404_error.php";

if (array_key_exists($page, $routes)) {
    if (in_array($role, $routes[$page])) {
        // Dashboard is a special case in your original code
        if ($page === 'dashboard') {
            include 'handlers/dashboard_data.php';
            $template = 'views/dashboard.php';
        } else {
            // Map 'service_request' to 'service_req.php' if filenames differ
            $filename = ($page === 'service_request') ? 'service_req' : $page;
            $template = "pages/{$filename}.php";
        }
    } else {
        $template = "pages/403_error.php"; // Access Denied
    }
}

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
    <link rel="preload" href="./css/adminlte.css" as="style" />
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
    <link rel="stylesheet" href="./css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->

    <link rel="stylesheet" href="css/apexcharts.css" />
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper ">
        <?php 
            include 'views/header.php';
            include 'views/sidebar.php';
            
            // Render the resolved page
            if (file_exists($template)) {
                include $template;
            } else {
                echo "<div class='p-4'>Error: File not found ($template)</div>";
            }
        ?>
    </div>
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
        src="js/overlayscrollbars.browser.es6.min.js"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
        src="js/popper.min.js"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
        src="js/bootstrap.min.js"
        ></script>
        <!-- src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" -->
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
</body>

</html>