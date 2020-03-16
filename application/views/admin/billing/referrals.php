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
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">
                        
						

                        <div class="padding">
 





                            <div class="mb-5">
							
							
                               <div class="col-sm-12 m-0 p-0">
                                    <div class="card">
                                        <div class="b-b">
                                            <div class="nav-active-border b-success top">
                                                <ul class="nav" id="myTab" role="tablist">
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Приглашения</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Настройки</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="true">Партнерские отчисления</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content p-0">
                                            <div class="tab-pane fade show active p-3" id="home4" role="tabpanel" aria-labelledby="home-tab">





                                <div class="table-responsive">
                                    <table class="table table-theme table-row table-hover v-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="ui-check m-0">
                                                        <input type="checkbox" onchange="massactions(this)">
                                                        <i></i>
                                                    </label>
                                                </th>
                                                <th class="text-muted">#ID</th>
												  <th class="text-muted">Дата и время</th>
												  <th class="text-muted">Приглашенный пользователь</th>
												  <th class="text-muted">Кто пригласил</th>			
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($referrals as $k=>$v){ ?>
                                            <tr class=" v-middle" data-id="<?=$v['id']?>">
                                                <td>
                                                    <label class="ui-check m-0 ">
                                                        <input type="checkbox" class="massactions" name="massaction[<?=$v['id']?>]" value="<?=$v['id']?>">
                                                        <i></i>
                                                    </label>
                                                </td>
                                                <td>
                                                    <?=$v['id']?>
                                                </td>
                                                <td class="flex">
                                                    <?=date('d.m.Y H:i',$v['date'])?>
                                                </td>
                                                <td class="flex">
                                                    <a class="item-title text-color "  data-toggle="dropdown" aria-expanded="true">
													<span class="badge badge-primary text-uppercase"><?=$this->users->GetUserById($v['new_user_id'])['username']?></span>
													</a>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="/admin/billing/statistics/?search=true&login=<?=$this->users->GetUserById($v['new_user_id'])['username']?>">
                                                <i class="fa fa-bar-chart"></i> Общая статистика
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/transactions/?search=true&login=<?=$this->users->GetUserById($v['new_user_id'])['username']?>">
                                                <i class="fa fa-money"></i> История баланса
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/refund/?search=true&login=<?=$this->users->GetUserById($v['new_user_id'])['username']?>">
                                               <i class="fa fa-credit-card"></i> Запросы вывода
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/invoice/?search=true&login=<?=$this->users->GetUserById($v['new_user_id'])['username']?>">
                                                 <i class="fa fa-folder-open-o"></i> Квитанции
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/admin/billing/users/?logins=<?=$this->users->GetUserById($v['new_user_id'])['username']?>">
                                                <i class="fa fa-money"></i> Изменить баланс
                                            </a>
                                        </div>
                                                </td>
                                                <td class="flex">
                                                    <a class="item-title text-color "  data-toggle="dropdown" aria-expanded="true">
													<span class="badge badge-primary text-uppercase"><?=$this->users->GetUserById($v['user_id'])['username']?></span>
													</a>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="/admin/billing/statistics/?search=true&login=<?=$this->users->GetUserById($v['user_id'])['username']?>">
                                                <i class="fa fa-bar-chart"></i> Общая статистика
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/transactions/?search=true&login=<?=$this->users->GetUserById($v['user_id'])['username']?>">
                                                <i class="fa fa-money"></i> История баланса
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/refund/?search=true&login=<?=$this->users->GetUserById($v['user_id'])['username']?>">
                                               <i class="fa fa-credit-card"></i> Запросы вывода
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/invoice/?search=true&login=<?=$this->users->GetUserById($v['user_id'])['username']?>">
                                                 <i class="fa fa-folder-open-o"></i> Квитанции
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/admin/billing/users/?logins=<?=$this->users->GetUserById($v['user_id'])['username']?>">
                                                <i class="fa fa-money"></i> Изменить баланс
                                            </a>
                                        </div>
                                                </td>
                                            </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
								<nav>
  <ul class="pagination">
<?=$PAGES?> 
  </ul>
</nav>
                                    
                                            </div>        
                                            <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab">



                                       <div class="card-body p-0 table-responsive">
<form method="POST" action="/admin/ajax/billing/referrals/save" class="ajax-form">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">
<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Включить:</h8>
									<span class="text-muted text-size-small hidden-xs">Включить плагин для всех пользователей</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_module_referrals_active" value="1" <?=($this->CONFIG->get('billing_module_referrals_active')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Включить:</h8>
									<span class="text-muted text-size-small hidden-xs">Включить плагин для всех пользователей</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<div class="input-group">
										<input type="number" step="0.01" name="billing_module_referrals_bonus" class="form-control" onchange="RepairSum(this);" value="<?=$this->CONFIG->get('billing_module_referrals_bonus')?>"><div class="input-group-append"> <span class="input-group-text" id="decline">[declines=<?=$this->CONFIG->get('billing_module_referrals_bonus')?>|<?=$this->CONFIG->get('billing_currency_decline')?>]</span> </div>
									</div>
								</td>
							</tr>
						</table>
						<button class="btn btn-success btn-block">Сохранить</button>
</form>



                                        </div>




                                            </div>
											
											
                                           <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab">
<form method="POST" action="/admin/ajax/billing/referrals/create" class="ajax-form">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">										   

                                <div class="table-responsive">
                                    <table class="table table-hover v-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-muted">#ID</th>
												  <th class="text-muted">Действие</th>
												  <th class="text-muted">Описание</th>		
												  <th class="text-muted">Сумма операции</th>			
												  <th class="text-muted">Вознаграждение</th>				
												  <th style="width:50px;"></th>		
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($refferals_rules as $k=>$v){ ?>
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
                                                <td>
                                                    <div class="item-action dropdown">
                                                        <a href="#" data-toggle="dropdown" class="text-muted">
                                                            <i data-feather="more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
															<?php if($v['status'] == 1) { ?>
                                                            <a class="dropdown-item" onclick="GetMass('/admin/ajax/billing/referrals/action/','off','<?=$v['id']?>')">
                                                                Деактивировать
                                                            </a>
															<?php } else { ?>
                                                            <a class="dropdown-item" onclick="GetMass('/admin/ajax/billing/referrals/action/','on','<?=$v['id']?>')">
                                                                Активировать
                                                            </a>
															<?php } ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a  onclick="GetMass('/admin/ajax/billing/referrals/action/','delete','<?=$v['id']?>')" class="dropdown-item trash">
                                                                Удалить
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
									<hr>

								<div class="p-5">
									<b><h5>Создать правило</h5></b>
												<div class="form-group">
													<label class="text-muted" for="action">Действие</label>
													<input type="text" class="form-control" id="action" name="action" placeholder="Действие" required="">
												</div>
									
									
									
									
									<div class="form-group">
													<label class="text-muted" for="description">Описание</label>
													<input type="text" class="form-control" id="description" name="description" placeholder="Описание" required="">
												</div>
									
									
									
									
									<label class="text-muted" for="description">Сумма операции</label>
									<div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                    <select name="plusminus" class="form-control">
                                                        <option value="1">Приход</option>
                                                        <option value="0">Расход</option>
                                                    </select>
                                                    <select name="type" class="form-control">
                                                        <option value="0">Больше</option>
                                                        <option value="1">Меньше</option>
                                                        <option value="2">Равно</option>
                                                        <option value="3">Не равно</option>
                                                    </select>
                                        </div>
                                        <input type="text" name="summ" class="form-control" placeholder="" onchange="RepairSum2(this);" value="0.00" aria-label="" aria-describedby="basic-addon1">
										<div class="input-group-append"> <span class="input-group-text" id="decline">[declines=10|<?=$this->CONFIG->get('billing_currency_decline')?>]</span> </div>
									</div>
									
									
									
									<label class="text-muted" for="amount1">Вознаграждение</label>
									<div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                    <select onchange="BeChanget(this)" name="type2" class="form-control">
                                                        <option value="1">Проценты</option>
                                                        <option value="0">Сумма</option>
                                                    </select>
                                        </div>
                                        <input type="text" style="display:none;" name="amount1" class="form-control" placeholder="" onchange="RepairSum2(this);" value="0.00" aria-label="" aria-describedby="basic-addon1">
										<div style="display:none;" id="amount1" class="input-group-append"> <span class="input-group-text" id="decline2">[declines=10|<?=$this->CONFIG->get('billing_currency_decline')?>]</span> </div>
										
                                        <input type="number" step='1' name="amount2" class="form-control" placeholder="" onchange="$(this).val(Number($(this).val()));" value="1" aria-label="" aria-describedby="basic-addon1">
										<div id="amount2" class="input-group-append"> <span class="input-group-text">%</span> </div>
									</div>
									
									
							<button type="submit" class="btn btn-success btn-block">Создать правило</button>
									
									
									
                                </div>
								
										   
                                            </div>
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
<script>	
function BeChanget(e){
	if($(e).val() == 1){
		$('[name=amount1]').hide();
		$('#amount1').hide();
		$('[name=amount2]').show();
		$('#amount2').show();
	}else{
		$('[name=amount2]').hide();
		$('#amount2').hide();
		$('[name=amount1]').show();
		$('#amount1').show();
	}
}	
function RepairSum(e){ 
	var val = 11;
	$('[name=amount1]').val(parseFloat($('[name=amount1]').val()).toFixed(2));
	var say = declOfNum(val, ['<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[0]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[1]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[2]?>']);
	$('#decline2').html(say);
}		
function RepairSum2(e){ 
	var val = 11;
	$('[name=summ]').val(parseFloat($('[name=summ]').val()).toFixed(2));
	var say = declOfNum(val, ['<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[0]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[1]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[2]?>']);
	$('#decline2').html(say);
}

</script>	