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
                        
					<form method="POST" action="/admin/ajax/tariffs/create" class="ajax-form">
						<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">

                        <div class="padding">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Данные тарифа</strong>
                                        </div>
                                        <div class="card-body">

                  <div class="form-group has-error">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Название" required>
                  </div>

                  <div class="form-group has-error">
                    <label for="desc">Описание</label>
                    <input type="text" class="form-control" id="desc" name="desc" placeholder="Описание">
                  </div>

                                            <div class="form-group row" id="connects_row">
                                                <label class="col-sm-4 col-form-label" for="connects">Кол-во подключений</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" name="connects" id="connects" min='1' step='1'  value="1">
                                                </div>
                                            </div>

                                            <div class="form-group row" id="portals_row">
                                                <label class="col-sm-4 col-form-label" for="portals">Кол-во порталов</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" name="portals" id="portals" min='1' step='1'  value="1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="archive">Архив</label>
                                                <div class="col-sm-8">
                                                    <label class="ui-switch ui-switch-md info m-t-xs">
                                                        <input name="archive" id="archive" type="checkbox" checked>
                                                        <i></i>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="active">Активен</label>
                                                <div class="col-sm-8">
                                                    <label class="ui-switch ui-switch-md info m-t-xs">
                                                        <input name="active" id="active" type="checkbox" checked>
                                                        <i></i>
                                                    </label>
                                                </div>
                                            </div>
<hr>



                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Состав тарифа</label>
                                                <div class="col-sm-8">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="typetariff" value='1' class="custom-control-input" id="customRadio1" checked>
                                                        <label class="custom-control-label" data-value='1' for="customRadio1">Плейлист + портал</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="typetariff" value='2' class="custom-control-input" id="customRadio3">
                                                        <label class="custom-control-label" data-value='2' for="customRadio3">Только плейлист</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="typetariff" value='3' class="custom-control-input" id="customRadio4">
                                                        <label class="custom-control-label" data-value='3' for="customRadio4">Только портал</label>
                                                    </div>
                                                </div>
                                            </div>





                  <div class="form-group has-error" id="external_id_field">
                    <label for="external_id">External_id тарифа в портале</label>
                    <input type="text" class="form-control" id="external_id" name="external_id" placeholder="External_id" required>
                  </div>

<hr>

				<div class="costs row">
					<div class="remm col-md-12 row">
						<div class="form-group col-md-2">
						<label>Период</label>
						<select name="period[]" class="form-control">
							<option value="60">Минута</option>
							<option value="3600">Час</option>
							<option value="86400" selected>День</option>
							<option value="604800">Неделя</option>
							<option value="2592000">Месяц</option>
							<option value="31536000">Год</option>
						</select>
					  </div>
					  <div class="form-group col-md-2">
						<label>Значение</label>
						<input type="number" class="form-control" name="long[]">
					  </div>
					  <div class="form-group col-md-2">
						<label>Стоимость</label>
						<input type="number" class="form-control" name="cost[]" step="0.01">
					  </div>
					  <div class="form-group col-md-3">
						<label>Название</label>
						<input type="text" class="form-control" name="text[]">
					  </div>
					  <div class="form-group col-md-3">
						<label>Действия</label><br>
						<button type="button" class="AddCost btn btn-success"><i class="mx-2" data-feather="plus"></i></button>
						<button type="button" class="RemoveCost btn btn-danger"><i class="mx-2" data-feather="minus"></i></button>
					  </div>
					  <hr>
					</div> 
                </div>
											
											
											
											
											
                                        </div>
                                    </div>
                                    
                                </div>
								
								
								
								

										
								<div class="col-md-6">
								

                                    <div class="list list-row card" data-plugin="sort" id="sortable-handle">
									<?php foreach($channels as $k=>$v){ ?>
                                        <div class="list-item " data-id="<?=$v['id']?>" style="border: 1px #e4e3e3 solid;">
                                            <div>
                                                <div class="text-muted js-handle">
                                                    <i data-feather="menu"></i>
                                                </div>
                                            </div>
                                            <div class="flex clickcheck">
                                                <a href="javascript:void(0);" class="item-author text-color "><?=$v['name']?></a>
                                                <div class="item-except text-muted text-sm h-1x">
                                                    <?=$v['fl']?>
                                                </div>
                                            </div>
                                            <div>
                                                    <label class="ui-check m-0">
                                                        <input name="ch[<?=$v['id']?>]" value="<?=$v['id']?>" type="checkbox">
                                                        <i></i>
                                                    </label>
                                            </div>
                                        </div>
									<?php } ?>
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
	
	  
<div class="template" style="display:none;">
					<div class="remm col-md-12 row">
						<div class="form-group col-md-2">
						<label>Период</label>
						<select name="period[]" class="form-control">
							<option value="60">Минута</option>
							<option value="3600">Час</option>
							<option value="86400" selected>День</option>
							<option value="604800">Неделя</option>
							<option value="2592000">Месяц</option>
							<option value="31536000">Год</option>
						</select>
					  </div>
					  <div class="form-group col-md-2">
						<label>Значение</label>
						<input type="number" class="form-control" name="long[]" step="0.01">
					  </div>
					  <div class="form-group col-md-2">
						<label>Стоимость</label>
						<input type="number" class="form-control" name="cost[]">
					  </div>
					  <div class="form-group col-md-3">
						<label>Название</label>
						<input type="text" class="form-control" name="text[]">
					  </div>
					  <div class="form-group col-md-3">
						<label>Действия</label><br>
						<button type="button" class="AddCost btn btn-success"><i class="mx-2" data-feather="plus"></i></button>
						<button type="button" class="RemoveCost btn btn-danger"><i class="mx-2" data-feather="minus"></i></button>
					  </div>
					  <hr>
					</div>  
</div>	 			