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
                        
					<form method="POST" action="/admin/ajax/users/group/edit/<?=$GROUP['id']?>" class="ajax-form">
						<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">

                        <div class="padding">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Данные группы</strong>
                                        </div>
                                        <div class="card-body">
											<div class="form-group">
												<label class="text-muted" for="name">Название</label>
												<input type="text" class="form-control" id="name" name="name" placeholder="Название" value="<?=$GROUP['name']?>" required>
											</div>
                                        </div>
                                    </div>
                                    
                                </div>
								
								
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Привилегии</strong>
                                        </div>
                                        <div class="card-body">
										<?php foreach($this->system->GetPrivilegies() as $k=>$v){ ?>
										
                                                    <div class="mb-3">
                                                        <label class="md-check">
                                                            <input type="checkbox" name="pr[<?=$v['id']?>]" value="<?=$v['id']?>" <?=($this->db->query("SELECT COUNT(*) as count FROM privilegies_group WHERE pr_id=? AND group_id=?",array($v['id'],$GROUP['id']))->row_array()['count'] > 0)? 'checked' : ''?>>
                                                            <i class="blue"></i>
                                                            <?=lang($v['lang'])?><?=$v['name']?>
                                                        </label>
                                                    </div>   
											
										<?php } ?>
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
			
			