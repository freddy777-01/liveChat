<?php
session_start();
if (!isset($_SESSION['User'])) {
    header("Location:/liveChat/");
}
print_r($_SESSION['User']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user-setting</title>
    <link rel="stylesheet" href="../../assets/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-5/css/all.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-5/css/brands.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <style>
        .images .image-list .image-container {
            margin: 0.7rem;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            /* border: 2px solid black; */
            border-radius: 5%;
            justify-content: space-between;
        }

        .images .image-list .image-container .image {
            position: relative;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .images .image-list .image-container .image:hover {
            opacity: 0.6;
        }

        .images .image-list .image-container input {
            position: absolute;
            left: 5;
            top: 5;
        }

        .images .image-list .image-container .my-image {
            position: relative;
            width: 100px;
            height: 7rem;
        }
    </style>
</head>

<body>
    <div class="float-menu">
        <span>
            <i class="fas fa-bars    "></i>
        </span>
        <ul class="menu shadow-sm">
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="Home">
                <a href="../../">
                    <i class="fas fa-home    "></i>
                </a>
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="Profile">
                <a href="../">
                    <i class="fas fa-user    "></i>
                </a>
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="SignOut" id="logout-btn">
                <a href="#">
                    <i class="fas fa-sign-out-alt    "></i>
                </a>
            </li>
        </ul>
    </div>
    <main class="container images">
        <header>
            <h1 class="h">Portfolio</h1>
            <div class="" id="error-logger">
            </div>
        </header>
        <div class="image-main-layout d-flex flex-row">
            <form action="" method="post" id="image-form">
                <div class="image-list d-flex flex-wrap">
                </div>
            </form>
            <button type="submit" class="btn btn-outline-danger my-3 align-self-start" id="image-delete-btn" data-bs-toggle="modal" data-bs-target="#modelId"> Delete</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="text-center"><span class="text-warning display-5 mx-3"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
                                    <span class="text-danger h5">Are sure you want to delete this ?</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-center" id="confirm-form">
                            <button type="button" class="btn btn-outline-warning mx-2 d-block w-75" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-outline-danger mx-2 d-block w-75" id="confirm-delete-btn">ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF MODAL -->
    </main>
    <!--  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modelId">
        Launch
    </button> -->



    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/fontawesome-free-5/js/all.min.js"></script>
    <script src="../../assets/fontawesome-free-5/js/brands.min.js"></script>
    <script src="../../assets/js/main_j.js"></script>
    <script>
        $(function() {
            let b = true;

            function displayError(response, errType, msg) {
                $('#error-logger #alert-note').remove();
                $('#error-logger').html(`
                <div class="alert alert-${errType} alert-dismissible" id="alert-note">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>${response}!</strong> ${msg}.
                </div>`)
                // setTimeout(() => {
                $('#alert-note').fadeOut(5000);
                // }, 3000);
            }
            // displayError("Failed", "danger", "There was unknown error !, Please try again");

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })



            // logout mechanisim
            $('#logout-btn').click(function(e) {
                e.preventDefault();
                $.post("../../Route.php", {
                    'request': 'logout'
                }, function(data, status) {
                    if (status === 'success') {
                        console.log(data);
                        let dataObj = JSON.parse(data);
                        switch (JSON.parse(data)['type']) {
                            case "url":
                                window.location.replace(dataObj["context"]["msg"])
                                break;
                            default:
                                displayError("Failed", "danger", "Unkown Error")
                                break;
                        }
                    }
                }, )
            })


            // automatic getting images and populating to input box
            $.post("../../Route.php", {
                'request': 'user_images',
                'id': '<?php echo $_SESSION['User']['id']; ?>'
            }, function(data, status) {
                if (status === 'success') {
                    // console.log(data);
                    let dataObj = JSON.parse(data);
                    // console.log(dataObj);
                    switch (JSON.parse(data)['type']) {
                        case 'images':
                            dataObj['context'].forEach(el => {
                                // console.log(el['file_name']);
                                // let imgContainer = ;
                                // let img =

                                $('.image-list').append($('<div></div>').attr({
                                    'class': 'image-container',
                                    'id': 'image_' + el['id'],
                                    'data-file_name': el['file_name'],
                                }).append($('<div class="image"></div>').append(
                                        $('<input type="checkbox" class="form-check-input">').attr({
                                            'name': el['id'],
                                            'value': el['file_name'],
                                        }),
                                        $('<img>').attr({
                                            'src': "../../uploads/" + el['file_name'] + " ",
                                            'class': 'my-image mx-auto d-block rounded',
                                        })),
                                    $('<button class="btn btn-outline-dark my-3 w-100 change-profile-image"> Set as Profile Picture</button>').attr({
                                        'data-change_image': el['file_name'],
                                        'data-image_id': el['id'],
                                    })))
                            });
                            $('.image-container .image').click(function() {
                                if ($(this).children().first().is(':checked')) {
                                    $(this).children().first().prop('checked', false)
                                } else {
                                    $(this).children().first().prop('checked', true)
                                }

                                // console.log($(this).children().first().prop('checked', !b));
                            })
                            $(".change-profile-image").click(function(e) {
                                e.preventDefault()
                                console.log($(this).data('change_image'));
                                $.post("../../Route.php", {
                                        'request': 'change_profile_image',
                                        'image': $(this).data('change_image')
                                    },
                                    function(data, status) {
                                        if (status === 'success') {
                                            // console.log(data);
                                            let dataObj = JSON.parse(data);
                                            switch (JSON.parse(data)['type']) {
                                                case "file_error":
                                                    displayError("Failed", "danger", dataObj["context"]["msg"])
                                                    break;
                                                case "success":
                                                    displayError("Success", "success", dataObj["context"]["msg"])
                                                    break;
                                                default:
                                                    displayError("Failed", "danger", "Unkown Error")
                                                    break;
                                            }
                                        }

                                    }, )
                            })
                            /* $('.image-container').each(function() {
                                $(this).click(function() {

                                    console.log("am cliked");
                                })
                            }) */
                            /* for (const key in dataObj['context']) {
                                console.log(key);
                            } */
                            break;
                        case 'conn_error':
                            displayError("Failed", "danger", dataObj["context"]["msg"])
                            break;
                        default:
                            displayError("Failed", "danger", dataObj["context"]["msg"])
                            break;
                    }
                }
            }, );
            // End of getting automatic images

            // Deleting mechanisikm
            $("#confirm-delete-btn").click(function() {
                // console.log("about to delete image");
                $("#image-form").submit()
            })
            $("#image-form").submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize()
                if (formData == "") {
                    displayError("Failed", "danger", "Please Select Image(s) to delete")
                } else {

                    // console.log(formData);
                    $.post("../../Route.php", {
                            'request': 'delete_image',
                            'data': formData
                        },
                        function(data, status) {
                            if (status === 'success') {
                                console.log(data);
                                let dataObj = JSON.parse(data);
                                switch (JSON.parse(data)['type']) {
                                    case "file_error":
                                        displayError("Failed", "danger", dataObj["context"]["msg"])
                                        break;
                                    case "success":
                                        displayError("Success", "success", dataObj["context"]["msg"])
                                        break;
                                    default:
                                        displayError("Failed", "danger", "Unkown Error")
                                        break;
                                }
                                window.location.reload();
                            }

                        }, )
                }
                // let req = $(this).children("[name='request']").val();
                /* $.ajaxSetup({
                    contentType: false,
                    processData: false
                }) */
            })

            // window.location.reload(); //this reload the current page
        });
        // End of deleting mechanisim
    </script>
</body>

</html>