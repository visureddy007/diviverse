<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= APPLICATION_NAME ?></title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="<?= base_url('assets') ?>/images/favicon.ico">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">

    <link href="<?= base_url('assets') ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets') ?>/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets') ?>/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets') ?>/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets') ?>/plugins/sweet-alert2/sweetalert2.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="<?= base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url('assets') ?>/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="<?= base_url() ?>" class="logo">
                    <span class="logo-light">
                        <img src="<?= base_url('assets/images/avanti_symbol.svg') ?>" width="32" title="<?= APPLICATION_NAME ?>">
                        <?= APPLICATION_NAME ?>
                    </span>
                    <span class="logo-sm">
                        <img src="<?= base_url('assets/images/avanti_symbol.svg') ?>" width="28" title="<?= APPLICATION_NAME ?>">
                    </span>
                </a>
            </div>

            <nav class="navbar-custom">
                <ul class="navbar-right list-inline float-right mb-0">

                   
                    <!-- full screen -->
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                        </a>
                    </li>

                  

                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= base_url('assets') ?>/images/users/user.png" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                               <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
                            </div>
                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                    
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->

        <?php $this->load->view('include/side_menu'); ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">