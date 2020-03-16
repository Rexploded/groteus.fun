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
                        
					<form method="POST" action="/admin/ajax/cat/create" class="ajax-form">
						<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">

                        <div class="padding">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Данные категории</strong>
                                        </div>
                                        <div class="card-body">
											<div class="form-group">
												<label class="text-muted" for="name">Название</label>
												<input type="text" class="form-control" id="name" name="name" placeholder="Название" required>
											</div>
											<div class="form-group">
												<label class="text-muted" for="channels">Каналы</label>
                                                    <select id="channels" name="channels[]" class="form-control select2-multiple" multiple data-plugin="select2" data-placeholder="Выберите каналы">
													<?php foreach($channels as $k=>$v){ ?>
														<option value='<?=$v['id']?>' <?=($v['category'] != 0) ? 'disabled' : ''?> ><?=$v['name']?></option>";
													<?php } ?>
                                                    </select>
											</div>
                                        </div>
                                    </div>
                                    
                                </div>
								
								
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Данные категории</strong>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="adult">Adult</label>
                                                <div class="col-sm-8">
                                                    <label class="ui-switch ui-switch-md info m-t-xs">
                                                        <input name="archive" id="adult" type="checkbox">
                                                        <i></i>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="pin">Pin-code</label>
                                                <div class="col-sm-8">
                                                        <input type="text"  name="pincode" class="form-control" maxlength="4" value="0000" id="pin" pattern="\d{4}" placeholder="Только 4 цифры" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                                                </div>
                                            </div>
											
											
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
			
			