<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>[config:site_title] | {lang=reg_title}</title>
        <meta name="description" content="Responsive, Bootstrap, BS4" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- style -->
        <!-- build:css /assets/css/site.min.css -->
        <link rel="stylesheet" href="/assets/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="/assets/css/theme.css" type="text/css" />
        <link rel="stylesheet" href="/assets/css/style.css" type="text/css" />
        <!-- endbuild -->
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                        <div class="p-3 p-md-5" id="bod">
                            <h5>Добро пожаловать</h5>
                            <p>
                                <small class="text-muted">Зарегистрируйте аккаунт</small>
                            </p>



                            <form method="POST" action="/register" class="ajax-form">
							<input type="hidden" name="{csrf_name}" value="{csrf_value}">
							<input type="hidden" name="register" value="1">
                                <div class="form-group">
                                    <label>Язык сайта</label>
											<select onchange="ChangeLang(this)" class="form-control" id="basic_plan" name="language" required>
											<?php foreach($this->system->get_lang_list() as $k=>$v){ ?>
												<option value="<?=$v['SYMBOL']?>" <?=($this->config->item('language') == $this->config->item('language')) ? 'selected' : ''?>><?=$v['NAME']?></option>
											<?php } ?>						
											</select>
                                </div>
                                <div class="form-group">
                                    <label>Страна</label>
											<select class="form-control" name="country" required>
												<?php foreach($this->config->item('country_codes') as $k=>$v){ ?>
												<option value="<?=$k?>" <?=($this->system->GetCountryCodeByIp($this->input->ip_address()) == $k) ? 'selected' : ''?>><?=$v?></option>
												<?php } ?>					
											</select>
                                </div>
                                <div class="form-group">
                                    <label>Логин</label>
                                    <input type="text" name="username" value="<?php echo set_value("username") ?>" class="form-control" placeholder="Enter username" required>
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" value="<?php echo set_value("email") ?>" class="form-control" placeholder="Enter email" required>
                                </div>
                                <div class="form-group">
                                    <label>Пароль</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label>Повторите пароль</label>
                                    <input type="passconf" name="passconf" class="form-control" placeholder="Password Confirmation" required>
                                </div>
                                <div class="checkbox mb-3">
                                    <label class="ui-check">
                                        <input name="rules" type="checkbox" required>
                                        <i></i> Согласен с <a href="/rules" target="blank">правилами</a>
                                    </label>
                                </div>
								<?=($this->CONFIG->get('sys_reg_allow_sec_code')) ? '<div class="g-recaptcha" data-sitekey="'.$this->CONFIG->get('recaptcha_public_key').'"></div>' : ''?>
								<input type="submit" value="Зарегистрироваться" class="btn btn-primary mb-4">
                                <div>У вас уже есть аккаунт? 
                                    <a href="/auth" class="text-primary">Войти</a>
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
        {*<script src="/assets/libs/pjax/pjax.min.js"></script>
        <script src="/assets/js/ajax.js"></script>*}
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
		<!-- Jquery mLoading-->
		<script src="/assets/js/plugins/mloading/jquery.mloading.js"></script>
		<link rel="stylesheet" href="/assets/js/plugins/mloading/jquery.mloading.css"> 
        <!-- endbuild -->

		<!-- Toastr -->
		<link rel="stylesheet" href="/assets/js/plugins/toastr/toastr.min.css?v=1"> 
		<script src="/assets/js/plugins/toastr/toastr.min.js"></script>		
		
<script>		
function ChangeLang(e){
	window.location.href = '/auth/lang/'+$(e).val();
}

$(function() {


$(document).on("submit",'.ajax-form', function (e) {
	e.preventDefault();
       var $form = $(this);
	   var form_data = new FormData($form.get(0));
		// Display the key/value pairs
		for(var pair of form_data.entries()) {
		   console.log(pair[0]+ ', '+ pair[1]); 
		}
		ShowLoad('body');
		console.log($form.serialize());
        $.ajax({
          type: $form.attr('method'),
          url: $form.attr('action'),
		  dataType: 'json',
                contentType: false,
                processData: false,
          data: form_data
        }).done(function(data) {
			console.log(data);
            if(data.response == 'error'){
				$.each(data.errors, function( index, value ) {
					$('[name="'+index+'"]').closest('.form-group').addClass('has-error');
					Alert('danger','Внимание!',value );
				});
				grecaptcha.reset();
			}else if(data.response == 'success'){
				//$('#addevent-modal').modal('hide');

				$('#modal-create').modal('hide');
				if(data.location){
					window.location.href = data.location;
				}
				if(data.reload){
					window.location.reload();
				}else{
					$('.w-xl').css('width','100%');
					$('#bod').html('<b>Отправлен запрос на активацию</b><br> Запрос на регистрацию принят.<br><br>Администрация сайта требует реальности всех вводимых e-mail-адресов. Через 10 минут (возможно и раньше) Вы получите письмо с инструкциями для следующего шага. Ещё немного, и Вы будете зарегистрированы на сайте. Если в течении этого времени Вы не получили письма с подтверждением, то возможно, оно попало в папку со спамом. Пожалуйста, проверьте содержимое этой папки. В противном случае повторите попытку, используя другой e-mail адрес или обратитесь к администратору сайта.');					
				}
				//window.location.href;
			}else{
				Alert('warning','Внимание!','Что-то пошло не так');
			}
		  HideLoad('body');
        }).fail(function() {
          Alert('danger','Внимание!','Возникла неизвестная ошибка');
		  grecaptcha.reset();
		  HideLoad('body');
        });
        //отмена действия по умолчанию для кнопки submit
        e.preventDefault();
})	  
	  
ShowLoad = function(e,a="Загрузка..."){
	$(e).mLoading({
	  mask:true,
	  text:a
	});	
}
HideLoad = function(e){
	$(e).mLoading('hide');
}	  
	  
Alert = function(t,i,m,d=50000){
switch (t) {
  case 'success':
    toastr.success(m,i,{'timeOut':d})	
    break;
  case 'warning':
    toastr.warning(m,i,{'timeOut':d})	
    break;
  case 'danger':
    toastr.error(m,i,{'timeOut':d})	
    break;
  case 'info':
    toastr.info(m,i,{'timeOut':d})	
    break;
  default:
    toastr.default(m,i,{'timeOut':d});	
}
	
}
});
</script>		
		
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