            <div id="content" class="flex ">
                <!-- ############ Main START-->
                <div>
                    <div class="page-hero page-container " id="page-hero">
                        <div class="padding d-flex">
                            <div class="page-title">
                                <h2 class="text-md text-highlight">{title}</h2>
                                <small class="text-muted">{desc}</small>
                            </div>
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">




                        <div class="padding">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
										<div class="card-header">
                                            Шаблоны биллинга
                                        </div>
										<div class="card-body">
										
<form method="POST" action="/admin/ajax/mail/templates/save" class="ajax-form">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">										
										
                                    <div id="accordion" class="mb-0">
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_1">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" aria-controls="collapse_1">
                                                    Настройка E-Mail сообщения, которое отсылается для активации аккаунта
                                                </a>
                                            </div>
                                            <div id="collapse_1" class="collapse" aria-labelledby="heading_1" data-parent="#accordion">
                                                <div class="card-body">
													<p>При написании шаблона для данного сообщения вы можете использовать следующие теги:<br>
													<b>{%username%}</b> - имя пользователя желающего зарегистрироваться<br>
													<b>{%email%}</b> - E-Mail пользователя желающего зарегистрироваться<br>
													<b>{%validationlink%}</b> - ссылка на активацию аккаунта<br>
													<b>{%password%}</b> - пароль пользователя, введенный при регистрации</p>
                                                    <textarea class="form-control" name="reg_mail_text" rows="15"><?=$this->CONFIG->get('reg_mail_text')?></textarea>
													<br><hr>
                                                    <label class="ui-check m-0">
                                                        <input name="reg_mail_html" value="1" type="checkbox" <?=($this->CONFIG->get('reg_mail_html') == 'html')? 'checked' : ''?>>
                                                        <i></i>Использовать HTML формат для данного письма
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_2">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="false" aria-controls="collapse_2">
                                                    Настройка E-Mail сообщения, которое отсылается через форму обратной связи
                                                </a>
                                            </div>
                                            <div id="collapse_2" class="collapse" aria-labelledby="heading_2" data-parent="#accordion">
                                                <div class="card-body">
													<p>При написании шаблона для данного сообщения вы можете использовать следующие теги:</br>
													<b>{%username_to%}</b> - имя получателя</br>
													<b>{%username_from%}</b> - имя отправителя</br>
													<b>{%group%}</b> - группа пользователя на сайте, в которой находится отправитель</br>
													<b>{%text%}</b> - текст сообщения от пользователя</br>
													<b>{%ip%}</b> - IP адрес отправителя</br>
													<b>{%email%}</b> - E-mail адрес отправителя письма</p>
                                                    <textarea class="form-control" name="feed_mail_text" rows="15"><?=$this->CONFIG->get('feed_mail_text')?></textarea>
													<br><hr>
                                                    <label class="ui-check m-0">
                                                        <input name="feed_mail_html" value="1" type="checkbox" <?=($this->CONFIG->get('feed_mail_html') == 'html')? 'checked' : ''?>>
                                                        <i></i>Использовать HTML формат для данного письма
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_4">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="false" aria-controls="collapse_4">
                                                    Настройка E-Mail сообщения, которое отсылается для восстановления забытого пароля
                                                </a>
                                            </div>
                                            <div id="collapse_4" class="collapse" aria-labelledby="heading_4" data-parent="#accordion">
                                                <div class="card-body">
													<p>При написании шаблона для данного сообщения вы можете использовать следующие теги:<br>
													<b>{%username%}</b> - имя пользователя<br>
													<b>{%lostlink%}</b> - ссылка на генерацию пароля и ссылка на сброс блокировки по IP<br>
													<b>{%losturl%}</b> - URL на сброс и генерацию нового пароля<br>
													<b>{%ipurl%}</b> - URL на сброс блокировки по IP<br>
													<b>{%ip%}</b> - IP адрес отправителя</p>
                                                    <textarea class="form-control" name="lost_mail_text" rows="15"><?=$this->CONFIG->get('lost_mail_text')?></textarea>
													<br><hr>
                                                    <label class="ui-check m-0">
                                                        <input name="lost_mail_html" value="1" type="checkbox" <?=($this->CONFIG->get('lost_mail_html') == 'html')? 'checked' : ''?>>
                                                        <i></i>Использовать HTML формат для данного письма
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_5">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" aria-controls="collapse_5">
                                                    Настройка E-Mail сообщения, которое отсылается при получении нового персонального сообщения
                                                </a>
                                            </div>
                                            <div id="collapse_5" class="collapse" aria-labelledby="heading_5" data-parent="#accordion">
                                                <div class="card-body">
												<p>При написании шаблона для данного сообщения вы можете использовать следующие теги:<br>
												<b>{%username%}</b> - пользователь, получивший персональное сообщение<br>
												<b>{%date%}</b> - дата получения сообщения<br>
												<b>{%fromusername%}</b> - логин отправителя<br>
												<b>{%title%}</b> - заголовок сообщения<br>
												<b>{%text%}</b> - текст сообщения<br>
												<b>{%url%}</b> - ссылка на просмотр полученного сообщения на сайте</p>
                                                    <textarea class="form-control" name="new_pm_text" rows="15"><?=$this->CONFIG->get('new_pm_text')?></textarea>
													<br><hr>
                                                    <label class="ui-check m-0">
                                                        <input name="new_pm_html" value="1" type="checkbox" <?=($this->CONFIG->get('new_pm_html') == 'html')? 'checked' : ''?>>
                                                        <i></i>Использовать HTML формат для данного письма
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_6">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_6" aria-expanded="false" aria-controls="collapse_6">
                                                    Настройка E-Mail сообщения, которое отсылается при использовании рассылки писем в админпанели
                                                </a>
                                            </div>
                                            <div id="collapse_6" class="collapse" aria-labelledby="heading_6" data-parent="#accordion">
                                                <div class="card-body">
													<p>При написании шаблона для данного сообщения вы можете использовать следующие теги:<br>
													<b>{%title%}</b> - заголовок рассылаемого сообщения<br>
													<b>{%content%}</b> - текст рассылаемого сообщения, написанный в редакторе перед отправкой сообщений<br>
													<b>{%charset%}</b> - кодировка вашего сайта<br>
													<b>{%unsubscribe%}</b> - Ссылка для того чтобы отписаться от получаемой рассылки</p>
                                                    <textarea class="form-control" name="new_newsletter_text" rows="15"><?=$this->CONFIG->get('new_newsletter_text')?></textarea>
													<br><hr>
                                                    <label class="ui-check m-0">
                                                        <input name="new_newsletter_html" value="1" type="checkbox" <?=($this->CONFIG->get('new_newsletter_html') == 'html')? 'checked' : ''?>>
                                                        <i></i>Использовать HTML формат для данного письма
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_7">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_7" aria-expanded="false" aria-controls="collapse_7">
                                                    Настройка E-Mail сообщения, которое отсылается при изменении баланса
                                                </a>
                                            </div>
                                            <div id="collapse_7" class="collapse" aria-labelledby="heading_7" data-parent="#accordion">
                                                <div class="card-body">
													<p>При написании шаблона для данного сообщения вы можете использовать следующие теги:<br>
													<b>{%username%}</b> - пользователь, получивший персональное сообщение<br>
													<b>{%date%}</b> - дата получения сообщения<br>
													<b>{%amount%}</b> - сумма пополнения/траты<br>
													<b>{%declines_amount%}</b> - склонение суммы</p>
													<b>{%comment%}</b> - комментарий<br>
													<b>{%balacne%}</b> - доступный остаток<br>
													<b>{%declines_balacne%}</b> - склонение доступного остатка</p>
                                                    <textarea class="form-control" name="billing_notif_mail_balancechangeadmin_text" rows="15"><?=$this->CONFIG->get('billing_notif_mail_balancechangeadmin_text')?></textarea>
													<br><hr>
                                                    <label class="ui-check m-0">
                                                        <input name="billing_plus_mail_type" value="1" type="checkbox" <?=($this->CONFIG->get('billing_plus_mail_type') == 'html')? 'checked' : ''?>>
                                                        <i></i>Использовать HTML формат для данного письма
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
										{*
										

										
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_8">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_8" aria-expanded="false" aria-controls="collapse_8">
                                                    Настройка E-Mail сообщения, которое отсылается для активации аккаунта
                                                </a>
                                            </div>
                                            <div id="collapse_8" class="collapse" aria-labelledby="heading_8" data-parent="#accordion">
                                                <div class="card-body">
                                                    <textarea class="form-control" rows="15"><?=$this->CONFIG->get('reg_mail_text')?></textarea>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_9">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_9" aria-expanded="false" aria-controls="collapse_9">
                                                    Настройка E-Mail сообщения, которое отсылается для активации аккаунта
                                                </a>
                                            </div>
                                            <div id="collapse_9" class="collapse" aria-labelledby="heading_9" data-parent="#accordion">
                                                <div class="card-body">
                                                    <textarea class="form-control" rows="15"><?=$this->CONFIG->get('reg_mail_text')?></textarea>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_10">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_10" aria-expanded="false" aria-controls="collapse_10">
                                                    Настройка E-Mail сообщения, которое отсылается для активации аккаунта
                                                </a>
                                            </div>
                                            <div id="collapse_10" class="collapse" aria-labelledby="heading_10" data-parent="#accordion">
                                                <div class="card-body">
                                                    <textarea class="form-control" rows="15"><?=$this->CONFIG->get('reg_mail_text')?></textarea>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="card mb-1">
                                            <div class="card-header no-border" id="heading_11">
                                                <a href="#" data-toggle="collapse" data-target="#collapse_11" aria-expanded="false" aria-controls="collapse_11">
                                                    Настройка E-Mail сообщения, которое отсылается для активации аккаунта
                                                </a>
                                            </div>
                                            <div id="collapse_11" class="collapse" aria-labelledby="heading_11" data-parent="#accordion">
                                                <div class="card-body">
                                                    <textarea class="form-control" rows="15"><?=$this->CONFIG->get('reg_mail_text')?></textarea>
                                                </div>
                                            </div>
                                        </div>										
										
										*}
										
										
                                    </div>
										
						<button type="submit" class="btn btn-success btn-block">Сохранить</button>
										</form>
										
										
										
										</div>
									</div>
								</div>
							</div>
						</div>
















                    </div>
                </div>
                <!-- ############ Main END-->
            </div>