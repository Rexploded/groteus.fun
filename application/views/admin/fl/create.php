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
                        
					<form method="POST" action="/admin/ajax/fl/create" class="ajax-form">
						<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">

                        <div class="padding">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Данные сервера</strong>
                                        </div>
                                        <div class="card-body">
											<div class="form-group">
												<label class="text-muted" for="name">Название</label>
												<input type="text" class="form-control" id="name" name="name" placeholder="Название" required>
											</div>
											<div class="form-group">
												<label class="text-muted" for="desc">Описание</label>
												<input type="text" class="form-control" id="desc" name="desc" placeholder="Описание">
											</div>
											<div class="form-group">
												<label class="text-muted" for="ip">IP (без http:// или https://)</label>
												<input type="text" class="form-control" id="ip" name="ip" placeholder="IP" required>
											</div>
											<div class="form-group">
												<label class="text-muted" for="domain">Домен (без http:// или https://)</label>
												<input type="text" class="form-control" id="domain" name="domain" placeholder="Домен">
											</div>
											<div class="form-group">
												<label class="text-muted" for="port">Порт</label>
												<input type="number" class="form-control" id="port" name="port" value="80" placeholder="Порт" required>
											</div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="secure">Использовать ssl</label>
                                                <div class="col-sm-8">
                                                    <label class="ui-switch ui-switch-md info m-t-xs">
                                                        <input name="secure" id="secure" type="checkbox">
                                                        <i></i>
                                                    </label>
                                                </div>
                                            </div>
											<hr>
											Заполните поля ниже для статистики и управления сессиями
											<hr>
												<div class="form-group">
													<label class="text-muted" for="username">Пользователь</label>
													<input type="text" class="form-control" id="username" name="username" placeholder="Пользователь">
												</div>
												<div class="form-group">
													<label class="text-muted" for="password">Пароль</label>
													<input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
												</div>
											<hr>
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
			
			