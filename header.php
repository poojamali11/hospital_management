<header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-sm text-right">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +91 8548830989</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> sneha123@gmail.com</a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="index.php"><span class="text-primary">Hospital </span>Management</a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="aboutus.php">About Us</a>
            </li>
            <?php if($_SESSION['ruserid']) { ?>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                  Dashboard
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="reception_dashboard.php">Dashboard</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="todays_appointments.php">Todays Appointments</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="appointments.php">Appointments</a>
            </li>
            
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Patients</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="patients.php" class="dropdown-item">Manage Patients</a>
                    <a href="add_patient.php" class="dropdown-item">Add Patient</a>
                </div>
            </li>
            
            <?php } else if($_SESSION['duserid']) { ?>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                  Dashboard
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="doctor_dashboard.php">Dashboard</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="todays_appointments.php">Todays Appointments</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="appointments.php">Appointments</a>
            </li>
            
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Patients</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="patients.php" class="dropdown-item">Manage Patients</a>
                    <a href="add_patient.php" class="dropdown-item">Add Patient</a>
                </div>
            </li>
            
            <?php } else { ?> 
            <li class="nav-item">
              <a class="nav-link" href="reception_login.php">Reception Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctor_login.php">Doctor Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="make_appointment.php">Make Appointment</a>
            </li>
            <?php } ?> 
            
            <li class="nav-item">
              <a class="nav-link" href="contactus.php">Contact</a>
            </li>
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>