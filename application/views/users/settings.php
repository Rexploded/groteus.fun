<style>
select[readonly]{
    background: #eee;
    cursor:no-drop;
}

select[readonly] option{
    display:none;
}
</style>
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
					<form enctype='multipart/form-data' method="POST" class="ajax-form" action="/admin/ajax/users/edit/">
					<input type="hidden" name="{csrf_name}" value="{csrf_value}">
					<input type="hidden" name="user_id" value="<?=$USER['id']?>">
                        <div class="padding">
                            <div id="accordion">
                                <p class="text-muted">
                                    <strong>{desc}</strong>
                                </p>
								
								
								
								
								
								
								
<div class="alert bg-danger mb-5 py-4" role="alert" id="userdelete" style="<?=($USER['id']) ? 'display:none;' : ''?>">
                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                            <div class="px-3">
                                                <h5 class="alert-heading">Выполнено!</h5>
                                                <p>Такого пользователя не существует</p>
                                                <p>Пользователя с таким #ID не существует, или он был удален.</p>
                                                <a href="/admin/users/" class="btn btn-white mx-1">Вернуться назад
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>								
								
								
								
								
<?php if($USER['id']){ ?>	
							
                                <div  id="usercard">
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
											<hr>
                                            <div class="form-group">
                                                <label>Старый пароль:</label>
                                                <input type="text" name="editpass" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Новый пароль:</label>
                                                <input type="text" name="editpass" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Повторите новый пароль:</label>
                                                <input type="text" name="editpass" class="form-control">
                                            </div>
											<hr>
                                            <div class="form-group">
											<label>Язык сайта:</label>
											<select class="form-control" name="language">
											<?php foreach($this->system->get_lang_list() as $k=>$v){ ?>
												<option value="<?=$v['SYMBOL']?>" <?=($USER['language'] == $v['SYMBOL']) ? 'selected' : ''?>><?=$v['NAME']?></option>
											<?php } ?>						
											</select>
                                            </div>
											<hr>
											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="alive_balace_mail" type="checkbox" <?=($USER['alive_balace_mail']) ? 'checked' : ''?>>
                                                            <i class="blue"></i>
                                                            Получать уведомления о изменении баланса
                                                        </label>
											</div>
											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="alive_site_mail" type="checkbox" <?=($USER['alive_site_mail']) ? 'checked' : ''?>>
                                                            <i class="blue"></i>
                                                            Получать рассылку с сайта
                                                        </label>
											</div>
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
                                            <div class="form-group">
                                                <label>Реквизиты по умолчанию</label>
                                                <input type="input" name="default_requisites" class="form-control" value="<?=$USER['default_requisites']?>">
                                            </div>
                                    </div>
									
                                    <div class="d-flex align-items-center px-4 py-3 b-t pointer">
                                        <i data-feather="credit-card"></i>
                                        <div class="px-3">
                                            <div>Страна и сервер</div>
                                        </div>
                                        <div class="flex"></div>
                                        <div>
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="p-4" id="c_3">
                                            <div class="form-group">
                                                <label>Страна</label>
                                                <select class="form-control" name="country" <?=($USER['disable_change_country']) ? 'readonly' : ''?>>
													<?php foreach($this->config->item('country_codes') as $k=>$v){ ?>
													<option value="<?=$k?>" <?=($USER['country'] == $k)?'selected':''?>><?=$v?></option>
													<?php } ?>
												</select>
                                            </div>
                                            <div class="form-group">
                                                <label>Сервер</label>
                                                <select class="form-control" name="server" <?=($USER['disable_change_server']) ? 'readonly' : ''?>>
													<option value="0">GEO IP</option>
													<?php foreach($this->admin->GetServers() as $k=>$v){ ?>
													<option value="<?=$v['id']?>" <?=($USER['server'] == $v['id'])?'selected':''?>><?=$v['name']?></option>
													<?php } ?>
												</select>
                                            </div>
                                    </div>
									
									<?php if($USER['refferals_success'] != 0){ ?>
                                    <div class="d-flex align-items-center px-4 py-3 b-t pointer" >
                                        <i data-feather="user-plus"></i>
                                        <div class="px-3">
                                            <div>Партнерская программа <?=($USER['refferals_success'] == 1) ? 'Общие условия' : 'Индивидуальные условия'?></div>
                                        </div>
                                        <div class="flex"></div>
                                        <div>
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="p-4" id="c_4">										
											
											
											

								<div class="p-5" id="refrules">
								
                                <div class="table-responsive">
                                    <table class="table table-hover v-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-muted">#ID</th>
												  <th class="text-muted">Действие</th>
												  <th class="text-muted">Описание</th>		
												  <th class="text-muted">Сумма операции</th>			
												  <th class="text-muted">Вознаграждение</th>			
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php $RULES = ($USER['refferals_success'] == 1) ? $this->billing->GetReferralsRules(false) : $this->billing->GetReferralsRulesForUser(false,$USER['id']);
										foreach($RULES as $k=>$v){ if($v['status'] != 0){?>
                                            <tr class=" v-middle <?=($v['status'] == 0) ? 'table-warning' : ''?>" data-id="<?=$v['id']?>">
                                                <td>
                                                    <?=$v['id']?>
                                                </td>
                                                <td class="flex">
                                                    <?=$v['plugin']?>
                                                </td>
                                                <td class="flex">
                                                    <?=$v['description']?>
                                                </td>
                                                <td class="flex">
                                                    <b class="<?=($v['plus'] == 1) ? 'text-success">+' : 'text-danger">-'?> <?=$v['summ'].' '.$this->system->declines($v['summ'],$this->CONFIG->get('billing_currency_decline'))?></b>
                                                </td>
                                                <td class="flex">
                                                    <b>+<?=($v['percent'] > 0) ? $v['percent'].' %' : $v['amount'].' '.$this->system->declines($v['amount'],$this->CONFIG->get('billing_currency_decline'))?></b>
                                                </td>
                                            </tr>
										<?php }} ?>
                                        </tbody>
                                    </table>
									</div>									
								
								
								<div class="for_remove"></div>
									
									
									
									
                                </div>											
		
											
											
											
											

                                    </div>
									<?php } ?>
									
                                </div>
								
                                <p class="text-muted">
                                    <strong>Не получать писем с сайта (никаких)</strong>
                                </p>
                                <div class="card">
                                    <div class="d-flex align-items-center px-4 py-3 b-t pointer bg-warning" data-toggle="collapse" data-parent="#accordion" data-target="#c_5">
                                        <div>Отключить получение писем</div>
                                        <div class="flex"></div>
                                        <div>
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="collapse <?=($USER['disabled_mail'])? 'show' : ''?> p-4" id="c_5">
                                        <div class="py-3" id="disable_mail" style="<?=($USER['disabled_mail'])? 'display:none;' : ''?>">
                                            <p>В случает отключения писем с сайта станет невозможным восстановление пароля</p>
                                            <button type="button" class="btn btn-primary" data-toggle="collapse" data-parent="#accordion" data-target="#c_5">Не уверен</button>
                                            <button type="button" class="btn btn-danger" onclick="DisableMail()">Уверен</button>
                                        </div>
                                        <div class="py-3" id="disable_mail_yes" style="<?=($USER['disabled_mail'])? '' : 'display:none;'?>">

											<div class="form-group">
                                                        <label class="md-check">
                                                            <input name="disabled_mail" type="checkbox" checked <?=($USER['disabled_mail'])? '' : 'disabled'?>>
                                                            <i class="red"></i>
                                                            ОТКЛЮЧИТЬ ПОЧТУ
                                                        </label>
											</div>
                                        </div>
                                    </div>
                                </div>		
								
                                <p class="text-muted">
                                    <strong>Сессии</strong>
                                </p>
                                <div class="card">
								<?php foreach($this->system->GetUserSessions($USER['id']) as $k=>$v){ ?>
								
								<div  id="session_<?=$v['id']?>">
                                    <div class="d-flex align-items-center px-4 py-3 <?=(session_id() == $v['id']) ? 'green' : ''?>">
                                        <div><?=$v['server']['HTTP_USER_AGENT']?>
										<br><small>Last Online: <?=date('d.m.Y H:i:s',$v['timestamp'])?></small>
										<br><small>ID: <?=$v['id']?></small>
										<br><small>IP: <?=$v['ip_address']?> (<?=$this->system->GetCountryCodeByIp($v['ip_address'])?>) <?=$this->system->GetCountryNameByIp($v['ip_address'])?> <?=($this->system->GetCountryIconByIp($v['ip_address'])) ? '<img src="'.$this->system->GetCountryIconByIp($v['ip_address']).'" style=" width: 14px;    margin-bottom: 0.18em !important; ">' : ''?></small>
										</div>
                                        <div class="flex"></div>

                                                        <button type="button" class="btn btn-xs w-sm mb-1 bg-danger<?=(session_id() == $v['id']) ? '' : '-lt'?>" onclick="SessionDelete('<?=$v['id']?>',true)">Удалить</button>
                                    </div>
									
                                </div>
									
								<?php } ?>
                                </div>
                                <p class="text-muted">
                                    <strong>Удаление</strong>
                                </p>
                                <div class="card">
                                    <div class="red d-flex align-items-center px-4 py-3 b-t pointer" data-toggle="collapse" data-parent="#accordion" data-target="#c_del">
                                        <div>Удалить аккаунт?</div>
                                        <div class="flex"></div>
                                        <div>
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="collapse p-4" id="c_del">
                                        <div class="py-3">
                                            <p>Вы уверены что стоит удалять аккаунт?</p>
                                            <button type="button" class="btn btn-primary" data-toggle="collapse" data-parent="#accordion" data-target="#c_del">Не уверен</button>
                                            <button type="button" class="btn btn-danger" onclick="DeleteUser(<?=$USER['id']?>);">Уверен</button>
                                        </div>
                                    </div>
                                </div>
								
								
								
								
                                </div>
								
<?php } ?>
								
								
                            </div>
                        </div>
						</form>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>






