
            <!-- ############ Content START-->
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
                            <div id="accordion">
                                <p class="text-muted">
                                    <strong>{desc}</strong>
                                </p>
                                <div class="card">
                                    <div class="d-flex align-items-center px-4 py-3 b-t">
                                        <div>
                                            <span class="w-48 avatar circle bg-info-lt" >
            <img src="<?=$USER['avatar']?>" alt=".">
          </span>
                                        </div>
                                        <div class="mx-3">
                                            <strong><?=$USER['username']?></strong>
                                            <div class="text-sm text-muted"><?=$USER['email']?></div>
                                        </div>
                                        <div class="flex"></div>
                                    </div>
                                    <div class="d-flex align-items-center px-4 py-3 b-t pointer" >
                                        <i data-feather="lock"></i>
                                        <div class="px-3">
                                            <div>Профиль</div>
                                        </div>
                                        <div class="flex"></div>
                                        <div>
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="p-4" id="c_2">
                                        <form role="form">
                                            <div class="form-group">
                                                <label>Аватар:</label>
                                                <div class="custom-file">
                                                    <input type="file" name="customFile" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Выберите файл</label>
                                                </div>
                                            </div>
											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="remove_avatar" type="checkbox">
                                                            <i class="blue"></i>
                                                            Удалить аватар
                                                        </label>
											</div>
                                            <div class="form-group">
                                                <label>Новый логин:</label>
                                                <input type="text" name="editusername" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Новый пароль:</label>
                                                <input type="text" name="editpass" class="form-control">
                                            </div>
											<hr>
                                            <div class="form-group">
											<label>Группа:</label>
											<select class="form-control" name="user_group">
											<option>---</option>
											<?php foreach($this->users->GetUserGroups() as $k=>$v){ ?>
												<option value="<?=$v['id']?>" <?=($USER['user_group'] == $v['id']) ? 'selected' : ''?>><?=$v['name']?></option>
											<?php } ?>						
											</select>
                                            </div>
                                            <div class="form-group">
                                                <label>В группе до:</label>
                                                <input type="text" class="form-control datetimepicker-input datetimepicker" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5"/>
                                            </div>
											<hr>
											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="ban" type="checkbox"  <?=($USER['ban'] == 1) ? 'checked' : ''?>>
                                                            <i class="blue"></i>
                                                            Забанен
                                                        </label>
											</div>
                                            <div class="form-group">
                                                <label>Срок окончания бана (в часах):</label>
                                                <input type="number" min='0' step="1" name="editusername" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Причина бана:</label>
                                                <textarea rows="3" name="editusername" class="form-control"><?=$USER['ban_reason']?></textarea>
                                            </div>
											<hr>
											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="remove_avatar" type="checkbox">
                                                            <i class="blue"></i>
                                                            Получать уведомления о изменении баланса
                                                        </label>
											</div>
											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="remove_avatar" type="checkbox">
                                                            <i class="blue"></i>
                                                            Получать рассылку с сайта
                                                        </label>
											</div>
                                        </form>
                                    </div>
									
                                    <div class="d-flex align-items-center px-4 py-3 b-t pointer">
                                        <i data-feather="credit-card"></i>
                                        <div class="px-3">
                                            <div>Реквизиты</div>
                                        </div>
                                        <div class="flex"></div>
                                        <div>
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="p-4" id="c_3">
                                        <form role="form">
                                            <div class="form-group">
                                                <label>Реквизиты по умолчанию</label>
                                                <input type="input" class="form-control">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="d-flex align-items-center px-4 py-3 b-t pointer" >
                                        <i data-feather="user-plus"></i>
                                        <div class="px-3">
                                            <div>Партнерская программа</div>
                                        </div>
                                        <div class="flex"></div>
                                        <div>
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="p-4" id="c_4">
                                        <form role="form">
											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="refferals_stop" type="ratio" <?=($USER['refferals_stop'] == 1) ? 'checked' : ''?>>
                                                            <i class="red"></i>
                                                            Запретить участие <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info" data-toggle="popover" data-trigger="hover" data-html="true" data-content="Полностью запретить участие в партнерской программе"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>
                                                        </label>
											</div>
											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="refferals_success" type="ratio" <?=($USER['refferals_success'] == 1) ? 'checked' : ''?>>
                                                            <i class="green"></i>
                                                            Индивидуальные условия <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info" data-toggle="popover" data-trigger="hover" data-html="true" data-content="Позволит создать индивидуальные условия партнерской программы для данного пользователя."><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>
                                                        </label>
											</div>
											
											
											
											

								<div class="p-5">
								<div class="remove"></div>
									
							<button type="button" onclick="AddRule()" class="btn btn-success btn-block"><i class="fas fa-plus"></i> Добавить правило</button>
									
									
									
                                </div>											
											
											
											
											
											

                                            <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
                                        </form>
                                    </div>
                                </div>
								
                                <p class="text-muted">
                                    <strong>Не получать писем с сайта (никаких)</strong>
                                </p>
                                <div class="card">
                                    <div class="d-flex align-items-center px-4 py-3 b-t pointer red" data-toggle="collapse" data-parent="#accordion" data-target="#c_5">
                                        <div>Отключить получение писем</div>
                                        <div class="flex"></div>
                                        <div>
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="collapse p-4" id="c_5">
                                        <div class="py-3" id="disable_mail">
                                            <p>В случает отключения писем с сайта станет невозможным восстановление пароля</p>
                                            <button type="button" class="btn btn-primary" data-toggle="collapse" data-parent="#accordion" data-target="#c_5">Не уверен</button>
                                            <button type="button" class="btn btn-danger" onclick="DisableMail()">Уверен</button>
                                        </div>
                                        <div class="py-3" id="disable_mail_yes" style="display:none;">

											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="disabled_mail" type="checkbox" checked disabled>
                                                            <i class="red"></i>
                                                            ОТКЛЮЧИТЬ ПОЧТУ
                                                        </label>
											</div>
                                        </div>
                                    </div>
                                </div>								
								
                                <p class="text-muted">
                                    <strong>Индивидуальные</strong>
                                </p>
                                <div class="card">
                                    <div class="d-flex align-items-center px-4 py-3">
                                        <div>Запретить все диллерские функции</div>
                                        <div class="flex"></div>
                                        <span>
              <label class="ui-switch ui-switch-md">
                <input type="checkbox">
                <i></i>
              </label>
          </span>
                                    </div>
                                    <div class="d-flex align-items-center px-4 py-3 b-t">
                                        <div>Anyone follow me</div>
                                        <div class="flex"></div>
                                        <span>
              <label class="ui-switch ui-switch-md">
                <input type="checkbox" checked>
                <i></i>
              </label>
          </span>
                                    </div>
                                    <div class="d-flex align-items-center px-4 py-3 b-t">
                                        <div>Anyone send me a message</div>
                                        <div class="flex"></div>
                                        <span>
              <label class="ui-switch ui-switch-md">
                <input type="checkbox" checked>
                <i></i>
              </label>
          </span>
                                    </div>
                                    <div class="d-flex align-items-center px-4 py-3 b-t">
                                        <div>Anyone invite me to group</div>
                                        <div class="flex"></div>
                                        <span>
              <label class="ui-switch ui-switch-md">
                <input type="checkbox">
                <i></i>
              </label>
          </span>
                                    </div>
                                    <div class="d-flex align-items-center px-4 py-3 b-t">
                                        <div>Update</div>
                                        <div class="flex"></div>
                                        <span>
              <label class="ui-switch ui-switch-md">
                <input type="checkbox" checked>
                <i></i>
              </label>
          </span>
                                    </div>
                                </div>
                                <p class="text-muted">
                                    <strong>Emails</strong>
                                </p>
                                <div class="card">
                                    <div class="d-flex align-items-center px-4 py-3">
                                        <div>Anyone posts a comment on my post</div>
                                        <div class="flex"></div>
                                        <span>
            <label class="ui-switch ui-switch-md">
              <input type="checkbox">
              <i></i>
            </label>
        </span>
                                    </div>
                                    <div class="d-flex align-items-center px-4 py-3 b-t">
                                        <div>Anyone follow me</div>
                                        <div class="flex"></div>
                                        <span>
            <label class="ui-switch ui-switch-md">
              <input type="checkbox" checked>
              <i></i>
            </label>
        </span>
                                    </div>
                                    <div class="d-flex align-items-center px-4 py-3 b-t">
                                        <div>Anyone repost</div>
                                        <div class="flex"></div>
                                        <span>
            <label class="ui-switch ui-switch-md">
              <input type="checkbox">
              <i></i>
            </label>
        </span>
                                    </div>
                                </div>
                                <p class="text-muted">
                                    <strong>Security</strong>
                                </p>
                                <div class="card">
                                    <div class="d-flex align-items-center px-4 py-3 b-t pointer" data-toggle="collapse" data-parent="#accordion" data-target="#c_5">
                                        <div>Delete account?</div>
                                        <div class="flex"></div>
                                        <div>
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="collapse p-4" id="c_5">
                                        <div class="py-3">
                                            <p>Are you sure to delete your account?</p>
                                            <button type="button" class="btn btn-white">No</button>
                                            <button type="button" class="btn btn-danger">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>






