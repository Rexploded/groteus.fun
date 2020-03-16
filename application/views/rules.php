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
        <div class="flex padding">
            <div class=" w-auto-sm mx-auto py-5">

                <div class="card">
                <div class="card-header">
				<h3>Правила сайта</h3>
				</div>
                    <div class="card-body" id="content-body">
					{RULES}
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