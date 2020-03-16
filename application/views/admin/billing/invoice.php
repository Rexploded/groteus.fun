						
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
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content p-0">
                                            <div class="tab-pane fade show active p-3" id="home4" role="tabpanel" aria-labelledby="home-tab">




							
                                <div class="toolbar ">
                                <div class="dropdown mb-2">
                                    <button class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">Действия </button>
                                    <div class="dropdown-menu bg-dark" role="menu">
                                        <a class="dropdown-item">
                                            <i class="fas fa-exclamation position-left"></i> Изменить статус на «Оплачено»
                                        </a>
                                        <a class="dropdown-item">
                                            <i class="fas fa-exclamation position-left"></i> Изменить статус на «Не оплачено»
                                        </a>
                                        <a class="dropdown-item">
                                            <i class="fas fa-exclamation position-left"></i> Изменить статус на «Оплачено» и зачислить средства
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item">
                                            <i class="fa fa-trash-o position-left"></i> Удалить
                                        </a>
                                    </div>
                                </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover v-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="ui-check m-0">
                                                        <input type="checkbox" onchange="massactions(this)">
                                                        <i></i>
                                                    </label>
                                                </th>
                                                <th class="text-muted">#ID</th>
                                                <th class="text-muted">Оплачено</th>
                                                <th class="text-muted">Зачислено</th>
                                                <th class="text-muted">Дата и время</th>
                                                <th class="text-muted">Система оплаты</th>
                                                <th class="text-muted">Пользователь</th>				
                                                <th class="text-muted">Статус</th>				
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($invoices as $k=>$v){ ?>
                                            <tr class=" v-middle <?=($v['success_time'] > 0) ? 'table-primary' : 'table-warning'?>" data-id="<?=$v['id']?>">
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
                                                    <?=$v['total']?> <?=$v['currency_in']?>
                                                </td>
                                                <td class="flex">
                                                    <?=$v['amount']?> <?=$v['currency_out']?>
                                                </td>
                                                <td class="flex">
                                                    <?=date('d.m.Y H:i:s',$v['create_time'])?>
                                                </td>
                                                <td class="flex">
                                                    <?=$v['system']?>
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
                                                    
													<?=($v['success_time'] > 0) ? '<span class="badge badge-success text-uppercase"> '.date('d.m.Y H:i:s',$v['success_time']).' </span>' : '<span class="badge badge-primary text-uppercase"> ОЖИДАЕТСЯ </span>'?>
													
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
<form method="GET" action="/admin/billing/invoice/" class="">
<input type="hidden" name="search" value="true">
<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Сумма к оплате:</h8>
									<span class="text-muted text-size-small hidden-xs">Фильтр поиска по значению «Оплачено»<br>Вы можете использовать один из символов сравнения: > < =</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="search_summa" class="form-control"  value="<?=(isset($_GET['search_summa'])) ? $this->input->get('search_summa') : ''?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Сумма к получению:</h8>
									<span class="text-muted text-size-small hidden-xs">Фильтр поиска по значению «Зачислено»<br>Вы можете использовать один из символов сравнения: > < =</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="search_summa_get" class="form-control"  value="<?=(isset($_GET['search_summa_get'])) ? $this->input->get('search_summa_get') : ''?>">
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
									<h8 class="media-heading text-semibold">Реквизиты плательщика:</h8>
									<span class="text-muted text-size-small hidden-xs">Вы можете использовать символ % - для составления маски запроса<br>Например: WMID3320%</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="search_requisites" class="form-control"  value="<?=(isset($_GET['search_requisites'])) ? $this->input->get('search_requisites') : ''?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Платежная система:</h8>
									<span class="text-muted text-size-small hidden-xs">При необходимости выберите систему оплаты</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name='search_paysys' class="form-control">
									<option value="" <?=(isset($_GET['search_paysys']) AND $_GET['search_paysys'] == '') ? 'selected' : ''?>>Все платежные системы</option>
										<?php foreach($this->db->query("SELECT DISTINCT system FROM pay WHERE 1")->result_array() as $k=>$v){ ?>
											<option value="<?=$v['system']?>" <?=(isset($_GET['search_paysys']) AND $_GET['search_paysys'] == $v['system']) ? 'selected' : ''?>><?=$v['system']?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Состояние:</h8>
									<span class="text-muted text-size-small hidden-xs">Выберите интересуюший вас статус квитанции</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name='search_status' class="form-control">
										<option value="" <?=(isset($_GET['search_status']) AND $_GET['search_status'] == '') ? 'selected' : ''?>>Все операции</option>
										<option value="1" <?=(isset($_GET['search_status']) AND $_GET['search_status'] == '1') ? 'selected' : ''?>>Оплачено</option>
										<option value="0" <?=(isset($_GET['search_status']) AND $_GET['search_status'] == '0') ? 'selected' : ''?>>Не оплачено</option>
									</select>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Дата и время создания квитанции:</h8>
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
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Дата и время поступления оплаты:</h8>
									<span class="text-muted text-size-small hidden-xs">Если не нужно учитывать - оставьте поле пустым</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<div class="input-group">
                                    <div class='input-group input-daterange mb-3' data-plugin="datepicker" data-option="{format: 'dd.mm.yyyy'}">
                                        <input type='text' class="form-control" name="search_date_pay" value="<?=(isset($_GET['search_date_pay'])) ? $this->input->get('search_date_pay') : ''?>">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">до</span>
                                        </div>
                                        <input type='text' class="form-control" name="search_date_pay_to" value="<?=(isset($_GET['search_date_pay_to'])) ? $this->input->get('search_date_pay_to') : ''?>">
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

											
                                        </div>
                                    </div>
                                </div>	