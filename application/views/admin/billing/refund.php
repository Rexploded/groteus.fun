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
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Заявки</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="true">Поиск</a>
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
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/billing/refund/action/','success')">
                                            <i class="fas fa-exclamation position-left"></i> Выполнено
                                        </a>
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/billing/refund/action/','wait')">
                                            <i class="fas fa-exclamation position-left"></i> Ожидается
                                        </a>
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/billing/refund/action/','cancel')">
                                            <i class="fas fa-exclamation position-left"></i> Отменить
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/billing/refund/action/','delete')">
                                            <i class="fa fa-trash-o position-left"></i> Удалить
                                        </a>
                                    </div>
                                </div>
                                </div>
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
												  <th class="text-muted">Сумма к выводу</th>
												  <th class="text-muted">Реквизиты</th>
												  <th class="text-muted">Дата и время</th>
												  <th class="text-muted">Пользователь</th>
												  <th class="text-muted">Статус</th>				
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($refunds as $k=>$v){ ?>
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
                                                    <?=$v['amount']?> [declines=<?=$v['amount']?>|<?=$this->CONFIG->get('billing_currency_decline')?>]
                                                </td>
                                                <td class="flex">
                                                    <?=$v['data']?>
                                                </td>
                                                <td class="flex">
                                                    <?=date('d.m.Y H:i',$v['date'])?>
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
                                                <td>
                                                    
													<?=($v['date_return'] > 0) ? '<span class="badge badge-success text-uppercase">Выполнено: '.date('d.m.Y H:i',$v['date_return']).'</span>' : '<span class="badge badge-primary text-uppercase">Ожидается</span>'?>
													
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

<div class="card">

                                        <div class="card-body p-0 table-responsive">
<form method="GET" action="/admin/billing/refund/" class="">
<input type="hidden" name="search" value="true">
<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Сумма к выводу:</h8>
									<span class="text-muted text-size-small hidden-xs">Фиьтр по сумме вывода<br>Вы можете использовать один из символов сравнения: > < =</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="search_summa" class="form-control"  value="<?=(isset($_GET['search_summa'])) ? $this->input->get('search_summa') : ''?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Реквизиты:</h8>
									<span class="text-muted text-size-small hidden-xs">Вы можете использовать символ % - для составления маски запроса<br>Например: R% - запросы вывода на R-кошелёк (WebMoney)</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="search_requisites" class="form-control"  value="<?=(isset($_GET['search_requisites'])) ? $this->input->get('search_requisites') : ''?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Пользователь:</h8>
									<span class="text-muted text-size-small hidden-xs">Введите логин пользователя или его часть.<br>Вы можете использовать символ % - вместо части запроса<br>Например: mr_% - пользователи, чей логин начинается с mr_</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="padding: 50px 20px;">
									<div class="input-group">
										<input type="text" name="search_login" class="form-control"  value="<?=(isset($_GET['search_login'])) ? $this->input->get('search_login') : ''?>">
									</div>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Статус запроса:</h8>
									<span class="text-muted text-size-small hidden-xs">Выберите интересуюший вас статус запроса</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name='search_status' class="form-control">
										<option value="" <?=(isset($_GET['search_status']) AND $_GET['search_status'] == '') ? 'selected' : ''?>>Любой</option>
										<option value="0" <?=(isset($_GET['search_status']) AND $_GET['search_status'] == '0') ? 'selected' : ''?>>Ожидается</option>
										<option value="1" <?=(isset($_GET['search_status']) AND $_GET['search_status'] == '1') ? 'selected' : ''?>>Выполнен</option>
									</select>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Дата и время:</h8>
									<span class="text-muted text-size-small hidden-xs">Если не нужно учитывать - оставьте поле пустым</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<div class="input-group">
                                    <div class='input-group input-daterange mb-3' data-plugin="datepicker" data-option="{format: 'dd.mm.yyyy'}">
                                        <input type='text' class="form-control" name="search_date" value="<?=(isset($_GET['search_date'])) ? $this->input->get('search_date') : ''?>">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">до</span>
                                        </div>
                                        <input type='text' class="form-control" name="search_date_to" value="<?=(isset($_GET['search_date_to'])) ? $this->input->get('search_date_to') : ''?>">
                                    </div>
									</div>
								</td>
							</tr>
						</table>
						<button class="btn btn-success btn-block">Поиск</button>
</form>


                                        </div>
                                        </div>









                                            </div>

											
                                            <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab">



                                       <div class="card-body p-0 table-responsive">
<form method="POST" action="/admin/ajax/billing/refund/save" class="ajax-form">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">
<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Включить:</h8>
									<span class="text-muted text-size-small hidden-xs">Включить плагин для всех пользователей</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_module_refund_active" value="1" <?=($this->CONFIG->get('billing_module_refund_active')) ? 'checked' : ''?>>
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