<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'myappp');

// Include config file


// Define variables and initialize with empty values
$CNE = $Nom = $prenom = $filiere = $absence = "";
$CNE_err = $nom_err = $prenom_err =  $filiere_err = $absence_err = "";

// Processing form data when form is submitted
if (isset($_POST["insererdatabase"])) {
    $input_CNE = trim($_POST["CNE"]);
    if (empty($input_CNE)) {
        $CNE_err = "Veuillez saisir un CNE.";
    } elseif (!ctype_digit($input_CNE)) {
        $CNE_err = "Le CNE doit être un entier.";
    } else {
        $CNE = $input_CNE;
    }
    // Validate nom
    $input_nom = trim($_POST["Nom"]);
    if (empty($input_nom)) {
        $nom_err = "Veuillez saisir un nom.";
    } elseif (!ctype_alpha($input_nom)) {
        $nom_err = "Le nom ne doit contenir que des lettres.";
    } else {
        $Nom = $input_nom;
    }

    // Validate prénom
    $input_prenom = trim($_POST["prenom"]);
    if (empty($input_prenom)) {
        $prenom_err = "Veuillez saisir un prénom.";
    } elseif (!ctype_alpha($input_prenom)) {
        $prenom_err = "Le prénom ne doit contenir que des lettres.";
    } else {
        $prenom = $input_prenom;
    }

    $input_filiere = trim($_POST["filiere"]);
    if (empty($input_filiere)) {
        $filiere_err = "Veuillez saisir un filier.";
    } elseif (!ctype_alpha($input_filiere)) {
        $filiere_err = "Le filier ne doit contenir que des lettres.";
    } else {
        $filiere = $input_filiere;
    }

    // Validate nombre
    $input_absence = trim($_POST["absence"]);
    if (empty($input_absence)) {
        $absence_err = "Veuillez saisir un nombre.";
    } elseif (!ctype_digit($input_absence)) {
        $absence_err = "Le nombre doit être un entier.";
    } else {
        $absence = $input_absence;
    }

    // Check input errors before inserting in database
    if (empty($CNE_err) && empty($nom_err) && empty($prenom_err) && empty($filiere_err) && empty($absence_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO etudients (CNE,Nom, Prenom,filiere ,absence ) VALUES (?, ?, ?, ?,?)";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_CNE, $param_name, $param_prenom, $param_filiere, $param_absence);

            // Set parameters
            $param_CNE = $CNE;
            $param_name = $Nom;
            $param_prenom = $prenom;
            $param_filiere = $filiere;
            $param_absence = $absence;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page

                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>gestion absence</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style>
        img {
            height: 25px;

        }
    </style>

    <!--google fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">



    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">



                <img src="img/users.png" />
                <div class="sidebar-brand-text mx-3">pfe GA </div>

            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashborde </span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="tables.php">
                    <i class="material-icons">home</i><span> Consulter absenc</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="ajouter.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="material-icons">apps</i><span>Consulter Filier</span></a>
                </a>


            </li>

            <!-- Nav Item - Utilities Collapse Menu -->

            <li class="nav-item active">
                <a class="nav-link" data-toggle="modal" data-target="#imprim" href="#" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="material-icons">equalizer</i><span> Fiche absence</span></a>
                </a>

            </li>
            <li class="nav-item active">
                <a class="nav-link" data-toggle="modal" data-target="#helostud" href="#" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="material-icons">equalizer</i><span>Inportais liste des Etudient</span></a>
                </a>

            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">

            </div>

            <!-- Nav Item - Pages Collapse Menu --
            >
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="material-icons">extension</i> <span>Gerer les utilisateure</span></a>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.php">Login</a>
                        <a class="collapse-item" href="register.php">Register</a>
                        <a class="collapse-item" href="forgot-password.php">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.php">404 Page</a>
                        <a class="collapse-item" href="blank.php">Blank Page</a>
                    </div>
                </div>
            </li>

             Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Notification</span></a>
            </li>
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">

            </div>

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Gerer message des etudients </span></a>
            </li>

            <!-- Nav Item - Tables -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <form action="recherche.php" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" name="search" required value="<?php if (isset($_GET['search'])) {
                                                                                    echo $_GET['search'];
                                                                                } ?>" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->


                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                            <!-- Dropdown - Messages -->


                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>







                        <!-- importais liste -->


                        <div class="modal fade" id="helostud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">importais liste </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="connexion.php" method="POST">

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label> Annee Universitaire </label>
                                                <input type="text" name="CNE" class="form-control" placeholder="Entrez Annee Universitaire">
                                            </div>

                                            <div class="form-group">
                                                <label> Filier</label>
                                                <input type="text" name="Nom" class="form-control" placeholder="Enter Le Nom de Filier">
                                            </div>
                                            <div>
                                                <form enctype="multipart/form-data" action="import_csv.php" method="post">
                                                    <label>Choisir un fichier CSV :</label>
                                                    <input type="file" name="file" accept=".csv">

                                                </form>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="insertdata" class="btn btn-primary">Importer</button>
                                        </div>
                                    </form>
                                </div>
                                </form>

                            </div>
                        </div>

                        <!-- imprimer - liste pdf -->


                        <div class="modal fade" id="imprim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">imprimer liste des etudient</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form method="post" action="imprim.php">

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="age">Chioisi filier :</label>
                                                <input type="text" id="filiere" name="filiere" class="form-control" placeholder="choisi Filiere ">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" value="Générer le PDF" name="insertdata" class="btn btn-primary">imprimer</button>
                                        </div>
                                    </form>
                                </div>
                                </form>

                            </div>
                        </div>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">+1</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notification
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">ecember 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->

                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter"></span>
                        </a>
                        <!-- Dropdown - Messages -->


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>


                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="http://localhost/hello/examples/login.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <!-- DataTales Example -->
                    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Student Data </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="" method="POST">

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label> CNE </label>
                                            <input type="text" name="CNE" class="form-control" value="">
                                            <span class="invalid-feedback"></span>
                                        </div>

                                        <div class="form-group">
                                            <label> Nom </label>
                                            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                                if (empty($_POST["Nom"])) {
                                                    echo '<span class="erure">le nom et vide !! </span>';
                                                }
                                            } ?>
                                            <input type="text" name="Nom" class="form-control ">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label> Prenom </label>
                                            <input name="prenom" class="form-control "></input>
                                            <span class="invalid-feedback"></span>
                                        </div>


                                        <div class="form-group">
                                            <label> Filier </label>
                                            <input type="text" name="filiere" class="form-control" value="">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label> Absence </label>
                                            <input type="text" name="absence" class="form-control " value="">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="insererdatabase" class="btn btn-primary" value="Submit">
                                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>


                    <!-- EDIT POP UP FORM (Bootstrap MODAL) -- <button type="button" class="btn btn-success editbtn"> EDIT </button>-->
                    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="updatecode.php" method="POST">

                                    <div class="modal-body">

                                        <input type="hidden" name="update_id" id="update_id">

                                        <div class="form-group">
                                            <label> CNE </label>
                                            <input type="text" name="CNE" id="CNE" class="form-control" placeholder="Enter CNE">
                                        </div>

                                        <div class="form-group">
                                            <label> Nom </label>
                                            <input type="text" name="Nom" id="Nom" class="form-control" placeholder="Enter NOM">
                                        </div>

                                        <div class="form-group">
                                            <label> Prenom </label>
                                            <input type="text" name="Prenom" id="Prenom" class="form-control" placeholder="Enter Prenom">
                                        </div>

                                        <div class="form-group">
                                            <label> FILIERE </label>
                                            <input type="text" name="filiere" id="filiere" class="form-control" placeholder="Enter Filire">
                                        </div>
                                        <div class="form-group">
                                            <label> Absence </label>
                                            <input type="text" name="absence" id="absence" class="form-control" placeholder="Enter absence ">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
                    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="deletecode.php" method="POST">

                                    <div class="modal-body">

                                        <input type="hidden" name="delete_id" id="delete_id">

                                        <h4> Do you want to Delete this Data ??</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- vueux-->

                    <!-- VIEW POP UP FORM (Bootstrap MODAL) -->
                    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> View Student Data </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="deletecode.php" method="POST">

                                    <div class="modal-body">

                                        <input type="text" name="view_id" id="view_id">

                                        <!-- <p id="fname"> </p> -->
                                        <h4 id="Nom"> <?php echo ''; ?> </h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> CLOSE </button>
                                        <!-- <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button> -->
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
                    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="deletecode.php" method="POST">

                                    <div class="modal-body">

                                        <input type="hidden" name="delete_id" id="delete_id">

                                        <h4> Do you want to Delete this Data ??</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">

                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Consulter absence</h6>
                            <span type="button" class="badge badge-success" data-toggle="modal" data-target="#studentaddmodal">
                                +add data
                            </span>
                        </div>




                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                    $connection = mysqli_connect("localhost", "root", "");
                                    $db = mysqli_select_db($connection, 'myappp');

                                    $query = "SELECT * FROM etudients";
                                    $query_run = mysqli_query($connection, $query);
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>CNE</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Filier </th>
                                            <th>absence </th>

                                            <th>action </th>
                                        </tr>
                                        <?php
                                        if ($query_run) {
                                            foreach ($query_run as $row) {
                                        ?>
                                    <tbody>
                                        <tr>
                                            <td> <?php echo $row['id']; ?> </td>
                                            <td> <?php echo $row['CNE']; ?> </td>
                                            <td> <?php echo $row['Nom']; ?> </td>
                                            <td> <?php echo $row['Prenom']; ?> </td>
                                            <td> <?php echo $row['filiere']; ?> </td>
                                            <td> <?php echo $row['absence']; ?> </td>

                                            <td>
                                                <button type="button" class="btn btn-info viewbtn"> VIEW </button>

                                                <button type="button" class="btn btn-success editbtn"> EDIT </button>

                                                <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                            </td>
                                        </tr>
                                    </tbody>
                            <?php
                                            }
                                        } else {
                                            echo "No Record Found";
                                        }
                            ?>
                            </thead>
                            <tfoot>


                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>














                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!--<script src="js/sb-admin-2.min.js"></script>-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function() {

            $('.viewbtn').on('click', function() {
                $('#viewmodal').modal('show');
                $.ajax({ //create an ajax request to display.php
                    type: "GET",
                    url: "display.php",
                    dataType: "html", //expect html to be returned                
                    success: function(response) {
                        $("#responsecontainer").html(response);
                        //alert(response);
                    }
                });
            });

        });
    </script>


    <script>
        $(document).ready(function() {

            $('#datatableid').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Your Data",
                }
            });

        });
    </script>

    <script>
        $(document).ready(function() {

            $('.deletebtn').on('click', function() {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.editbtn').on('click', function() {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#CNE').val(data[1]);
                $('#Nom').val(data[2]);
                $('#Prenom').val(data[3]);
                $('#filiere').val(data[4]);
                $('#absence').val(data[5]);
            });
        });
    </script>


</body>

</html>