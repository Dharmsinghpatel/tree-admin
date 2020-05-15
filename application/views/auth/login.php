<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

<!-- Custom CSS and js-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin.css">

<div class="container">
    <div class="row justify-content-center login-row align-items-center">
        <div class="col-4">
            <div class="card text-center bg-dark">
                <div class="card-header bg-dark">
                    <span> <img src="https://amar.vote/assets/img/amarVotebd.png" class="w-75" alt="Logo"> </span><br />
                    <span class="logo_title mt-5"> Login Dashboard </span>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="user_id" class="form-control" placeholder="Username">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" value="Login" class="btn btn-outline-danger float-right login_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>