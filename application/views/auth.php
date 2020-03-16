<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>[config:site_title]</title>
        <meta name="description" content="Responsive, Bootstrap, BS4" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- style -->
        <!-- build:css /assets/css/site.min.css -->
        <link rel="stylesheet" href="/assets/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="/assets/css/theme.css" type="text/css" />
        <link rel="stylesheet" href="/assets/css/style.css" type="text/css" />
        <!-- endbuild -->
    </head>
    <body class="layout-row">
        <div class="flex">
            <div class="w-xl w-auto-sm mx-auto py-5">
                <div class="p-4 d-flex flex-column h-100">
                    <!-- brand -->
                    <a href="index.html" class="navbar-brand align-self-center">
                        <svg width="32" height="32" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <g class="loading-spin" style="transform-origin: 256px 256px">
                                <path d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z"></path>
                            </g>
                        </svg>
                        <!-- <img src="/assets/img/logo.png" alt="..."> -->
                        <span class="hidden-folded d-inline l-s-n-1x align-self-center">Basik</span>
                    </a>
                    <!-- / brand -->
                </div>
                <div class="card">
                    <div id="content-body">
                        <div class="p-3 p-md-5">
                            <h5>Добро пожаловать</h5>
                            <p>
                                <small class="text-muted">Войдите в свой аккаунт</small>
                            </p>

              <?php $error = $this->session->flashdata("error"); ?>
			  <?php if($error) { ?>
  						<div class="alert alert-<?php echo $error ? 'warning' : 'info' ?> alert-dismissible" role="alert">
  						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						  <?php echo $error ? $error : 'Enter your username and password' ?>
  						</div>
			  <?php } ?>

                            <?php echo form_open(); ?> 
                                <div class="form-group">
                                    <label>Логин</label>
                                    <input type="text" name="username" value="<?php echo set_value("username") ?>" class="form-control" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label>Пароль</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="my-3 text-right">
                                        <a href="forgot-password.html" class="text-muted">Забыли пароль?</a>
                                    </div>
                                </div>
                                <div class="checkbox mb-3">
                                    <label class="ui-check">
                                        <input type="checkbox">
                                        <i></i> Запомнить меня
                                    </label>
                                </div>
								<input type="submit" value="Login" class="btn btn-primary mb-4">
                                <div>У вас нет аккаунта?
                                    <a href="/register" class="text-primary">Зарегистрироваться</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-center text-muted">&copy; Copyright. Basik</div>
            </div>
        </div>
        <!-- build:js /assets/js/site.min.js -->
        <!-- jQuery -->
        <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- ajax page -->
        {*<script src="/assets/libs/pjax/pjax.min.js"></script>*}
        <script src="/assets/js/ajax.js"></script>
        <!-- lazyload plugin -->
        <script src="/assets/js/lazyload.config.js"></script>
        <script src="/assets/js/lazyload.js"></script>
        <script src="/assets/js/plugin.js"></script>
        <!-- scrollreveal -->
        <script src="/assets/libs/scrollreveal/dist/scrollreveal.min.js"></script>
        <!-- feathericon -->
        <script src="/assets/libs/feather-icons/dist/feather.min.js"></script>
        <script src="/assets/js/plugins/feathericon.js"></script>
        <!-- theme -->
        <script src="/assets/js/theme.js"></script>
        <script src="/assets/js/utils.js"></script>
        <!-- endbuild -->
    </body>
</html>


{*
<div class="container">
  		<div class="row login-wrapper">
  			<div class="col-md-4 col-xs-6 col-md-offset-4 col-xs-offset-3">
  				<div class="panel panel-default">
  					<div class="panel-heading">
  						<strong>Login Form</strong>
  					</div>
  					<div class="panel-body">  
              <?php $error = $this->session->flashdata("error"); ?>
  						<div class="alert alert-<?php echo $error ? 'warning' : 'info' ?> alert-dismissible" role="alert">
  						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						  <?php echo $error ? $error : 'Enter your username and password' ?>
  						</div>

  						<?php echo form_open(); ?>  
                <?php $error = form_error("username", "<p class='text-danger'>", '</p>'); ?>              
  							<div class="form-group <?php echo $error ? 'has-error' : '' ?>">
  								<label for="username">Username</label>
  								<div class="input-group">
  									<span class="input-group-addon">
  										<i class="glyphicon glyphicon-user"></i>
  									</span>
  									<input type="text" name="username" value="<?php echo set_value("username") ?>" id="username" class="form-control">
  								</div>  
                  <?php echo $error; ?>
  							</div>
                <?php $error = form_error("password", "<p class='text-danger'>", '</p>'); ?>
  							<div class="form-group <?php echo $error ? 'has-error' : '' ?>">
  								<label for="password">Password</label>
  								<div class="input-group">
  									<span class="input-group-addon">
  										<i class="glyphicon glyphicon-lock"></i>
  									</span>
  									<input type="password" name="password" id="password" class="form-control">
  								</div> 
                  <?php echo $error; ?>
  							</div>
  							<input type="submit" value="Login" class="btn btn-primary">
  						<?php echo form_close(); ?>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
*}