<?php
$user = $_SESSION['user_data'] ?? null;
$roleId = $_SESSION['role_id'] ?? null;

// Optional safety
if (!$roleId) {
    header('Location: login.php');
    exit;
}


?>

<!--begin::Header-->
  <nav class="app-header navbar sticky-top navbar-expand bg-body ">
    <!--begin::Container-->
    <div class="container-fluid ">
      <!--begin::Start Navbar Links-->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-lte-toggle="sidebar" role="button">
            <i class="bi bi-list"></i>
          </a>
        </li>
        <li class="nav-item d-none d-md-block"><a href="index.php" class="nav-link">Home</a></li>
        <!-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li> -->
      </ul>
      <!--end::Start Navbar Links-->
      <!--begin::End Navbar Links-->
      <ul class="navbar-nav ms-auto">

        <!--begin::Navbar Search-->
        <li class="nav-item">
          <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="bi bi-search"></i>
          </a> -->

        </li>
        <!--end::Navbar Search-->

        <!--begin::Messages Dropdown Menu-->
          <!-- see backup.txt -->
          
        
          <!--end::Messages Dropdown Menu-->

        <!--begin::Notifications Dropdown Menu-->
          <!-- see backup.txt -->
          
        <!--end::Notifications Dropdown Menu-->


        <!--begin::User Menu Dropdown-->
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <!-- MAKE DYNAMIC LATER -->
            <img
              
              src="<?php 
              echo  htmlspecialchars($_SESSION['profile_pic']) ?>"
              class="user-image rounded-circle shadow"
              alt="User Image"
            />
            <span class="d-none d-md-inline">
            <?php echo  htmlspecialchars(
              $_SESSION['first_name'] . ' ' .
              (!empty($_SESSION['middle_name']) ? $_SESSION['middle_name'][0] . '. ' : '') .
              $_SESSION['last_name']
            )
            ?>

            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <!--begin::User Image-->
            <li class="user-header text-bg-primary">
              <img
                src="<?php echo  htmlspecialchars($_SESSION['profile_pic']) ?>"
                class="rounded-circle shadow"
                alt="User Image"
              />
              <p>
                <?php echo  htmlspecialchars(
                  $_SESSION['first_name'] . ' ' .
                  (!empty($_SESSION['middle_name']) ? $_SESSION['middle_name'][0] . '. ' : '') .
                  $_SESSION['last_name']
                )
                ?>
              </p>
            </li>
            <!--end::User Image-->
            <!--begin::Menu Body-->
            <!--end::Menu Body-->
            <!--begin::Menu Footer-->
            <li class="user-footer">
              <button type="button"
                  class="btn btn-default btn-flat update-profile-btn" 
                  data-bs-toggle="modal" 
                  data-bs-target="#editProfileModal"
                  data-user='<?php echo json_encode($user); ?>'>
                Profile
              </button>
              <a href="logout.php" class="btn btn-default btn-flat float-end">Sign out</a>
            </li>
            <!--end::Menu Footer-->
          </ul>
        </li>
        <!--end::User Menu Dropdown-->
        
      </ul>
      <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->

  </nav>
<!--end::Header-->

<div class="modal" id="editProfileModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editProfileForm">
                <?php echo Security::csrfField() ?>
                <input type="hidden" name="employee_id" id="edit_employee_id">
                
                <div class="modal-header">
                    <h5 class="modal-title">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" id="update_first_name" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="update_middle_name" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Last Name</label>
                          <input type="text" name="last_name" id="update_last_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <input type="email" name="email" id="update_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Mobile Number</label>
                          <input type="text" name="mobile_num" id="update_mobile_num" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Address</label>
                          <input type="text" name="address" id="update_address" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" id="updateUserPhoto" class="form-control" accept="image/*">
                        <div class="mt-2 text-center" style="display:none;" id="UpdateUserCropContainer">
                            <img id="UpdateUserCropPreview" style="max-width: 100%;">
                        </div>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let editUserCropper = null;

    function initCropper(inputId, containerId, previewId) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(containerId);
        const preview = document.getElementById(previewId);

        if (!input) return; // Guard clause if element doesn't exist

        input.addEventListener('change', function(e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                    
                    if (editUserCropper) {
                        editUserCropper.destroy();
                    }
                    
                    editUserCropper = new Cropper(preview, {
                        aspectRatio: 1,
                        viewMode: 1,
                        autoCropArea: 1,
                    });
                };
                reader.readAsDataURL(files[0]);
            }
        });
    }

    // Match these IDs exactly to your HTML
    initCropper('updateUserPhoto', 'UpdateUserCropContainer', 'UpdateUserCropPreview');

    // Populate Edit Modal
    document.querySelectorAll('.update-profile-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const user = JSON.parse(this.dataset.user);
            // Ensure these IDs exist in your HTML
            document.getElementById('update_first_name').value = user.first_name;
            document.getElementById('update_middle_name').value = user.middle_name || '';
            document.getElementById('update_last_name').value = user.last_name;
            document.getElementById('update_email').value = user.email;
            document.getElementById('update_mobile_num').value = user.mobile_num || '';
            document.getElementById('update_address').value = user.address || '';
        });
    });

    // Update User - Corrected ID to editProfileForm
    const profileForm = document.getElementById('editProfileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
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
    }

    function submitUpdateUser(formData) {
        fetch('data/update_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message || "An error occurred");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Failed to update profile.");
        });
    }
});
</script>