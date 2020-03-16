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
                        
					<form method="POST" action="/admin/ajax/ch/edit/<?=$channel['id']?>" class="ajax-form">
						<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">

                        <div class="padding">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Данные канала</strong>
                                        </div>
                                        <div class="card-body">
											<div class="form-group">
												<label class="text-muted" for="name">Название</label>
												<input type="text" class="form-control" id="name" name="name" placeholder="Название" value="<?=$channel['name']?>" required>
											</div>
												
											<div class="form-group">
												<label class="text-muted" for="nameott">Название (ottplay)</label>
												<input type="text" class="form-control" id="nameott" name="nameott" value="<?=$channel['nameott']?>" placeholder="Название (ottplay)">
											</div>
											<div class="form-group">
												<label class="text-muted" for="server">Сервер</label>
                                                    <select id="server" name="server[]" data-plugin="select2" id="select2-multiple-fl" class="select2-multiple form-control" data-placeholder="Сервера" multiple required>
													<?php
													$servers_array = array_diff(explode('|',$channel['server']),array(''));
													foreach($servers as $k=>$v){ ?>
														<option value='<?=$v['id']?>' <?=(in_array($v['id'],$servers_array)) ? 'selected' : ''?>><?=$v['name']?></option>
													<?php }	?>
                                                    </select>
											</div>
												
											<div class="form-group">
												<label class="text-muted" for="fl">ID Flussonic</label>
												<input type="text" class="form-control" id="fl" name="fl" placeholder="ID Flussonic" value="<?=$channel['fl']?>" required>
											</div>
												
											<div class="form-group">
												<label class="text-muted" for="epg">EPG</label>
												<input type="text" class="form-control" id="epg" name="epg" value="<?=$channel['epg']?>" placeholder="EPG">
											</div>
												
											<div class="form-group">
												<label class="text-muted" for="epg">EPG (siptv)</label>
												<input type="text" class="form-control" id="epgsiptv" name="epgsiptv" value="<?=$channel['epgsiptv']?>" placeholder="EPG (siptv)">
											</div>
												
											<div class="form-group">
												<label class="text-muted" for="icon">Иконка</label>
												<input type="text" class="form-control" id="icon" name="icon" value="<?=$channel['icon']?>" placeholder="Иконка">
											</div>
                                        </div>
                                    </div>
                                    
                                </div>
								
								
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Данные канала</strong>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="archive">Архив</label>
                                                <div class="col-sm-8">
                                                    <label class="ui-switch ui-switch-md info m-t-xs">
                                                        <input name="archive" id="archive" type="checkbox" <?=($channel['archive']) ? 'checked' : ''?>>
                                                        <i></i>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="active">Канал включен</label>
                                                <div class="col-sm-8">
                                                    <label class="ui-switch ui-switch-md info m-t-xs">
                                                        <input name="active" id="active" type="checkbox" <?=($channel['active']) ? 'checked' : ''?>>
                                                        <i></i>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="select2-multiple-fl" class="col-sm-4 col-form-label">Блокировка по странам (Flussonic)</label>
                                                <div class="col-sm-8">
                                        <select data-plugin="select2" id="select2-multiple-fl" class="select2-multiple form-control" name="block_fl[]" data-placeholder="Нет блокировки" multiple>
										<?php foreach($this->config->item('country_codes') as $k=>$v){ ?>
										<option value="<?=$k?>" <?=(in_array($k,explode(',',$channel['block_fl']))) ? 'selected' : ''?>><?=$v?></option>
										<?php } ?>
                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="select2-multiple-site" class="col-sm-4 col-form-label">Блокировка по странам (Сайт из профиля)</label>
                                                <div class="col-sm-8">
                                        <select data-plugin="select2" id="select2-multiple-site" class="select2-multiple form-control" name="block_pl[]" data-placeholder="Нет блокировки" multiple>
										<?php foreach($this->config->item('country_codes') as $k=>$v){ ?>
										<option value="<?=$k?>" <?=(in_array($k,explode(',',$channel['block_pl']))) ? 'selected' : ''?>><?=$v?></option>
										<?php } ?>
                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="select2-multiple-auth" class="col-sm-4 col-form-label">Блокировка по странам (GEOip Авторизация при просмотре и скачивание плейлиста)</label>
                                                <div class="col-sm-8">
                                        <select data-plugin="select2" id="select2-multiple-auth" class="select2-multiple form-control" name="block[]" data-placeholder="Нет блокировки" multiple>
										<?php foreach($this->config->item('country_codes') as $k=>$v){ ?>
										<option value="<?=$k?>" <?=(in_array($k,explode(',',$channel['block']))) ? 'selected' : ''?>><?=$v?></option>
										<?php } ?>
                                        </select>
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
			
			