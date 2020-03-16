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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Поиск пользователей</strong>
                                        </div>
                                        <div class="card-body">

                <form role="form" action="/admin/users/" method="GET">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Логин</label>
                        <input type="text" name="username" class="form-control" placeholder="Логин" value="{form-value-get=username}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" value="{form-value-get=email}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Статус</label>
						<select name="phone" class="form-control">
							<option>---</option>
							<option value="1" <?=($FORMF['phone'] == 1) ? 'selected' : ''?>>Активные</option>
							<option value="2" <?=($FORMF['phone'] == 2) ? 'selected' : ''?>>Не активные</option>
							<option value="3" <?=($FORMF['phone'] == 3) ? 'selected' : ''?>>Забаненые</option>
							<option value="4" <?=($FORMF['phone'] == 4) ? 'selected' : ''?>>Не забаненые</option>
							<option value="5" <?=($FORMF['phone'] == 5) ? 'selected' : ''?>>Активные и не забаненые</option>
							<option value="6" <?=($FORMF['phone'] == 6) ? 'selected' : ''?>>Активные и забаненые</option>
							<option value="7" <?=($FORMF['phone'] == 7) ? 'selected' : ''?>>Не активные и забаненые</option>
							<option value="8" <?=($FORMF['phone'] == 8) ? 'selected' : ''?>>Не активные и не забаненые</option>
						</select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Группа</label>
						<select class="form-control" name="user_group">
						<option>---</option>
						<?php foreach($this->users->GetUserGroups() as $k=>$v){ ?>
							<option value="<?=$v['id']?>" <?=($FORMF['user_group'] == $v['id']) ? 'selected' : ''?>><?=$v['name']?></option>
						<?php } ?>						
						</select>
                      </div>
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Логин</label>
						<select class="form-control" name="username_sort">
							<option>---</option>
							<option value="asc" <?=($FORMF['username_sort'] == 'asc') ? 'selected' : ''?>>По возрастанию</option>
							<option value="desc" <?=($FORMF['username_sort'] == 'desc') ? 'selected' : ''?>>По убыванию</option>
						</select>
                      </div>
                    </div>	

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Дата регистрации</label>
						<select class="form-control" name="registration_sort">
							<option>---</option>
							<option value="asc" <?=($FORMF['registration_sort'] == 'asc') ? 'selected' : ''?>>По возрастанию</option>
							<option value="desc" <?=($FORMF['registration_sort'] == 'desc') ? 'selected' : ''?>>По убыванию</option>
						</select>
                      </div>
                    </div>	

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Баланс</label>
						<select class="form-control" name="balance">
							<option>---</option>
							<option value="asc" <?=($FORMF['balance'] == 'asc') ? 'selected' : ''?>>По возрастанию</option>
							<option value="desc" <?=($FORMF['balance'] == 'desc') ? 'selected' : ''?>>По убыванию</option>
						</select>
                      </div>
                    </div>	

					
                  </div>
				  <button class="btn btn-primary btn-block">Поиск</button>
				  <?php
				  if(isset($_GET['username']) OR isset($_GET['email']) OR isset($_GET['phone']) OR isset($_GET['user_group']) OR isset($_GET['username_sort']) OR isset($_GET['registration_sort']) OR isset($_GET['balance'])){
					  ?>
					  <a href="/admin/users/" class="btn btn-warning btn-block">Сбросить поиск</a>
					  <?php
				  }
				  ?>
				  </form>



        </div>
        </div>
        </div>
        </div>
        </div>







<div class="padding">





                            <div class="mb-5">
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
						<div class="card p-3">	
							
							
                                <div class="toolbar ">
                                <div class="dropdown mb-2">
                                    <button class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">Действия </button>
                                    <div class="dropdown-menu bg-dark" role="menu">
                                        <a class="dropdown-item">
                                            Просмотр
                                        </a>
                                        <a class="dropdown-item">
                                            Статистика
                                        </a>
                                        <a class="dropdown-item">
                                            Включить
                                        </a>
                                        <a class="dropdown-item">
                                            Отключить
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item">
                                            Удалить
                                        </a>
                                    </div>
                                </div>
                                    <form  class="flex" action="/admin/users/" method="GET" style="width: 100%;">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-theme form-control-sm search" name="username" value="<?=(isset($_GET['username'])) ? $_GET['username'] : ''?>" placeholder="Поиск" required>
                                            <span class="input-group-append">
                <button class="btn btn-white no-border btn-sm" type="submit">
                  <span class="d-flex text-muted"><i data-feather="search"></i></span>
                                            </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table v-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="ui-check m-0">
                                                        <input type="checkbox" onchange="massactions(this)">
                                                        <i></i>
                                                    </label>
                                                </th>
                                                <th class="text-muted">Логин</th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Дата регистрации</span></th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Баланс</span></th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Тарифов</span></th>
                                                <th style="width:50px;"></th>					
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($USERS as $k=>$v){ ?>
                                            <tr class=" v-middle" data-id="15">
                                                <td>
                                                    <label class="ui-check m-0 ">
                                                        <input type="checkbox" class="massactions" name="massaction[<?=$v['id']?>]" value="<?=$v['id']?>">
                                                        <i></i>
                                                    </label>
                                                </td>
                                                <td class="flex">
                                                    <a href="/admin/users/<?=$v['id']?>" class="item-title text-color "><?=$v['username']?></a>
													<div class="item-except text-muted text-sm h-1x"><?=$this->users->GetGroupName($v['user_group'])?></div>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=date('d.m.Y H:i:s',$v['created_at'])?></span>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=$v['balance']?> $</span>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=$this->users->GetCountPack($v['id'])?></span>
                                                </td>
                                                <td>
                                                    <div class="item-action dropdown">
                                                        <a href="#" data-toggle="dropdown" class="text-muted">
                                                            <i data-feather="more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                                            <a class="dropdown-item" href="/admin/users/<?=$v['id']?>">
                                                                Редактировать
                                                            </a>
                                                            <a class="dropdown-item download">
                                                                Заблокировать
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