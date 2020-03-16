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
						
										<div class="card">
											<div class="card-header">
												Отправка сообщения
											</div>
											<div class="card-body">
<table width="100%">
    <tbody><tr>
        <td width="120" style="    box-sizing: unset !important;">Получатели:</td>
        <td><?=$COUNT?></td>
    </tr>
    <tr>
        <td>Тип сообщения:</td>
        <td><?=($type == '0') ? 'E-Mail' : 'Сообщение'?></td>
    </tr>
    <tr>
        <td colspan="2">
<div class="progress" style="height: 20px;">
  <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
</div>
		Отправлено сообщений: <span style="color:red;" id="gesendet">0</span> из <span style="color:blue;"><?=$COUNT?></span> Статус: <span id="status"></span>
		</td>
    </tr>
</tbody></table>

<br>
<button type="button" id="start_btn" onclick="START()" class="btn btn-primary btn-block">Начать отправку</button>
											</div>											
										</div>											

<form id="data" method="POST" style="display:none;">
	<input type="hidden" name="<?=$CSRF['name']?>" value="<?=$this->security->get_csrf_hash()?>">
                                                <div class="form-group">
                                                    <label class="text-muted" for="exampleInputEmail1">Тип сообщения:</label>
                                                    <select class="form-control" name="type">
														<option value="0" <?=($this->input->post('type') == 0) ? 'selected' : ''?>>E-mail</option>
														<option value="1" <?=($this->input->post('type') == 1) ? 'selected' : ''?>>Сообщение</option>
													</select>
                                                </div>
												
                                                <div class="form-group">
                                                    <label class="text-muted" for="exampleInputEmail1">Группы:</label>
														<select data-plugin="select2" id="user_groups" class="select2-multiple form-control" name="user_groups[]" data-placeholder="Всем" multiple>
														<option value="0" <?=(in_array(0,$this->input->post('user_groups'))) ? 'selected' : ''?>>Все</option>
														<?php foreach($this->users->GetUserGroups() as $k=>$v){ ?>
															<option value="<?=$v['id']?>"  <?=(in_array($v['id'],$this->input->post('user_groups'))) ? 'selected' : ''?>><?=$v['name']?></option>
														<?php } ?>
														</select>
                                                </div>
												
                                                <div class="form-group">
                                                    <label class="text-muted" for="start_reg">Дата регистрации:</label>
														<div class='input-group input-daterange mb-3' data-plugin="datepicker" data-option="{format: 'dd.mm.yyyy'}">
															<div class="input-group-prepend">
																<span class="input-group-text">от</span>
															</div>
															<input type='text' class="form-control" name="start_reg" value="<?=$this->input->post('start_reg')?>">
															<div class="input-group-prepend">
																<span class="input-group-text">до</span>
															</div>
															<input type='text' class="form-control" name="end_reg" value="<?=$this->input->post('end_reg')?>">
														</div>
                                                </div>
												
                                                <div class="form-group">
                                                    <label class="text-muted" for="start_online">Дата последнего посещения:</label>
														<div class='input-group input-daterange mb-3' data-plugin="datepicker" data-option="{format: 'dd.mm.yyyy'}">
															<div class="input-group-prepend">
																<span class="input-group-text">от</span>
															</div>
															<input type='text' class="form-control" name="start_online" value="<?=$this->input->post('start_online')?>">
															<div class="input-group-prepend">
																<span class="input-group-text">до</span>
															</div>
															<input type='text' class="form-control" name="end_online" value="<?=$this->input->post('end_online')?>">
														</div>
                                                </div>
												
											<div class="form-group">
												<label class="text-muted" for="text">Заголовок</label>
												<input type="text" name="title" class="form-control" value="<?=$this->input->post('title')?>">
											</div>
												
											<div class="form-group">
												<label class="text-muted" for="text">Сообщение</label>
												<div  style="background: aliceblue !important;"><textarea class="form-control" rows="8" id="text" name="message" data-plugin="summernote" data-option="{minHeight: 150}"><?=$this->input->post('message')?></textarea></div>
											</div>

</form>						
						
						</div>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>
			
<script>

function GetProgress(n,m){
	
	var percent=Math.ceil(100*n/m).toString()+'%';
	console.log(percent);
	$('#progressbar').css('width',percent)
	$('#progressbar').html(percent)
}

function START(offset=0){
	
	$('#status').html('<b class="text-warning">Выполняется<b>');
	$('#start_btn').attr('disabled',true);
	$('#start_btn').html('Идет отправка');
	
	var $form = $('#data');
	
	var def = 4;
	
	var form_data = new FormData($form.get(0));
	var count = <?=$COUNT?>;
	var counts = count - offset + def;
	
	var END = false;
	
	if(def > counts){
		offset_count = counts;
		END = true
	}else{
		offset_count = def;
	}
        $.ajax({
          type: 'POST',
          url: '/admin/ajax/send/'+offset+'/'+offset_count,
		  dataType: 'json',
                contentType: false,
                processData: false,
          data: form_data
        }).done(function(data) {
			if(offset > count){
				$('#gesendet').html(count);
				GetProgress(count,count);
			}else{
				$('#gesendet').html(offset);
				GetProgress(offset,count);
			}
				
				
				
			if(!END && offset+offset_count != count){
				START(offset+offset_count);
				console.log('/admin/ajax/send/'+offset+'/'+offset_count);
				console.log(offset+offset_count);
			}else{
				$('#status').html('<b class="text-success">Выполнено<b>');
				$('#status').html('<b class="text-success">Выполнено<b>');
				$('#start_btn').slideUp();
			}
        }).fail(function() {
          Alert('danger','Внимание!','Возникла неизвестная ошибка');
			$('#start_btn').attr('disabled',false);
			$('#start_btn').html('Попробовать сного');		  
        });	

}
</script>