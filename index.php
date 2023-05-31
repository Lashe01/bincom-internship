<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Toluwani Abimbola">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard · Nincom Internship</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Bincom Internship</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
        
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <span data-feather="home"></span> DASHBOARD
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="results.php">
                                <span data-feather="file"></span> GENERAL RESULTS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="summed_results.php">
                                <span data-feather="shopping-cart"></span> LGA RESULTS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create.php">
                                <span data-feather="shopping-cart"></span> ADD RECORD</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>                   
                    
                </div>
                <div class="alert bg-primary">
                    <div class="card-body">
                        <h4 class="card-title fw-bold">Question 1:</h4><hr>
                        <p class="card-text">Create a page to display the result for any individual polling unit.</p>
                    <a href="results.php" class="text-light fw-bold">View solution</a>
                    </div>
                </div>
                <div class="alert text-light bg-dark">
                    <div class="card-body">
                        <h4 class="card-title fw-bold">Question 2:</h4><hr>
                        <p class="card-text">Create a page to display the summed total result of all the polling units under a particular local government.</p>
                        <a href="summed_results.php" class="text-light fw-bold">View solution</a>

                    </div>
                </div>
                <div class="alert bg-primary">
                    <div class="card-body">
                        <h4 class="card-title fw-bold">Question 3:</h4><hr>
                        <p class="card-text">Create a page to store results for all parties for a new polling unit.</p>
                        <a href="create.php" class="text-light fw-bold">View solution</a>
                        
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>

</html>