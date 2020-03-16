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

<form method="POST" action="/admin/mail">
<input type="hidden" name="send" value="1">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">
						<div class="padding">



<div class="alert bg-info mb-5 py-4" role="alert">
                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                            <div class="px-3">
                                                <h5 class="alert-heading">Внимание!</h5>
                                                <p>В своем сообщении вы можете использовать тег {%user%}, который будет заменен на логин получателя в сообщении, или на полное имя, если пользователь его указывал в своем профиле.</p>
												<p>Если в настройках скрипта включено использование поля BCC для рассылки, то тег будет заменен на слово: Пользователь. </p>
												
                                            </div>
                                        </div>
                                    </div>



										<div class="card">
											<div class="card-header">
												Настройки
											</div>
											<div class="card-body">
												
                                                <div class="form-group">
                                                    <label class="text-muted" for="exampleInputEmail1">Тип сообщения:</label>
                                                    <select class="form-control" name="type">
														<option value="0" <?=($this->input->post('type') == 0) ? 'selected' : ''?>>E-mail</option>
														<option value="1" <?=($this->input->post('type') == 1) ? 'selected' : ''?>>Сообщение</option>
													</select>
                                                </div>
												
                                                <div class="form-group">
                                                    <label class="text-muted" for="exampleInputEmail1">Группы:</label>
														<select data-plugin="select2" id="user_groups" class="select2-multiple form-control" name="user_groups[]" data-placeholder="Всем" multiple>
														<option value="0" <?=($this->input->post('send') != 1) ? 'selected' : ''?><?=(in_array(0,$this->input->post('user_groups'))) ? 'selected' : ''?>>Все</option>
														<?php foreach($this->users->GetUserGroups() as $k=>$v){ ?>
															<option value="<?=$v['id']?>"  <?=(in_array($v['id'],$this->input->post('user_groups'))) ? 'selected' : ''?>><?=$v['name']?></option>
														<?php } ?>
														</select>
                                                </div>
												
                                                <div class="form-group">
                                                    <label class="text-muted" for="start_reg">Дата регистрации:</label>
														<div class='input-group input-daterange mb-3' data-plugin="datepicker" data-option="{format: 'dd.mm.yyyy'}">
															<div class="input-group-prepend">
																<span class="input-group-text">от</span>
															</div>
															<input type='text' class="form-control" name="start_reg" value="<?=$this->input->post('start_reg')?>">
															<div class="input-group-prepend">
																<span class="input-group-text">до</span>
															</div>
															<input type='text' class="form-control" name="end_reg" value="<?=$this->input->post('end_reg')?>">
														</div>
                                                </div>
												
                                                <div class="form-group">
                                                    <label class="text-muted" for="start_online">Дата последнего посещения:</label>
														<div class='input-group input-daterange mb-3' data-plugin="datepicker" data-option="{format: 'dd.mm.yyyy'}">
															<div class="input-group-prepend">
																<span class="input-group-text">от</span>
															</div>
															<input type='text' class="form-control" name="start_online" value="<?=$this->input->post('start_online')?>">
															<div class="input-group-prepend">
																<span class="input-group-text">до</span>
															</div>
															<input type='text' class="form-control" name="end_online" value="<?=$this->input->post('end_online')?>">
														</div>
                                                </div>
												
											<div class="form-group">
												<label class="text-muted" for="text">Заголовок</label>
												<input type="text" name="title" class="form-control" value="<?=$this->input->post('title')?>">
											</div>
												
											<div class="form-group">
												<label class="text-muted" for="text">Сообщение</label>
												<div  style="background: aliceblue !important;"><textarea class="form-control" rows="8" id="text" name="message" data-plugin="summernote" data-option="{minHeight: 150}"><?=$this->input->post('message')?></textarea></div>
											</div>
												<button class="btn btn-success btn-block" type="submit">Начать рассылку</button>
											</div>
										</div>








						</div>
						</form>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>