<?php
session_start();
if($_SESSION['Status'] != "Logged in") {
   header("Location: login.php");
}
?>

<!doctype html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <title>Dooo - Subscription Setting</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />

    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->

    <link rel="shortcut icon" href="public/images/favicon.ico">



    <link href="public/cssadd-movie.css" rel="stylesheet" type="text/css" />



    <!-- Summernote css -->

    <link href="public/libs/summernote/summernote.css" rel="stylesheet" type="text/css" />


    <!-- Sweet Alert-->

    <link href="public/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


    <link href="public/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <link href="public/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <link href="public/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="public/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />



    <?php include 'layouts/headerStyle.php'; ?>

</head>



<?php include 'layouts/master.php'; echo setLayout();?>


<body onload="javascript:onLoad()">
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

                                <h4 class="font-size-18">Subscription Setting</h4>

                                <ol class="breadcrumb mb-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Subscription Setting</a></li>

                                    <li class="breadcrumb-item active">Subscription Setting</li>

                                </ol>

                            </div>

                        </div>

                    </div>

                    <!-- end page title -->


                    <div class="form" method="post">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="card card-body">

                                    <h3 class="card-title mt-0">Razorpay</h3>

                                    <hr>



                                    <div class="tab-pane active" id="rest_api" role="tabpanel">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 ">Enable Razorpay</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="razorpay_status" switch="bool">
                                                <label for="razorpay_status" data-on-label=""
                                                    data-off-label=""></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label">Razorpay key id</label>
                                            <div class="col-sm-6">
                                                <input type="text" value="" name="razorpay_key_id" id="razorpay_key_id"
                                                    placeholder="" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label">Razorpay key secret</label>
                                            <div class="col-sm-6">
                                                <input type="text" value="" name="razorpay_key_secret"
                                                    id="razorpay_key_secret" placeholder="" class="form-control"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="col-md-12 row justify-content-end">

                                                <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                                    onclick="Save_Subscription_Setting_Data()" id="create_btn" type="submit"
                                                    aria-haspopup="true" aria-expanded="false">

                                                    <i class="mdi mdi-content-save-all"></i> SAVE

                                                </button>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                </div> <!-- container-fluid -->

            </div>

            <!-- End Page-content -->

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


    <!-- Sweet Alerts js -->

    <script src="public/libs/sweetalert2/sweetalert2.min.js"></script>



    <!-- Sweet alert init js-->

    <script src="public/js/pages/sweet-alerts.init.js"></script>



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
        function onLoad() {
            $.ajax({
                type: 'POST',
                url: "dashboard_api/get_config.php",
                contentType: 'application/json',
                dataType: 'json',
                headers: {
                    'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
                },
                success: function (response2) {
                    var razorpay_status = response2.razorpay_status;
                    var razorpay_key_id = response2.razorpay_key_id;
                    var razorpay_key_secret = response2.razorpay_key_secret;

                    if (razorpay_status == "1") {
                        document.getElementById("razorpay_status").checked = true;
                    } else {
                        document.getElementById("razorpay_status").checked = false;
                    }

                    $("#razorpay_key_id").val(razorpay_key_id);
                    $("#razorpay_key_secret").val(razorpay_key_secret);
                }

            });
        }


        function Save_Subscription_Setting_Data() {
                if ($('#razorpay_status').is(':checked')) {
                    var razorpay_status_int = 1;
                } else {
                    var razorpay_status_int = 0;
                }
                var razorpay_key_id = document.getElementById("razorpay_key_id").value;
                var razorpay_key_secret = document.getElementById("razorpay_key_secret").value;

                var jsonObjects = {
                    "razorpay_status_int": razorpay_status_int,
                    "razorpay_key_id": razorpay_key_id,
                    "razorpay_key_secret": razorpay_key_secret
                };
                $.ajax({
                    type: 'POST',
                    url: "dashboard_api/update_razorpay_sub_setting.php",
                    contentType: 'application/json',
                    data: JSON.stringify(jsonObjects),
                    dataType: 'text',
                    headers: {
                      'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
                    },
                    success: function (response3) {
                        if (response3 == "razorpay Sub Settings Updated successfully") {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Razorpay Settings Updated successfully!',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Error_response();
                        }

                    }

                });
        }

        function Error_response() {
            swal.fire({
                title: 'Error',
                text: 'Something Went Wrong :(',
                type: 'error'
            }).then(function () {
                location.reload();
            });
        }

    </script>