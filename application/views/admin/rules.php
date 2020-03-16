            <div id="content" class="flex ">
                <!-- ############ Main START-->
                <div>
                    <div class="page-hero page-container " id="page-hero">
                        <div class="padding d-flex">
                            <div class="page-title">
                                <h2 class="text-md text-highlight">{title}</h2>
                                <small class="text-muted">{desc}</small>
                            </div>
                            <div class="flex"></div>
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">
                        <div class="padding">
							<form method="POST" action="/admin/ajax/rules/save" class="ajax-form">
								<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">
								<div class="card">
									<div class="card-header">
										<h3>Редактирование правил сайта</h3>
									</div>
									<div class="card-body">
										<textarea class="form-control" rows="20" name="rules" data-plugin="summernote" data-option="{minHeight: 400}">[config:rules]</textarea>
									</div>
									<br>
									<button type="submit" class="btn btn-success btn-block">Сохранить</button>
								</div>
							</form>							
						</div>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>