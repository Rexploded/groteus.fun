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
                            <div class="card p-3">
                                <div class="toolbar ">
                                <div class="dropdown mb-2">
                                    <button class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">Действия </button>
                                    <div class="dropdown-menu bg-dark" role="menu">
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/ch/action/','on')">
                                            Включить
                                        </a>
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/ch/action/','off')">
                                            Отключить
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" onclick="GetMass('/admin/ajax/ch/action/','delete')">
                                            Удалить
                                        </a>
                                    </div>
                                </div>
                                </div>
                                <div class="table-responsive card-body">
                                    <table class="table v-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="ui-check m-0">
                                                        <input type="checkbox" onchange="massactions(this)">
                                                        <i></i>
                                                    </label>
                                                </th>
                                                <th class="text-muted">Иконка</th>
                                                <th class="text-muted">Канал</th>
                                                <th class="text-muted">Клиентов</th>
                                                <th class="text-muted">Сервер</th>
                                                <th class="text-muted"><span class="d-none d-sm-block">EPG</span></th>
                                                <th class="text-muted"><span class="d-none d-sm-block">ottplayer.es name</span></th>
                                                <th class="text-muted"><span class="d-none d-sm-block">EPG siptv</span></th>
                                                <th style="width:50px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($channels as $k=>$v){ ?>
                                            <tr class=" v-middle <?=($v['active'] == 0) ? 'table-warning' : ''?>" data-id="15">
                                                <td>
                                                    <label class="ui-check m-0 ">
                                                        <input type="checkbox" class="massactions" name="massaction[<?=$v['id']?>]" value="<?=$v['id']?>">
                                                        <i></i>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div class="avatar-group ">
														<?=($v['icon'])? '<a href="javascript:void(0);" class="avatar ajax w-32"><img src="'.$v['icon'].'" alt="."></a>' : ''?>
                                                    </div>
                                                </td>
                                                <td class="flex">
                                                    <a href="/admin/ch/<?=$v['id']?>" class="item-title text-color "><?=$v['name']?></a>
                                                    <div class="item-except text-muted text-sm h-1x">
                                                       <?=$v['fl']?>
                                                    </div>
                                                </td>
                                                <td class="flex">
                                                    <div class="item-except text-muted text-sm h-1x">
                                                       <a href="/admin/ch/<?=$v['id']?>/sessions"><span class="badge badge-success text-uppercase p-1" style="min-width: 57px;"> <?=($CH_DATA['client_count'][$v['fl']]) ? $CH_DATA['client_count'][$v['fl']] : 0?></span></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm ">
													<?php foreach(array_diff(explode('|',$v['server']), array('')) as $v2){ ?>
														<a href="/admin/fl/<?=$v2?>"><span class="badge badge-primary text-uppercase p-1"> <?=$this->admin->GetServer($v2)['name']?> <br> <?=($CH_DATA['bitrate'][$v2][$v['fl']]) ? $CH_DATA['bitrate'][$v2][$v['fl']].'k' : ''?></span></a>
													<?php } ?>
													</span>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=$v['epg']?></span>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=$v['nameott']?></span>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=$v['epgsiptv']?></span>
                                                </td>
                                                <td>
                                                    <div class="item-action dropdown">
                                                        <a href="#" data-toggle="dropdown" class="text-muted">
                                                            <i data-feather="more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
														<?php if($v['active'] == 0){ ?>
                                                            <a class="dropdown-item" href="javascript:GetMass('/admin/ajax/ch/action/','on','<?=$v['id']?>')">
                                                                Включить
                                                            </a>
														<?php }else{ ?>
                                                            <a class="dropdown-item download" href="javascript:GetMass('/admin/ajax/ch/action/','off','<?=$v['id']?>')">
                                                                Отключить
                                                            </a>
														<?php } ?>
                                                            <a class="dropdown-item edit" href="/admin/ch/<?=$v['id']?>">
                                                                Редактировать
                                                            </a>
                                                            <a class="dropdown-item edit" href="/admin/ch/<?=$v['id']?>/sessions">
                                                                Сессии
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
                </div>
                <!-- ############ Main END-->
            </div>