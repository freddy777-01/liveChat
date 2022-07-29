<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-5/css/all.min.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-5/css/brands.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/modalForm.css">
    <link rel="stylesheet" href="./assets/css/profile.css">
</head>

<body>
    <div class="float-menu">
        <span>
            <i class="fas fa-bars    "></i>
        </span>
        <ul class="menu shadow-sm">
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="Home">
                <a href="../">
                    <i class="fas fa-home    "></i>
                </a>
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="Profile">
                <a href="./">
                    <i class="fas fa-user    "></i>
                </a>
            </li>
            <li data-bs-toggle="tooltip" data-bs-placement="left" title="SignOut">
                <a href="#">
                    <i class="fas fa-sign-out-alt    "></i>
                </a>
            </li>
        </ul>
    </div>
    <main class="container">
        <div class="profile showCase d-flex align-items-center justify-content-center flex-column justify-content-around">
            <h1 class="h mb-4">welcome<span>User Freddy</span></h1>
            <img src="../assets/images/freddie..ctn.jpg" class="rounded-circle shadow-lg" alt="" srcset="">
            <div class="bio">
                <p class="h3">About me</p>
                <p>
                    Lorem ipsum dolor sit amet et, enim in porttitor pretium malesuada libero est tellus mattis
                    , molestie. Vestibulum, ligula, nec bibendum, platea malesuada posuere
                    , at placerat, mi, pellentesque feugiat ligula. Taciti cras torquent vitae
                    , odio, nunc tristique auctor, iaculis quam, molestie erat velit arcu, non.
                </p>
            </div>
            <div class="mt-5">
                <button type="button" class="btn btn-lg btn-outline-dark mx-3">
                    <a href="#">
                        online users
                    </a>
                    <span class="online"></span>
                </button>
                <button type="button" class="btn btn-lg btn-outline-dark mx-2" data-bs-toggle="modal" data-bs-target="#modelId">
                    <a href="#">
                        Create Group
                        <i class="fas fa-users    "></i>
                    </a>
                </button>
                <button type="button" class="btn btn-lg btn-outline-dark mx-2">
                    <a href="../chats/">
                        iGroups
                        <i class="fas fa-users    "></i>
                    </a>
                    <span></span>
                </button>
                <button type="button" class="btn btn-lg btn-outline-dark mx-2">
                    <a href="#">
                        Messages
                        <i class="fas fa-envelope    "></i>
                    </a>
                    <span></span>
                </button>
                <button type="button" class="btn btn-lg btn-outline-dark mx-2">
                    <a href="./user_setting/">
                        <i class="fas fa-cog    "></i>
                    </a>
                </button>
            </div>
        </div>
    </main>
    <!--  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modelId">
        Launch
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <form action="" method="post">
                                <div class="mb-4 input-container">
                                    <input type="text" autocomplete="off" class="" name="uname" id="" aria-describedby="helpId" placeholder="" required>
                                    <label for="" class="">Group name</label>
                                </div>
                                <div class="mb-4 input-container">
                                    <input type="text" autocomplete="off" class="" name="pwd" id="" aria-describedby="helpId" placeholder="" required>
                                    <label for="" class="">About group</label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-outline-dark float-end">Create</button>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-dark">Save</button>
                </div> -->
            </div>
        </div>
    </div>

    <script>
        var modelId = document.getElementById('modelId');

        modelId.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            let recipient = button.getAttribute('data-bs-whatever');

            // Use above variables to manipulate the DOM
        });
    </script>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/fontawesome-free-5/js/all.min.js"></script>
    <script src="../assets/fontawesome-free-5/js/brands.min.js"></script>
    <script src="../assets/js/main_j.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>