<script id="template" type="text/template">

									<div class="remove">
									<b><h5>Новое правило</h5></b>
												<div class="form-group">
													<label class="text-muted" for="action">Действие</label>
													<input type="text" class="form-control name="action[]" placeholder="Действие" required="">
												</div>
									
									
									
									
									<div class="form-group">
													<label class="text-muted" for="description">Описание</label>
													<input type="text" class="form-control" name="description[]" placeholder="Описание" required="">
												</div>
									
									
									
									
									<label class="text-muted" for="description">Сумма операции</label>
									<div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                    <select name="plusminus[]" class="form-control">
                                                        <option value="1">Приход</option>
                                                        <option value="0">Расход</option>
                                                    </select>
                                                    <select name="type[]" class="form-control">
                                                        <option value="0">Больше</option>
                                                        <option value="1">Меньше</option>
                                                        <option value="2">Равно</option>
                                                        <option value="3">Не равно</option>
                                                    </select>
                                        </div>
                                        <input type="text" name="summ[]" class="form-control" placeholder="" onchange="RepairSum2(this);" value="0.00" aria-label="" aria-describedby="basic-addon1">
										<div class="input-group-append"> <span class="input-group-text">[declines=10|<?=$this->CONFIG->get('billing_currency_decline')?>]</span> </div>
									</div>
									
									
									
									<label class="text-muted" for="amount1[]">Вознаграждение</label>
									<div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                    <select onchange="BeChanget(this)" name="type2" class="form-control">
                                                        <option value="1">Проценты</option>
                                                        <option value="0">Сумма</option>
                                                    </select>
                                        </div>
                                        <input type="text" style="display:none;" name="amount1[]" class="form-control" placeholder="" onchange="RepairSum2(this);" value="0.00" aria-label="" aria-describedby="basic-addon1">
										<div style="display:none;"  class="input-group-append">
											<span class="input-group-text" >[declines=10|<?=$this->CONFIG->get('billing_currency_decline')?>]</span> 
										</div>
										
                                        <input type="number" step='1' name="amount2[]" class="form-control" placeholder="" onchange="$(this).val(Number($(this).val()));" value="1" aria-label="" aria-describedby="basic-addon1">
										<div  class="input-group-append"> <span class="input-group-text">%</span> </div>
									</div>
									<div class="col-md-12"><button type="button" onclick="RemoveRule(this)" class="btn btn-danger btn-block"><i class="fas fa-minus" aria-hidden="true"></i> Удалить правило</button></div>
									</div>
