<!doctype html>
<html lang="en">
  <head>
    <title>Login - Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url("css/style.css") ?>">
  </head>
  <body>
    <div class="wrapper">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <?php echo $message; ?>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" name="email" placeholder="E-mail">
                                </div>
                                <?php echo form_error("email"); ?>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <?php echo form_error("password"); ?>
                                <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="<?php echo $site; ?>"></div>
                                </div>

                                <div class="form-group text-center">
                                    <button class="btn btn-dark btn-block" type="submit" name="loginbtn" value="login">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>