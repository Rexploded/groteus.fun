<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>[config:site_title] | Админпанель</title>
        <meta name="description" content="Responsive, Bootstrap, BS4" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- style -->
        <!-- build:css /assets/css/site.min.css -->
        <link rel="stylesheet" href="/assets/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="/assets/css/theme.css" type="text/css" />
        <link rel="stylesheet" href="/assets/css/style.css" type="text/css" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
  
<style>  
.list-item.active{
background: #e1ecff;
}
</style>    
  
        <!-- endbuild -->
		<script src="https://kit.fontawesome.com/626fc1890e.js" crossorigin="anonymous"></script>
    </head>
    <body class="layout-row">
	<input type="hidden" value="{csrf_name}" id="csrf_name">
	<input type="hidden" value="{csrf_value}" id="csrf_value">
        <!-- ############ Aside START-->
        <div id="aside" class="page-sidenav no-shrink bg-light nav-dropdown fade" aria-hidden="true">
            <div class="sidenav h-100 modal-dialog bg-light">
                <!-- sidenav top -->
                <div class="navbar">
                    <!-- brand -->
                    <a href="index.html" class="navbar-brand ">
                        <svg width="32" height="32" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <g class="loading-spin" style="transform-origin: 256px 256px">
                                <path d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z"></path>
                            </g>
                        </svg>
                        <!-- <img src="/assets/img/logo.png" alt="..."> -->
                        <span class="hidden-folded d-inline l-s-n-1x ">Basik</span>
                    </a>
                    <!-- / brand -->
                </div>
                <!-- Flex nav content -->
                <div class="flex">
				

                                                <div class="pt-2">
                                                    <div class="nav-fold px-2">
                                                        <a class="d-flex p-2" data-toggle="dropdown">
                                                            <span class="avatar w-40 rounded hide">J</span>
                                                            <img src="<?=$_SESSION['avatar']?>" alt="..." class="w-40 r">
                                                        </a>
                                                        <div class="hidden-folded flex p-2">
                                                            <div class="d-flex">
                                                                <a href="/admin/users/<?=$_SESSION['id']?>" class="mr-auto text-nowrap">
                                                                    <?=$_SESSION['username']?>
                                                                    <small class="d-block text-muted"><?=$this->users->GetGroupName($_SESSION['user_group'])?></small>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>				
				
                    <div class="nav-active-text-primary" data-nav>
                        <ul class="nav bg">
                            <li class="nav-header hidden-folded">
                                <span class="text-muted">Main</span>
                            </li>
                            <li>
                                <a href="/admin">
                                    <span class="nav-icon text-primary"><i data-feather='home'></i></span>
                                    <span class="nav-text">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/settings">
                                    <span class="nav-icon text-primary"><i data-feather='home'></i></span>
                                    <span class="nav-text">Настройки</span>
                                </a>
                            </li>
							
                            <li>
                                <a href="/admin/messages/">
                                    <span class="nav-icon text-warning"><i data-feather='message-circle'></i></span>
                                    <span class="nav-text">Сообщения</span>
                                    <span class="nav-badge"><b class="badge-circle xs text-warning"></b></span>
                                </a>
                            </li>							

                            <li>
                                <a href="#" class="">
                                    <span class="nav-icon"><i data-feather='grid'></i></span>
                                    <span class="nav-text">E-mail</span>
                                    <span class="nav-caret"></span>
                                </a>
                                <ul class="nav-sub nav-mega">
                                    <li>
                                        <a href="/admin/mail" class="">
                                            <span class="nav-text">Массовая рассылка</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/mail/templates" class="">
                                            <span class="nav-text">Шаблоны e-mail</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>		

                            <li>
                                <a href="#" class="">
                                    <span class="nav-icon"><i data-feather='grid'></i></span>
                                    <span class="nav-text">Новости</span>
                                    <span class="nav-caret"></span>
                                </a>
                                <ul class="nav-sub nav-mega">
                                    <li>
                                        <a href="/admin/news" class="">
                                            <span class="nav-text">Список новостей</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/news/create" class="">
                                            <span class="nav-text">Добавить новость</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>		

                            <li>
                                <a href="#" class="">
                                    <span class="nav-icon"><i data-feather='grid'></i></span>
                                    <span class="nav-text">Flussonic</span>
                                    <span class="nav-caret"></span>
                                </a>
                                <ul class="nav-sub nav-mega">
                                    <li>
                                        <a href="/admin/fl" class="">
                                            <span class="nav-text">Серверы</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/fl/create" class="">
                                            <span class="nav-text">Добавить сервер</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>	

                            <li>
                                <a href="#" class="">
                                    <span class="nav-icon"><i data-feather='grid'></i></span>
                                    <span class="nav-text">Биллинг</span>
                                    <span class="nav-caret"></span>
                                </a>
                                <ul class="nav-sub nav-mega">
                                    <li>
                                        <a href="/admin/billing" class="">
                                            <span class="nav-text">Главная</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/billing/settings/" class="">
                                            <span class="nav-text">Настройки</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/billing/users" class="">
                                            <span class="nav-text">Пользователи и группы</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/billing/statistics" class="">
                                            <span class="nav-text">Статистика</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/billing/transactions" class="">
                                            <span class="nav-text">История движения</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/billing/invoice" class="">
                                            <span class="nav-text">Поступление средств </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/billing/statistics" class="">
                                            <span class="nav-text">Статистика</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>	
							
							

                            <li>
                                <a href="#" class="">
                                    <span class="nav-icon"><i data-feather='grid'></i></span>
                                    <span class="nav-text">Каналы</span>
                                    <span class="nav-caret"></span>
                                </a>
                                <ul class="nav-sub nav-mega">
                                    <li>
                                        <a href="/admin/ch/" class="">
                                            <span class="nav-text">Список каналов</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/ch/create/" class="">
                                            <span class="nav-text">Добавить канал</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/сh/stat" class="">
                                            <span class="nav-text">Статистика</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/cat/" class="">
                                            <span class="nav-text">Список категорий</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/cat/create/" class="">
                                            <span class="nav-text">Добавить категорию</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/tariffs/" class="">
                                            <span class="nav-text">Список тарифов</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/tariffs/create/" class="">
                                            <span class="nav-text">Создать тариф</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>			
							
							

                            <li>
                                <a href="#" class="">
                                    <span class="nav-icon"><i data-feather='grid'></i></span>
                                    <span class="nav-text">Пользователи</span>
                                    <span class="nav-caret"></span>
                                </a>
                                <ul class="nav-sub nav-mega">
                                    <li>
                                        <a href="/admin/users/" class="">
                                            <span class="nav-text">Список пользователей</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/users/group/" class="">
                                            <span class="nav-text">Группы пользователей</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>							
							
							
							
							
							
							
							
							
	
                        </ul>
                        
                    </div>
                </div>
				
