<style>
.files .msg {
    color: #5e676f !important;
    background-color: #e1ecff !important;
}
[data-class="alt"].chat-item,
.chat-item.alt {
  -ms-flex-direction: row-reverse;
  flex-direction: row-reverse;
}
[data-class="alt"].chat-item .chat-body,
  .chat-item.alt .chat-body {
    -ms-flex-align: end;
    align-items: flex-end;
}

[data-class="alt"].chat-item .chat-date,
  .chat-item.alt .chat-date {
    text-align: right;
	
}


[data-class="alt files"].chat-item,
.chat-item.alt {
  -ms-flex-direction: row-reverse;
  flex-direction: row-reverse;
}
[data-class="alt files"].chat-item .chat-body,
  .chat-item.alt .chat-body {
    -ms-flex-align: end;
    align-items: flex-end;
}

[data-class="alt files"].chat-item .chat-date,
  .chat-item.alt .chat-date {
    text-align: right;
	
}

[data-class="alt files"] .msg {
    color: #5e676f !important;
    background-color: #e1ecff !important;
	
}




[data-class=" files"] .msg {
    color: #5e676f !important;
    background-color: #e1ecff !important;
	
}
</style>

            <div id="content" class="flex ">
                <!-- ############ Main START-->
                <div class="d-flex flex fixed-content">
                    <div class="aside aside-sm" id="content-aside">
                        <div class="d-flex flex-column w-xl modal-dialog bg-body" id="chat-nav">
                            <div class="navbar">
                                <div class="input-group flex bg-light rounded">
                                    <input type="text" class="form-control no-bg no-border no-shadow search" placeholder="Search" required="">
                                    <span class="input-group-append">
		                  <button class="btn no-bg no-shadow" type="button"><i data-feather="search" class="text-fade"></i></button>
		                </span>
                                </div>
                            </div>
                            <div class="scrollable hover">
                                <div class="list list-row">
								
								<?php
								$LIST = $this->messages->GetUserList($_SESSION['id']);
								$START_ID = ($START_ID) ? $START_ID : $LIST[0]['id'];
								$START_ID_DATA = $this->users->GetUserById($START_ID);
								$CHAT = $this->messages->GetChatHistory($START_ID);
								$in_list = false;
								foreach($LIST as $k=>$v){
									$in_list = ($START_ID == $v['id']) ? true : $in_list;
								}
								if(!$in_list AND $START_ID){?>
                                    <div class="list-item active" data-conversations-id="<?=$START_ID_DATA['id']?>" data-id="<?=$START_ID_DATA['id']?>">
                                        <div>
                                            <span class="avatar-status <?=($this->users->GetOnlineById($START_ID_DATA['id'])) ? 'on' : 'off'?>" data-userid="<?=$START_ID_DATA['id']?>"></span>
                                        </div>
                                        <div>
                                            <a href="/admin/messages/<?=$START_ID_DATA['id']?>">
                                                <span class="w-40 avatar gd-primary">
		                          <img src="<?=$START_ID_DATA['avatar']?>" alt=".">
		                    </span>
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <a href="/admin/messages/<?=$START_ID_DATA['id']?>" class="item-author text-color "><?=$START_ID_DATA['username']?></a>
                                            <div class="item-except text-muted text-sm h-1x">
                                            </div>
                                        </div>
                                        <div>
                                        </div>
                                    </div>										
								<?php }
								foreach($LIST as $k=>$v){
								?>
                                    <div class="list-item <?=($START_ID == $v['id'])?'active':''?>" data-conversations-id="<?=$v['id']?>" data-id="<?=$v['id']?>">
                                        <div>
                                            <span class="avatar-status <?=($this->users->GetOnlineById($v['id'])) ? 'on' : 'off'?>" data-userid="<?=$v['id']?>"></span>
                                        </div>
                                        <div>
                                            <a href="/admin/messages/<?=$v['id']?>">
                                                <span class="w-40 avatar gd-primary">
		                          <img src="<?=$v['avatar']?>" alt=".">
		                    </span>
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <a href="/admin/messages/<?=$v['id']?>" class="item-author text-color "><?=$v['username']?></a>
                                            <div class="item-except text-muted text-sm h-1x">
                                                <?=($v['last']['message']) ? $v['last']['message'] : $v['last']['attachment_name']?>
                                            </div>
                                        </div>
                                        <div>
										<?=($this->messages->GetUnredMessageCount($v['id']) > 0) ? '<span class="item-amount badge badge-pill gd-warning unread">'.$this->messages->GetUnredMessageCount($v['id']).'</span>' : '<span class="item-amount badge badge-pill gd-warning unread" style="display:none;">'.$this->messages->GetUnredMessageCount($v['id']).'</span>'?>
                                        </div>
                                    </div>	
								
								
								
								<? } ?>
								{*
                                    <div class="list-item " data-id="1">
                                        <div>
                                            <span class="avatar-status on"></span>
                                        </div>
                                        <div>
                                            <a href="app.message.html">
                                                <span class="w-40 avatar gd-primary">
		                          <img src="../assets/img/a1.jpg" alt=".">
		                    </span>
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <a href="app.message.html" class="item-author text-color ">Joyce McCoy</a>
                                            <div class="item-except text-muted text-sm h-1x">
                                                In WordPress Tutorial, we’ll streamline the process for you by pointing out the all key features of the WordPress
                                            </div>
                                        </div>
                                        <div>
                                        </div>
                                    </div>								
								
								*}
								
								
								
								
								
								
								
								
								
								
								
								
								
                                </div>
                                <div class="no-result hide">
                                    <div class="p-4 text-center">
                                        No Results
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex pr-md-3" id="content-body">
                        <div class="d-flex flex-column flex card m-0 mb-md-3" id="chat-list" data-plugin="chat">
                            <div class="navbar flex-nowrap b-b">
                                <button data-toggle="modal" data-target="#content-aside" data-modal class="d-md-none btn btn-sm btn-icon no-bg">
                                    <span>
				      		<i data-feather="menu"></i>
				        </span>
                                </button>
                                <span class="text-ellipsis flex mx-1">
			        	<span class="text-md text-highlight mx-2"><?=$START_ID_DATA['username']?></span>
                                </span>
                                <span class="flex"></span>
                                <div>
								
                                </div>
                            </div>
                            <div class="scrollable">
                                <div class="loading m-3"></div>
                                <div class="list hide">
                                    <div class="p-3">
                                        <div class="chat-list">






