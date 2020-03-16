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
                        
					<form method="POST" action="/admin/ajax/news/edit/<?=$news['id']?>" class="ajax-form">
						<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">

                        <div class="padding">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Данные</strong>
                                        </div>
                                        <div class="card-body">
											<div class="form-group">
												<label class="text-muted" for="title">Название</label>
												<input type="text" class="form-control" id="title" name="title" placeholder="Название" value="<?=$news['title']?>" required>
											</div>
												
											<div class="form-group">
												<label class="text-muted" for="text">Новость</label>
												<textarea class="form-control" rows="8" id="text" name="text"  data-plugin="summernote" data-option="{minHeight: 150}"><?=$news['text']?></textarea>
											</div>
                                        </div>
                                    </div>
                                    
                                </div>
								
								
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Дополнительно</strong>
                                        </div>
                                        <div class="card-body">



                                            <div class="form-group row">
                                                <label for="select2-multiple-fl" class="col-sm-4 col-form-label">Разрешить только языки</label>
                                                <div class="col-sm-8">
                                        <select data-plugin="select2" id="langs" class="select2-multiple form-control" name="langs[]" data-placeholder="Всем" multiple>
										<?php foreach($this->system->get_lang_list() as $k=>$v){ ?>
											<option value="<?=$v['SYMBOL']?>" <?=(in_array($v['SYMBOL'],$news['langs'])) ? 'selected' : ''?>><?=$v['NAME']?></option>
										<?php } ?>
                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="select2-multiple-site" class="col-sm-4 col-form-label">Разрешить только группы</label>
                                                <div class="col-sm-8">
                                        <select data-plugin="select2" id="user_groups" class="select2-multiple form-control" name="user_groups[]" data-placeholder="Всем" multiple>
										<?php foreach($this->users->GetUserGroups() as $k=>$v){ ?>
											<option value="<?=$v['id']?>" <?=(in_array($v['id'],$news['user_groups'])) ? 'selected' : ''?>><?=$v['name']?></option>
										<?php } ?>
                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="select2-multiple-site" class="col-sm-4 col-form-label">Разрешить только пользователям</label>
                                                <div class="col-sm-8">
													<input type="text" class="form-control" name="users" value="<?=$news['users']?>" placeholder="Всем">
                                                </div>
                                            </div>
											

<hr>
<hr>

                                            <div class="form-group row">
                                                <label for="select2-multiple-fl" class="col-sm-4 col-form-label">Запретить только для языков</label>
                                                <div class="col-sm-8">
                                        <select data-plugin="select2" id="not_langs" class="select2-multiple form-control" name="not_langs[]" data-placeholder="Никому" multiple>
										<?php foreach($this->system->get_lang_list() as $k=>$v){ ?>
											<option value="<?=$v['SYMBOL']?>" <?=(in_array($v['SYMBOL'],$news['not_langs'])) ? 'selected' : ''?>><?=$v['NAME']?></option>
										<?php } ?>
                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="select2-multiple-site" class="col-sm-4 col-form-label">Запретить только для групп</label>
                                                <div class="col-sm-8">
                                        <select data-plugin="select2" id="not_user_groups" class="select2-multiple form-control" name="not_user_groups[]" data-placeholder="Никому" multiple>
										<?php foreach($this->users->GetUserGroups() as $k=>$v){ ?>
											<option value="<?=$v['id']?>" <?=(in_array($v['id'],$news['not_user_groups'])) ? 'selected' : ''?>><?=$v['name']?></option>
										<?php } ?>
                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="select2-multiple-site" class="col-sm-4 col-form-label">Запретить только для пользователей</label>
                                                <div class="col-sm-8">
													<input type="text" class="form-control" name="not_users" value="<?=$news['not_users']?>" placeholder="Никому">
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
			
			