<div class="py-2 mt-2 b-t no-shrink">
                                                <ul class="nav no-border">
                                                    <li>
                                                        <a href="#">
                                                            <span class="nav-icon">
						          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
						        </span>
                                                            <span class="nav-text">Logout</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>				
				
                <!-- sidenav bottom -->
                <div class="no-shrink ">
                    <div class="p-3 d-flex align-items-center">
                        <div class="text-sm hidden-folded text-muted">
                            Trial: 35%
                        </div>
                        <div class="progress mx-2 flex" style="height:4px;">
                            <div class="progress-bar gd-success" style="width: 35%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ############ Aside END-->
        <div id="main" class="layout-column flex">
            <!-- ############ Header START-->
            <div id="header" class="page-header ">
                <div class="navbar navbar-expand-lg">
                    <!-- brand -->
                    <a href="index.html" class="navbar-brand d-lg-none">
                        <svg width="32" height="32" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <g class="loading-spin" style="transform-origin: 256px 256px">
                                <path d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z"></path>
                            </g>
                        </svg>
                        <!-- <img src="/assets/img/logo.png" alt="..."> -->
                        <span class="hidden-folded d-inline l-s-n-1x d-lg-none">Basik</span>
                    </a>
                    <!-- / brand -->
                    <!-- Navbar collapse -->
                    <div class="collapse navbar-collapse order-2 order-lg-1" id="navbarToggler">
                        <form class="input-group m-2 my-lg-0 ">
                            <div class="input-group-prepend">
                                <button type="button" class="btn no-shadow no-bg px-0 text-inherit">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control no-border no-shadow no-bg typeahead" placeholder="Search components..." data-plugin="typeahead" data-api="/assets/api/menu.json">
                        </form>
                    </div>
                    <ul class="nav navbar-menu order-1 order-lg-2">
                        <li class="nav-item d-none d-sm-block">
                            <a class="nav-link px-2" data-toggle="fullscreen" data-plugin="fullscreen">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link px-2" data-toggle="dropdown">
                                <i data-feather="settings"></i>
                            </a>
                            <!-- ############ Setting START-->
                            <div class="dropdown-menu dropdown-menu-center mt-3 w-md animate fadeIn">
                                <div class="setting px-3">
                                    <div class="mb-2 text-muted">
                                        <strong>Setting:</strong>
                                    </div>
                                    <div class="mb-3" id="settingLayout">
                                        <label class="ui-check ui-check-rounded my-1 d-block">
                                            <input type="checkbox" name="stickyHeader">
                                            <i></i>
                                            <small>Sticky header</small>
                                        </label>
                                        <label class="ui-check ui-check-rounded my-1 d-block">
                                            <input type="checkbox" name="stickyAside">
                                            <i></i>
                                            <small>Sticky aside</small>
                                        </label>
                                        <label class="ui-check ui-check-rounded my-1 d-block">
                                            <input type="checkbox" name="foldedAside">
                                            <i></i>
                                            <small>Folded Aside</small>
                                        </label>
                                        <label class="ui-check ui-check-rounded my-1 d-block">
                                            <input type="checkbox" name="hideAside">
                                            <i></i>
                                            <small>Hide Aside</small>
                                        </label>
                                    </div>
                                    <div class="mb-2 text-muted">
                                        <strong>Color:</strong>
                                    </div>
                                    <div class="mb-2">
                                        <label class="radio radio-inline ui-check ui-check-md">
                                            <input type="radio" name="bg" value="">
                                            <i></i>
                                        </label>
                                        <label class="radio radio-inline ui-check ui-check-color ui-check-md">
                                            <input type="radio" name="bg" value="bg-dark">
                                            <i class="bg-dark"></i>
                                        </label>
                                    </div>
                                    <div class="mb-2 text-muted">
                                        <strong>Layouts:</strong>
                                    </div>
                                    <div class="mb-3">
                                        <a href="dashboard.html" class="btn btn-xs btn-white no-ajax mb-1">Default</a>
                                        <a href="layout.a.html?bg" class="btn btn-xs btn-primary no-ajax mb-1">A</a>
                                        <a href="layout.b.html?bg" class="btn btn-xs btn-info no-ajax mb-1">B</a>
                                        <a href="layout.c.html?bg" class="btn btn-xs btn-success no-ajax mb-1">C</a>
                                        <a href="layout.d.html?bg" class="btn btn-xs btn-warning no-ajax mb-1">D</a>
                                    </div>
                                    <div class="mb-2 text-muted">
                                        <strong>Apps:</strong>
                                    </div>
                                    <div>
                                        <a href="dashboard.html" class="btn btn-sm btn-white no-ajax mb-1">Dashboard</a>
                                        <a href="music.html?bg" class="btn btn-sm btn-white no-ajax mb-1">Music</a>
                                        <a href="video.html?bg" class="btn btn-sm btn-white no-ajax mb-1">Video</a>
                                    </div>
                                </div>
                            </div>
                            <!-- ############ Setting END-->
                        </li>
                        <!-- Notification -->
                        <li class="nav-item dropdown">
                            <a class="nav-link px-2 mr-lg-2" data-toggle="dropdown">
                                <i data-feather="bell"></i>
                                <span class="badge badge-pill badge-up bg-primary">5</span>
                            </a>
                            <!-- dropdown -->
                            <div class="dropdown-menu dropdown-menu-right mt-3 w-md animate fadeIn p-0">
                                <div class="scrollable hover" style="max-height: 250px">
                                    <div class="list list-row">
                                        <div class="list-item " data-id="11">
                                            <div>
                                                <a href="#">
                                                    <span class="w-32 avatar gd-info">
		                          K
		                    </span>
                                                </a>
                                            </div>
                                            <div class="flex">
                                                <div class="item-feed h-2x">
                                                    Prepare the documentation for the
                                                    <a href='#'>Fitness app</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item " data-id="14">
                                            <div>
                                                <a href="#">
                                                    <span class="w-32 avatar gd-warning">
		                          B
		                    </span>
                                                </a>
                                            </div>
                                            <div class="flex">
                                                <div class="item-feed h-2x">
                                                    Do you know which are the popular ones? Leave a comment and get to know more from professional developers
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item " data-id="17">
                                            <div>
                                                <a href="#">
                                                    <span class="w-32 avatar gd-warning">
		                          H
		                    </span>
                                                </a>
                                            </div>
                                            <div class="flex">
                                                <div class="item-feed h-2x">
                                                    AI will deliver adaptive learning processes in assessments & digital textbooks to personalize learning
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item " data-id="10">
                                            <div>
                                                <a href="#">
                                                    <span class="w-32 avatar gd-danger">
		                          <img src="/assets/img/a10.jpg" alt=".">
		                    </span>
                                                </a>
                                            </div>
                                            <div class="flex">
                                                <div class="item-feed h-2x">
                                                    Developers of
                                                    <a href='#'>@iAI</a>, the AI assistant based on Free Software
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item " data-id="20">
                                            <div>
                                                <a href="#">
                                                    <span class="w-32 avatar gd-warning">
		                          G
		                    </span>
                                                </a>
                                            </div>
                                            <div class="flex">
                                                <div class="item-feed h-2x">
                                                    <a href='#'>@Netflix</a> hackathon
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item " data-id="17">
                                            <div>
                                                <a href="#">
                                                    <span class="w-32 avatar gd-warning">
		                          A
		                    </span>
                                                </a>
                                            </div>
                                            <div class="flex">
                                                <div class="item-feed h-2x">
                                                    Alibaba made a smart screen
                                                    <a href='#'>@Alibaba</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex px-3 py-2 b-t">
                                    <div class="flex">
                                        <span>6 Notifications</span>
                                    </div>
                                    <a href="page.setting.html">See all
                                        <i class="fa fa-angle-right text-muted"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- / dropdown -->
                        </li>
                        <!-- User dropdown menu -->
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link d-flex align-items-center px-2 text-color">
                                <span class="avatar w-24" style="margin: -2px;"><img src="/assets/img/a1.jpg" alt="..."></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right w mt-3 animate fadeIn">
                                <a class="dropdown-item" href="page.profile.html">
                                    <span>Jacqueline Reid</span>
                                </a>
                                <a class="dropdown-item" href="page.price.html">
                                    <span class="badge bg-success text-uppercase">Upgrade</span>
                                    <span>to Pro</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="page.profile.html">
                                    <span>Profile</span>
                                </a>
                                <a class="dropdown-item d-flex" href="page.invoice.html">
                                    <span class="flex">Invoice</span>
                                    <span><b class="badge badge-pill gd-warning">5</b></span>
                                </a>
                                <a class="dropdown-item" href="page.faq.html">Need help?</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="page.setting.html">
                                    <span>Account Settings</span>
                                </a>
                                <a class="dropdown-item" href="/auth/logout">Sign out</a>
                            </div>
                        </li>
                        <!-- Navarbar toggle btn -->
                        <li class="nav-item d-lg-none">
                            <a href="#" class="nav-link px-2" data-toggle="collapse" data-toggle-class data-target="#navbarToggler">
                                <i data-feather="search"></i>
                            </a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a class="nav-link px-1" data-toggle="modal" data-target="#aside">
                                <i data-feather="menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ############ Footer END-->
            <!-- ############ Content START-->
			{CONTENT}
            <!-- ############ Content END-->
            <!-- ############ Footer START-->
            <div id="footer" class="page-footer hide">
                <div class="d-flex p-3">
                    <span class="text-sm text-muted flex">&copy; Copyright. flatfull.com</span>
                    <div class="text-sm text-muted">Version 1.1.2</div>
                </div>
            </div>
            <!-- ############ Footer END-->
        </div>
		
		
		
		
                            <div id="modal-content-lg" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content ">
                                        <div class="modal-header ">
                                            <div class="modal-title text-md" id="modal-content-lg-title">Modal title</div>
                                            <button class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body" id="modal-content-lg-body">
                                            <div class="p-4 text-center">
                                                <p>Woohoo, you're reading this text in a modal!</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer" id="modal-content-lg-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Save Changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->		
		
		
		
		
		
		
        <!-- build:js /assets/js/site.min.js -->
        <!-- jQuery -->
        <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- ajax page -->
        {*<script src="/assets/libs/pjax/pjax.min.js"></script>
        <script src="/assets/js/ajax.js?v=8"></script>*}
        <!-- lazyload plugin -->
        <script src="/assets/js/lazyload.config.js?v=45"></script>
        <script src="/assets/js/lazyload.js"></script>
        <script src="/assets/js/plugin.js"></script>
        <!-- scrollreveal -->
        <script src="/assets/libs/scrollreveal/dist/scrollreveal.min.js"></script>
        <!-- feathericon -->
        <script src="/assets/libs/feather-icons/dist/feather.min.js"></script>
        <script src="/assets/js/plugins/feathericon.js"></script>
        <!-- theme -->
        <script src="/assets/js/theme.js?v=3"></script>
        <script src="/assets/js/utils.js"></script>
		<!-- Jquery mLoading-->
		<script src="/assets/js/plugins/mloading/jquery.mloading.js"></script>
		<link rel="stylesheet" href="/assets/js/plugins/mloading/jquery.mloading.css"> 
        <!-- endbuild -->

		<!-- Toastr -->
		<link rel="stylesheet" href="/assets/js/plugins/toastr/toastr.min.css?v=1"> 
		<script src="/assets/js/plugins/toastr/toastr.min.js"></script>		
		
		<!-- Highcharts -->
		<script src="/assets/js/plugins/highcharts/highcharts.js"></script>
			<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<script>

