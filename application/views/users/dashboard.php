            <div id="content" class="flex ">
                <!-- ############ Main START-->
                <div>
                    <div class="page-hero page-container " id="page-hero">
                        <div class="padding d-flex">
                            <div class="page-title">
                                <h2 class="text-md text-highlight">Blank</h2>
                                <small class="text-muted">Start application in a blank page</small>
                            </div>
                            <div class="flex"></div>
                            <div>
                                <a href="https://themeforest.net/item/basik-responsive-bootstrap-web-admin-template/23365964" class="btn btn-md text-muted">
                                    <span class="d-none d-sm-inline mx-1">Buy this Item</span>
                                    <i data-feather="arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">
                        <div>

						</div>
						<div class="padding sr">
						
							[no_user]
								<div class="row">
<div class="col-12">
                                    <div class="alert bg-danger mb-5 py-4" role="alert">
                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                            <div class="px-3">
                                                <h5 class="alert-heading">Внимание!</h5>
                                                <p>Такого пользователя не существует</p>
                                                <p>Возможно вы ввели не верные данные.</p>
                                                <a href="javascript:history.back()" class="btn btn-white mx-1">Назад
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>								
								</div>
							[/no_user]
							[is_user]
                            <div class="card">
                                <div class="card-header bg-dark bg-img p-0 no-border"  style="background-image:url(/assets/img/b3.jpg);" >
                                    <div class="bg-dark-overlay r-2x no-r-b">
                                        <div class="d-md-flex">
                                            <div class="p-4">
                                                <div class="d-flex">
                                                    <a href="#">
                                                        <span class="avatar w-64">
                  <img src="{USER}{avatar}{/USER}" alt=".">
                  <i class="on"></i>
                </span>
                                                    </a>
                                                    <div class="mx-3">
                                                        <h5 class="mt-2">{USER}{username}{/USER}</h5>
                                                        <div class="text-fade text-sm"><span class="m-r">{USER}{group_name}{/USER}</span>
                                                            <small>
                                                                [if '{USER}{id}{/USER}' == [profile:id] AND '[profile:country]' != '']<i class="fa fa-map-marker mr-2"></i>[profile:country][/if]</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="flex"></span>
                                            <div class="align-items-center d-flex p-4">
                                                <div class="toolbar">
                                                    [no_profile]<a href="/messages/{USER}{id}{/USER}" class="btn btn-sm bg-dark-overlay btn-rounded text-white bg-success active">Написать</a>[/no_profile]
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
							[/is_user]



                            <div class="row">
                                <div class="col-sm-12 col-lg-12">
								<h2>Новости</h2>
								
								</div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tab_1">
										{NEWS}
                                            <div class="card" id="feed-1">
                                                <div class="card-header d-flex">
                                                    <div class="mx-3">
                                                        <a href="javascript:void(0)">{title}</a>
                                                        <div class="text-muted text-sm">{date=d.m.Y H:i:s={date}}</div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-text mb-3">
                                                        <p>{text}</p>
                                                    </div>
                                                </div>
                                            </div>
										{/NEWS}
                                           
                                        </div>
                                        <div class="tab-pane fade" id="tab_2">
                                            <div class="card p-4">
                                                <div class="timeline animates animates-fadeInUp">
                                                    <div class="tl-item  active">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">Added to
                                                                <a href='#'>@TUT</a> team</div>
                                                            <div class="tl-date text-muted mt-1">2 days ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="tl-item  ">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">
                                                                <a href='#'>@Netflix</a> hackathon</div>
                                                            <div class="tl-date text-muted mt-1">25/12 18</div>
                                                        </div>
                                                    </div>
                                                    <div class="tl-item  ">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">Just saw this on the
                                                                <a href='#'>@eBay</a> dashboard, dude is an absolute unit.</div>
                                                            <div class="tl-date text-muted mt-1">1 Week ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="tl-item  ">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">Prepare the documentation for the
                                                                <a href='#'>Fitness app</a>
                                                            </div>
                                                            <div class="tl-date text-muted mt-1">20 minutes ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="tl-item  ">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">
                                                                <a href='#'>@NextUI</a> submit a ticket request</div>
                                                            <div class="tl-date text-muted mt-1">1 hour ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="tl-item  ">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">Developers of
                                                                <a href='#'>@iAI</a>, the AI assistant based on Free Software</div>
                                                            <div class="tl-date text-muted mt-1">1 day ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="tl-item  ">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">
                                                                <a href='#'>@WordPress</a> How To Get Started With WordPress</div>
                                                            <div class="tl-date text-muted mt-1">20 minutes ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="tl-item  ">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">From design to dashboard,
                                                                <a href='#'>@Dash</a> builds custom hardware according to on-site requirements</div>
                                                            <div class="tl-date text-muted mt-1">21 July</div>
                                                        </div>
                                                    </div>
                                                    <div class="tl-item  ">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">Fun project from this weekend. Both computer replicas are fully functional</div>
                                                            <div class="tl-date text-muted mt-1">03/12 18</div>
                                                        </div>
                                                    </div>
                                                    <div class="tl-item  ">
                                                        <div class="tl-dot ">
                                                        </div>
                                                        <div class="tl-content">
                                                            <div class="">We help companies deliver reliable and beautiful
                                                                <a href='#'>@IOSapps</a>
                                                            </div>
                                                            <div class="tl-date text-muted mt-1">13/12 18</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_3">
                                            <div class="card p-4">
                                                <div class="list list-row row">
                                                    <div class="list-item col-sm-6 no-border" data-id="17">
                                                        <div>
                                                            <a href="#">
                                                                <span class="w-40 avatar gd-warning">
            	          <span class="avatar-status on b-white avatar-right"></span> A
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#" class="item-author text-color ">Alan Mendez</a>
                                                            <a href="#" class="item-company text-muted h-1x">
                                                                Alibaba
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="list-item col-sm-6 no-border" data-id="9">
                                                        <div>
                                                            <a href="#">
                                                                <span class="w-40 avatar gd-info">
            	          <span class="avatar-status on b-white avatar-right"></span>
                                                                <img src="../assets/img/a9.jpg" alt=".">
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#" class="item-author text-color ">Steven Cruz</a>
                                                            <a href="#" class="item-company text-muted h-1x">
                                                                HHH inc
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="list-item col-sm-6 no-border" data-id="3">
                                                        <div>
                                                            <a href="#">
                                                                <span class="w-40 avatar gd-primary">
            	          <span class="avatar-status away b-white avatar-right"></span>
                                                                <img src="../assets/img/a3.jpg" alt=".">
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#" class="item-author text-color ">Jordan Stephens</a>
                                                            <a href="#" class="item-company text-muted h-1x">
                                                                Wealth corp
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="list-item col-sm-6 no-border" data-id="10">
                                                        <div>
                                                            <a href="#">
                                                                <span class="w-40 avatar gd-danger">
            	          <span class="avatar-status on b-white avatar-right"></span>
                                                                <img src="../assets/img/a10.jpg" alt=".">
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#" class="item-author text-color ">Edward Clark</a>
                                                            <a href="#" class="item-company text-muted h-1x">
                                                                Goldage
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="list-item col-sm-6 no-border" data-id="5">
                                                        <div>
                                                            <a href="#">
                                                                <span class="w-40 avatar gd-warning">
            	          <span class="avatar-status on b-white avatar-right"></span>
                                                                <img src="../assets/img/a5.jpg" alt=".">
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#" class="item-author text-color ">Sara George</a>
                                                            <a href="#" class="item-company text-muted h-1x">
                                                                Sun
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="list-item col-sm-6 no-border" data-id="19">
                                                        <div>
                                                            <a href="#">
                                                                <span class="w-40 avatar gd-warning">
            	          <span class="avatar-status on b-white avatar-right"></span> T
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#" class="item-author text-color ">Tiffany Baker</a>
                                                            <a href="#" class="item-company text-muted h-1x">
                                                                AI
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="list-item col-sm-6 no-border" data-id="4">
                                                        <div>
                                                            <a href="#">
                                                                <span class="w-40 avatar gd-success">
            	          <span class="avatar-status off b-white avatar-right"></span>
                                                                <img src="../assets/img/a4.jpg" alt=".">
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#" class="item-author text-color ">Billy Johnston</a>
                                                            <a href="#" class="item-company text-muted h-1x">
                                                                GE
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="list-item col-sm-6 no-border" data-id="2">
                                                        <div>
                                                            <a href="#">
                                                                <span class="w-40 avatar gd-primary">
            	          <span class="avatar-status off b-white avatar-right"></span>
                                                                <img src="../assets/img/a2.jpg" alt=".">
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#" class="item-author text-color ">Kathy Alexander</a>
                                                            <a href="#" class="item-company text-muted h-1x">
                                                                Microsoft
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_4">
                                            <div class="card">
                                                <div class="px-2">
                                                    <div class="py-3">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link">
                                                                    <span>Califorlia</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link">
                                                                    <span>320-654-123</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link">
                                                                    <span>July 10</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link">
                                                                    <span>garret@gmail.com</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="px-4 py-4">
                                                    <div class="row mb-2">
                                                        <div class="col-6">
                                                            <small class="text-muted">Cell Phone</small>
                                                            <div class="my-2">1243 0303 0333</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted">Family Phone</small>
                                                            <div class="my-2">+32(0) 3003 234 543</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-6">
                                                            <small class="text-muted">Reporter</small>
                                                            <div class="my-2">Coch Jose</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted">Manager</small>
                                                            <div class="my-2">James Richo</div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted">Bio</small>
                                                        <div class="my-2">Ut maecenas sed purus ultrices sed sapien massa quam eu sed odio id dui, sed sed lectus amet cursus sed habitant est morbi adipiscing nam consectetur nullam urna, proin condimentum ut laoreet congue
                                                            felis, diam pulvinar aliquam libero non tortor turpis aliquet massa eu etiam eget quisque egestas tristique tempus purus blandit nunc volutpat aliquam amet, aliquet nec et sed</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						
						</div>
						
						
						
						
						
						
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>