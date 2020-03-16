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
                        <div>
						
						
                        <div class="padding">
                            <div class="row" data-plugin="sort">
                                <div class="col-md-7">
						

                                    <div class="list list-row card" id="sortable-handle">
									
									<?php foreach($LIST as $k=>$v){ 
											//$SERVER = $this->flussonic->GetInfo($v['username'],$v['password'],$v['ip']);
									?>
									
									
                                        <div class="list-item " data-id="6">
                                            <div>
                                                <div class="text-muted js-handle">
                                                    <i data-feather="menu"></i>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <a href="/admin/fl/<?=$v['id']?>" class="item-author text-color "><?=$v['name']?></a>
                                                <div class="item-except text-muted text-sm h-1x">
                                                    <?=$v['description']?>
                                                </div>
                                            </div>
                                            <div class="no-wrap">
                                                <div class="item-date text-muted text-sm d-none d-md-block"><?=$v['ip']?></div>
                                            </div>
                                            <div class="no-wrap">
                                                <div class="item-date text-muted text-sm d-none d-md-block"><?=$v['domain']?></div>
                                            </div>
                                            <div>
                                                <div class="item-action dropdown">
                                                    <a href="#" data-toggle="dropdown" class="text-muted">
                                                        <i data-feather="more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                                        <a href="/admin/fl/<?=$v['id']?>" class="dropdown-item edit">
                                                            Редактировать
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item trash">
                                                            Удалить
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									<?php } ?>
                                    </div>						
                                    </div>						
                                    </div>						
                                    </div>						
						
						
						
						
						
						
						
						
						
						
						</div>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>