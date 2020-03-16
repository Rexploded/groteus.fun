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
                        
					<form method="POST" action="/admin/ajax/billing/settings/" class="ajax-form">
						<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">

                        <div class="padding">
                            <div class="row">
                                <div class="col-md-12">
								
								
								
<?php
$month = array(
	1=>lang('cal_jan'),
	2=>lang('cal_feb'),
	3=>lang('cal_mar'),
	4=>lang('cal_apr'),
	5=>lang('cal_may'),
	6=>lang('cal_jun'),
	7=>lang('cal_jul'),
	8=>lang('cal_aug'),
	9=>lang('cal_sep'),
	10=>lang('cal_oct'),
	11=>lang('cal_nov'),
	12=>lang('cal_dec'),
);

$count = date('j');
$mm = date('n');
$YY = date('Y');
$categories = array();
$pays = array();
$payss = array();

$user_id = false;
if(isset($_GET['search'])){
	$username = $this->users->GetUserByUsername($this->input->get('login'));
	$user_id = ($username['id']) ? $username['id'] : -1;
}

if(isset($_POST['date_edit_start']) AND isset($_POST['date_edit_end'])){
	$count = (strtotime($_POST['date_edit_end']) - strtotime($_POST['date_edit_start'])) / 86400 + 1;



for ($i = 1; $i <= $count; $i++) {
$mm = date('n',strtotime($_POST['date_edit_start']) - 86400 + ($i * 86400));
$YY = date('Y',strtotime($_POST['date_edit_start']) - 86400 + ($i * 86400));	
$dd = date("j",strtotime($_POST['date_edit_start']) - 86400 + ($i * 86400));
    $categories[] = "'{$dd} {$month[$mm]}'";
	$pays[] = $this->billing->GetDayPayments($dd.'.'.$mm.'.'.$YY.'',$user_id);
	$payss[] = $this->billing->GetDayUserPayments($dd.'.'.$mm.'.'.$YY.'',$user_id);
	
	
	/* 

	$piastrix[] = $this->billing->GetDayPaymentsPiastrix($i.'.'.$mm.'.'.$YY.'');
	$robokassa[] = $this->billing->GetDayPaymentsRobokassa($i.'.'.$mm.'.'.$YY.'');
	$freekassa[] = $this->billing->GetDayPaymentsFreekassa($i.'.'.$mm.'.'.$YY.'');
	$yandex[] = $this->billing->GetDayPaymentsYandex($i.'.'.$mm.'.'.$YY.'');
	$webmoney[] = $this->billing->GetDayPaymentsWebmoney($i.'.'.$mm.'.'.$YY.'');
	*/
	
}


	
}else{
for ($i = 1; $i <= $count; $i++) {
    $categories[] = "'{$i} {$month[$mm]}'";
	$pays[] = $this->billing->GetDayPayments($i.'.'.$mm.'.'.$YY.'',$user_id);
	$payss[] = $this->billing->GetDayUserPayments($i.'.'.$mm.'.'.$YY.'',$user_id);
	
	
	/* 

	$piastrix[] = $this->billing->GetDayPaymentsPiastrix($i.'.'.$mm.'.'.$YY.'');
	$robokassa[] = $this->billing->GetDayPaymentsRobokassa($i.'.'.$mm.'.'.$YY.'');
	$freekassa[] = $this->billing->GetDayPaymentsFreekassa($i.'.'.$mm.'.'.$YY.'');
	$yandex[] = $this->billing->GetDayPaymentsYandex($i.'.'.$mm.'.'.$YY.'');
	$webmoney[] = $this->billing->GetDayPaymentsWebmoney($i.'.'.$mm.'.'.$YY.'');
	*/	
	
}	
}
/* 
$piastrix = implode(',',$piastrix);
$robokassa = implode(',',$robokassa);
$freekassa = implode(',',$freekassa);
$yandex = implode(',',$yandex);
$webmoney = implode(',',$webmoney);
 */


 $categories = implode(',',$categories);
 $pays = implode(',',$pays);
 $payss = implode(',',$payss);
?>								 
								
                                    <div class="card">
                                        <div class="b-b">
                                            <div class="nav-active-border b-success top">
                                                <ul class="nav" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link <?=($mode != 'paysys')? 'active' : ''?>" href="/admin/billing/statistics/">Расчетный доход</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content p-3">
                                            <div class="tab-pane fade show active">