<?//print_r(json_encode(array('button'=>array(array('title'=>'Закрыть','role'=>'close')))));?>
function Modal(title=false,body='',footer=''){
	$('#modal-content-lg-title').html(title);
	$('#modal-content-lg-body').html(body);
	$('#modal-content-lg-footer').html(footer);
	$('#modal-content-lg').modal('show');
	
}



$(function() { 


$(document).on("submit",'.ajax-form', function (e) {
	e.preventDefault();
       var $form = $(this);
	   var form_data = new FormData($form.get(0));
		// Display the key/value pairs
		for(var pair of form_data.entries()) {
		   console.log(pair[0]+ ', '+ pair[1]); 
		}
		ShowLoad('body');
		console.log($form.serialize());
        $.ajax({
          type: $form.attr('method'),
          url: $form.attr('action'),
		  dataType: 'json',
                contentType: false,
                processData: false,
          data: form_data
        }).done(function(data) {
			console.log(data);
            if(data.response == 'error'){
				$.each(data.errors, function( index, value ) {
					$('[name="'+index+'"]').closest('.form-group').addClass('has-error');
					Alert('danger','Внимание!',value );
				});
			}else if(data.response == 'success'){
				//$('#addevent-modal').modal('hide');
				if(data.msg){
					Alert('success','Внимание!',data.msg);
				}else{
					Alert('success','Внимание!','Данные успешно сохранены!');
				}
				$('#modal-create').modal('hide');
				if(data.location){
					window.location.href = data.location;
				}
				if(data.reload){
					window.location.reload();
				}
				//window.location.href;
			}else{
				Alert('warning','Внимание!','Что-то пошло не так');
			}
		  HideLoad('body');
        }).fail(function() {
          Alert('danger','Внимание!','Возникла неизвестная ошибка');
		  HideLoad('body');
        });
        //отмена действия по умолчанию для кнопки submit
        e.preventDefault();
})	  
	  
ShowLoad = function(e,a="Загрузка..."){
	$(e).mLoading({
	  mask:true,
	  text:a
	});	
}
HideLoad = function(e){
	$(e).mLoading('hide');
}	  
	  
Alert = function(t,i,m,d=50000){
switch (t) {
  case 'success':
    toastr.success(m,i,{'timeOut':d})	
    break;
  case 'warning':
    toastr.warning(m,i,{'timeOut':d})	
    break;
  case 'danger':
    toastr.error(m,i,{'timeOut':d})	
    break;
  case 'info':
    toastr.info(m,i,{'timeOut':d})	
    break;
  default:
    toastr.default(m,i,{'timeOut':d});	
}
	
}	  


            $(function () {
                $('.datetimepicker').datetimepicker({
                    locale: 'ru',
					format: 'DD-MM-YYYY HH:mm'
                });
            });
$(function(){
	
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop() || $('html').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });
});


