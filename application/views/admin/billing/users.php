<style>
.media-heading{
	display:block;
} 
</style>
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
							
							
                               <div class="col-sm-12 m-0 p-0">
                                    <div class="card">
                                        <div class="b-b">
                                            <div class="nav-active-border b-success top">
                                                <ul class="nav" id="myTab" role="tablist">
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Пользователи</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="true">Поиск</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Группы пользователей</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content p-0">
                                            <div class="tab-pane fade show active p-3" id="home4" role="tabpanel" aria-labelledby="home-tab">





                               
                                <div class="table-responsive">
                                    <table class="table table-row table-hover v-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-muted">Пользователь</th>
												  <th class="text-muted">Email</th>
												  <th class="text-muted">Группа</th>
												  <th class="text-muted">Дата регистрации</th>			
												  <th class="text-muted">Баланс</th>			
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($users_top as $k=>$v){ ?>
                                            <tr class=" v-middle" data-id="<?=$v['id']?>">
                                                <td>
                                                    <span onclick="usersAdd( '<?=$v['username']?>',<?=$v['id']?> )" id="user_<?=$v['id']?>" style="cursor: pointer"><i class="fa fa-plus" style="margin-left: 10px; vertical-align: middle"></i></span> 

                                                    <a class="item-title text-color "  data-toggle="dropdown" aria-expanded="true">
													<span class="badge badge-primary text-uppercase"><?=$v['username']?></span>
													</a>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="/admin/billing/statistics/?search=true&login=<?=$v['username']?>">
                                                <i class="fa fa-bar-chart"></i> Общая статистика
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/transactions/?search=true&login=<?=$v['username']?>">
                                                <i class="fa fa-money"></i> История баланса
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/refund/?search=true&login=<?=$v['username']?>">
                                               <i class="fa fa-credit-card"></i> Запросы вывода
                                            </a>
                                            <a class="dropdown-item" href="/admin/billing/invoice/?search=true&login=<?=$v['username']?>">
                                                 <i class="fa fa-folder-open-o"></i> Квитанции
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/admin/billing/users/?logins=<?=$v['username']?>">
                                                <i class="fa fa-money"></i> Изменить баланс
                                            </a>
                                        </div>
                                                </td>
                                                <td class="flex">
                                                   <?=$v['email']?>
                                                </td>
                                                <td class="flex">
                                                    <?=$this->users->GetGroupName($v['user_group'])?>
                                                </td>
                                                <td class="flex">
													<?=date('d.m.Y H:i:s',$v['created_at'])?>
                                                </td>
                                                <td class="flex">
													<?=$v['balance']?>
                                                </td>
                                            </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
                                </div>







                                            </div>
                                            <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab">



                                        <div class="card-body p-0 table-responsive">
<form method="GET" action="/admin/billing/users/" class="">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">
<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Данные для поиска:</h8>
									<span class="text-muted text-size-small hidden-xs">Введите логин ( email ) пользователя или его часть</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="search_name" class="form-control"  value="<?=(isset($_GET['search_name'])) ? $this->input->get('search_name') : ''?>">
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Баланс:</h8>
									<span class="text-muted text-size-small hidden-xs">Используйте один из символов сравнения: > < =</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<div class="input-group">
										<input type="text" name="search_balance" class="form-control"  value="<?=(isset($_GET['search_balance'])) ? $this->input->get('search_balance') : ''?>">
									</div>
								</td>
							</tr>
						</table>
						<button class="btn btn-success btn-block">Поиск</button>
</form>


                                        </div>









                                            </div>
                                            <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab">




                               
                                <div class="table-responsive">
                                    <table class="table table-row table-hover v-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-muted">Группа</th>
												  <th class="text-muted">Пользователей</th>
												  <th class="text-muted">Минимальный баланс</th>
												  <th class="text-muted">Максимальный</th>			
												  <th class="text-muted">Всего на счетах</th>			
												
												
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($this->users->GetUserGroups() as $k=>$v){ ?>
                                            <tr class=" v-middle" data-id="<?=$v['id']?>">
                                                <td class="flex">
													<?=$v['name']?>
                                                </td>
                                                <td class="flex">
                                                   <?=$this->db->query("SELECT COUNT(id) as count FROM users WHERE user_group=?",array($v['id']))->row_array()['count']?>
                                                </td>
                                                <td class="flex">
                                                    <?=$this->billing->convert($this->db->query("SELECT MIN(balance) as min FROM users WHERE user_group=?",array($v['id']))->row_array()['min'])?> [declines=<?=$this->billing->convert($this->db->query("SELECT MIN(balance) as min FROM users WHERE user_group=?",array($v['id']))->row_array()['min'])?>|<?=$this->CONFIG->get('billing_currency_decline')?>]
                                                </td>
                                                <td class="flex">
                                                    <?=$this->billing->convert($this->db->query("SELECT MAX(balance) as max FROM users WHERE user_group=?",array($v['id']))->row_array()['max'])?> [declines=<?=$this->billing->convert($this->db->query("SELECT MAX(balance) as max FROM users WHERE user_group=?",array($v['id']))->row_array()['max'])?>|<?=$this->CONFIG->get('billing_currency_decline')?>]
                                                </td>
                                                <td class="flex">
													<?=$this->billing->convert($this->db->query("SELECT SUM(balance) as sum FROM users WHERE user_group=?",array($v['id']))->row_array()['sum'])?> [declines=<?=$this->billing->convert($this->db->query("SELECT SUM(balance) as sum FROM users WHERE user_group=?",array($v['id']))->row_array()['sum'])?>|<?=$this->CONFIG->get('billing_currency_decline')?>]
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
							
							
                               <div class="col-sm-12 m-0 p-0">                                    <div class="card">
                                        <div class="b-b">
                                            <div class="nav-active-border b-primary bottom">
                                                <ul class="nav" id="myTab" role="tablist">
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Изменить баланс пользователю</a>
                                                    </li>
                                                    <li class="nav-tabs nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Изменить баланс группе</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content p-0">
                                            <div class="tab-pane table-responsive fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab">

<form method="POST" action="/admin/ajax/billing/users/pay/users/" class="ajax-form">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">


<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Пользователи:</h8>
									<span class="text-muted text-size-small hidden-xs">Укажите через запятую логины пользователей</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="logins" id="logins" class="form-control" value="<?=(isset($_GET['logins'])) ? $this->input->get('logins') : ''?>" required>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Действие:</h8>
									<span class="text-muted text-size-small hidden-xs">Выберите из придложенного списка</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name="action" class="form-control" >
										<option value="1">Пополнить баланс</option>
										<option value="0">Понизить баланс</option>
									</select>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Сумма:</h8>
									<span class="text-muted text-size-small hidden-xs">Введите сумму</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
								<div class="input-group">
									<input type="number" step="0.01" min='0.01' name="amount" class="form-control" onchange="$(this).val(parseFloat($(this).val()).toFixed(2));" value="" required>
									
										 <span class="input-group-text">[declines=10|<?=$this->CONFIG->get('billing_currency_decline')?>]</span> </div>
									</div>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Комментарий:</h8>
									<span class="text-muted text-size-small hidden-xs">Введите описание платежа</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="comment" class="form-control" value="">
								</td>
							</tr>
						</table>

<button type="submit" class="btn btn-success btn-block">Изменить</button>
</form>



                                            </div>
                                            <div class="tab-pane table-responsive fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab">



<form method="POST" action="/admin/ajax/billing/users/pay/group/" class="ajax-form">
<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">

<table width="100%" class="table table-striped">
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Изменить баланс группе:</h8>
									<span class="text-muted text-size-small hidden-xs">Баланс будет изменен каждому пользователю выбранной группы</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select class="form-control" name="logins">
									<?php foreach($this->users->GetUserGroups() as $k=>$v){ ?>
										<option value="<?=$v['id']?>"><?=$v['name']?></option>
									<?php } ?>						
									</select>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Действие:</h8>
									<span class="text-muted text-size-small hidden-xs">Выберите из придложенного списка</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<select name="action" class="form-control" >
										<option value="1">Пополнить баланс</option>
										<option value="0">Понизить баланс</option>
									</select>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Сумма:</h8>
									<span class="text-muted text-size-small hidden-xs">Введите сумму</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
								<div class="input-group">
									<input type="number" step="0.01" name="amount" class="form-control" onchange="$(this).val(parseFloat($(this).val()).toFixed(2));" value="" required>
									
										 <span class="input-group-text">[declines=10|<?=$this->CONFIG->get('billing_currency_decline')?>]</span> </div>
									</div>
								</td>
							</tr>
							<tr class="d-flex">
								<td class="col-xs-6 col-sm-6 col-md-7">
									<h8 class="media-heading text-semibold">Комментарий:</h8>
									<span class="text-muted text-size-small hidden-xs">Введите описание платежа</span>
								</td>
								<td class="col-xs-6 col-sm-6 col-md-5" style="    padding: 21px 20px;">
									<input type="text" name="comment" class="form-control" value="">
								</td>
							</tr>
						</table>

<button type="submit" class="btn btn-success btn-block">Изменить</button>
</form>


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
<script>		
function RepairSum(e){ 
	var val = 11;
	$('[name=amount]').val(parseFloat($('[name=amount]').val()).toFixed(2));
	var say = declOfNum(val, ['<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[0]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[1]?>', '<?=explode('|',$this->CONFIG->get('billing_currency_decline'))[2]?>']);
	$('#decline').html(say);
}

var users = [];
function usersAdd( name,id )
{
	if( users.in_array(name) )
	{
		users.clean(name);

		$('#user_'+id).html('<i class=\"fa fa-plus\" style=\"margin-left: 10px; vertical-align: middle\"></i>');
	}
	else
	{
		users[users.length+1] = name;

		$('#user_' + id).html('<i class=\'fa fa-check\' style=\'margin-left: 10px; vertical-align: middle\'></i>');
	}

	users.clean(undefined);

	$('#logins').val( users.join(', ') );
};
Array.prototype.in_array = function(p_val)
{
	for(var i = 0, l = this.length; i < l; i++)
	{
		if(this[i] == p_val)
		{
			return true;
		}
	}
	return false;
};
Array.prototype.clean = function(deleteValue)
{
    for (var i = 0; i < this.length; i++)
    {
        if (this[i] == deleteValue)
        {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
};
</script>		