<script id="template" type="text/template">

									<div class="remove mb-3">
									<b><h5>Новое правило</h5></b>
												<div class="form-group">
													<label class="text-muted" for="action">Действие</label>
													<input type="text" class="form-control" name="action[]" placeholder="Действие">
												</div>
									
									
									
									
									<div class="form-group">
													<label class="text-muted" for="description">Описание</label>
													<input type="text" class="form-control" name="description[]" placeholder="Описание">
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
                                                    <select onchange="BeChanget(this)" name="type2[]" class="form-control">
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
									<button type="button" onclick="RemoveRule(this)" class="btn btn-danger btn-block"><i class="fas fa-minus" aria-hidden="true"></i> Удалить правило</button>
									</div>
</script>

<script>
function RefferalsChange(e){
	var val = $(e).val();
switch(val) {
 case '0':
  $('#refrules').hide();
  break;
 case '1':
  $('#refrules').hide();
  break;
 case '2':
  $('#refrules').show();
  break;
 default:
 alert(val)
}            
}
function AddRule(){
	var template = $('#template').html();
	$( '.for_remove' ).append( template );
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
function SessionDelete(id,reload=false){
	$.get( "/admin/ajax/users/session/delete/1/"+id+"?{csrf_name}={csrf_value}", function( data ) {
	  $('#session_'+id).slideUp('slow');
	  if(reload){
		  window.location.reload();
	  }
	});
}

function DeleteUser(id){
	ShowLoad('body');
	$.get( "/admin/ajax/users/delete/"+id+"/?{csrf_name}={csrf_value}", function( data ) {
	  $('#usercard').slideUp();
	  $('#userdelete').slideDown();
	HideLoad('body');
	});	
}
</script>	