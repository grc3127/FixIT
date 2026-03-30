<?php

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
          <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
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
              src="./assets/img/user2-160x160.jpg"
              class="user-image rounded-circle shadow"
              alt="User Image"
            />
            <span class="d-none d-md-inline">
            <?= htmlspecialchars(
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
                src="./assets/img/user2-160x160.jpg"
                class="rounded-circle shadow"
                alt="User Image"
              />
              <p>
                <?= htmlspecialchars(
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
              <a href="#" class="btn btn-default btn-flat">Profile</a>
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