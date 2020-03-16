(function (global, $) {
	"use strict";

  var nav_el = "#chat-nav"
      ,list_el = "#chat-list"
      ,filter = ""
      ,navlist
      ,list
      ,robotList = ['Hello', 'How can I help you', 'That sound great', 'Really?', 'Howdy']
      ,noticed = false
      ;

  $(document).on('click', '#chat-form .btn', function(e){
    create();
  });

  $(document).on('keypress', '#chat-form input', function(e){
    if(e.keyCode == 13){
      create();
    }
  });

  //var timeout;
  
$('.fileDiv').click(function(){
	$('.upload_attachmentfile').click()    
});



$('.upload_attachmentfile').change(function(){
	
	//DisplayMessage('<div class="spiner"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
	//ScrollDown();
	
	var file_data = $('.upload_attachmentfile').prop('files')[0];
	var receiver_id = $('#receiver_id').val();   
	var csrf_value = $('#csrf_value').val();
    var form_data = new FormData();
    form_data.append('attachmentfile', file_data);
	form_data.append('type', 'Attachment');
	form_data.append('receiver_id', receiver_id);
	form_data.append('ci_csrf_token', csrf_value);
	
	$.ajax({
                url: '/admin/messages/chat-attachment/upload', 
                dataType: 'json',  
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                        
                type: 'post',
                success: function(response){
					console.log(response);






									 var receiver_avatar = $('#receiver_avatar').val();
									 var receiver_id = $('#receiver_id').val();
									 //$('#imgField').val()
									 var imgField = (response.data.sender_id == receiver_id) ? receiver_avatar : $('#imgField').val();
									 var Class = (response.data.sender_id == receiver_id) ? '' : 'alt';
									 
									// var msg = value.message;
									 var msg = '';
									 if(response.data.message != ''){
										 msg = response.data.message;
									 }else{
										 msg = '<a href="/uploads/attachments/'+response.data.attachment_real_name+'" download="'+response.data.attachment_name+'">'+response.data.attachment_name+' <span class="text-muted">'+response.data.file_size+'</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download text-muted"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a>';
										 Class = Class+' files';
									 }
									 
									 
									  list.add({
										msg: msg,
										date: response.data.date,
										image: imgField,
										class: Class,
										id: response.data.id
									  });

										gotoMsg();















				},
				error: function (jqXHR, status, err) {
 							 // alert('Local error callback');
				}
	 });
	
});





  function create(){
    var newField = $('#newField');
    var img = $('#imgField');
    var receiver_id = $('#receiver_id').val();
	
	var csrf_name = $('#csrf_name').val();
	var csrf_value = $('#csrf_value').val();
	
	
    if(newField.val() !== ''){

	  
				$.ajax({
						  dataType : "json",
						  type : 'post',
						  data : {messageTxt : newField.val(), receiver_id : receiver_id, ci_csrf_token: csrf_value},
						  url: '/messages/'+receiver_id+'/send-message',
						  success:function(data)
						  {
							  if(data.status == 1){
								  list.add({
									msg: data.data.message,
									date: data.date,
									image: img.val(),
									class: 'alt',
									id: data.id
								  });
								  newField.val('');	 
							  }
						  },
						  error: function (jqXHR, status, err) {
 							//alert('Local error callback');
						  }
 					});	  
	  
	  
    }
    gotoMsg();
    //clearTimeout(timeout);
    //timeout = setTimeout(robot, (Math.random() * robotList.length)*500 + 1000 );
  }

  function robot(){
    list.add({
        msg: robotList[Math.floor((Math.random() * robotList.length))],
        date: 'Только что',
        image: '../assets/img/a2.jpg',
        class: ''
    });
    gotoMsg();
  }



function GetChatHistory(receiver_id){
	var csrf_value = $('#csrf_value').val();
	var last = $('.chat-list').find('.chat-item').last().attr('data-id');
				$.ajax({
						  //dataType : "json",
  						  url: '/messages/'+receiver_id+'/get-chat-history-vendor?ci_csrf_token='+csrf_value+'&last='+last,
						  success:function(data)
						  {
							  data = jQuery.parseJSON(data);
							 
							 if(data.length > 0){
								 
								 
								$.each( data, function( key, value ) {

								 var receiver_avatar = $('#receiver_avatar').val();
								 var receiver_id = $('#receiver_id').val();
								 //$('#imgField').val()
								 var imgField = (value.sender_id == receiver_id) ? receiver_avatar : $('#imgField').val();
								 var Class = (value.sender_id == receiver_id) ? '' : 'alt';
								 
								// var msg = value.message;
								 var msg = '';
								 if(value.message != ''){
									 msg = value.message;
								 }else{ 
									 msg = '<a href="/uploads/attachments/'+value.attachment_real_name+'" download="'+value.attachment_name+'">'+value.attachment_name+' <span class="text-muted">'+value.file_size+'</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download text-muted"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a>';
									 Class = Class+' files';
								 }
								 
								 
								  list.add({
									msg: msg,
									date: value.date,
									image: imgField,
									class: Class,
									id: value.id
								  });

									gotoMsg();
								});  								 
								 
							 
								 
								 
								 
							 }							
							 
						  },
						  error: function (jqXHR, status, err) {
 							 // alert('Local error callback');
						  }
 					});
}

var timerId = setInterval(function(){
	var receiver_id = $('#receiver_id').val();
	if(receiver_id!=''){GetChatHistory(receiver_id);}
}, 1000);

var timerId2 = setInterval(function(){
	var array = $('div[data-conversations-id]').map(function(){
		return $(this).data('conversations-id');
	}).get();
	
	
	 	GetTimerState(array);
	
	
}, 1000);


function GetTimerState(array){
var csrf_value = $('#csrf_value').val();
				$.ajax({
						  dataType : "json",
						  type : 'post',
						  data : {users : array, ci_csrf_token: csrf_value},
						  url: '/messages/state',
						  success:function(data)
						  {
							  console.log(data)	 
							  
							$.each( data, function( key, value ) {
								var CON = $('[data-conversations-id='+key+']');
								if(value.unread > 0){
									CON.find('.unread').show();
									CON.find('.unread').html(value.unread);
								}else{
									CON.find('.unread').hide();
									CON.find('.unread').html(value.unread);
								}
								
								if(CON.find('.avatar-status').hasClass('on')){
									if(!value.online){
										CON.find('.avatar-status').removeClass('on');
										CON.find('.avatar-status').addClass('off');
									}
								}else{
									if(value.online){
										CON.find('.avatar-status').removeClass('off');
										CON.find('.avatar-status').addClass('on');
									}									
								}
							});							  
							  
							  
							  
						  },
						  error: function (jqXHR, status, err) {
 							//alert('Local error callback');
						  }
 					});	
}



  function gotoMsg(time){
    var t = time || 1000;
    sr.sync();
    $('.scrollable', list_el).animate({ 
      scrollTop: $('.scrollable', list_el).prop("scrollHeight")
    }, t, function (x, t, b, c, d) {
          if (t==0) return b;
          if (t==d) return b+c;
          if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
          return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
    });
  }

  var init = function(){
    $(document).trigger('refresh');
    
    // nav
    navlist = new List(nav_el.substr(1), {
        valueNames: [
          'item-author',
          'item-except'
        ]
    });

    navlist.on('updated', function (list) {
      if (navlist.matchingItems.length > 0) {
        $('.no-result').addClass('hide');
      } else {
        $('.no-result').removeClass('hide');
      }
    });


    // list
    list = new List(list_el.substr(1), {
      listClass: 'chat-list',
      item: 'chat-item',
      valueNames: [
        'msg',
        'date',
        { data: ['class']},
        { name: 'image', attr: 'src' },
        { data: ['id'] }
      ]
    });

    $(list_el+' .list').removeClass('hide');
    sr.reveal(list_el+ ' .chat-item',{
      origin: 'bottom', 
      distance: '50px', 
      afterReveal:function (el) {
        $(el).css('transform', 'none');
        if(!noticed){
          //notie.alert({type:1, text: 'Try say something' });
          noticed = true;
        }
      }
    }, 1);

    gotoMsg(2500);

  }

  global.chat = {init: init};

})(this, jQuery);
