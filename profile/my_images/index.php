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

        .images .image-main-layout #image-form {
            width: 97%;
        }

        .images .image-main-layout .form-btn {
            width: 3%;
        }

        .show-hide {
            visibility: hidden;
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
        <div class="image-main-layout d-flex">
            <form action="" method="post" id="image-form" class="">
                <div class="image-list d-flex flex-wrap">
                </div>
            </form>
            <div class="form-btn">
                <button type="submit" class="btn btn-outline-danger m-2 align-self-start" id="image-delete-btn"> Delete</button>
                <button type="submit" class="btn btn-outline-warning m-2 align-self-start show-hide" id="confirm-delete-btn"> Confirm</button>
            </div>
        </div>

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
                    switch (JSON.parse(data)['type']) {
                        case 'images':
                            // console.log(dataObj['context'].length);
                            $('.image-list').html('');
                            dataObj['context'].length != 0 ?
                                dataObj['context'].forEach(el => {

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
                                }) : $('.image-list').html('<div class="h3 text-warning">You have not upload image(S)<span class="mx-3"><i class="fas fa-sad-cry    "></i></span></div>')
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

            // Deleting mechanisism
            $('#image-delete-btn').click(function() {
                $("#confirm-delete-btn").toggleClass("show-hide")
                // console.log("about to delete image");
            })
            $("#confirm-delete-btn").click(function() {
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
                            $("#confirm-delete-btn").toggleClass("show-hide")
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