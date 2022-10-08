<?php
session_start();
if($_SESSION['Status'] != "Logged in") {
   header("Location: login.php");
}

$backupDir = "../db/backup";
$files = array_diff(scandir($backupDir), array('.', '..'));
?>

<!doctype html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <title>Dooo - DB Manager</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />

    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->

    <link rel="shortcut icon" href="public/images/favicon.ico">



    <link href="public/cssadd-movie.css" rel="stylesheet" type="text/css" />



    <!-- Summernote css -->

    <link href="public/libs/summernote/summernote.css" rel="stylesheet" type="text/css" />


    <!-- DataTables -->

    <link href="public/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="public/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->

    <link href="public/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />


    <link href="public/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <link href="public/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <link href="public/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="public/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />



    <?php include 'layouts/headerStyle.php'; ?>

</head>



<?php include 'layouts/master.php'; echo setLayout();?>



<!-- Begin page -->

<div id="layout-wrapper">





    <?php include 'layouts/topbar.php'; ?>

    <div class="main-content">



        <div class="page-content">

            <div class="container-fluid">



                <!-- start page title -->

                <div class="row align-items-center">

                    <div class="col-sm-6">

                        <div class="page-title-box">

                            <h4 class="font-size-18">Genrer Manager</h4>

                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                <li class="breadcrumb-item"><a href="javascript: void(0);">System</a></li>

                                <li class="breadcrumb-item active">DB Manager</li>

                            </ol>

                        </div>

                    </div>

                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <a href=""
                                class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="modal" data-target="#Add_Genre_Modal" onclick='onCreateClick()'> <i
                                    class="mdi mdi-plus-box-multiple-outline mr-2"></i> Create Backup</a>

                        </div>
                    </div>

                </div>

                <!-- end page title -->

                <div class="form" action="" method="post">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card card-body">

                            <table id="datatable" class="table table-striped"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>##</th>
                                    </tr>

                                </thead>
                                <tbody>
                                <?php $i = 0; foreach($files as $file) { $i++;
                                    ?>
                                    <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <th scope="row"><?php echo $file; ?></th>
                                    <th scope="row">
                                        <div class="btn-group mr-1 mt-2"> 
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">Options</button> 
                                            <div class="dropdown-menu" style=""> 
                                                <a class="dropdown-item" onclick="downloadDB('<?php echo $file; ?>')">Download</a> 
                                                <a class="dropdown-item" onclick="deleteDB('<?php echo $file; ?>')">Delete</a> 
                                            </div> 
                                        </div>
                                    </th>
                                    </tr>
                                    <?php
                                } ?>
                                </tbody>

                            </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



        </div> <!-- container-fluid -->

    </div>

    <!-- End Page-content -->

    <!-- Add Genre Modal -->
    <div class="modal fade" id="Add_Genre_Modal" tabindex="-1" role="dialog" aria-labelledby="Add_Genre_Modal_Lebel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Add_Genre_Modal_Lebel">Create Backup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="panel-heading">
                        <h3 class="panel-title row justify-content-center">Add Backup Information</h3>
                    </div>

                    <hr>

                    <div class="form-group"> <label class="control-label">
                            Name</label>&nbsp;&nbsp;<input id="modal_createBackup_Name" type="text" name="label"
                            class="form-control" placeholder="name" required=""> </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="createBackup()" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'layouts/footer.php'; ?>

</div>

<!-- end main content-->

</div>

<!-- END layout-wrapper -->

<?php include 'layouts/footerScript.php'; ?>



<!--tinymce js-->

<script src="public/libs/tinymce/tinymce.min.js"></script>



<!-- Summernote js -->

<script src="public/libs/summernote/summernote.js"></script>



<!-- init js -->

<script src="public/js/pages/form-editor.init.js"></script>

<!-- Required datatable js -->

<script src="public/libs/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="public/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->

<script src="public/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>

<script src="public/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->

<script src="public/js/pages/datatables.init.js"></script>

<!-- Buttons examples -->

<script src="public/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

<script src="public/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>

<script src="public/libs/jszip/jszip.min.js"></script>

<script src="public/libs/pdfmake/build/pdfmake.min.js"></script>

<script src="public/libs/pdfmake/build/vfs_fonts.js"></script>

<script src="public/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>

<script src="public/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

<script src="public/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>



<script src="public/libs/select2/js/select2.min.js"></script>

<script src="public/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="public/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<script src="public/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>

<script src="public/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>

<script src="public/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>



<script src="public/js/pages/form-advanced.init.js"></script>



<?php include "layouts/content-end.php"; ?>



<?php require '../db/config.php'; ?>

<script>
    var base_url = window.location.origin;
    
    $('#datatable').dataTable({
        "order": [],
        "ordering": false,
        "processing": false,
        "serverSide": false
    });
    function onCreateClick() {
        $("#modal_createBackup_Name").val("DB-Backup");
    }
    function createBackup() {
        var modal_createBackup_Name = document.getElementById("modal_createBackup_Name").value;
        $.ajax({
            type: 'POST',
            url: "dashboard_api/db_ie.php?type=exportDatabase&name="+modal_createBackup_Name,
            contentType: 'application/json',
            dataType: 'text',
            headers: {
                'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
            },
            success: function (response) {
                if(response == "export Successfull") {
                    swal.fire({
                        title: 'Successful!',
                        text: 'Database Exported successfully!',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#556ee6',
                        cancelButtonColor: "#f46a6a"
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }
    
    function downloadDB(file) {
        var link = document.createElement("a");
        link.setAttribute('download', file);
        link.href = base_url+"/db/backup/"+file;
        document.body.appendChild(link);
        link.click();
        link.remove();
    }

    function deleteDB(file) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "dashboard_api/delete_db.php?file="+file,
                    contentType: 'application/json',
                    dataType: 'text',
                    headers: {
                        'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
                    },
                    success: function (response) {
                        if(response == "Delete Successfull") {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Database Deleted successfully!',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    }

</script>