<?php 
if(!$in_list){
?>


                                            <div class="chat-item testmessages"  style="opacity: 0 !important;"data-id='<?=$v['id']?>' data-class="">
                                                <div class="chat-body">
                                                    <div class="chat-content rounded msg bg-body bg-primary--lt" style="width: 100%;">
                                                        Начните общение прямо сейчас!
                                                    </div>
                                                </div>
                                            </div>	

<?php	
}
?>
											
										<?php foreach($CHAT as $k=>$v){ ?>
                                            <div class="chat-item" data-id='<?=$v['id']?>' data-class="<?=($v['sender_id'] != $_SESSION['id']) ? '' : 'alt'?>">
                                                <a href="#" class="avatar w-40">
                                                    <img class="image" src="<?=($v['sender_id'] != $_SESSION['id']) ? $START_ID_DATA['avatar'] : $_SESSION['avatar']?>" alt=".">
                                                </a>
                                                <div class="chat-body">
                                                    <div class="chat-content rounded msg bg-body <?=(!$v['message']) ? 'bg-primary--lt' : ''?>">
                                                        <?=($v['message']) ? $v['message'] : '<a href="/uploads/attachments/'.$v['attachment_real_name'].'" download="'.$v['attachment_name'].'">'.$v['attachment_name'].' <span class="text-muted">'.$v['file_size'].'</span><i class="text-muted" data-feather="download"></i></a>' ?>
                                                    </div>
                                                    <div class="chat-date date">
                                                        <?=(date('d.m.Y') == date('d.m.Y',$v['message_date_time'])) ? date('H:i',$v['message_date_time']) : date('d.m.Y H:i',$v['message_date_time'])?>
                                                    </div>
                                                </div>
                                            </div>											
										<?php } ?>
                                            
                                        </div>
                                        <div class="hide">
                                            <div class="chat-item idd" id="chat-item" data-id data-class>
                                                <a href="#" class="avatar w-40">
                                                    <img class="image" src="" alt=".">
                                                </a>
                                                <div class="chat-body">
                                                    <div class="chat-content rounded msg block bg-body">
                                                    </div>
                                                    <div class="chat-date date"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto b-t" id="chat-form">
                                <div class="p-2">
                                    <div class="px-3 hide">
                                        <div class="toolbar my-1">
                                            <a href="#" class="text-muted mx-1">
                                                <i data-feather="image" width="14" height="14"></i>
                                            </a>
                                            <a href="#" class="text-muted mx-1">
                                                <i data-feather="camera" width="14" height="14"></i>
                                            </a>
                                            <a href="#" class="text-muted mx-1">
                                                <i data-feather="map-pin" width="14" height="14"></i>
                                            </a>
                                            <a href="#" class="text-muted mx-1">
                                                <i data-feather="paperclip" width="14" height="14"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="input-group">
										<?php if($this->CONFIG->get('sys_messages_allow_files_upload')){ ?>
                                        <button class="btn btn-icon gd-primary fileDiv" type="button" id="newBtn2" <?=(!$START_ID) ? 'disabled' : ''?>>
                                            <i data-feather="upload"></i>
                                        </button>
										<?php } ?>
										<input type="file" style="display:none;" name="file" class="upload_attachmentfile"/>
                                        <input type="text" class="form-control p-3 no-shadow no-border" placeholder="Сообщение..." id="newField" <?=(!$START_ID) ? 'readonly' : ''?>>
                                        <input type="hidden" value="<?=$_SESSION['avatar']?>" id="imgField">
                                        <input type="hidden" value="<?=$START_ID?>" id="receiver_id">
                                        <input type="hidden" value="<?=$START_ID_DATA['avatar']?>" id="receiver_avatar">
                                        <button class="btn btn-icon gd-success" type="button" id="newBtn" <?=(!$START_ID) ? 'disabled' : ''?>>
                                            <i data-feather="arrow-up"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ############ Main END-->
            </div>
			
			
			
<script>			

</script>			