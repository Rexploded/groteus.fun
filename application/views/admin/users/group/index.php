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
                                    <table class="table table-theme table-row v-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="ui-check m-0">
                                                        <input type="checkbox">
                                                        <i></i>
                                                    </label>
                                                </th>
                                                <th class="text-muted">#ID</th>
                                                <th class="text-muted">Название</th>
                                                <th style="width:50px;"></th>					
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($GROUPS as $k=>$v){ ?>
                                            <tr class=" v-middle" data-id="15">
                                                <td>
                                                    <label class="ui-check m-0 ">
                                                        <input type="checkbox" name="id" value="15">
                                                        <i></i>
                                                    </label>
                                                </td>
                                                <td class="flex">
                                                    <?=$v['id']?>
                                                </td>
                                                <td class="flex">
                                                    <a href="/admin/users/group/<?=$v['id']?>" class="item-title text-color "><?=$v['name']?></a>
                                                </td>
                                                <td>
                                                    <div class="item-action dropdown">
                                                        <a href="#" data-toggle="dropdown" class="text-muted">
                                                            <i data-feather="more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                                            <a class="dropdown-item" href="/admin/users/group/<?=$v['id']?>">
                                                                Редактировать
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item trash">
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


                            </div>
                            </div>








                    </div>
                </div>
                <!-- ############ Main END-->
            </div>