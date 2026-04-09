<?php
// Ensure the session is started (usually done in index.php, but safe to check)
$role_id = $_SESSION['role_id'] ?? 0; 

// If index.php defines it as $role, sync it here:
if (!isset($role_id) && isset($role)) {
    $role_id = $role;
}

// 1. Identify the current page for the "active" class
$current_page = $_GET['page'] ?? 'dashboard';
// 1. Define the Menu Items and their corresponding keys in $routes
$menu_items = [
    [
        'label' => 'Main Dashboard',
        'page'  => 'dashboard',
        'icon'  => 'bi-speedometer'
    ],
    [
        'label' => 'Job Requests',
        'page'  => 'job_requests',
        'icon'  => 'bi-tools'
    ],
    [
        'label' => 'Inventory Requests',
        'page'  => 'inventory_requests',
        'icon'  => 'bi-cart'
    ],
    [
        'label' => 'Inventory Management',
        'page'  => 'inventory_mgmt',
        'icon'  => 'bi-box'
    ],
    [
        'label' => 'User Management',
        'page'  => 'user_mgmt',
        'icon'  => 'bi-people'
    ],
    [
        'label' => 'Service Request',
        'page'  => 'service_request',
        'icon'  => 'bi-clipboard-check'
    ],
];
?>

<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="./index.php" class="brand-link">
            <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">I-SeRVE</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation">
                
                <?php foreach ($menu_items as $item): ?>
                    <?php 
                        $page_key = $item['page'];
                        if (isset($routes[$page_key]) && in_array($role_id, $routes[$page_key])): 
                            $isActive = ($current_page == $page_key) ? 'active' : '';
                    ?>
                        <li class="nav-item">
                            <a href="index.php?page=<?= $page_key ?>" class="nav-link <?= $isActive ?>">
                                <i class="nav-icon bi <?= $item['icon'] ?>"></i>
                                <p><?= $item['label'] ?></p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>

                
            </ul>
        </nav>
    </div>
</aside>