<?php if($user_id > 0){ ?>
<div class="col-md-12">
							<div id="general" class="box" style="padding: 10px">
								<table width="100%">
									<tbody><tr>
										<td width="62" valign="middle" class="bt_table_right">
											<img src="<?=$this->users->GetUserById($user_id)['avatar']?>" style="max-width: 62px; border-radius: 5px" title="210105" alt="210105">
										</td>
										<td class="bt_table_right">
											<div class="btn-group">
                                                    <a class="item-title text-color "  data-toggle="dropdown" aria-expanded="true">
													<span class="badge badge-primary text-uppercase"><?=$this->users->GetUserById($user_id)['username']?></span>
													</a>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="/admin/billing/statistics/?search=true&login=<?=$this->users->GetUserById($user_id)['username']?>">
                                                <i class="fa fa-bar-chart"></i> Общая статистика
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/transactions/?search=true&login=<?=$this->users->GetUserById($user_id)['username']?>">
                                                <i class="fa fa-money"></i> История баланса
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/refund/?search=true&login=<?=$this->users->GetUserById($user_id)['username']?>">
                                               <i class="fa fa-credit-card"></i> Запросы вывода
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/invoice/?search=true&login=<?=$this->users->GetUserById($user_id)['username']?>">
                                                 <i class="fa fa-folder-open-o"></i> Квитанции
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/admin/billing/users/?logins=<?=$this->users->GetUserById($user_id)['username']?>">
                                                <i class="fa fa-money"></i> Изменить баланс
                                            </a>
                                        </div>
						
						
						
						
						
						
				</div> <br><?=$this->users->GetGroupName($this->users->GetUserById($user_id)['user_group'])?>
										</td>
										<td class="bt_table_right" style="font-size: 16px;margin:0;">
											<?=$this->users->GetUserById($user_id)['balance']?> [declines=<?=$this->users->GetUserById($user_id)['balance']?>|<?=$this->CONFIG->get('billing_currency_decline')?>]
											<div style="margin:0;font-size: 11px; color: #ccc">текущий баланс</div>
										</td>
										<td class="bt_table_right" style="font-size: 16px;margin:0;">
											<?=$this->billing->GetRefundsByUserId($user_id)?> [declines=<?=$this->billing->GetRefundsByUserId($user_id)?>|<?=$this->CONFIG->get('billing_currency_decline')?>]
											<div style="margin:0;font-size: 11px; color: #ccc">к выводу</div>
										</td>
										<td class="bt_table_right" style="border: none">
											<a href="/index.php?do=pm&amp;doaction=newpm&amp;username=210105" target="_blank" class="tip" title="" data-original-title="Отправить сообщение на сайте">
												<i class="fa fa-comments" style="font-size: 24px;margin-right: 10px; color: #428bca"></i>
											</a>
											<a href="/index.php?do=feedback&amp;user=15037" target="_blank" class="tip" title="" data-original-title="Отправить email">
												<i class="fa fa-envelope" style="font-size: 24px; color: #428bca"></i>
											</a>
										</td>
									</tr>
								</tbody></table>
							</div>
						</div>

<?php } ?>




<div style="padding: 10px; text-align: center; border-bottom: 1px solid #ccc">

                                    <div class='form-group row col-12 '></div>
                                    <div class='form-group row'>
                                    <div class='input-group input-daterange mb-3' data-plugin="datepicker" data-option="{format: 'dd.mm.yyyy'}">
                                        <input type='text' class="form-control" name="start">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">to</span>
                                        </div>
                                        <input type='text' class="form-control" name="end">
                                    </div>
									
									<button class="btn btn-success btn-block" name="sort" type="submit" value="Показать">Показать</button>
					</div>
					</div>


<script>
window.addEventListener('load', function () {
		    $('#container_1').highcharts({
			     chart: {
			         type: 'area'
			     },
			     title: {
			         text: ''
			     },
			     xAxis: {
			         categories: [<?=$categories?>],
			         tickmarkPlacement: 'on',
			         title: {
			             enabled: false
			         }
			     },
			     yAxis: {
			         title: {
			             text: 'Сумма $'
			         }
			     },
			     tooltip: {
			         split: true,
			         valueSuffix: ' $'
			     },
			     plotOptions: {
			         area: {
			             stacking: 'normal',
			             lineColor: '#666666',
			             lineWidth: 1,
			             marker: {
			                 lineWidth: 1,
			                 lineColor: '#666666'
			             }
			         }
			     },
			     series: [{
			         name: 'Доход пользователей',
			         data: [<?=$pays?>]
			     }, {
			         name: 'Расход пользователей',
			         data: [<?=$payss?>]
			     }]
		    });
			
			
			{*
		    $('#container_2').highcharts({
			     chart: {
			         type: 'area'
			     },
			     title: {
			         text: ''
			     },
			     xAxis: {
			         categories: [<?=$categories?>],
			         tickmarkPlacement: 'on',
			         title: {
			             enabled: false
			         }
			     },
			     yAxis: {
			         title: {
			             text: 'Сумма $'
			         }
			     },
			     tooltip: {
			         split: true,
			         valueSuffix: ' $'
			     },
			     plotOptions: {
			         area: {
			             stacking: 'normal',
			             lineColor: '#666666',
			             lineWidth: 1,
			             marker: {
			                 lineWidth: 1,
			                 lineColor: '#666666'
			             }
			         }
			     },
			     series: [{
			         name: 'Пополнения Piastrix',
			         data: [<?=$piastrix?>]
			     }, {
			         name: 'Пополнения Robokassa',
			         data: [<?=$robokassa?>]
			     }, {
			         name: 'Пополнения Free-kassa',
			         data: [<?=$freekassa?>]
			     }, {
			         name: 'Пополнения Яндекс',
			         data: [<?=$yandex?>]
			     }, {
			         name: 'Пополнения Webmoney',
			         data: [<?=$webmoney?>]
			     }]
		    });
			*}
		
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

		<div id="container_1" style="min-width: 310px; height: 400px; margin: 10px auto"></div>
		
		
		
		
		
	
		<div id="container_2" style="min-width: 310px; height: 400px; margin: 10px auto"></div>











                                            </div>
                                        </div>
                                    </div>								
								
								
								
								
								
                                </div>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
                                
                                </div>
                                </div>
						
						
						
						</form>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>
			
			