$(document).on("click",'.clickcheck', function (e) {
	$(this).next().find('input:checkbox:first').click();
});

$(document).on('click','.dd-content',function(){
    $( this ).find('.icheck').iCheck('toggle');
});

$(document).on('click','.AddCost',function(){
	$('.costs').find('.AddCost').remove();
    $('.costs').append($('.template').html());
});

$(document).on('click','.RemoveCost',function(){
	if($('.costs').find('.remm').length > 1){
		if($(this).closest('.remm').find('.AddCost').length == 1){
			$(this).closest('.remm').remove();
			$('.costs').find('.remm').last().find('.RemoveCost').prev().after('<button type="button" class="AddCost btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mx-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>');
		}else{
			$(this).closest('.remm').remove();
		}
	}
});
$(document).on('change','[name=typetariff]',function(){
	var value = $('[name=typetariff]:checked').val();
	if(value == 1){
		$('#sortable-handle').slideDown();
		$('#external_id_field').slideDown();
		$('#connects_row').slideDown();
		$('#portals_row').slideDown();
		$('#portals').attr('required',true)
		$('#connects').attr('required',true)
		$('#external_id').attr('required','required')
	}
	if(value == 2){
		$('#sortable-handle').slideDown();
		$('#external_id_field').slideUp();
		$('#connects_row').slideDown();
		$('#portals_row').slideUp();
		$('#portals').attr('required',false)
		$('#connects').attr('required',true)
		$('#external_id').attr('required',false)
	}
	if(value == 3){
		$('#sortable-handle').slideUp();
		$('#external_id_field').slideDown();
		$('#connects_row').slideUp();
		$('#portals_row').slideDown();
		$('#portals').attr('required',true)
		$('#connects').attr('required',false)
		$('#external_id').attr('required','required')
	}
})

    });
	
	
		
