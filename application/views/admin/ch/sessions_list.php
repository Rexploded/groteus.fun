							<?php 
							foreach($sessions as $k1=>$v1){ 
								foreach($v1 as $k=>$v){ 
								$v['time'] = $this->system->seconds2times(intval($v['duration']/1000));
								$color = 'green';
								$btn = 'btn-danger';
								$color = (intval($v['duration']/1000) >= 86400) ? 'light-blue' : $color;
								$color = ( strpos( mb_strtolower($v['user_agent']), "na" ) !== false ) ? 'red' : $color;
								$color = ( strpos( mb_strtolower($v['user_agent']), "flussonic" ) !== false ) ? 'red' : $color;
								$color = ( strpos( mb_strtolower($v['user_agent']), "xtream" ) !== false ) ? 'red' : $color;
								$color = ( strpos( mb_strtolower($v['user_agent']), "nice" ) !== false ) ? 'red' : $color;
								$color = ( strpos( mb_strtolower($v['user_agent']), "ACEStream" ) !== false ) ? 'red' : $color;
								
								$btn = ($color != 'green') ? 'btn-warning' : $btn;
							?>
									<div  id="session_<?=$v['session_id']?>">
										<div class="d-flex align-items-center px-4 py-3 <?=$color?>">
											<div><?=$v['user_agent']?>
											<br><small>Start watch: <?=date('d.m.Y H:i:s',intval($v['created_at']/1000))?></small>
											<br><small>TIME: <?=($v['time'][3]) ? $v['time'][3].':' : ''?><?=($v['time'][2]) ? $v['time'][2].':' : ''?><?=($v['time'][1]) ? $v['time'][1] : '00'?>:<b><?=$v['time'][0]?></b></small>
											<br><small>SERVER: <a href="/admin/fl/<?=$k1?>"><span class="badge badge-primary text-uppercase p-1"> <?=$this->admin->GetServer($k1)['name']?></span></a></small>
											<?php if($v['user_id']){ ?><br><small>USER: <a href="/admin/users/<?=$v['user_id']?>"><span class="badge badge-primary text-uppercase p-1"> <?=$this->users->GetUserById($v['user_id'])['username']?></span></a></small><?php } ?>
											<br><small>ID: <?=$v['id']?></small>
											<br><small>SESSION ID: <?=$v['session_id']?></small>
											<br><small>IP: <?=$v['ip']?> (<?=$this->system->GetCountryCodeByIp($v['ip'])?>) <?=$this->system->GetCountryNameByIp($v['ip'])?> <?=($this->system->GetCountryIconByIp($v['ip'])) ? '<img src="'.$this->system->GetCountryIconByIp($v['ip']).'" style=" width: 14px;    margin-bottom: 0.18em !important; ">' : ''?></small>
											</div>
											<div class="flex"></div>

															<button type="button" class="btn btn-xs w-sm mb-1 <?=$btn?>" onclick="ChannelsSessionDelete(<?=$k1?>,'<?=$v['session_id']?>')">KILL</button>
										</div>
										
									</div><hr>
							<?php 
								} 
							} 
							?>