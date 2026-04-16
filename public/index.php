<?php
require_once __DIR__ . "/../config/bootstrap.php";
Security::sendSecurityHeaders();

if (empty($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$csrfToken = Security::generateCsrfToken();

$routes = [
        'dashboard' => [1, 2, 3],
        'job_requests' => [1, 2],
        'inventory_requests' => [1, 2],
        'inventory_mgmt' => [1, 2],
        'user_mgmt' => [1],
        'service_request' => [3],
];

$page = $_GET['page'] ?? 'dashboard';
$role = (int)$_SESSION['role_id'];
$template = null;

if (array_key_exists($page, $routes)) {
    if (in_array($role, $routes[$page], true)) {
        if ($page === 'dashboard') {
            include __DIR__ . '/../src/handlers/dashboard_data.php';
            $template = 'views/dashboard.php';
        } else {
            $filename = ($page === 'service_request') ? 'service_req' : $page;
            $template = "views/{$filename}.php";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>I-SeRVE | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
    <meta name="color-scheme" content="light dark"/>
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)"/>
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)"/>
    <meta name="csrf-token" content="<?php echo  htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
    <link
            rel="stylesheet"
            href="/css/index.css"
            media="print"
            onload="this.media='all'"/>
    <link
            rel="stylesheet"
            href="/css/overlayscrollbars.min.css"
            crossorigin="anonymous"/>
    <link
            rel="stylesheet"
            href="/css/bootstrap-icons.min.css"
            crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/adminlte.css"/>
    <link rel="stylesheet" href="/css/apexcharts.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

<div class="app-wrapper">
    <?php
    include __DIR__ . '/../src/views/header.php';
    include __DIR__ . '/../src/views/sidebar.php';

    if ($template) {
        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $template;
        if (file_exists($file)) {
            include $file;
            include __DIR__ . '/../src/views/footer.php';
        } else {
            echo '<div class="app-main"><div class="app-content"><div class="container-fluid p-4"><div class="alert alert-danger">Page not found.</div></div></div></div>';
        }
    } else {
        echo '<div class="app-main"><div class="app-content"><div class="container-fluid p-4"><div class="alert alert-warning">Access denied or page not found.</div></div></div></div>';
    }
    ?>
</div>

<script src="/js/apexcharts.min.js"></script>
<script src="/js/overlayscrollbars.browser.es6.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/adminlte.js"></script>
<script src="/js/cropper.min.js"></script>
<script>
    // CSRF token for all fetch requests
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
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
<?php
include __DIR__ . '/../src/views/scripts.php';
?>
</body>
</html>
