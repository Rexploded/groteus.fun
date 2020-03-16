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
                                            <strong><?=$channel['name']?></strong>
                                        </div>
                                        <div class="card-body">
										
										
										
                                <div class="card" id="sessions">
																			
																			{SESSIONS}
																			
										
										
										
										
										
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
window.addEventListener('load', function () {
	
var timerId = setInterval(function(){
	ReNewSessions();
}, 1000);	
	
});	
function ReNewSessions(){
	$.get( "/admin/ch/<?=$channel['id']?>/sessions", function( data ) {
	  $( "#sessions" ).html( data );
	});
}

function ChannelsSessionDelete(server_id,session_id){
	ShowLoad('#session_'+session_id);
	$.get( "/admin/ajax/ch/session/delete/"+server_id+"/"+session_id+"?{csrf_name}={csrf_value}", function( data ) {
	});
}
</script>			
			