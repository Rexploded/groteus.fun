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
                        
					<form method="POST" action="/admin/ajax/billing/transfer/save" class="ajax-form">
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
									<h8 class="media-heading text-semibold">Включить:</h8>
									<span class="text-muted text-size-small hidden-xs">Включить плагин для всех пользователей</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<label class="md-check">
										<input type="checkbox" name="billing_module_transfer_active" value="1" <?=($this->CONFIG->get('billing_module_transfer_active')) ? 'checked' : ''?>>
										<i class="blue"></i>
									</label>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Минимальная сумма для перевода:</h8>
									<span class="text-muted text-size-small hidden-xs">В текущей валюте сайта</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="number" step="0.01" name="billing_transfer_minimum" class="form-control" onchange="$(this).val(parseFloat($(this).val()).toFixed(2));" value="<?=$this->billing->convert($this->CONFIG->get('billing_transfer_minimum'))?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Комиссия сайта:</h8>
									<span class="text-muted text-size-small hidden-xs">Данный процент от суммы вывода будет удерживаться сайтом в качестве комиссии.</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
								<div class="input-group">
									<input type="number" min='0' step='1' max='100' name="billing_transfer_comission" value="0" class="form-control" onchange="if($(this).val() > 100 || $(this).val()< 0){ $(this).val(0); }" value="<?=$this->CONFIG->get('billing_transfer_comission')?>">
<div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                </div>
								</td>
							</tr>
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
			
			