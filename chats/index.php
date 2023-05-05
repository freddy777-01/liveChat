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
    <link rel="stylesheet" href="./assets/css/chats.css">
    <title>chats</title>
    <style>
        .group .groups .groups-container {
            border: 2px solid red;
            height: 40rem;
            overflow-y: scroll;
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
    <div class="" id="error-logger">
    </div>
    <main class="container">
        <section class="group mt-5">
            <h2>Chat groups</h2>
            <div class="d-flex">

                <aside class="groups">
                    <header>
                        <div class="mb-3 w-70 mx-auto d-flex align-items-center">
                            <label for="" class="form-label mx-3">Filter</label>
                            <select class="form-control form-control-sm" name="" id="group-view-filter">
                                <option value="all-groups">All</option>
                                <option value="subscribes">Subscribed</option>
                                <option value="my-groups">my groups</option>
                            </select>
                        </div>
                    </header>
                    <div class="groups-container">
                        <div class="agroup my-3 d-flex justify-content-around align-items-center">
                            <span class="agroup-icon"><i class="fas fa-users    "></i></span>
                            <span class="agroup-name">
                                <p>Group name</p>
                            </span>w
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
                <section class="group-chat px-4 py-4">
                    <div class="msg-container clearfix">
                        <div class="receiver-msg">
                            Lorem ipsum dolor sit amet amet, eget rhoncus, pulvinar, justo ligula.
                            Dolor, eros ipsum odio, neque, lobortis lectus tristique dictumst id diam urna, mattis viverra id.
                        </div>
                        <div class="sender-msg float-end">
                            Lorem ipsum dolor sit amet amet, eget rhoncus, pulvinar, justo ligula.
                            Dolor, eros ipsum odio, neque, lobortis lectus tristique dictumst id diam urna, mattis viverra id.
                        </div>
                    </div>
                    <div class="form-container py-2">
                        <form action="" method="post">
                            <div class="input-group">
                                <textarea class="form-control" name="reply-box" id="" cols="30" rows="" placeholder="Reply Here..."></textarea>
                                <button type="button" class="btn btn-outline-dark"><i class="fab fa-telegram-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </section>
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
        // subscription functionality
        function subscription(d) {
            $.post("../Route.php", {
                'request': 'subscription',
                data: d
            }, function(data, status) {
                if (status === 'success') {
                    console.log(data);
                    setTimeout(() => {
                        groupFilter($('#group-view-filter').val());
                    }, 1000);
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
            })
        }
        // End of subscription functionality

        // getting groups
        function groupFilter(filter) {
            $.post("../Route.php", {
                'request': 'get_groups_by_filter',
                'filter': filter
            }, function(data, status) {
                if (status === 'success') {
                    $('.groups-container').html('');
                    // console.log(data);
                    let dataObj = JSON.parse(data);
                    if (typeof dataObj['context'] != 'string') {
                        console.log(dataObj['context']);
                        dataObj['context'].length != 0 ?
                            dataObj['context'].forEach(el => {
                                $('.groups-container').append($('<div class="agroup my-3 d-flex justify-content-around align-items-center"></div>')
                                    .append('<span class="agroup-icon"><i class="fas fa-users    "></i></span>',
                                        $('<span class="agroup-name"></span>').append(`<p>${el['group_name']}</p>`),
                                        `<span class="agroup-sub ${filter==='subscribes'?'text-success':null}" data-group_id=${el['id']}><i class="fas fa-bell    "></i></span>`
                                    ))
                            }) : $('.groups-container').html('<div class="h3 text-warning">No groups available<span class="mx-3"><i class="fas fa-sad-cry    "></i></span></div>')

                        /* $('.agroup-sub').click((e) => {
                            let t = e.target.parentElement.parentElement;
                            let data = null;
                            switch (filter) {
                                case "all-groups":
                                    data = {
                                        requestTo: "subscribe",
                                        group_id: $(t).data("group_id")
                                    }
                                    t.classList.add('text-success')
                                    if (subscription(data)) {
                                        console.log("hello");
                                        groupFilter(filter)
                                    }

                                case "subscribes":
                                    data = {
                                        requestTo: "unsubscribe",
                                        group_id: $(t).data("group_id")
                                    }
                                    t.classList.remove('text-success')
                                    console.log(t);
                                    subscription(data) ? groupFilter(filter) : null
                                    break;

                                default:
                                    break;
                            }
                        }) */
                    } else {
                        $('.groups-container').html('<div class="h3 text-warning">No groups available<span class="mx-3"><i class="fas fa-sad-cry    "></i></span></div>')
                    }

                }
            }, );
        }
        $(document).click((e) => {
            let t = e.target.parentElement.parentElement;
            if (t.classList.contains("agroup-sub")) {
                let data = null;
                let filter = $('#group-view-filter').val();
                if (filter === "all-groups") {
                    data = {
                        requestTo: "subscribe",
                        group_id: $(t).data("group_id")
                    }
                    t.classList.add('text-success')
                    subscription(data)
                } else {

                    data = {
                        requestTo: "unsubscribe",
                        group_id: $(t).data("group_id")
                    }
                    t.classList.remove('text-success')
                    subscription(data)
                }
            }
        })
        groupFilter($('#group-view-filter').val());
        $('#group-view-filter').change(function(e) {
            groupFilter($(this).val())
            // console.log($(this).val());
        })
        // end of getting groups
    </script>
</body>

</html>