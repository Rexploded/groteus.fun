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

<div class="padding">





                            <div class="mb-5">

                                <div class="table-responsive">
                                    <table class="table v-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-muted">Название</th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Языки</span></th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Группы</span></th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Пользователи</span></th>
                                                <th class="text-muted">Дата</th>
                                                <th style="width:50px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($news as $k=>$v){ ?>
                                            <tr class=" v-middle" data-id="<?=$v['id']?>">
                                                <td>
                                                    <div class="avatar-group ">
														<a href="/admin/news/<?=$v['id']?>" class="item-title text-color "><?=$v['title']?></a>
                                                    </div>
                                                </td>
                                                <td class="flex">
													<span class="item-amount d-none d-sm-block">
                                                    <?php
													$lang_list = array();
													foreach(array_diff(explode('|',$v['langs']), array('')) as $k=>$v2){
														if($this->system->get_lang_list()[$v2]){
															$lang_list[] = '<span class="badge badge-success"> '.$this->system->get_lang_list()[$v2]['NAME'].' </span>';
														}
													}
													$lang_list[] = "<br>";
													foreach(array_diff(explode('|',$v['not_langs']), array('')) as $k=>$v2){
														if($this->system->get_lang_list()[$v2]){
															$lang_list[] = '<span class="badge badge-danger"> '.$this->system->get_lang_list()[$v2]['NAME'].' </span>';
														}
													}
													echo implode('',$lang_list);
													?>
													</span>
                                                </td>
                                                <td>
													<span class="item-amount d-none d-sm-block">
                                                    <?php
													$group_list = array();
													foreach(array_diff(explode('|',$v['user_groups']), array('')) as $k=>$v2){
														if($this->users->GetGroupName($v2)){
															$group_list[] = '<span class="badge badge-success"> '.$this->users->GetGroupName($v2).' </span>';
														}
													}
													$group_list[] = "<br>";
													foreach(array_diff(explode('|',$v['not_user_groups']), array('')) as $k=>$v2){
														if($this->users->GetGroupName($v2)){
															$group_list[] = '<span class="badge badge-danger"> '.$this->users->GetGroupName($v2).' </span>';
														}
													}
													echo implode('',$group_list);
													?>     
													</span>
                                                </td>
                                                <td>
													<span class="item-amount d-none d-sm-block">
                                                    <?php
													$users_list = array();
													foreach(array_diff(explode('|',$v['users']), array('')) as $k=>$v2){
														if($this->users->GetUserById($v2)['username']){
															$users_list[] = '<span class="badge badge-success"> '.$this->users->GetUserById($v2)['username'].' </span>';
														}
													}
													$users_list[] = "<br>";
													foreach(array_diff(explode('|',$v['not_users']), array('')) as $k=>$v2){
														if($this->users->GetUserById($v2)['username']){
															$users_list[] = '<span class="badge badge-danger"> '.$this->users->GetUserById($v2)['username'].' </span>';
														}
													}
													echo implode('',$users_list);
													?>  
													</span>
                                                </td>
                                                <td>
                                                    <?=date('d.m.Y H:i:s',$v['date'])?>
                                                </td>
                                                <td>
                                                    <div class="item-action dropdown">
                                                        <a href="#" data-toggle="dropdown" class="text-muted">
                                                            <i data-feather="more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                                            <a class="dropdown-item edit" href="/admin/ch/<?=$v['id']?>">
                                                                Редактировать
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item trash" href="javascript:GetMass('/admin/ajax/ch/action/','delete','<?=$v['id']?>')">
                                                                Удалить
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
								<nav>
  <ul class="pagination">
<?=$PAGES?> 
  </ul>
</nav>

                            </div>
                            </div>








                    </div>
                </div>
                <!-- ############ Main END-->
            </div>