<?php
    include_once 'assets/database/db.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Toluwani Abimbola">
    <meta name="generator" content="Hugo 0.84.0">
    <title>LGA Results · Bincom Test</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">

    <style>
        @media (min-width: 576px) {
            .w-sm-50 {
            width: 50% !important;
            }
        }
    </style>
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
                            <a class="nav-link" aria-current="page" href="index.php">
                                <span data-feather="home"></span> DASHBOARD
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="results.php">
                                <span data-feather="file"></span> GENERAL RESULTS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
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
                    <h1 class="h3">Sum Total of Individual Polling Results</h1>
                </div>

                <!-- Initially display the select field -->
                <?php
                if (!isset($_GET['id']) || $_GET['id'] == '') { ?>
                    <!-- Select box for choosing individual local government area -->
                    <label for="lga" class="h6">Select your preferred local government area</label>
                    <select class="form-select w-sm-50" name="lga" id="lga" onchange="selected()">
                        <option value="">Select LGA</option>
                        <?php
                        $call_lga= mysqli_query($con, "SELECT * FROM lga") or die ("Error fetching lga from db");
                        while ($row = mysqli_fetch_array($call_lga)) {
                            $lga= $row['lga_name'];
                            $lga_id= $row['lga_id'];
                            ?>
                            <option value="<?php echo $lga_id; ?>"><?php echo $lga; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                
                    <?php
                } else { ?>
                    <!-- Select box for choosing individual local government area -->
                    <label for="lga" class="h6">Select your preferred local government area</label>
                    <select class="form-select w-sm-50" name="lga" id="lga" onchange="selected()">
                        <option value="">Select LGA</option>
                        <?php
                        $call_lga= mysqli_query($con, "SELECT * FROM lga") or die ("Error fetching lga from db");
                        while ($row = mysqli_fetch_array($call_lga)) {
                            $lga= $row['lga_name'];
                            $lga_id= $row['lga_id'];
                            ?>
                            <option value="<?php echo $lga_id; ?>" 
                            <?php
                                if (@$_GET['id'] == $lga_id) {
                                    echo "selected";
                                } else {
                                    
                                }?>>
                            <?php echo $lga; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br>
                    <!-- // Call the chosen lga to display records -->
                    <div class="table-responsive">
                        <?php
                        $counter= 0;
                        // Fetch data from database
                        $query = mysqli_query($con, "SELECT * FROM announced_pu_results JOIN polling_unit on announced_pu_results.polling_unit_uniqueid=polling_unit.uniqueid WHERE lga_id= $_GET[id]") or die("Unable to query data");
                        // Check if record exist
                        $check_availability= mysqli_num_rows($query);
                        if ($check_availability < 1) {
                            echo "<p class='text-danger'>No record found for the selected local government area.</p>";
                        } else {
                            
                            ?>
                        <table class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Polling Unit</th>
                                    <th scope="col">Party Name</th>
                                    <th scope="col">Score</th>
                                    <!-- <th scope="col">Date</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($query)) {
                                    $pollingUnit= $row['polling_unit_name'];
                                    $party= $row['party_abbreviation'];
                                    $score= $row['party_score'];
                                    $counter ++;
                                ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td class="text-capitalize"><?php echo $pollingUnit; ?></td>
                                        <td><?php echo $party; ?></td>
                                        <td><?php echo $score; ?></td>
                                    </tr> <?php
                                } ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="fw-bolder">Total:</td>
                                    <td class="fw-bolder">
                                        <?php 
                                            $sum_query = mysqli_query($con, "SELECT SUM(party_score) FROM announced_pu_results JOIN polling_unit on announced_pu_results.polling_unit_uniqueid=polling_unit.uniqueid WHERE lga_id= $_GET[id]") or die("Unable to query sum");
                                            while ($row = mysqli_fetch_array($sum_query)) {
                                                $total= $row['SUM(party_score)'];
                                            }
                                            echo $total;
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>   
                    </div>
                    <?php }  
                } ?>
            </main>
        </div>
    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>

    <script>
    function selected(){
        var x= document.getElementById("lga").value;
        if (x == '') {
            location.href= "summed_results.php";            
        } else {
            location.href= "summed_results.php?id=" + x;
        }
    }
</script>
</body>

</html>