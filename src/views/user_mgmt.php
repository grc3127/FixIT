<?php
include '../src/handlers/user_mgmt_data.php';

?>

<!-- <main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User Management</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-header">
                    Administration 
                </div>
                <div class="card-body p-3 h-100">
                    <div class="card shadow-none">
                         <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center" 
                                    role="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="">
                                <img src="" class="rounded-circle border me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            </div>
                            <div class="col">
                                <strong>Name</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header">
                    TECHNICAL 
                </div>
                <div class="card-body p-3 h-100">
                    <div class="card shadow-none">
                         <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center" 
                                    role="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="">
                                <img src="" class="rounded-circle border me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            </div>
                            <div class="col">
                                <strong>Name</strong>
                            </div>
                            <div class="" style="">
                                <i class="bi bi-pencil-square text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header">
                    EMPLOYEE 
                </div>
                <div class="card-body p-3 h-100">
                    <div class="card shadow-none">
                         <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center" 
                                    role="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="">
                                <img src="" class="rounded-circle border me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            </div>
                            <div class="col">
                                <strong>Name</strong>
                            </div>
                            <div class="" style="">
                                <i class="bi bi-pencil-square text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> -->

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">User Management</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-person-plus-fill"></i> Add New User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <?php
            // Configuration for the three roles found in your employee table
            $roleConfigs = [
                1 => ['title' => 'ADMINISTRATION', 'show_edit' => false, 'id' => 'adminCollapse'],
                2 => ['title' => 'TECHNICAL', 'show_edit' => true, 'id' => 'techCollapse'],
                3 => ['title' => 'EMPLOYEE', 'show_edit' => true, 'id' => 'empCollapse']
            ];

            foreach ($roleConfigs as $roleId => $config): ?>
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-white py-3" 
                         role="button" 
                         data-bs-toggle="collapse" 
                         data-bs-target="#<?php echo $config['id']; ?>" 
                         aria-expanded="true"
                         style="cursor: pointer;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold text-secondary text-uppercase">
                                <?php echo $config['title']; ?>
                            </h6>
                            <span class="badge bg-secondary rounded-pill">
                                <?php echo count($groupedUsers[$roleId]); ?> Users
                            </span>
                        </div>
                    </div>

                    <div id="<?php echo $config['id']; ?>" class="collapse show">
                        <div class="card-body p-3">
                            <?php if (!empty($groupedUsers[$roleId])): ?>
                                <?php foreach ($groupedUsers[$roleId] as $user): 
                                    // Fallback for empty profile_pic strings
                                    $img = !empty($user['profile_pic']) ? $user['profile_pic'] : '../public/img/profile_pic/default.png';
                                ?>
                                    <div class="card shadow-none border mb-2">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="<?php echo htmlspecialchars($img); ?>" 
                                                     class="rounded-circle border me-3" 
                                                     style="width: 50px; height: 50px; object-fit: cover;"
                                                     alt="Profile">
                                            </div>
                                            <div class="col">
                                                    <strong class="d-block text-dark">
                                                        <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>
                                                    </strong>
                                                    <small class="text-muted"><?php echo htmlspecialchars($user['email']); ?></small>
                                                </div>
                                            <?php if ($config['show_edit']): ?>
                                                <div>
                                                    <button class="btn btn-link p-0 text-success" title="Edit User">
                                                        <i class="bi bi-pencil-square fs-5"></i>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-3 text-muted">
                                    <small>No users found for this role.</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>