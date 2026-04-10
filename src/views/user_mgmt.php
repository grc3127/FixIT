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
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
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
                                    $img = !empty($user['profile_pic']) ? $user['profile_pic'] : '/img/profile_pic/default.png';
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
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-link p-0 text-success edit-user-btn" 
                                                            title="Edit User"
                                                            data-user='<?php echo json_encode($user); ?>'
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editUserModal">
                                                        <i class="bi bi-pencil-square fs-5"></i>
                                                    </button>
                                                    <button class="btn btn-link p-0 text-danger delete-user-btn" 
                                                            title="Delete User"
                                                            data-id="<?php echo $user['employee_id']; ?>"
                                                            data-name="<?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>">
                                                        <i class="bi bi-trash fs-5"></i>
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addUserForm">
                <?php echo  Security::csrfField() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" name="mobile_num" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Department</label>
                            <select name="dept_id" class="form-select" required>
                                <option value="">Select Dept</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?php echo $dept['dept_id']; ?>"><?php echo htmlspecialchars($dept['dept_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Role</label>
                            <select name="role_id" class="form-select" required>
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $id => $name): ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" id="addUserPhoto" class="form-control" accept="image/*">
                        <div class="mt-2 text-center" style="display:none;" id="addUserCropContainer">
                            <img id="addUserCropPreview" style="max-width: 100%;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editUserForm">
                <?php echo  Security::csrfField() ?>
                <input type="hidden" name="employee_id" id="edit_employee_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" id="edit_first_name" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="edit_middle_name" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="edit_last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" name="mobile_num" id="edit_mobile_num" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" id="edit_address" class="form-control">
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Department</label>
                            <select name="dept_id" id="edit_dept_id" class="form-select" required>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?php echo $dept['dept_id']; ?>"><?php echo htmlspecialchars($dept['dept_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Role</label>
                            <select name="role_id" id="edit_role_id" class="form-select" required>
                                <?php foreach ($roles as $id => $name): ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Picture (optional)</label>
                        <input type="file" id="editUserPhoto" class="form-control" accept="image/*">
                        <div class="mt-2 text-center" style="display:none;" id="editUserCropContainer">
                            <img id="editUserCropPreview" style="max-width: 100%;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status_id" id="edit_status_id" class="form-select" required>
                            <?php foreach ($statuses as $status): ?>
                                <option value="<?php echo $status['status_id']; ?>"><?php echo htmlspecialchars($status['status_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password (leave blank to keep current)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let addUserCropper = null;
    let editUserCropper = null;

    function initCropper(inputId, containerId, previewId) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(containerId);
        const preview = document.getElementById(previewId);
        let cropper = null;

        input.addEventListener('change', function(e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(preview, {
                        aspectRatio: 1,
                        viewMode: 1,
                        autoCropArea: 1,
                    });
                    if (inputId === 'addUserPhoto') addUserCropper = cropper;
                    else editUserCropper = cropper;
                };
                reader.readAsDataURL(files[0]);
            }
        });
    }

    initCropper('addUserPhoto', 'addUserCropContainer', 'addUserCropPreview');
    initCropper('editUserPhoto', 'editUserCropContainer', 'editUserCropPreview');

    // Add User
    document.getElementById('addUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        if (addUserCropper) {
            addUserCropper.getCroppedCanvas({
                width: 300,
                height: 300
            }).toBlob((blob) => {
                formData.append('profile_pic', blob, 'profile.jpg');
                submitAddUser(formData);
            }, 'image/jpeg', 0.8);
        } else {
            submitAddUser(formData);
        }
    });

    function submitAddUser(formData) {
        fetch('data/create_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        });
    }

    // Populate Edit Modal
    document.querySelectorAll('.edit-user-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const user = JSON.parse(this.dataset.user);
            document.getElementById('edit_employee_id').value = user.employee_id;
            document.getElementById('edit_first_name').value = user.first_name;
            document.getElementById('edit_middle_name').value = user.middle_name || '';
            document.getElementById('edit_last_name').value = user.last_name;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('edit_mobile_num').value = user.mobile_num || '';
            document.getElementById('edit_address').value = user.address || '';
            document.getElementById('edit_dept_id').value = user.dept_id;
            document.getElementById('edit_role_id').value = user.role_id;
            document.getElementById('edit_status_id').value = user.status_id;
        });
    });

    // Update User
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        if (editUserCropper) {
            editUserCropper.getCroppedCanvas({
                width: 300,
                height: 300
            }).toBlob((blob) => {
                formData.append('profile_pic', blob, 'profile.jpg');
                submitUpdateUser(formData);
            }, 'image/jpeg', 0.8);
        } else {
            submitUpdateUser(formData);
        }
    });

    function submitUpdateUser(formData) {
        fetch('data/update_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        });
    }

    // Delete User
    document.querySelectorAll('.delete-user-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            if (confirm(`Are you sure you want to delete user ${name}?`)) {
                const formData = new FormData();
                formData.append('employee_id', id);
                formData.append('csrf_token', CSRF_TOKEN);
                fetch('data/delete_user.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        });
    });
});
</script>