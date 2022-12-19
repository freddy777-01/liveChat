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
    <main class="container">
        <header>
            <h1 class="h">Configuration Setup</h1>
            <div class="" id="error-logger">
            </div>
        </header>
        <div class="setting d-flex">
            <div class="form-container w-50">
                <form action="" method="post" id="user-inf">
                    <input type="hidden" name="request" value="updateUser">
                    <div class="first-block">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="first_name" placeholder="first_name" value="">
                            <label for="full-name">First name</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" name="last_name" placeholder="last_name" value="">
                            <label for="full-name">Last name</label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="text" class="form-control needs-validation" name="user_name" placeholder="user name" value="">
                            <label for="user-name">User name</label>
                            <div class="valid-feedback">user name available</div>
                            <div class="invalid-feedback">user name already used</div>
                        </div>
                    </div>
                    <div class="second-block my-4">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="third-block">
                        <!--    <div class="form-floating">
                            <input type="password" class="form-control" name="pasword" id="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mt-1">
                            <input type="password" class="form-control" name="conf_pasword" id="confirm-pwd" placeholder="Confirm Password">
                            <label for="confirm-pwd">Confirm Password</label>
                        </div> -->
                    </div>
                    <div class="form-footer d-flex justify-content-end">
                        <button class="btn btn-outline-dark mt-3" type="submit" id="update-user">Save</button>
                    </div>
                </form>
                <div class="d-grid gap-2 mt-3">
                    <a name="" id="" class="link-btn btn btn-outline-dark btn-block" href="/liveChat/profile/change_password/" role="button">
                        Change Password
                    </a>
                    <a name="" id="" class="link-btn btn btn-outline-danger btn-block" href="/liveChat/profile/change_password/" role="button">
                        Delete My Account
                    </a>
                </div>
            </div>
            <div class="image-block w-100">
                <div class="h2 text-center mb-5">New photo here</div>
                <form action="" method="post" enctype="multipart/form-data" class="text-center">
                    <div class="image-input ">
                        <input type="file" name="profileImage" id="">
                        <span class="image-icon">
                            <span class="fa-icon">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                            </span>
                            <img src="../assets/images/person_FILL0.svg" alt="" srcset="">
                        </span>
                    </div>
                    <button type="submit" class="btn btn-outline-dark my-3 w-25 mx-auto">Save</button>
                </form>
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

            $(".image-input input").change(function() {
                let validImage = ["image/jpeg", "image/png"]
                if (validImage.includes(this.files[0]['type'])) {
                    // console.log($.inArray(this.files[0]['type'], validImage));
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $(".image-input .image-icon img").attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0])
                } else {
                    displayError("Failed", "danger", "Please Choose and Image !");
                    // console.log("not image");
                }
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


            // automatic getting user infor and populating to input box
            $.post("../../Route.php", {
                'request': 'user',
                'id': '<?php echo $_SESSION['User']['id']; ?>'
            }, function(data, status) {
                if (status === 'success') {
                    // console.log(data);
                    let dataObj = JSON.parse(data);
                    // console.log(dataObj);
                    switch (JSON.parse(data)['type']) {
                        case 'user':
                            for (const key in dataObj['context']) {
                                $('#user-inf :input').each(function(i, el) {
                                    if ($(this).attr('name') === key) {
                                        // console.log(el);
                                        $(this).val(dataObj['context'][key])
                                    }
                                })
                            }
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

            /* Updating user information */
            $('#update-user').click(function(e) {
                e.preventDefault();
                // console.log('am cliked');
                let formData = $('#user-inf').serialize();
                $.post("../../Route.php", formData, function(data, status) {
                    // console.log(data);
                    let dataObj = JSON.parse(data);
                    switch (JSON.parse(data)['type']) {
                        case "input_error":
                            $(":input").each(function(i, el) {
                                if ($(this).attr("name") === dataObj['context']['field_name']) {
                                    $('.erMsg').remove();
                                    $(this).parent().append('<div class = "erMsg text-danger text-center font-italic mx-auto">' + dataObj['context']['msg'] + '</div>')
                                    $('.erMsg').fadeOut(4000)
                                }
                            })
                            break;
                        case "success":
                            // console.log(dataObj["context"]["msg"]);
                            displayError("Success", "success", dataObj["context"]["msg"])
                            break;
                        case "conn_error":
                            // console.log(dataObj["context"]["msg"]);
                            displayError("Failed", "danger", dataObj["context"]["msg"])
                            break;
                        default:
                            displayError("Failed", "danger", dataObj["context"]["msg"])
                            break;
                    }
                }, )
            })
            /* End of user update functionality */

            // window.location.reload(); //this reload the current page
        });
    </script>
</body>

</html>