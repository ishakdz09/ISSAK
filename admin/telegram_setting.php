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

    <title>Dooo - Telegram Notification Settings</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />

    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->

    <link rel="shortcut icon" href="public/images/favicon.ico">



    <!-- Sweet Alert-->

    <link href="public/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />



    <?php include 'layouts/headerStyle.php'; ?>

</head>



<?php include 'layouts/master.php'; echo setLayout();?>



<body onload="javascript:Load_Teligram_Data()">



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

                            <h4 class="font-size-18">Push Notification</h4>

                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Telegram Notifications</a></li>

                                <li class="breadcrumb-item active">Settings</li>

                            </ol>

                        </div>

                    </div>



                </div>

                <!-- end page title -->

                <div class="form" action="" method="post">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card card-body">

                                <h3 class="card-title mt-0">TELEGRAM NOTIFICATION SETTING</h3>

                                <hr>



                                <div class="alert alert-warning">If you don't have <a href="https://telegram.org/"

                                        target="_blank">Telegram</a> account yet.Signup <a

                                        href="https://telegram.org/" target="_blank">here</a> to get Bot Token And Chat ID.

                                </div>

                                <br>



                                <div class="form-group">

                                    <label>Telegram Bot Token</label>

                                    <input class="form-control col-md-9" type="text" value="" id="telegram_bot_token">

                                </div>



                                <div class="form-group">

                                    <label>Telegram Chat ID</label>

                                    <input class="form-control col-md-9" type="text" value="" id="teligram_chat_id" placeholder="@telegram">

                                </div>



                                <div class="form-group">

                                    <div class="col-md-12 row justify-content-end">

                                        <button class="btn btn-primary dropdown-toggle waves-effect waves-light"

                                            onclick="Save_Teligram_Data()" id="create_btn"

                                            type="submit" aria-haspopup="true" aria-expanded="false">

                                            <i class="mdi mdi-content-save-all"></i> SAVE CHANGES

                                        </button>

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



<!-- Sweet Alerts js -->

<script src="public/libs/sweetalert2/sweetalert2.min.js"></script>



<!-- Sweet alert init js-->

<script src="public/js/pages/sweet-alerts.init.js"></script>



<?php include "layouts/content-end.php"; ?>



<script>
var base_url = window.location.origin;

function copyToClipboard(element) {
            var copyText = document.getElementById(element);
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            swal.fire({
                title: 'Copied!',
                text: copyText.value + '\nNow just paste into android configuration file',
                type: 'success'
            });
        }


function Load_Teligram_Data() {

    $.ajax({

            type: 'POST',

            url: "dashboard_api/get_teligram_data.php",

            contentType: 'application/json',

            dataType: 'json',

            headers: {
                      'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
                    },

            success: function (response) {



                var telegram_token = response.telegram_token;

                var telegram_chat_id = response.telegram_chat_id;



                $("#telegram_bot_token").val(telegram_token);

                $("#teligram_chat_id").val(telegram_chat_id);

            }

        });

}



function Save_Teligram_Data() {

    var telegram_bot_token = document.getElementById("telegram_bot_token").value;

    var teligram_chat_id = document.getElementById("teligram_chat_id").value;



    var jsonObjects = {

                "telegram_bot_token": telegram_bot_token,

                "teligram_chat_id": teligram_chat_id,

            };

    $.ajax({

        type: 'POST',

        url: 'dashboard_api/save_telegram_data.php',

        contentType: 'application/json',

        data: JSON.stringify(jsonObjects),

        dataType: 'text',
        
        headers: {
                      'x-api-key': '<?php echo $_SESSION['api_key']; ?>'
                    },

        success: function (response) {

            if (response == "Telegram Data Updated successfully") {

                Success();

            } else {

                Error();

            }

        }

    })

}



function Success() {

        swal.fire({

                    title: 'Successful!',

                    text: 'Telegram Data Updated successfully!',

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



</script>