<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.0.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>

    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/css/font-awesome.min.css">

    <!-- ckeditor -->
    <script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin.css">
    <!-- Custom CSS and js-->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/form-validation.css">
    <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
</head>

<body>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Agri Arbor</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded" src="<?php echo isset($user) ? site_url('assets/uploads/images/') . '' . $user['unique_name'] : '' ?>" alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong><?php echo isset($user) ? $user['name'] : '' ?></strong>
                        </span>
                        <span class="user-role">Administrator</span>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>
                <!-- sidebar-header  -->
                <div class="sidebar-search">
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control search-menu" placeholder="Search...">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="<?php echo site_url('charts'); ?>">
                                <i class="fa fa-chart-line"></i>
                                <span>Charts</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('resources'); ?>">
                                <i class="fa fa-folder"></i>
                                <span>Resources</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('carousel/list-carousel/0'); ?>">
                                <i class="fa fa-picture-o"></i>
                                <span>Carousel</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('profile'); ?>">
                                <i class="fa fa-user"></i>
                                <span>Profile</span>
                            </a>
                        </li>

                        <li class="header-menu">
                            <span>Documentation</span>
                        </li>
                        <li>
                            <a href="<?php echo site_url('documents'); ?>">
                                <i class="fa fa-book"></i>
                                <span>Do you know</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('documents/list-documents/news'); ?>">
                                <i class="fa fa-book"></i>
                                <span>News</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('documents/list-documents/document'); ?>">
                                <i class="fa fa-book"></i>
                                <span>Reading Contents</span>
                            </a>
                        </li>

                        <!-- <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-globe"></i>
                                <span>Maps</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Google maps</a>
                                    </li>
                                    <li>
                                        <a href="#">Open street map</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-calendar"></i>
                                <span>Calendar</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-folder"></i>
                                <span>Examples</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <a href="<?php echo site_url('carousel/list-carousel/1'); ?>">
                    <i class="fa fa-bell"></i>
                    <?php echo isset($notification) && !empty($notification) ? '<span class="badge badge-pill badge-warning notification">' . $notification . '</span>' : '' ?>
                </a>
                <a href="<?php echo site_url('email'); ?>">
                    <i class="fa fa-envelope"></i>
                    <?php echo isset($unread_msg) && !empty($unread_msg) ? '<span class="badge badge-pill badge-success notification">' . $unread_msg . '</span>' : '' ?>
                </a>
                <a href="<?php echo site_url('setting'); ?>">
                    <i class="fa fa-cog"></i>
                    <span class="badge-sonar"></span>
                </a>
                <a href="<?php echo site_url('auth/logout'); ?>">
                    <i class="fa fa-power-off"></i>
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->

        <main class="page-content">
            <div class="container-fluid">
                <div class="card table-border">
                    <?php echo $contents; ?>
                </div>
            </div>
        </main>
        <!-- page-content" -->

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal_label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_label">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

    </div>
    <!-- page-wrapper -->

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- datatable -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css1.10.20.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery.dataTables1.10.20.js">
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui.min1.10.3.js"> -->

    <script src="<?php echo base_url(); ?>assets/js/form-validation.js"></script>

    <!-- Validation JS file -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate1.17.0.js"></script>

    <!-- <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script> -->

    <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/toastr.min.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> -->

    <script src="<?php echo base_url(); ?>assets/css/toastr.min.css"></script>

    <!-- charts -->
    <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/canvasjs.min.js"></script>

    <!-- toasts -->
    <script type="text/javascript">
        <?php if ($this->session->flashdata('success')) { ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
        <?php } else if ($this->session->flashdata('error')) {  ?>
            toastr.error("<?php echo $this->session->flashdata('error'); ?>");
        <?php } else if ($this->session->flashdata('warning')) {  ?>
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
        <?php } else if ($this->session->flashdata('info')) {  ?>
            toastr.info("<?php echo $this->session->flashdata('info'); ?>");
        <?php } ?>
    </script>

</body>

</html>