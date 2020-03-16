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
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Главные настройки</strong>
                                        </div>
                                        <div class="card-body p-0 table-responsive">


<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Наименование у.е.:</h8>
									<span class="text-muted text-size-small hidden-xs">Отображается рядом с суммой. Формат настройки: рубль|рубля|рублей</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="billing_currency_decline" class="form-control" value="<?=$this->CONFIG->get('billing_currency_decline')?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Логин администратора:</h8>
									<span class="text-muted text-size-small hidden-xs">Будет использоваться как отправитель в служебных сообщениях пользователям</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="billing_admin_login_message" class="form-control" value="<?=$this->CONFIG->get('billing_admin_login_message')?>" required>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Сумма оплаты по умолчанию:</h8>
									<span class="text-muted text-size-small hidden-xs">Используется на странице пополнения баланса</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="number" step="0.01" name="billing_minimum_pay" class="form-control" onchange="$(this).val(parseFloat($(this).val()).toFixed(2));" value="<?=$this->billing->convert($this->CONFIG->get('billing_minimum_pay'))?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Ключ доступа платежной системы:</h8>
									<span class="text-muted text-size-small hidden-xs">Введите произвольный нобор букв и цифр, ключ используется для формировании result url.<br>
Никому не сообщайте этот ключ</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="billing_secret_key" class="form-control" value="<?=$this->CONFIG->get('billing_secret_key')?>">
								</td>
							</tr>
						</table>



                                        </div>
                                    </div>
                                    
                                </div>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Настройки уведомлений</strong>
                                        </div>
                                        <div class="card-body p-0 table-responsive">


<table width="100%" class="table table-striped">
<thead><tr class="d-flex">
<td class="col-xs-6 col-sm-6 col-md-8">Действие пользователя</td>
<td class="col-xs-3 col-sm-3 col-md-2">Сообщение в личную почту</td>
<td class="col-xs-3 col-sm-3 col-md-2">Сообщение на email</td></tr></thead>
<tbody>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-8">
									<h8 class="media-heading text-semibold">Квитанция оплачена:</h8>
									<span class="text-muted text-size-small hidden-xs">Пользователь успешно завершил оплату на сайте платежной системы</span>
								</td>
								<td class="col-xs-3 col-sm-3 col-md-2" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_notif_pm_paysuccess" value="1" <?=($this->CONFIG->get('billing_notif_pm_paysuccess')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
								<td class="col-xs-3 col-sm-3 col-md-2" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_notif_mail_paysuccess" value="1"  <?=($this->CONFIG->get('billing_notif_mail_paysuccess')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>

							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-8">
									<h8 class="media-heading text-semibold">Новая квитанция:</h8>
									<span class="text-muted text-size-small hidden-xs">Пользователь начал процесс пополнения баланса</span>
								</td>
								<td class="col-xs-3 col-sm-3 col-md-2" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_notif_pm_paystart" value="1" <?=($this->CONFIG->get('billing_notif_pm_paystart')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
								<td class="col-xs-3 col-sm-3 col-md-2" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_notif_mail_paystart" value="1"  <?=($this->CONFIG->get('billing_notif_mail_paystart')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-8">
									<h8 class="media-heading text-semibold">Баланс изменён:</h8>
									<span class="text-muted text-size-small hidden-xs">Баланс пользователя на сайте был изменён (НЕ платежной системой)</span>
								</td>
								<td class="col-xs-3 col-sm-3 col-md-2" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_notif_pm_balancechangeadmin" value="1" <?=($this->CONFIG->get('billing_notif_pm_balancechangeadmin')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
								<td class="col-xs-3 col-sm-3 col-md-2" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_notif_mail_balancechangeadmin" value="1"  <?=($this->CONFIG->get('billing_notif_mail_balancechangeadmin')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>
							
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-8">
									<h8 class="media-heading text-semibold">Баланс изменён:</h8>
									<span class="text-muted text-size-small hidden-xs">Баланс пользователя на сайте был изменён (платежной системой)</span>
								</td>
								<td class="col-xs-3 col-sm-3 col-md-2" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_notif_pm_balancechange" value="1" <?=($this->CONFIG->get('billing_notif_pm_balancechange')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
								<td class="col-xs-3 col-sm-3 col-md-2" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_notif_mail_balancechange" value="1"  <?=($this->CONFIG->get('billing_notif_mail_balancechange')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>
</tbody>
						</table>



                                        </div>
                                    </div>
                                    
                                </div>
								
								
                                
										
								<div class="col-md-12">
								
								<button class="btn btn-success btn-block">Сохранить</button>
								
								
                                </div>
                                </div>
                                </div>
						
						
						
						</form>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>
			
			