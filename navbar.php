<?php if(isset($user_id)) {?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="images/logo.png" alt="Bootstrap" width="120" height="50" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="accommodations.php">Accommodations</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="appointments.php">Appointments</a>
                    </li>
                </ul>
                <form class="d-flex signOutbtn" role="search">
                        <a class="btn btn-outline-secondary me-2" href="apply.php" type="button">
                        Apply My Property
                        </a>
                        <a class="btn btn-outline-secondary me-2" href="logout.php" type="button">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </nav>
<?php } else { ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="images/logo.png" alt="Bootstrap" width="120" height="50" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="accommodations.php">Accommodations</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="about.php">About Us</a>
                </li>
            </ul>
            <form class="d-flex signOutbtn" role="search">
                    <a class="btn btn-outline-secondary me-2" href="apply.php" type="button">
                    Apply My Property
                    </a>
                    <a class="btn btn-outline-secondary me-2" href="login.php" type="button">
                        Log In
                    </a>
                </form>
        </div>
    </div>
</nav>
<?php } ?>