</script>
			
<script>

function AddRule(){
	var template = $('#template').html();
	$( template ).insertAfter( ".remove" );
}

function RemoveRule(e){
	$(e).closest('.remove').remove();
}

function DisableMail(){
	$('#disable_mail').hide();
	$('#disable_mail_yes').show();
	$('[name=disabled_mail]').attr('disabled',false)
}
function BeChanget(e){
	console.log($(e).parent().next().next().html());
	if($(e).val() == 0){
		$(e).parent().next().next().next().hide();
		$(e).parent().next().next().next().next().hide();
		$(e).parent().next().show();
		$(e).parent().next().next().show();
	}else{
		$(e).parent().next().next().hide();
		$(e).parent().next().hide();
		$(e).parent().next().next().next().next().show();
		$(e).parent().next().next().next().show();
	}
}	
function RepairSum(e){ 
	var val = 11;
	$('[name=amount1]').val(parseFloat($('[name=amount1]').val()).toFixed(2));
	var say = declOfNum(val, ['<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[0]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[1]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[2]?>']);
	$('#decline2').html(say);
}		
function RepairSum2(e){ 
	var val = parseFloat($(e).val()).toFixed(2);
	$(e).val(val);
	var say = declOfNum(val, ['<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[0]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[1]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[2]?>']);
	$(e).next().children().html(say);
}

</script>	