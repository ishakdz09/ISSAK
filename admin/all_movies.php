<?php

require '../db/config.php';

session_start();
if($_SESSION['Status'] != "Logged in") {
   header("Location: login.php");
}
?>

<!doctype html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <title>Dooo - All Movies</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />

    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->

    <link rel="shortcut icon" href="public/images/favicon.ico">



    <!-- DataTables -->

    <link href="public/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="public/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->

    <link href="public/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Sweet Alert-->
    <link href="public/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Toaster-->
    <link href="public/libs/toaster/toastr.min.css" rel="stylesheet" type="text/css" />

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

                            <h4 class="font-size-18">All Movies</h4>

                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Movies</a></li>

                                <li class="breadcrumb-item active">All Movies</li>

                            </ol>

                        </div>

                    </div>

                </div>

                <!-- end page title -->

                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-body">

                                <table id="datatable" class="table table-striped"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                    <thead>

                                        <tr>

                                            <th>#</th>

                                            <th>##</th>

                                            <th>Thumbnail</th>

                                            <th>Name</th>

                                            <th>Description</th>

                                            <th>Status</th>

                                        </tr>

                                    </thead>

                                </table>



                            </div>

                        </div>

                    </div> <!-- end col -->

                </div> <!-- end row -->



            </div> <!-- container-fluid -->

        </div>

        <!-- End Page-content -->

        <?php include 'layouts/footer.php'; ?>

    </div>

    <!-- end main content-->

</div>

<!-- END layout-wrapper -->

<?php include 'layouts/footerScript.php'; ?>





<!-- Required datatable js -->

<script src="public/libs/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="public/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->

<script src="public/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

<script src="public/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>

<script src="public/libs/jszip/jszip.min.js"></script>

<script src="public/libs/pdfmake/build/pdfmake.min.js"></script>

<script src="public/libs/pdfmake/build/vfs_fonts.js"></script>

<script src="public/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>

<script src="public/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

<script src="public/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->

<script src="public/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>

<script src="public/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->

<script src="public/js/pages/datatables.init.js"></script>

<!-- Sweet Alerts js -->
<script src="public/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Toaster js -->
<script src="public/libs/toaster/toastr.min.js"></script>

<!-- Sweet alert init js-->
<script src="public/js/pages/sweet-alerts.init.js"></script>

<?php include "layouts/content-end.php"; ?>

<script>
    $('#datatable').dataTable({
        "order": [],
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/admin/dashboard_api/movies/get_all_movies.php",
            "type":"GET",
            headers: { 'x-api-key': '<?php echo $_SESSION['api_key']; ?>' },
        },
        "columns": [{
                "data": "1",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "2",
                render: function (data) {
                    return '<div class="btn-group mr-1 mt-2"> <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">Edit</button> <div class="dropdown-menu" style=""> <a class="dropdown-item" onclick="Edit_Movie(' +
                        data + ')" href="#">Edit Movie</a> <a class="dropdown-item" onclick="Manage_Videos(' +
                        data + ')" href="#">Manage Videos</a> <a class="dropdown-item" onclick="Manage_Downloads(' +
                        data + ')" href="#">Manage Downloads</a> <a class="dropdown-item" id="Delete" onclick="Delete_Data(' +
                        data + ')" href="#">Delete</a> <div class="dropdown-divider"></div> <a class="dropdown-item" href="notification_movie.php?id=' +
                        data + '">Send Push Notification</a> <a class="dropdown-item" onclick="telegramNotify(' +
                        data + ')">Send Telegram Notification</a> </div> </div>';
                }
            },
            {
                "data": "3",
                render: function (data) {
                   return '<img class="img-fluid" height="100" width="80" src='+ data +' data-holder-rendered="true">';
                }
            },
            {
                "data": "4"
            },
            {
                "data": "5"
            },
            {
                "data": "6",
                render: function (data) {
                    if (data == 0) {
                        return '<span class="badge badge-danger">UnPublished</span>';
                    } else if (data == 1) {
                        return '<span class="badge badge-success">Published</span>';
                    }
                }
            }
        ]
    });

    function Delete_Data(ID) {
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
                var jsonObjects = {
                    "ID": ID
                };
                $.ajax({
                    type: 'POST',
                    url: "dashboard_api/delete_movie_api.php",
                    contentType: 'application/json',
                    data: JSON.stringify(jsonObjects),
                    dataType: 'text',
                    headers: {
                        'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
                    },
                    success: function (response) {
                        if (response == "Movie Deleted successfully") {
                            Success();
                        } else {
                            Error();
                        }

                    }
                });
            }
        });
    }

    function Success() {
        swal.fire({
                    title: 'Successful!',
                    text: 'Movie Deleted Successfully!',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#556ee6',
                    cancelButtonColor: "#f46a6a"
                }).then(function() {
                    location.reload();
                });
    }

    function Error() {
        swal.fire({
            title: 'Error',
                      text: 'Something Went Wrong :(',
                      type: 'error'
                }).then(function() {
                    location.reload();
                });
    }

    function Edit_Movie(ID) {
        window.location.assign("edit_movie.php?id="+ID);
    }

    function Manage_Videos(ID) {
        window.location.assign("manage_movie_links.php?id="+ID);
    }

    function Manage_Downloads(ID) {
        window.location.assign("manage_movie_Download_links.php?id="+ID);
    }

    function telegramNotify(data) {
        var jsonObjects = {
            "ID": data
        };
        $.ajax({
            url: 'dashboard_api/get_single_movie_details.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(jsonObjects),
            dataType: 'json'
        })
        .done(function (response) {
            sendTelegramNotification(response.name, response.description, response.poster);
        })
        .fail(function (response) {
            alert('Something went wrong..');
        })
    }

    var telegram_token;
    var telegram_chat_id;

        $.ajax({
            type: 'POST',
            url: "dashboard_api/get_teligram_data.php",
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                      'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
                    },
            success: function (response) {

                telegram_token = response.telegram_token;
                telegram_chat_id = response.telegram_chat_id;
            }
        });

    function sendTelegramNotification(Heading, Message, image) {
        
        var movieJsonObjects = {
            "telegram_token": telegram_token,
	        "telegram_chat_id": telegram_chat_id,
	        "Heading": Heading,
            "Message": Message,
	        "image": image
        };
        $.ajax({
            type: 'POST',
            url: 'dashboard_api/teligram.php',
            headers: {
                'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
            },
            contentType: 'application/json',
            data: JSON.stringify(movieJsonObjects),
            dataType: 'text',
            success: function (response) {
                toastr.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": true,
                  "progressBar": false,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "2000",
                  "timeOut": "2000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                };
                toastr.success("Message Sended Successfully!");
            },
            error: function (response) {
                toastr.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": true,
                  "progressBar": false,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "2000",
                  "timeOut": "2000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                };
                toastr.error("Something Went Wrong!");
            }
        })  
    }

</script>