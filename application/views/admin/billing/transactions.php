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
                        
						<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">

                        <div class="padding">
 





                            <div class="mb-5">
							
							
							
							
							
							
							
							
							
							
									<div class="card">
                                            <div class="nav-active-border b-success top">
                                                <ul class="nav" id="myTab" role="tablist">
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">История движения средств</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="true">Поиск</a>
                                                    </li>
                                                </ul>
                                            </div>					
							
							
							
							
							
							
                                        <div class="tab-content p-3">
                                            <div class="tab-pane fade show active p-0" id="home4" role="tabpanel" aria-labelledby="home-tab">						
							
							
                                <div class="toolbar ">
                                <div class="dropdown mb-2">
                                    <button class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">Действия </button>
                                    <div class="dropdown-menu bg-dark" role="menu">
                                        <a class="dropdown-item">
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
                                                <th class="text-muted"><span class="d-none d-sm-block">Плагин</span></th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Дата и время</span></th>
                                                <th class="text-muted">Сумма</th>
                                                <th class="text-muted">Пользователь</th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Остаток на балансе</span></th>				
                                                <th class="text-muted"><span class="d-none d-sm-block">Комментарий</span></th>				
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($transactions as $k=>$v){ ?>
                                            <tr class=" v-middle" data-id="<?=$v['id']?>">
                                                <td>
                                                    <label class="ui-check m-0 ">
                                                        <input type="checkbox" class="massactions" name="massaction[<?=$v['id']?>]" value="<?=$v['id']?>">
                                                        <i></i>
                                                    </label>
                                                </td>
                                                <td class="flex">
                                                    <?=$v['id']?>
                                                </td>
                                                <td class="flex">
                                                    <?=$v['plugin']?>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=date('d.m.Y H:i:s',$v['date'])?></span>
                                                </td>
                                                <td>
                                                    <span class="item-amount"><b class="<?=($v['plus'] > 0) ? 'text-success' : 'text-danger'?>"><?=($v['plus'] > 0) ? '+'.$v['plus'].' [declines='.$v['plus'].'|'.$this->CONFIG->get('billing_currency_decline').']' : '-'.$v['minus'].' [declines='.$v['minus'].'|'.$this->CONFIG->get('billing_currency_decline').']'?> </b></span>
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
                                                    <span class="item-amount d-none d-sm-block text-sm "><b><?=$v['balance']?></b></span>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><b><?=$v['text']?></b></span>
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
<form method="GET" action="/admin/billing/transactions/" class="">
<input type="hidden" name="search" value="true">
<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Код плагина:</h8>
									<span class="text-muted text-size-small hidden-xs">Если не нужно учитывать - оставьте поле пустым</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="search_plugin" class="form-control"  value="<?=(isset($_GET['search_plugin'])) ? $this->input->get('search_plugin') : ''?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Операция:</h8>
									<span class="text-muted text-size-small hidden-xs">Выберите тип транзакции: доход, расход или все операции</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name='search_type' class="form-control">
										<option value="" <?=(isset($_GET['search_type']) AND $_GET['search_type'] == '') ? 'selected' : ''?>>Все операции</option>
										<option value="1" <?=(isset($_GET['search_type']) AND $_GET['search_type'] == '1') ? 'selected' : ''?>>Доход</option>
										<option value="0" <?=(isset($_GET['search_type']) AND $_GET['search_type'] == '0') ? 'selected' : ''?>>Расход</option>
									</select>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Сумма:</h8>
									<span class="text-muted text-size-small hidden-xs">Вы можете использовать один из символов сравнения: > < =</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="search_summa" class="form-control"  value="<?=(isset($_GET['search_summa'])) ? $this->input->get('search_summa') : ''?>">
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
									<h8 class="media-heading text-semibold">Комментарий:</h8>
									<span class="text-muted text-size-small hidden-xs">Вы можете использовать символ % - вместо части запроса</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<div class="input-group">
										<input type="text" name="search_comment" class="form-control"  value="<?=(isset($_GET['search_comment'])) ? $this->input->get('search_comment') : ''?>">
									</div>
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
							
							
							
							
							
							
							
							
							
							
							
                            </div>




                                        </div>	


                            </div>









 </div>
						
						
						
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>
<script>
window.addEventListener('load', function () {
		
$.fn.datepicker.dates['ru'] = {
    days: ["<?=lang('cal_sunday')?>", "<?=lang('cal_monday')?>", "<?=lang('cal_tuesday')?>", "<?=lang('cal_wednesday')?>", "<?=lang('cal_thursday')?>", "<?=lang('cal_friday')?>", "<?=lang('cal_saturday')?>"],
    daysShort: ["<?=lang('cal_sun')?>", "<?=lang('cal_mon')?>", "<?=lang('cal_tue')?>", "<?=lang('cal_wed')?>", "<?=lang('cal_thu')?>", "<?=lang('cal_fri')?>", "<?=lang('cal_sat')?>"],
    daysMin: ["<?=lang('cal_su')?>", "<?=lang('cal_mo')?>", "<?=lang('cal_tu')?>", "<?=lang('cal_we')?>", "<?=lang('cal_th')?>", "<?=lang('cal_fr')?>", "<?=lang('cal_sa')?>"],
    months: ["<?=lang('cal_january')?>", "<?=lang('cal_february')?>", "<?=lang('cal_march')?>", "<?=lang('cal_april')?>", "<?=lang('cal_mayl')?>", "<?=lang('cal_june')?>", "<?=lang('cal_july')?>", "<?=lang('cal_august')?>", "<?=lang('cal_september')?>", "<?=lang('cal_october')?>", "<?=lang('cal_november')?>", "<?=lang('cal_december')?>"],
    monthsShort: ["<?=lang('cal_jan')?>", "<?=lang('cal_feb')?>", "<?=lang('cal_mar')?>", "<?=lang('cal_apr')?>", "<?=lang('cal_may')?>", "<?=lang('cal_jun')?>", "<?=lang('cal_jul')?>", "<?=lang('cal_aug')?>", "<?=lang('cal_sep')?>", "<?=lang('cal_oct')?>", "<?=lang('cal_nov')?>", "<?=lang('cal_dec')?>"],
    today: "<?=lang('cal_today')?>",
    clear: "<?=lang('cal_clear')?>",
    format: "<?=lang('cal_format')?>",
    titleFormat: "<?=lang('cal_title_format')?>", /* Leverages same syntax as 'format' */
    weekStart: 0
};		
		});
		
		</script>		