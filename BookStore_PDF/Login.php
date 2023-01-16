<?php require_once 'Header.php'; ?>
<!--<link rel="stylesheet" href="admin/assets/css/main.css">-->
<body>
    <section class="login-content">
        <div class="login-box">
            <form class="login-form" id="form" name="form" method="post" enctype="multipart/form-data">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
                <div class="form-group">
                    <label class="control-label">User Name</label>
                    <input class="form-control" type="text" name="UserName" placeholder="Email" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input class="form-control" type="password" name="Password" placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="utility">
                        <div class="animated-checkbox">
                            <label class="semibold-text">
                                <input type="checkbox"><span class="label-text">Stay Signed in</span>
                            </label>
                        </div>
                        <p class="semibold-text mb-0"><a id="toFlip" href="#">Forgot Password ?</a></p>
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" onclick="UserLogin(this.form)">SIGN IN <i class="fa fa-sign-in fa-lg"></i></button>
                </div>
            </form>
        </div>
    </section>
</body>

<script>
    function UserLogin(form) {
        var data = $('#' + form.id).serialize();
//        alert("loginPage");
//        return false;
        jQuery.ajax({
            type: 'POST',
            url: "class/class.ajaxRequest.php",
            data: data + "&do=UserLogin",
            success: function (result) {

                var data = $.parseJSON(result);
//                alert(result);
//                alert(data.RedirectMsg);
//                return false;
                if (data.RedirectMsg == 'Admin' && data.RedirectMsg != 'Agent' && data.RedirectMsg != 'User') {
                    window.location = "admin/home";
                    return false;
                } else if (data.RedirectMsg == 'Agent' && data.RedirectMsg != 'Admin' && data.RedirectMsg != 'User') {
//                    alert("call");
                    window.location = "admin/home";
                    return false;
                } else if (data.RedirectMsg == 'WebUser' && data.RedirectMsg != 'Agent' && data.RedirectMsg != 'Admin') {
                    window.location = "index.php";
                    return false;
                } else {
                    window.location = "index.php";
                    return false;
                }

            }
        });
//    }
    }
</script>
<?php require_once 'Footer.php'; ?>