function massactions(e){
	if(!$(e).is(":checked")){
		$('.massactions').prop('checked', false);
	}else{
		$('.massactions').prop('checked', true);
	}
}	
function declOfNum(number, titles) {  
    cases = [2, 0, 1, 1, 1, 2];  
    return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
}

function GetMass(url,action='none',values=false){
	if(values === false){
		values = $(".massactions:checked").map(function(){return $(this).val();}).get();
	}
		ShowLoad('body');
        $.ajax({
          type: 'POST',
          url: url,
          data: { 'match[]':values, '{csrf_name}':'{csrf_value}', 'action':action }
        }).done(function(data) {
			console.log(data);
            if(data.response == 'error'){
				$.each(data.errors, function( index, value ) {
					$('[name="'+index+'"]').closest('.form-group').addClass('has-error');
					Alert('danger','Внимание!',value );
				});
			}else if(data.response == 'success'){
				//$('#addevent-modal').modal('hide');
				if(data.msg){
					Alert('success','Внимание!',data.msg);
				}else{
					Alert('success','Внимание!','Данные успешно сохранены!');
				}
				$('#modal-create').modal('hide');
				if(data.location){
					window.location.href = data.location;
				}
				if(data.reload){
					window.location.reload();
				}
				//window.location.href;
			}else{
				Alert('warning','Внимание!','Что-то пошло не так');
			}
		  HideLoad('body');
        }).fail(function() {
          Alert('danger','Внимание!','Возникла неизвестная ошибка');
		  HideLoad('body');
        });
}
</script>		
		
		
		
    </body>
</html>