<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-5/css/all.min.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-5/css/brands.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/chats.css">
    <title>chats</title>
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
                <a href="../profile/">
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
        <section class="group">
            <h2>Chat groups</h2>
            <div class="d-flex">

                <aside class="groups">
                    <header>
                        <div class="mb-3 w-70 mx-auto d-flex align-items-center">
                            <label for="" class="form-label mx-3">Filter</label>
                            <select class="form-control" name="" id="">
                                <option>All</option>
                                <option>Subscribed</option>
                            </select>
                        </div>
                    </header>
                    <div class="groups-container">
                        <div class="agroup my-3 d-flex justify-content-around align-items-center">
                            <span class="agroup-icon"><i class="fas fa-users    "></i></span>
                            <span class="agroup-name">
                                <p>Group name</p>
                            </span>
                            <span class="agroup-sub"><i class="fas fa-bell    "></i></span>
                        </div>
                        <div class="agroup my-3 d-flex justify-content-around align-items-center">
                            <span class="agroup-icon"><i class="fas fa-users    "></i></span>
                            <span class="agroup-name">
                                <p>Group name</p>
                            </span>
                            <span class="agroup-sub"><i class="fas fa-bell    "></i></span>
                        </div>
                        <div class="agroup my-3 d-flex justify-content-around align-items-center">
                            <span class="agroup-icon"><i class="fas fa-users    "></i></span>
                            <span class="agroup-name">
                                <p>Group name</p>
                            </span>
                            <span class="agroup-sub"><i class="fas fa-bell    "></i></span>
                        </div>
                    </div>
                </aside>
                <section class="group-chat"></section>
            </div>
        </section>
    </main>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/fontawesome-free-5/js/all.min.js"></script>
    <script src="../assets/fontawesome-free-5/js/brands.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>