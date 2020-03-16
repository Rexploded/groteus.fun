<style>
.media-heading{
	display:block;
} 
</style>
            <div id="content" class="flex ">
                <!-- ############ Main START-->
                <div>
                    <div class="page-hero page-container " id="page-hero">
                        <div class="padding d-flex">
                            <div class="page-title">
                                <h2 class="text-md text-highlight">{title}</h2>
                                <small class="text-muted">{desc}</small>
                            </div>
                            <div class="flex"></div>
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">
                        
						
						
						
						
						
						
						
						
				

                        <div class="padding">
 





                            <div class="mb-5">
							
<form method="POST" action="/admin/ajax/settings/save" class="ajax-form">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">							
                               <div class="col-sm-12 m-0 p-0">
                                    <div class="card">
                                        <div class="b-b">
                                            <div class="nav-active-border b-success top">
                                                <ul class="nav" id="myTab" role="tablist">
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="true"><i class="fa fa-cog"></i> Общие</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-envelope-o"></i> Почта</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-upload"></i> Файлы</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content p-0">
                                            <div class="tab-pane fade p-0" id="home4" role="tabpanel" aria-labelledby="home-tab">

                                       <div class="card-body p-0 table-responsive">

<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Системный E-Mail адрес администратора:</h8>
									<span class="text-muted text-size-small hidden-xs">Введите E-Mail адрес администратора сайта. От имени данного адреса будут отправляться служебные сообщения скрипта, например уведомления пользователей о новом персональном сообщении и т.д. А также на этот адрес будут отправляться системные уведомления для администрации сайта, например, уведомления о новых комментариях и т.д.</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="email" class="form-control" name="sys_mail_send_mail" value="<?=$this->CONFIG->get('sys_mail_send_mail')?>">
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Заголовок отправителя писем, при отправке писем:</h8>
									<span class="text-muted text-size-small hidden-xs">При отправке писем с сайта вы можете указать заголовок, который будет добавляться к почте отправителя. Например, вы можете там указать краткое название вашего сайта</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="sys_mail_subject" value="<?=$this->CONFIG->get('sys_mail_subject')?>">
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Метод отправки почты:</h8>
									<span class="text-muted text-size-small hidden-xs">Если функция PHP mail() недоступна, выберите метод SMTP</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name="sys_mail_metod" class="form-control">
										<option value="php" <?=($this->CONFIG->get('sys_mail_metod') == 'php') ? 'selected' : ''?>>PHP Mail()</option>
										<option value="smtp" <?=($this->CONFIG->get('sys_mail_metod') == 'smtp') ? 'selected' : ''?>>SMTP</option>
									</select>
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">SMTP хост:</h8>
									<span class="text-muted text-size-small hidden-xs">Обычно — localhost</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="sys_mail_smtp_host" value="<?=$this->CONFIG->get('sys_mail_smtp_host')?>">
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">SMTP порт:</h8>
									<span class="text-muted text-size-small hidden-xs">Обычно — 25</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="sys_mail_smtp_port" value="<?=$this->CONFIG->get('sys_mail_smtp_port')?>">
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">SMTP Имя пользователя:</h8>
									<span class="text-muted text-size-small hidden-xs">Не требуется в большинстве случаев, когда используется 'localhost'</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="sys_mail_smtp_user" value="<?=$this->CONFIG->get('sys_mail_smtp_user')?>">
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">SMTP Пароль:</h8>
									<span class="text-muted text-size-small hidden-xs">Не требуется в большинстве случаев, когда используется 'localhost'</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="sys_mail_smtp_pass" value="<?=$this->CONFIG->get('sys_mail_smtp_pass')?>">
								</td>
							</tr>



							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Использовать защищенный протокол для отправки писем через SMTP сервер:</h8>
									<span class="text-muted text-size-small hidden-xs">Выберите протокол шифрования при отправке писем с использованием SMTP сервера</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name="sys_mail_smtp_secure" class="form-control">
										<option value="" <?=($this->CONFIG->get('sys_mail_smtp_secure') == '') ? 'selected' : ''?>>Нет</option>
										<option value="ssl" <?=($this->CONFIG->get('sys_mail_smtp_secure') == 'ssl') ? 'selected' : ''?>>SSL</option>
										<option value="tls" <?=($this->CONFIG->get('sys_mail_smtp_secure') == 'tls') ? 'selected' : ''?>>TLS</option>
									</select>
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">E-mail для авторизации на SMTP сервере в качестве отправителя:</h8>
									<span class="text-muted text-size-small hidden-xs">Данная настройка является необязательной, однако некоторые бесплатные почтовые сервисы, например yandex.ru, требуют, чтобы в качестве E-mail адреса отправителя был указан именно адрес, зарегистрированный на их почтовом сервисе.</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="sys_mail_smtp_mail" value="<?=$this->CONFIG->get('sys_mail_smtp_mail')?>">
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Использовать поле BCC для рассылки:</h8>
									<span class="text-muted text-size-small hidden-xs">Если вы выберете 'Включено' то при рассылке сообщений в качестве получателей будет указано несколько адресатов, что позволяет сократить общее время отправки сообщений и количество отправленных сообщений.</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="sys_mail_bcc" value="1" <?=($this->CONFIG->get('sys_mail_bcc')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>
						</table>

                                        </div>
                                            </div>        
                                            <div class="tab-pane fade show active" id="contact4" role="tabpanel" aria-labelledby="contact-tab">



                                      <div class="card-body p-0 table-responsive">

<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Название сайта:</h8>
									<span class="text-muted text-size-small hidden-xs">Например: "Моя домашняя страница"</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="site_title" value="<?=$this->CONFIG->get('site_title')?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Используемый по умолчанию язык:</h8>
									<span class="text-muted text-size-small hidden-xs">Выберите язык, который будет использоваться по умолчанию при работе с системой</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
											<select class="form-control" name="default_language">
											<?php foreach($this->system->get_lang_list() as $k=>$v){ ?>
												<option value="<?=$v['SYMBOL']?>" <?=($this->CONFIG->get('default_language') == $v['SYMBOL']) ? 'selected' : ''?>><?=$v['NAME']?></option>
											<?php } ?>						
											</select>
								</td>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Регистрировать новых пользователей в группе:</h8>
									<span class="text-muted text-size-small hidden-xs">Выберите группу в которую будут помещены новые пользователи после регистрации</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name="sys_reg_group" class="form-control">
														<?php foreach($this->users->GetUserGroups() as $k=>$v){ ?>
															<option value="<?=$v['id']?>"  <?=($this->CONFIG->get('sys_reg_group') == $v['id']) ? 'selected' : ''?>><?=$v['name']?></option>
														<?php } ?>
									</select>
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Способ регистрации на сайте:</h8>
									<span class="text-muted text-size-small hidden-xs">При включении упрощенной системы регистрации не будет отсылаться письмо с активацией аккаунта</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name="registration_type" class="form-control">
										<option value="0" <?=($this->CONFIG->get('registration_type') == 0) ? 'selected' : ''?> >Упрощенный</option>
										<option value="1" <?=($this->CONFIG->get('registration_type') == 1) ? 'selected' : ''?>>Расширенный</option>
									</select>
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Код безопасности (reCAPTCHA):</h8>
									<span class="text-muted text-size-small hidden-xs">Отображение кода безопасности при регистрации для защиты от автоматической регистрации</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="sys_reg_allow_sec_code" value="1" <?=($this->CONFIG->get('sys_reg_allow_sec_code')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Публичный ключ сервиса reCAPTCHA::</h8>
									<span class="text-muted text-size-small hidden-xs">Получить ключ вы можете по ссылке: http://www.google.com/recaptcha Внимание, настоятельно рекомендуется зарегистрироваться на сервисе и сгенерировать для своего сайта уникальную пару ключей, установив разрешение на использование только на своем домене. Использование стандартной пары ключей, не дает должного эффекта по защите от спам роботов.</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="recaptcha_public_key" value="<?=$this->CONFIG->get('recaptcha_public_key')?>">
								</td>
							</tr>
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Секретный ключ сервиса reCAPTCHA:</h8>
									<span class="text-muted text-size-small hidden-xs">Получить ключ вы можете по ссылке: http://www.google.com/recaptcha Внимание, настоятельно рекомендуется зарегистрироваться на сервисе и сгенерировать для своего сайта уникальную пару ключей, установив разрешение на использование только на своем домене. Использование стандартной пары ключей, не дает должного эффекта по защите от спам роботов.</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="recaptcha_private_key" value="<?=$this->CONFIG->get('recaptcha_private_key')?>">
								</td>
							</tr>
							
							
							
							
							
							
							</tr>
						</table>




                                        </div>




                                            </div>
											
											
                                           <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab">
										   
										   
                                       <div class="card-body p-0 table-responsive">

<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Разрешить загрузку файлов в сообщениях:</h8>
									<span class="text-muted text-size-small hidden-xs">Будет разрешена загрузка не только картинок в сообщениях, но и других разрешеных файлов</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="sys_messages_allow_files_upload" value="1" <?=($this->CONFIG->get('sys_messages_allow_files_upload')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Расширения файлов, разрешенных в сообщениях:</h8>
									<span class="text-muted text-size-small hidden-xs">Укажите через | расширения для файлов, которые разрешено отправлять в сообщениях</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="messages_allow_files_upload" value="<?=$this->CONFIG->get('messages_allow_files_upload')?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Максимальный размер файла допустимый к загрузке в сообщениях (в килобайтах):</h8>
									<span class="text-muted text-size-small hidden-xs">Введите максимальный размер файлов которые допустимо загружать на сервер. Данный размер указывается в килобайтах, например для ограничения размера файла в 2 мегабайта, в настройках указывается 2048. Если вы хотите снять ограничение, то укажите в настройках 0.</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="number" class="form-control" name="messages_files_upload_max_size" value="<?=$this->CONFIG->get('messages_files_upload_max_size')?>">
								</td>
							</tr>
							
							
							
							
							
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Расширения файлов, разрешенных для аватара:</h8>
									<span class="text-muted text-size-small hidden-xs">Укажите через | расширения для файлов, которые разрешено загружать для аватара</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" class="form-control" name="avatar_allow_files_upload" value="<?=$this->CONFIG->get('avatar_allow_files_upload')?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Максимальный размер файла допустимый к загрузке для аватара:</h8>
									<span class="text-muted text-size-small hidden-xs">Введите максимальный размер файлов которые допустимо загружать на сервер. Данный размер указывается в килобайтах, например для ограничения размера файла в 2 мегабайта, в настройках указывается 2048. Если вы хотите снять ограничение, то укажите в настройках 0.</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="number" class="form-control" name="system_image_max_up_size" value="<?=$this->CONFIG->get('system_image_max_up_size')?>">
								</td>
							</tr>
						</table>




                                        </div>										   
										   
										   
                                        </div>
                                    </div>
                                </div>							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
 

                            </div>
							
							
							
							<div class="col-sm-12 m-0 p-0">
							<button type="submit" class="btn btn-success btn-block">Сохранить</button>
                            </div>
							
							</form>







 </div>
						
						
						
                    </div>						
						
						
						
						
						
						
						
						
						
						
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>