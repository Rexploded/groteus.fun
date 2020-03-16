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
                                                <th class="text-muted">Категория</th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Каналов</span></th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Adult</span></th>
                                                <th class="text-muted"><span class="d-none d-sm-block">Pin-code</span></th>
                                                <th style="width:50px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php foreach($category as $k=>$v){ ?>
                                            <tr class=" v-middle" data-id="15">
                                                <td class="flex">
                                                    <a href="/admin/cat/<?=$v['id']?>" class="item-title text-color "><?=$v['name']?></a>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=$this->category->CountInCat($v['id'])?></span>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=($v['adult']) ? '<span class="badge badge-danger text-uppercase"> Adult </span>' : '<span class="badge badge-primary text-uppercase"> NO Adult </span>'?></span>
                                                </td>
                                                <td>
                                                    <span class="item-amount d-none d-sm-block text-sm "><?=($v['adult']) ? $v['pincode'] : ''?></span>
                                                </td>
                                                <td>
                                                    <div class="item-action dropdown">
                                                        <a href="#" data-toggle="dropdown" class="text-muted">
                                                            <i data-feather="more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                                            <a class="dropdown-item" href="/admin/cat/<?=$v['id']?>">
                                                                Редактировать
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a onclick="DeleteCategory(<?=$v['id']?>)" class="dropdown-item trash">
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
			
			
<script>			
function DeleteCategory(id){
	ShowLoad('body');
        $.ajax({
          type: 'get',
          url: '/admin/ajax/cat/delete/'+id+'/?<?=$CSRF['name']?>=<?=$CSRF['hash']?>'
        }).done(function(data) {
            if(data.response == 'error'){
				$.each(data.errors, function( index, value ) {
					$('[name="'+index+'"]').closest('.form-group').addClass('has-error');
					Alert('danger','Внимание!',value );
				});
			}else if(data.response == 'success'){
				Modal(data.title,data.body,data.footer);
			}else{
				Alert('warning','Внимание!','Что-то пошло не так');
			}
		  HideLoad('body');
		}).fail(function() {
          Alert('danger','Внимание!','Возникла неизвестная ошибка');
		  HideLoad('body');
        });
}	
function DeleteCategoryConfirm (id){
	ShowLoad('body');
	var new_cat = $('#new_category').val();
	
	var url = (new_cat) ? '/admin/ajax/cat/delete/'+id+'/'+new_cat+'/?{csrf_name}={csrf_value}' : '/admin/ajax/cat/delete/'+id+'/0/?{csrf_name}={csrf_value}';
        $.ajax({
          type: 'get',
          url: url
        }).done(function(data) {
            if(data.response == 'error'){
				$.each(data.errors, function( index, value ) {
					$('[name="'+index+'"]').closest('.form-group').addClass('has-error');
					Alert('danger','Внимание!',value );
				});
			}else if(data.response == 'success'){
				Modal(data.title,data.body,data.footer);
$('#modal-content-lg').on('hide.bs.modal', function () {
  window.location.reload();
})
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