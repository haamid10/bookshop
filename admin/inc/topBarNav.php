<link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


<!-- Navbar -->
     
         
        </ul>
        <!-- Right navbar links -->
 <nav class="header-nav ml-auto">
  <ul class="d-flex align-items-center">
  <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url ?>" class="nav-link"><?php echo (!isMobileDevice()) ? $_settings->info('name'):$_settings->info('short_name'); ?> - Admin</a>
          </li>
<li class="nav-item dropdown pe-3">
<button class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
  <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" alt="user image" class="rounded-circle"></span>
 
  <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo ucwords($_settings->userdata('firstname').' '.$_settings->userdata('lastname')) ?></span>
  <span class="sr-only">Toggle Dropdown</span>
</button>

<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
  

  <li>
    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url.'admin/?page=user' ?>">
      <i class="bi bi-person"></i>
      <span>My Account</span>
    </a>
  </li>
  <li>
    <hr class="dropdown-divider">
  </li>



  <li>
 
    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url.'/classes/Login.php?f=logout' ?>">
      <i class="bi bi-box-arrow-right"></i>
      <span>Sign Out</span>
    </a>
  </li>

</ul>

      
      
      </nav>
      <!-- /.navbar -->