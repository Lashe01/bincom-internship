<?php
    include_once 'assets/database/db.php';
?>
<!-- Handles submission -->
<?php
include_once 'assets/database/db.php';

if(isset($_POST['submit'])){
for($i=0;$i<count($_POST['counter']);$i++){
    $polling_unit = $_POST['polling'][$i];
    $party = $_POST['party'][$i];
    $score = $_POST['score'][$i];
    $agent = $_POST['agent'][$i];
    if($polling_unit!=='' && $party!=='' && $score!=='' && $agent!==''){
        $insert= mysqli_query($con, "INSERT INTO announced_pu_results VALUES (NULL, '$polling_unit', '$party', '$score', '$agent', NOW(), '192.168.1.101')") or die ("Error inserting into db");
        
    } else{
        echo "<script type='text/javascript'>";
        echo "alert('Oops, submission failed!')";
        echo "</script>";
    }
}
    echo "<script type='text/javascript'>";
    echo "alert('Great, submitted successfully')";
    echo "</script>";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Toluwani Abimbola">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Create Records · Bincom Test</title>

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
        .counter{
            width: 35px;
            padding: px;
            border: none;
            background: none;
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
                            <a class="nav-link" href="summed_results.php">
                                <span data-feather="shopping-cart"></span> LGA RESULTS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <span data-feather="shopping-cart"></span> ADD RECORD</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h3">Add Records</h1>
                </div>
                <?php
                            $counter= 1;

                            ?>

                <div>
                    <form class="" action="" method="POST">
                    <table class="table table-responsive table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Polling Unit</th>
                                <th>Party Name</th>
                                <th>Score</th>
                                <th>Agent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="next">

                           

                                <tr>
                                    <td class="text-center"><input class="counter" name="counter[]" id="counter" type="number" value="1" readonly=""></td>
                                    <td>
                                        <select required class="col-sm-6 form-select" name="polling[]" id="pu">
                                            <option value="">Select Polling Unit</option>
                                            <?php
                                            $call_pu= mysqli_query($con, "SELECT * FROM polling_unit") or die ("Error fetching polling unit from db");
                                            while ($row = mysqli_fetch_array($call_pu)) {
                                                $pu= $row['polling_unit_name'];
                                                $pu_id= $row['uniqueid'];
                                                ?>
                                                <option value="<?php echo $pu_id; ?>"><?php echo $pu; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select required class="col-sm-6 form-select" name="party[]" id="party">
                                            <option value="">Select Party</option>
                                            <?php
                                            $call_party= mysqli_query($con, "SELECT * FROM party") or die ("Error fetching party from db");
                                            while ($row = mysqli_fetch_array($call_party)) {
                                                $party= $row['partyname'];
                                                $party_id= $row['id'];
                                                ?>
                                                <option value="<?php echo $party; ?>"><?php echo $party; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input required type="text" name="score[]" class="form-control"></td>
                                    <td><input type="text" name="agent[]" class="form-control"></td>
                                    <td><button class="btn btn-primary btn-sm" name="addrow" id="addrow">Add</button></td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm" type="submit" name="submit">Save record</button>
                    </form>
                </div>
                
            </main>
        </div>
    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/jquery.js"></script>

    <script>
    $('#addrow').click(function(){
        var length = $('.counter').length;
        var i   = parseInt(length)+parseInt(1);
        var newrow = $('#next').append('<tr><td class="text-center"><input class="counter" name="counter[]" id="counter" type="number" value="'+i+'" readonly=""></td><td> <select required class="col-sm-6 form-select" name="polling[]" id="pu"><option value="">Select Polling Unit</option><?php $call_pu= mysqli_query($con, "SELECT * FROM polling_unit") or die ("Error fetching polling unit from db"); while ($row = mysqli_fetch_array($call_pu)) { $pu= $row['polling_unit_name']; $pu_id= $row['uniqueid'];?><option value="<?php echo $pu_id; ?>"><?php echo $pu; ?></option><?php }  ?>  </select> </td>  <td> <select required class="col-sm-6 form-select" name="party[]" id="party"> <option value="">Select Party</option> <?php $call_party= mysqli_query($con, "SELECT * FROM party") or die ("Error fetching party from db");  while ($row = mysqli_fetch_array($call_party)) {  $party= $row['partyname']; $party_id= $row['id']; ?> <option value="<?php echo $party; ?>"><?php echo $party; ?></option><?php } ?> </select> </td> <td><input required type="text" name="score[]" class="form-control"></td> <td><input type="text" name="agent[]" class="form-control"></td> <td><button class="btn btnRemove btn-danger">Remove</button></td> </tr>');
        
        });
    
    // Removing event here
    $('body').on('click','.btnRemove',function() {
        $(this).closest('tr').remove()

    });
            
    </script>

</body>

</html>