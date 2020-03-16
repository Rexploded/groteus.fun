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
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Промокоды</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="true">Создание промокодов</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Настройки</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content p-0">
                                            <div class="tab-pane fade show active p-3" id="home4" role="tabpanel" aria-labelledby="home-tab">





                               <div class="toolbar ">
                                <div class="dropdown mb-2">
                                    <button class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">Действия </button>
                                    <div class="dropdown-menu bg-dark" role="menu">
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/billing/prcode/action/','success')">
                                            <i class="fas fa-exclamation position-left"></i> Пометить активированым
                                        </a>
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/billing/prcode/action/','cancel')">
                                            <i class="fas fa-exclamation position-left"></i> Отменить активацию
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/billing/prcode/action/','delete')">
                                            <i class="fa fa-trash-o position-left"></i> Удалить
                                        </a>
                                    </div>
                                </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-row table-hover v-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="ui-check m-0">
                                                        <input type="checkbox" onchange="massactions(this)">
                                                        <i></i>
                                                    </label>
                                                </th>
                                                <th class="text-muted">#ID</th>
												  <th class="text-muted">Промокод</th>
												  <th class="text-muted">Сумма</th>
												  <th class="text-muted">Состояние</th>			
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
								
										<?php foreach($prcodes as $k=>$v){ 
$HTMLUSERLINK = <<<HTML
                                                    <a class="item-title text-color "  data-toggle="dropdown" aria-expanded="true">
													<span class="badge badge-primary text-uppercase">{$this->users->GetUserById($v['user_id'])['username']}</span>
													</a>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="/admin/billing/statistics/?search=true&login={$this->users->GetUserById($v['user_id'])['username']}">
                                                <i class="fa fa-bar-chart"></i> Общая статистика
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/transactions/?search=true&login={$this->users->GetUserById($v['user_id'])['username']}">
                                                <i class="fa fa-money"></i> История баланса
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/refund/?search=true&login={$this->users->GetUserById($v['user_id'])['username']}">
                                               <i class="fa fa-credit-card"></i> Запросы вывода
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/invoice/?search=true&login={$this->users->GetUserById($v['user_id'])['username']}">
                                                 <i class="fa fa-folder-open-o"></i> Квитанции
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/admin/billing/users/?logins={$this->users->GetUserById($v['user_id'])['username']}">
                                                <i class="fa fa-money"></i> Изменить баланс
                                            </a>
                                        </div>
HTML;
													if($v['user_id'] != 0 OR $v['active_date']>0){
														//Кто-то активировал
															$state = '<span class="badge badge-primary text-uppercase"> '.$HTMLUSERLINK.' <i class="fa fa-fw fa-arrow-right"></i> '.date('d.m.Y H:i',$v['active_date']).'</span>';
															$state_class = "table-success";
															$style = 'text-decoration:line-through;';
													}else{
														if($v['active_before'] > time() OR $v['active_before'] == 0){
															//еще действителен
															$state = '<span class="badge badge-warning text-uppercase"> НЕ активирован </span>';
															$state_class = "table-primary";
															$style = '';
														}else{
															//Код протух
															$state = '<span class="badge badge-warning text-uppercase"> Код просрочен </span>';
															$state_class = "table-danger";
															$style = 'text-decoration:line-through;';
														}
													}
													
										
										?>
                                            <tr class=" v-middle <?=$state_class?>" data-id="<?=$v['id']?>">
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
                                                    <b style="<?=$style?>"><?=$v['prcode_tag']?></b> 
                                                </td>
                                                <td class="flex">
                                                    <?=$v['amount']?> [declines=<?=$v['amount']?>|<?=$this->CONFIG->get('billing_currency_decline')?>]
                                                </td>
                                                <td class="flex">
												<?=$state?>
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
                                            <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab">



                                        <div class="card-body p-0 table-responsive">
<form method="POST" action="/admin/ajax/billing/prcode/generate" class="ajax-form">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">
<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Количество:</h8>
									<span class="text-muted text-size-small hidden-xs">Сколько сгенерировать кодов</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="number" step='1' min='1' name="count" class="form-control" value="10">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Номинал:</h8>
									<span class="text-muted text-size-small hidden-xs">Сколько начислить средст на баланс пользователю, активировавшему код</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<div class="input-group">
										<input type="number" step="0.01" name="amount" class="form-control" onchange="RepairSum(this);" value="10.00"><div class="input-group-append"> <span class="input-group-text" id="decline">[declines=10|<?=$this->CONFIG->get('billing_currency_decline')?>]</span> </div>
									</div>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Шаблон промокода:</h8>
									<span class="text-muted text-size-small hidden-xs">Используйте цифру 0 для обозначения случайного символа</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="mask" class="form-control"  value="0000-0000-0000-0000">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Время активации:</h8>
									<span class="text-muted text-size-small hidden-xs">Вы можете установить дату, позже которой код невозможно активировать</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
								<div class='input-group input-daterange mb-3'>
								
<div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <label class="md-check">
                                                            <input name="times" type="checkbox">
                                                            <i class="indigo"></i>
                                                        </label>
                                                    </div>
                                                </div>
									<input type="text" name="time"  data-plugin="datepicker" data-option="{format: 'dd/mm/yyyy'}" class="form-control" value="<?=date("d/m/Y",time() + 864000)?>">
									</div>
								</td>
							</tr>
						</table>
						<button class="btn btn-success btn-block">Сгенерировать</button>
</form>


                                        </div>









                                            </div>
                                            <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab">



                                       <div class="card-body p-0 table-responsive">
<form method="POST" action="/admin/ajax/billing/prcode/save" class="ajax-form">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">
<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Включить:</h8>
									<span class="text-muted text-size-small hidden-xs">Включить плагин для всех пользователей</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_module_prcode_active" value="1" <?=($this->CONFIG->get('billing_module_prcode_active')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>
						</table>
						<button class="btn btn-success btn-block">Сохранить</button>
</form>



                                        </div>




                                            </div>
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
function RepairSum(e){ 
	var val = 11;
	$('[name=amount]').val(parseFloat($('[name=amount]').val()).toFixed(2));
	var say = declOfNum(val, ['<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[0]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[1]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[2]?>']);
	$('#decline').html(say);
}

</script>		