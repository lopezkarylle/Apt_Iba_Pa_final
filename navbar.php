<nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img src="resources/images/logo.png" alt="Bootstrap" width="120" height="50" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          
  
          <?php if(isset($user_id)) {?>
        <style><?php include('css/dashboard_logged.css'); ?></style>
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

          <button class="btnNotif me-5 position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-label="Inbox">
            <i class="fa-regular fa-inbox fa-3x"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle pulsate">
              <span class="visually-hidden">New alerts</span>
            </span>
          </button>

          <li class="nav-item dropdown-center me-5">
            <button class="nav-link dropdown-toggle position-relative" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-bell fa-2x"></i>
              <span class="position-absolute top-0 start-100 translate-middle p-2  badge rounded-pill bg-danger">
                5+
                <span class="visually-hidden">unread messages</span>
            </button>
            
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
            <form class="d-flex signOutbtn" role="search" action="apply.php" method="POST">
              <button class="btn me-2" type="submit">
              Apply My Property&nbsp;
              </button>
            </form>
            <form class="d-flex signOutbtn" role="search" action="logout.php" method="POST">
              <button class="btn me-2" type="submit">
              Sign Out &nbsp;<i class="fa-solid fa-right-from-bracket"></i> 
              </button>
            </form>
            <?php } else { ?>
                <style><?php include('css/dashboard.css'); ?></style>
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
          <form class="d-flex signInbtn" role="search" action="apply.php" method="POST">
              <button class="btn me-2" type="submit">
              Apply My Property&nbsp;
              </button>
            </form>
                <form class="d-flex signInbtn" role="search" action="login.php" method="POST">
              <button class="btn me-2" type="submit">
              Sign In &nbsp;<i class="fa-solid fa-right-from-bracket"></i> 
              </button>
            </form>
            <?php } ?>
        </div>
      </div>
    </nav>

    <!-- Off Canvas - Chat -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header canvasTitleHeader">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Messages</h5>
  </div>
  <div class="offcanvas-body">
    <div class="row justify-content-between pt-3">

      <div class="col-2 d-flex justify-content-center">
        <button type="button" class="btn" data-bs-dismiss="offcanvas"><i class="fa-regular fa-arrow-left fa-2x"></i></button>
      </div>
      <div class="col-5 justify-content-center fs-3 d-flex align-items-center">
        Inbox
      </div>
      <div class="col-2 d-flex justify-content-center">
        <button type="button" class="btn"><i class="fa-regular fa-plus fa-2x"></i></button>
      </div>
    </div>

    <br>
    <br>

    <div class="row borderChat pt-3 ps-2">
      <div class="col">
        <h3 class="nameChat">Karylle Lopez</h3>
        <div class="row">
          <p class="messageChat">Sample message</p>
        </div>
      </div>
    </div>

    <div class="row borderChat pt-3 ps-2">
      <div class="col">
        <h3 class="nameChat">David Echon</h3>
        <div class="row">
          <p class="messageChat">Sample message</p>
        </div>
      </div>
    </div>

    <div class="row borderChat pt-3 ps-2">
      <div class="col">
        <h3 class="nameChat">Arnold Lim</h3>
        <div class="row">
          <p class="messageChat">Sample message</p>
        </div>
      </div>
    </div>

  </div>
</div>