<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_model extends CI_Model {

	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	function edit_users_group($id){
		$this->system->accessError('Admin Users Group Edit');
        $validation_rules = array(
            array('field' => 'name', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'pr[]', 'label' => 'Привилегии', 'rules' => array('required','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['id'] = $id;
			$DATA['name'] = $this->input->post('name');
			$this->users->EditGroup($DATA);
			
			$PR = $this->input->post('pr');
			$this->system->SetGroupPR($PR,$id);
			
			$AN['response'] = 'success';
			$AN['location'] = '/admin/users/group/';
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}
	
	function edit_users(){
		$this->system->accessError('Admin Users Edit');
		$langs = array();
		foreach($this->system->get_lang_list() as $k=>$v){
			$langs[] = $v['SYMBOL'];
		}
		
        $validation_rules = array(
            array('field' => 'user_id', 'label' => '', 'rules' => array('required','is_natural_no_zero','max_length[255]')),
            array('field' => 'remove_avatar', 'label' => 'Удалить аватар', 'rules' => array('max_length[5]')),
            array('field' => 'editusername', 'label' => 'Новый логин', 'rules' => array('max_length[255]')),
            array('field' => 'editemail', 'label' => 'Новый логин', 'rules' => array('max_length[255]')),
            array('field' => 'editpass', 'label' => 'Новый пароль', 'rules' => array('max_length[255]')),
            array('field' => 'user_group', 'label' => 'Группа пользователя', 'rules' => array('is_natural_no_zero','max_length[255]')),
            array('field' => 'ban', 'label' => 'Забанен', 'rules' => array('max_length[5]')),
            array('field' => 'ban_long', 'label' => 'Срок окончания бана', 'rules' => array('is_natural_no_zero','max_length[255]')),
            array('field' => 'ban_reason', 'label' => 'Причина бана'),
            array('field' => 'alive_balace_mail', 'label' => 'Получать уведомления о изменении баланса', 'rules' => array('max_length[5]')),
            array('field' => 'alive_site_mail', 'label' => 'Получать рассылку с сайта', 'rules' => array('max_length[5]')),
            array('field' => 'default_requisites', 'label' => 'Реквизиты по умолчанию', 'rules' => array('max_length[255]')),
            array('field' => 'country', 'label' => 'Страна', 'rules' => array('max_length[5]')),
            array('field' => 'refferals_success', 'label' => 'Партнерская программа', 'rules' => array('is_natural_no_zero','in_list[0,1,2]','max_length[1]')),
            array('field' => 'disabled_mail', 'label' => 'Отключить получение всех писем', 'rules' => array('max_length[5]')),
            array('field' => 'delete', 'label' => 'Удалить аккаунт', 'rules' => array('max_length[5]')),
            array('field' => 'language', 'label' => 'Язык', 'rules' => array('required','in_list['.implode(',',$langs).']','max_length[255]')),
			
			

			
			
            array('field' => 'session_delete[]', 'label' => 'Удалить сессию', 'rules' => array('max_length[5]')),
			
			
        );
		
		
		
		if($this->input->post('refferals_success') == 2 AND count($this->input->post('action')) > 0){
            $validation_rules[] = array('field' => 'action[]', 'label' => 'Действие', 'rules' => array('required','max_length[255]'));
            $validation_rules[] = array('field' => 'description[]', 'label' => 'Описание', 'rules' => array('required','max_length[255]'));
            $validation_rules[] = array('field' => 'plusminus[]', 'label' => 'Тип операции', 'rules' => array('required','in_list[0,1]','numeric','max_length[255]'));
            $validation_rules[] = array('field' => 'type[]', 'label' => 'Тип операции', 'rules' => array('required','numeric','in_list[0,1,2,3]','max_length[255]'));
            $validation_rules[] = array('field' => 'summ[]', 'label' => 'Сумма операции', 'rules' => array('required','numeric','greater_than[0]','max_length[255]'));
            $validation_rules[] = array('field' => 'type2[]', 'label' => 'Тип вознаграждения', 'rules' => array('required','in_list[0,1]','numeric','max_length[255]'));
            $validation_rules[] = array('field' => 'amount1[]', 'label' => 'Сумма вознаграждения', 'rules' => array('numeric','max_length[255]'));
            $validation_rules[] = array('field' => 'amount2[]', 'label' => 'Сумма вознаграждения', 'rules' => array('numeric','less_than_equal_to[100]','max_length[255]'));
		}
		
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$user_id = $this->input->post('user_id');
			
			$USER = $this->users->GetUserById($user_id);
			
			$remove_avatar = ($this->input->post('remove_avatar'))? true : false;
			$editusername = ($this->input->post('editusername') != '') ? $this->input->post('editusername') : false;
			$editemail = ($this->input->post('editemail') != '') ? $this->input->post('editemail') : false;
			$editpass = ($this->input->post('editpass') != '') ? $this->input->post('editpass') : false;
			$user_group = intval($this->input->post('user_group'));
			$ban = ($this->input->post('ban'))? 1 : 0;
			$ban_long = $this->input->post('ban_long');
			$ban_reason = $this->input->post('ban_reason');
			$alive_balace_mail = ($this->input->post('alive_balace_mail'))? 1 : 0;
			$alive_site_mail = ($this->input->post('alive_site_mail'))? 1 : 0;
			$default_requisites = $this->input->post('default_requisites');
			$country = $this->input->post('country');
			$disable_change_country = ($this->input->post('disable_change_country'))? 1 : 0;
			$server = $this->input->post('server');
			$disable_change_server = ($this->input->post('disable_change_server'))? 1 : 0;
			$refferals_success = $this->input->post('refferals_success');
			$disabled_mail = ($this->input->post('disabled_mail'))? 1 : 0;
			$language = $this->input->post('language');
			
			$delete = ($this->input->post('delete'))? true : false;//!!!!!!!!!!!!!!!!

			if($refferals_success != 2){
				$this->billing->DeleteReferralsRulesForUser(false,$user_id);
			}
			if($refferals_success == 2 AND count($this->input->post('action')) > 0){
				$DATA['user_id'] = $user_id;
				$DATA['plugin'] = $this->input->post('action');
				$DATA['description'] = $this->input->post('description');
				$DATA['type'] = $this->input->post('type');
				foreach($this->input->post('plusminus') as $k=>$v){
					$DATA['plus'][] = ($v == 1) ? 1 : 0;
				}
				foreach($this->input->post('plusminus') as $k=>$v){
					$DATA['minus'][] = ($v == 0) ? 1 : 0;
				}
				$DATA['summ'] = $this->input->post('summ');

				foreach($this->input->post('type2') as $k=>$v){
					$DATA['amount'][] = ($v == 0) ? $this->billing->convert($this->input->post('amount1')[$k]) : $this->billing->convert(0);
				}
				
				foreach($this->input->post('type2') as $k=>$v){
					$DATA['percent'][] = ($v == 1) ? intval($this->input->post('amount2')) : 0;
				}
				
				$this->billing->CreateReferralsRulesForUser($DATA);
			}

			$avatar = $USER['avatar'];
			if($_FILES['customFile']['name']){
                $config['upload_path']          = './uploads/avatars/';
                $config['allowed_types']        =$this->CONFIG->get('avatar_allow_files_upload');
				if($this->CONFIG->get('system_image_max_up_size') > 0){
					$config['max_size']             = $this->CONFIG->get('system_image_max_up_size');
				}
                $config['file_name']           = $user_id;
                $config['overwrite']           = $true;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('customFile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						$avatar = '/uploads/avatars/'.$data['upload_data']['file_name'];
                }
			}
			//CONSTRUKTOR
			$ATA = array(
				$editemail,
				$language,
				$alive_balace_mail,
				$alive_site_mail,
				$disabled_mail,
				($editusername) ? $editusername : $USER['username'],
				($editpass) ? crypt($editpass, '$6$rounds=20000$') : $USER['password'],
				$country,
				$disable_change_country,
				$server,
				$disable_change_server,
				$user_group,
				$avatar,
				$ban,
				$ban_long,
				$ban_reason,
				$default_requisites,
				$refferals_success,
				$user_id
			);
			
			$this->db->query("UPDATE `users` SET `email`=?,`language`=?,`alive_balace_mail`=?,`alive_site_mail`=?,`disabled_mail`=?,`username`=?,`password`=?,`country`=?,`disable_change_country`=?,`server`=?,`disable_change_server`=?,`user_group`=?,`avatar`=?,`ban`=?,`ban_long`=?,`ban_reason`=?,`default_requisites`=?,`refferals_success`=? WHERE id=?",$ATA);

			
			if($user_group != $USER['user_group'] OR $editpass OR $ban){
				$this->system->DeleteUserSessions($user_id);
			}


			$AN['response'] = 'success';
			$AN['reload'] = 'true';
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}
	
	function edit_fl($id){
		$ERROR = array('error'=>false);
		$this->system->accessError('Admin Fl Edit');
        $validation_rules = array(
            array('field' => 'name', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'desc', 'label' => 'Описание (ottplay)', 'rules' => array('max_length[255]')),
            array('field' => 'ip', 'label' => 'IP адрес', 'rules' => array('required','max_length[255]')),
            array('field' => 'domain', 'label' => 'Домен', 'rules' => array('max_length[255]')),
            array('field' => 'port', 'label' => 'Порт', 'rules' => array('required','is_natural')),
            array('field' => 'secure', 'label' => 'SSL', 'rules' => array('max_length[255]')),
            array('field' => 'username', 'label' => 'Логин', 'rules' => array('max_length[255]')),
            array('field' => 'password', 'label' => 'Пароль', 'rules' => array('max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['id'] = $id;
			$DATA['name'] = $this->input->post('name');
			$DATA['desc'] = $this->input->post('desc');
			$DATA['ip'] = $this->input->post('ip');
			$DATA['domain'] = $this->input->post('domain');
			$DATA['port'] = $this->input->post('port');
			$DATA['secure'] = ($this->input->post('secure')) ? 1 : 0;
			$DATA['username'] = $this->input->post('username');
			$DATA['password'] = $this->input->post('password');
			
			if($DATA['username'] != '' AND $DATA['password'] != ''){
				if(!$this->flussonic->SessionDelete($DATA['username'],$DATA['password'],$DATA['ip'],'test')){
					$ERROR['error'] = true;
					$ERROR['errors']['username'] = "Не удалось подключиться к серверу, проверьте введеные данные";	
					goto function_edit_fl;
				}
			}
			
			$this->admin->EditServer($DATA);
			$AN['response'] = 'success';
			$AN['location'] = '/admin/fl/';
		}else{
function_edit_fl:
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
			foreach($ERROR['errors'] as $k=>$v){
					$AN['errors'][$k] = $ERROR['errors'][$k];
			}
		}
		return $AN;
	}
	
	function create_fl(){
		$ERROR = array('error'=>false);
		$this->system->accessError('Admin Fl Create');
        $validation_rules = array(
            array('field' => 'name', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'desc', 'label' => 'Описание (ottplay)', 'rules' => array('max_length[255]')),
            array('field' => 'ip', 'label' => 'IP адрес', 'rules' => array('required','max_length[255]')),
            array('field' => 'domain', 'label' => 'Домен', 'rules' => array('max_length[255]')),
            array('field' => 'port', 'label' => 'Порт', 'rules' => array('required','is_natural')),
            array('field' => 'secure', 'label' => 'SSL', 'rules' => array('max_length[255]')),
            array('field' => 'username', 'label' => 'Логин', 'rules' => array('max_length[255]')),
            array('field' => 'password', 'label' => 'Пароль', 'rules' => array('max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['name'] = $this->input->post('name');
			$DATA['desc'] = $this->input->post('desc');
			$DATA['ip'] = $this->input->post('ip');
			$DATA['domain'] = $this->input->post('domain');
			$DATA['port'] = $this->input->post('port');
			$DATA['secure'] = ($this->input->post('secure')) ? 1 : 0;
			$DATA['username'] = $this->input->post('username');
			$DATA['password'] = $this->input->post('password');
			
			if($DATA['username'] != '' AND $DATA['password'] != ''){
				if(!$this->flussonic->SessionDelete($DATA['username'],$DATA['password'],$DATA['ip'],'test')){
					$ERROR['error'] = true;
					$ERROR['errors']['username'] = "Не удалось подключиться к серверу, проверьте введеные данные";	
					goto function_create_fl;
				}
			}			
			
			$this->admin->CreateServer($DATA);
			$AN['response'] = 'success';
			$AN['location'] = '/admin/fl/';
		}else{
function_create_fl:
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
			foreach($ERROR['errors'] as $k=>$v){
					$AN['errors'][$k] = $ERROR['errors'][$k];
			}
		}
		return $AN;
	}
	
	function create_news(){
        $validation_rules = array(
            array('field' => 'title', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'text', 'label' => 'Текст новости', 'rules' => array('required','max_length[255]')),
            array('field' => 'langs[]', 'label' => 'Для языков'),
            array('field' => 'user_groups[]', 'label' => 'Для групп'),
            array('field' => 'users', 'label' => 'Для пользователей'),
            array('field' => 'not_langs[]', 'label' => 'Не для языков'),
            array('field' => 'not_user_groups[]', 'label' => 'Не для групп'),
            array('field' => 'not_users', 'label' => 'Не для пользователей'),
        );		
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['title'] = $this->input->post('title');
			$DATA['text'] = $this->input->post('text');
			$DATA['date'] = time();
			
			$DATA['langs'] = ($this->input->post('langs') == NULL) ? '' : $this->input->post('langs');
			$DATA['user_groups'] = ($this->input->post('user_groups') == NULL) ? '' : $this->input->post('user_groups');
			$DATA['users'] = ($this->input->post('users') == NULL) ? '' : $this->input->post('users');
			$DATA['not_langs'] = ($this->input->post('not_langs') == NULL) ? '' : $this->input->post('not_langs');
			$DATA['not_user_groups'] = ($this->input->post('not_user_groups') == NULL) ? '' : $this->input->post('not_user_groups');
			$DATA['not_users'] = ($this->input->post('not_users') == NULL) ? '' : $this->input->post('not_users');
			
			
			$this->admin->CreateNews($DATA);
			$AN['response'] = 'success';
			$AN['location'] = '/admin/news';
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}			
		}
		return $AN;
	}
	
	function edit_news($id){
        $validation_rules = array(
            array('field' => 'title', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'text', 'label' => 'Текст новости', 'rules' => array('required','max_length[255]')),
            array('field' => 'langs[]', 'label' => 'Для языков'),
            array('field' => 'user_groups[]', 'label' => 'Для групп'),
            array('field' => 'users', 'label' => 'Для пользователей'),
            array('field' => 'not_langs[]', 'label' => 'Не для языков'),
            array('field' => 'not_user_groups[]', 'label' => 'Не для групп'),
            array('field' => 'not_users', 'label' => 'Не для пользователей'),
        );		
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['id'] = $id;
			$DATA['title'] = $this->input->post('title');
			$DATA['text'] = $this->input->post('text');
			$DATA['date'] = time();
			$DATA['langs'] = ($this->input->post('langs') == NULL) ? '' : $this->input->post('langs');
			$DATA['user_groups'] = ($this->input->post('user_groups') == NULL) ? '' : $this->input->post('user_groups');
			$DATA['users'] = ($this->input->post('users') == NULL) ? '' : $this->input->post('users');
			$DATA['not_langs'] = ($this->input->post('not_langs') == NULL) ? '' : $this->input->post('not_langs');
			$DATA['not_user_groups'] = ($this->input->post('not_user_groups') == NULL) ? '' : $this->input->post('not_user_groups');
			$DATA['not_users'] = ($this->input->post('not_users') == NULL) ? '' : $this->input->post('not_users');
			
			$this->admin->EditNews($DATA);
			$AN['response'] = 'success';
			$AN['location'] = '/admin/news';
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}			
		}
		return $AN;
	}
	function edit_channel($id){
		$this->system->accessError('Admin Channels Edit');
		foreach($this->config->item('country_codes') as $k=>$v){
			$countrys_code[] = $k;
		}
		$countrys_code = implode(',',$countrys_code);
        $validation_rules = array(
            array('field' => 'name', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'nameott', 'label' => 'Название (ottplay)', 'rules' => array('max_length[255]')),
            array('field' => 'server[]', 'label' => 'Сервер', 'rules' => array('required','is_natural_no_zero')),
            array('field' => 'fl', 'label' => 'ID Flussonic', 'rules' => array('required','max_length[255]')),
            array('field' => 'epg', 'label' => 'EPG', 'rules' => array('max_length[255]')),
            array('field' => 'icon', 'label' => 'Иконка', 'rules' => array('max_length[255]')),
            array('field' => 'epgsiptv', 'label' => 'EPG (siptv)', 'rules' => array('max_length[255]')),
            array('field' => 'archive', 'label' => 'Архив', 'rules' => array('max_length[255]')),
            array('field' => 'active', 'label' => 'Канал включен', 'rules' => array('max_length[255]')),
            array('field' => 'block[]', 'label' => 'Блокировка по странам (Авторизация)', 'rules' => array('in_list['.$countrys_code.']','max_length[255]')),
            array('field' => 'block_fl[]', 'label' => 'Блокировка по странам (Flussonic)', 'rules' => array('in_list['.$countrys_code.']','max_length[255]')),
            array('field' => 'block_pl[]', 'label' => 'Блокировка по странам (Сайт)', 'rules' => array('in_list['.$countrys_code.']','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['id'] = $id;
			$DATA['name'] = $this->input->post('name');
			$DATA['nameott'] = $this->input->post('nameott');
			$DATA['server'] = '';
			foreach($this->input->post('server') as $v){
				$DATA['server'] .= '|'.$v.'|';
			}
			$DATA['fl'] = $this->input->post('fl');
			$DATA['epg'] = $this->input->post('epg');
			$DATA['epgsiptv'] = $this->input->post('epgsiptv');
			$DATA['icon'] = $this->input->post('icon');
			$DATA['archive'] = ($this->input->post('archive')) ? 1 : 0;
			$DATA['active'] = ($this->input->post('active')) ? 1 : 0;
			$DATA['block'] = ($this->input->post('block[]')) ? implode(',',$this->input->post('block[]')) : '';
			$DATA['block_pl'] = ($this->input->post('block_pl[]')) ? implode(',',$this->input->post('block_pl[]')) : '';
			$DATA['block_fl'] = ($this->input->post('block_fl[]')) ? implode(',',$this->input->post('block_fl[]')) : '';
			$this->channels->edit($DATA);
			$AN['response'] = 'success';
			$AN['location'] = '/admin/ch/';
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
			
		}
		return $AN;
	}
	
	
	function delete_session_users($user_id=false,$session_id=false){
		$this->system->accessError('Admin Users Edit');
		$this->system->DeleteUserSessions($user_id,$session_id);
	}
	function delete_session_ch($server_id,$session_id){
		$this->system->accessError('Admin Channels Edit');
		$server = $this->admin->GetServer($server_id);
		$this->flussonic->SessionDelete($server['username'],$server['password'],$server['ip'],$session_id);
	}
	
	
	function delete_users($user_id=false){
		$this->system->accessError('Admin Users Delete');
		$this->users->DELETE($user_id);
	}
	
	
	function action_channel(){
        $validation_rules = array(
            array('field' => 'match[]', 'label' => 'Выбрано', 'rules' => array('required','max_length[255]')),
            array('field' => 'action', 'label' => 'Действие', 'rules' => array('required','max_length[255]','in_list[on,off,delete]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['match'] = $this->input->post('match');			
			$DATA['action'] = $this->input->post('action');		
			foreach($DATA['match'] as $id){
				switch ($DATA['action']) {
					case 'on':
						$this->system->accessError('Admin Channels Edit');
						$this->db->query("UPDATE channels SET active=? WHERE id=?",array(1,$id));
						break;
					case 'off':
						$this->system->accessError('Admin Channels Edit');
						$this->db->query("UPDATE channels SET active=? WHERE id=?",array(0,$id));
						break;
					case 'delete':
						$this->system->accessError('Admin Channels Delete');
						$this->db->query("DELETE FROM channels  WHERE id=?",array($id));
						$this->db->query("DELETE FROM tariffs_channel  WHERE ch_id=?",array($id));
						break;
				}
			}

		$AN['response'] = 'success';
		$AN['reload'] = 'true';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}	
	
	
	function action_users_referrals_billing(){
		$this->system->accessError('Admin Billing Refferals');
        $validation_rules = array(
            array('field' => 'match[]', 'label' => 'Выбрано', 'rules' => array('required','max_length[255]')),
            array('field' => 'action', 'label' => 'Действие', 'rules' => array('required','max_length[255]','in_list[on,off,delete]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['match'] = $this->input->post('match');			
			$DATA['action'] = $this->input->post('action');		
			foreach($DATA['match'] as $id){
				switch ($DATA['action']) {
					case 'on':
						$this->db->query("UPDATE refferals_rules_users SET status=? WHERE id=?",array(1,$id));
						break;
					case 'off':
						$this->db->query("UPDATE refferals_rules_users SET status=? WHERE id=?",array(0,$id));
						break;
					case 'delete':
						$this->db->query("DELETE FROM refferals_rules_users  WHERE id=?",array($id));
						break;
				}
			}

		$AN['response'] = 'success';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}	
	
	
	function action_referrals_billing(){
		$this->system->accessError('Admin Billing Refferals');
        $validation_rules = array(
            array('field' => 'match[]', 'label' => 'Выбрано', 'rules' => array('required','max_length[255]')),
            array('field' => 'action', 'label' => 'Действие', 'rules' => array('required','max_length[255]','in_list[on,off,delete]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['match'] = $this->input->post('match');			
			$DATA['action'] = $this->input->post('action');		
			foreach($DATA['match'] as $id){
				switch ($DATA['action']) {
					case 'on':
						$this->db->query("UPDATE refferals_rules SET status=? WHERE id=?",array(1,$id));
						break;
					case 'off':
						$this->db->query("UPDATE refferals_rules SET status=? WHERE id=?",array(0,$id));
						break;
					case 'delete':
						$this->db->query("DELETE FROM refferals_rules  WHERE id=?",array($id));
						break;
				}
			}

		$AN['response'] = 'success';
		$AN['reload'] = 'true';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}	
	
	function create_channel(){
		$this->system->accessError('Admin Channels Create');
		foreach($this->config->item('country_codes') as $k=>$v){
			$countrys_code[] = $k;
		}
		$countrys_code = implode(',',$countrys_code);
        $validation_rules = array(
            array('field' => 'name', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'nameott', 'label' => 'Название (ottplay)', 'rules' => array('max_length[255]')),
            array('field' => 'server[]', 'label' => 'Сервер', 'rules' => array('required','is_natural_no_zero')),
            array('field' => 'fl', 'label' => 'ID Flussonic', 'rules' => array('required','max_length[255]','is_unique[channels.fl]')),
            array('field' => 'epg', 'label' => 'EPG', 'rules' => array('max_length[255]')),
            array('field' => 'icon', 'label' => 'Иконка', 'rules' => array('max_length[255]')),
            array('field' => 'epgsiptv', 'label' => 'EPG (siptv)', 'rules' => array('max_length[255]')),
            array('field' => 'archive', 'label' => 'Архив', 'rules' => array('max_length[255]')),
            array('field' => 'active', 'label' => 'Канал включен', 'rules' => array('max_length[255]')),
            array('field' => 'block[]', 'label' => 'Блокировка по странам (Авторизация)', 'rules' => array('in_list['.$countrys_code.']','max_length[255]')),
            array('field' => 'block_fl[]', 'label' => 'Блокировка по странам (Flussonic)', 'rules' => array('in_list['.$countrys_code.']','max_length[255]')),
            array('field' => 'block_pl[]', 'label' => 'Блокировка по странам (Сайт)', 'rules' => array('in_list['.$countrys_code.']','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['name'] = $this->input->post('name');
			$DATA['nameott'] = $this->input->post('nameott');
			$DATA['server'] = '';
			foreach($this->input->post('server') as $v){
				$DATA['server'] .= '|'.$v.'|';
			}
			
			$DATA['fl'] = $this->input->post('fl');
			$DATA['epg'] = $this->input->post('epg');
			$DATA['epgsiptv'] = $this->input->post('epgsiptv');
			$DATA['icon'] = $this->input->post('icon');
			$DATA['archive'] = ($this->input->post('archive')) ? 1 : 0;
			$DATA['active'] = ($this->input->post('active')) ? 1 : 0;
			$DATA['block'] = ($this->input->post('block[]')) ? implode(',',$this->input->post('block[]')) : '';
			$DATA['block_pl'] = ($this->input->post('block_pl[]')) ? implode(',',$this->input->post('block_pl[]')) : '';
			$DATA['block_fl'] = ($this->input->post('block_fl[]')) ? implode(',',$this->input->post('block_fl[]')) : '';
			$this->channels->create($DATA);
			$AN['response'] = 'success';
			$AN['location'] = '/admin/ch/';
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
			
		}
		return $AN;
	}
	
	
	
	function create_category(){
		$this->system->accessError('Admin Category Create');
		foreach($this->channels->GetChannels() as $k=>$v){
			$allow_channels[] = ($v['category'] == 0) ? $v['id'] : '';
		}
		$allow_channels = implode(',',$allow_channels);
        $validation_rules = array(
            array('field' => 'name', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'adult', 'label' => 'Adult', 'rules' => array('max_length[255]')),
            array('field' => 'pincode', 'label' => 'Pin-code', 'rules' => array('max_length[4]','min_length[4]','numeric','max_length[255]')),
            array('field' => 'channels[]', 'label' => 'Каналы', 'rules' => array('in_list['.$allow_channels.']','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['name'] = $this->input->post('name');
			$DATA['adult'] = ($this->input->post('adult')) ? 1 : 0;
			$DATA['pincode'] = ($this->input->post('pincode')) ? $this->input->post('pincode') : '0000';
			$DATA['channels'] = $this->input->post('channels');
			
			$this->category->create($DATA);
			$AN['response'] = 'success';
			$AN['location'] = '/admin/cat/';
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}
	
	
	
	function edit_category($id){
		$this->system->accessError('Admin Category Edit');
		foreach($this->channels->GetChannels() as $k=>$v){
			$allow_channels[] = ($v['category'] == 0 OR $v['category'] == $id) ? $v['id'] : '';
		}
		$allow_channels = implode(',',$allow_channels);
        $validation_rules = array(
            array('field' => 'name', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'adult', 'label' => 'Adult', 'rules' => array('max_length[255]')),
            array('field' => 'pincode', 'label' => 'Pin-code', 'rules' => array('max_length[4]','min_length[4]','numeric','max_length[255]')),
            array('field' => 'channels[]', 'label' => 'Каналы', 'rules' => array('in_list['.$allow_channels.']','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['id'] = $id;
			$DATA['name'] = $this->input->post('name');
			$DATA['adult'] = ($this->input->post('adult')) ? 1 : 0;
			$DATA['pincode'] = ($this->input->post('pincode')) ? $this->input->post('pincode') : '0000';
			$DATA['channels'] = $this->input->post('channels');
			
			$this->category->edit($DATA);
			$AN['response'] = 'success';
			$AN['location'] = '/admin/cat/';
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}
	
	
	function delete_category($id){
		$this->system->accessError('Admin Category Delete');
		$category = $this->category->GetCategory($id);
		$AN['response'] = 'success';
		$AN['title'] = 'Удаление категории <b>"'.$category['name'].'"</b>';
		$AN['body'] = '<div class="p-4 text-center"> <p>Вы действительно хотите удалить категорию <b>"'.$category['name'].'"</b> ?</p> <p>Данное действие невозможно отменить.</p> </div>';
		if($this->category->CountInCat($id) > 0){
			$AN['body'] .= '<div class="p-4 text-center"> <p>Категория содержит каналы. Вы можете выбрать новую категорию для каналов:</p> </div>';
			$categorys = array();
			foreach($this->category->GetCategory() as $k=>$v){
				if($v['id'] != $id){
					$categorys[] = "<option value='{$v['id']}'>{$v['name']}</option>";
				}
			}
			$categorys = implode("\r\n",$categorys);
			$AN['body'] .= <<<HTML
											<div class="form-group">
												<label class="text-muted" for="new_category">Новая категория</label>
                                                    <select id="new_category" name="new_category" class="form-control">
																											<option value='0'>---</option>
																											{$categorys}
													                                                    </select>
											</div>			
HTML;
		}
		$AN['footer'] = '<button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button> <button type="button" class="btn btn-danger" onclick="DeleteCategoryConfirm('.$category['id'].')">Удалить</button>';
		return $AN;
	}
	
	function delete_category_confirm($id,$new_id=0){
		$this->system->accessError('Admin Category Delete');
		$category = $this->category->GetCategory($id);
		$new_category = $this->category->GetCategory($new_id);
		$AN['response'] = 'success';
		$AN['title'] = 'Удаление категории <b>"'.$category['name'].'"</b>';
		$AN['body'] = '<div class="p-4 text-center"> <p>Категория <b>"'.$category['name'].'" успешно удалена!</p> </div>';
		if($new_id){
			$AN['body'] .= '<div class="p-4 text-center"> <p>Все каналы были перенесены в категорию <b>"'.$new_category['name'].'" .</p> </div>';
			$this->db->query("DELETE FROM `category` WHERE id=?",array($id));
			$this->db->query("UPDATE channels SET category=? WHERE category=?",array($new_id,$id));
		}else{
			$this->db->query("DELETE FROM `category` WHERE id=?",array($id));
		}
		$AN['footer'] = '<button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button>';
		return $AN;
	}
	
	
	function create_tariff(){
		$this->system->accessError('Admin Tariffs Create');
		$ERROR = array('error'=>false);
        $validation_rules = array(
            array('field' => 'name', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'desc', 'label' => 'Описание', 'rules' => array('required','max_length[255]')),
            array('field' => 'connects', 'label' =>	'Подключения', 'rules' => array('required','is_natural_no_zero','max_length[255]')),
            array('field' => 'portals', 'label' =>	'Порталы', 'rules' => array('is_natural','max_length[255]')),
            array('field' => 'archive', 'label' => 'Архивы', 'rules' => array('max_length[3]')),
            array('field' => 'active', 'label' => 'Активность', 'rules' => array('max_length[3]')),
            array('field' => 'typetariff', 'label' => 'Тип тарифа'),
            array('field' => 'external_id', 'label' => 'Внешний ID портала'),
            array('field' => 'period[]', 'label' => 'Периоды'),
            array('field' => 'long[]', 'label' => 'Длительность'),
            array('field' => 'text[]', 'label' => 'Длительность'),
            array('field' => 'cost[]', 'label' => 'Стоимость'),
            array('field' => 'ch[]', 'label' => 'Каналы'),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['name'] = $this->input->post('name');
			$DATA['desc'] = $this->input->post('desc');
			$DATA['connects'] = $this->input->post('connects');
			$DATA['portals'] = ($this->input->post('portals')) ? $this->input->post('portals') : 0;
			$DATA['archive'] = ($this->input->post('archive')) ? 1 : 0;
			$DATA['active'] = ($this->input->post('active')) ? 1 : 0;
			$DATA['period'] = $this->input->post('period');
			$DATA['period'] = $this->input->post('period');
			$DATA['long'] = $this->input->post('long');
			$DATA['text'] = $this->input->post('text');
			$DATA['cost'] = $this->input->post('cost');
			$DATA['ch'] = $this->input->post('ch');
			$DATA['type'] = $this->input->post('typetariff');
			$DATA['external_id'] = $this->input->post('external_id');
			if(count($DATA['period']) != count($DATA['long']) OR count($DATA['period']) != count($DATA['cost']) OR count($DATA['cost']) != count($DATA['long'])){
				$ERROR['error'] = true;
				$ERROR['errors']['unknown'] = "неизвестная ошибка, проверьте форму";
			}
			
			
			if(($DATA['type'] == 1 OR $DATA['type'] == 3) AND $DATA['external_id'] == ''){
				$ERROR['error'] = true;
				$ERROR['errors']['external_id'] = "Вы не указали ID тарифа в портале!";
			}
			if(($DATA['type'] == 1 OR $DATA['type'] == 2) AND count($DATA['ch']) < 1){
				$ERROR['error'] = true;
				$ERROR['errors']['ch[]'] = "Вы не выбрали каналы!";
			}
			
			
			
			if($ERROR['error']){
				goto tariffs_create;
			}
			
			
			
			
		$this->tariffs->create($DATA);
			
			
		$AN['response'] = 'success';
		$AN['location'] = '/admin/tariffs/';
		}else{
tariffs_create:		
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
			foreach($ERROR['errors'] as $k=>$v){
					$AN['errors'][$k] = $ERROR['errors'][$k];
			}
		}
		return $AN;
	}
	
	
	
	function edit_tariff($id){
		$this->system->accessError('Admin Tariffs Edit');
		$ERROR = array('error'=>false);
        $validation_rules = array(
            array('field' => 'name', 'label' => 'Название', 'rules' => array('required','max_length[255]')),
            array('field' => 'desc', 'label' => 'Описание', 'rules' => array('required','max_length[255]')),
            array('field' => 'connects', 'label' =>	'Подключения', 'rules' => array('required','is_natural_no_zero','max_length[255]')),
            array('field' => 'portals', 'label' =>	'Порталы', 'rules' => array('is_natural','max_length[255]')),
            array('field' => 'archive', 'label' => 'Архивы', 'rules' => array('max_length[3]')),
            array('field' => 'active', 'label' => 'Активность', 'rules' => array('max_length[3]')),
            array('field' => 'typetariff', 'label' => 'Тип тарифа'),
            array('field' => 'external_id', 'label' => 'Внешний ID портала'),
            array('field' => 'period[]', 'label' => 'Периоды'),
            array('field' => 'long[]', 'label' => 'Длительность'),
            array('field' => 'text[]', 'label' => 'Длительность'),
            array('field' => 'cost[]', 'label' => 'Стоимость'),
            array('field' => 'ch[]', 'label' => 'Каналы'),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['id'] = $id;
			$DATA['name'] = $this->input->post('name');
			$DATA['desc'] = $this->input->post('desc');
			$DATA['connects'] = $this->input->post('connects');
			$DATA['portals'] = ($this->input->post('portals')) ? $this->input->post('portals') : 0;
			$DATA['archive'] = ($this->input->post('archive')) ? 1 : 0;
			$DATA['active'] = ($this->input->post('active')) ? 1 : 0;
			$DATA['period'] = $this->input->post('period');
			$DATA['period'] = $this->input->post('period');
			$DATA['long'] = $this->input->post('long');
			$DATA['text'] = $this->input->post('text');
			$DATA['cost'] = $this->input->post('cost');
			$DATA['ch'] = $this->input->post('ch');
			$DATA['type'] = $this->input->post('typetariff');
			$DATA['external_id'] = $this->input->post('external_id');
			if(count($DATA['period']) != count($DATA['long']) OR count($DATA['period']) != count($DATA['cost']) OR count($DATA['cost']) != count($DATA['long'])){
				$ERROR['error'] = true;
				$ERROR['errors']['unknown'] = "неизвестная ошибка, проверьте форму";
			}
			
			
			if(($DATA['type'] == 1 OR $DATA['type'] == 3) AND $DATA['external_id'] == ''){
				$ERROR['error'] = true;
				$ERROR['errors']['external_id'] = "Вы не указали ID тарифа в портале!";
			}
			if(($DATA['type'] == 1 OR $DATA['type'] == 2) AND count($DATA['ch']) < 1){
				$ERROR['error'] = true;
				$ERROR['errors']['ch[]'] = "Вы не выбрали каналы!";
			}
			
			
			
			if($ERROR['error']){
				goto tariffs_edit;
			}
			
			
			
			
		$this->tariffs->edit($DATA);
			
			
		$AN['response'] = 'success';
		$AN['location'] = '/admin/tariffs/';
		}else{
tariffs_edit:		
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
			foreach($ERROR['errors'] as $k=>$v){
					$AN['errors'][$k] = $ERROR['errors'][$k];
			}
		}
		return $AN;
	}
	
	
	


//==================================================	
//==================================================	
//==================================================	
	//Надо еще с порталом состыковать
	
	
	function delete_tariff($id){
		$this->system->accessError('Admin Tariffs Delete');
		$tariff = $this->tariffs->GetTariff($id);//$this->tariffs->GetCountInTariff($v['id'])
		$AN['response'] = 'success';
		$AN['title'] = 'Удаление тарифа <b>"'.$tariff['name'].'"</b>';
		$AN['body'] = '<div class="p-4 text-center"> <p>Вы действительно хотите удалить тариф <b>"'.$tariff['name'].'"</b> ?</p> <p>Данное действие невозможно отменить.</p> </div>';
		if($this->tariffs->GetUsersInTariff($id) > 0){
			$AN['body'] .= '<div class="p-4 text-center"> <p>На данном тарифе есть пользователи. Вы можете выбрать новый тариф пользователей:</p> </div>';
			$tariffs = array();
			foreach($this->tariffs->GetTariffs() as $k=>$v){
				if($v['id'] != $id){
					$tariffs[] = "<option value='{$v['id']}'>{$v['name']}</option>";
				}
			}
			$tariffs = implode("\r\n",$tariffs);
			$AN['body'] .= <<<HTML
											<div class="form-group">
												<label class="text-muted" for="new_tariff">Новый тариф</label>
                                                    <select id="new_tariff" name="new_tariff" class="form-control">
																											<option value='0'>---</option>
																											{$tariffs}
													                                                    </select>
											</div>			
HTML;
		}
		$AN['footer'] = '<button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button> <button type="button" class="btn btn-danger" onclick="DeleteCategoryConfirm('.$tariff['id'].')">Удалить</button>';
		return $AN;
	}
	
	function delete_tariff_confirm($id,$new_id=0){
		$this->system->accessError('Admin Tariffs Delete');
		$tariff = $this->tariffs->GetTariff($id);
		$new_tariff = $this->tariffs->GetTariff($new_id);
		$AN['response'] = 'success';
		$AN['title'] = 'Удаление тарифа <b>"'.$tariff['name'].'"</b>';
		$AN['body'] = '<div class="p-4 text-center"> <p>Тариф <b>"'.$tariff['name'].'" успешно удален!</p> </div>';
		if($new_id){
			$AN['body'] .= '<div class="p-4 text-center"> <p>Все пользователи были переведены на тариф <b>"'.$new_tariff['name'].'" .</p> </div>';
			$this->db->query("DELETE FROM `tariffs` WHERE id=?",array($id));
			$this->db->query("DELETE FROM `tariffs_channel` WHERE tariff_id=?",array($id));
			$this->db->query("DELETE FROM `tariffs_cost` WHERE tariff_id=?",array($id));
			$this->db->query("UPDATE pack SET tariff_id=? WHERE tariff_id=?",array($new_id,$id));
			$this->db->query("DELETE FROM `pack` WHERE tariff_id=?",array($id));
		}else{
			$this->db->query("DELETE FROM `tariffs` WHERE id=?",array($id));
			$this->db->query("DELETE FROM `tariffs_channel` WHERE tariff_id=?",array($id));
			$this->db->query("DELETE FROM `tariffs_cost` WHERE tariff_id=?",array($id));
			$this->db->query("DELETE FROM `pack` WHERE tariff_id=?",array($id));
		}
		$AN['footer'] = '<button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button>';
		return $AN;
	}	


//==================================================	
//==================================================	
//==================================================	
	
	
	
	
	
	
	
	
	
	function settings_billing(){
		$this->system->accessError('Admin Billing Settings');
		$ERROR = array('error'=>false);
        $validation_rules = array(
            array('field' => 'billing_currency_decline', 'label' => 'Наименование у.е.', 'rules' => array('required','max_length[255]')),
            array('field' => 'billing_admin_login_message', 'label' => 'Логин администратора', 'rules' => array('required','max_length[255]')),
            array('field' => 'billing_minimum_pay', 'label' => 'Сумма оплаты по умолчанию', 'rules' => array('required','decimal','max_length[255]')),
            array('field' => 'billing_secret_key', 'label' => 'Ключ доступа платежной системы', 'rules' => array('required','max_length[255]')),
			
            array('field' => 'billing_notif_pm_paysuccess', 'label' => 'Квитанция оплачена (ПС)', 'rules' => array('max_length[1]')),
            array('field' => 'billing_notif_mail_paysuccess', 'label' => 'Квитанция оплачена (MAIL)', 'rules' => array('max_length[1]')),
			
            array('field' => 'billing_notif_pm_paystart', 'label' => 'Новая квитанция (ПС)', 'rules' => array('max_length[1]')),
            array('field' => 'billing_notif_mail_paystart', 'label' => 'Новая квитанция (MAIL)', 'rules' => array('max_length[1]')),
			
            array('field' => 'billing_notif_pm_balancechangeadmin', 'label' => 'Баланс изменён (НЕ платежной системой) (ПС)', 'rules' => array('max_length[1]')),
            array('field' => 'billing_notif_mail_balancechangeadmin', 'label' => 'Баланс изменён (НЕ платежной системой) (MAIL)', 'rules' => array('max_length[1]')),
			
            array('field' => 'billing_notif_pm_balancechange', 'label' => 'Баланс изменён (платежной системой) (ПС)', 'rules' => array('max_length[1]')),
            array('field' => 'billing_notif_mail_balancechange', 'label' => 'Баланс изменён (платежной системой) (MAIL)', 'rules' => array('max_length[1]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['billing_currency_decline'] = $this->input->post('billing_currency_decline');
			$DATA['billing_admin_login_message'] = $this->input->post('billing_admin_login_message');
			$DATA['billing_minimum_pay'] = $this->billing->convert($this->input->post('billing_minimum_pay'));
			$DATA['billing_secret_key'] = $this->input->post('billing_secret_key');
			
			$DATA['billing_notif_pm_paysuccess'] = ($this->input->post('billing_notif_pm_paysuccess')) ? 1 : 0;
			$DATA['billing_notif_mail_paysuccess'] = ($this->input->post('billing_notif_mail_paysuccess')) ? 1 : 0;
			
			$DATA['billing_notif_pm_paystart'] = ($this->input->post('billing_notif_pm_paystart')) ? 1 : 0;
			$DATA['billing_notif_mail_paystart'] = ($this->input->post('billing_notif_mail_paystart')) ? 1 : 0;
			
			$DATA['billing_notif_pm_balancechangeadmin'] = ($this->input->post('billing_notif_pm_balancechangeadmin')) ? 1 : 0;
			$DATA['billing_notif_mail_balancechangeadmin'] = ($this->input->post('billing_notif_mail_balancechangeadmin')) ? 1 : 0;
			
			$DATA['billing_notif_pm_balancechange'] = ($this->input->post('billing_notif_pm_balancechange')) ? 1 : 0;
			$DATA['billing_notif_mail_balancechange'] = ($this->input->post('billing_notif_mail_balancechange')) ? 1 : 0;
			
			if(count(explode('|',$DATA['billing_currency_decline'])) <> 3){
				$ERROR['error'] = true;
				$ERROR['errors']['billing_currency_decline'] = "Неверное значение поля";
			}
			
			if($DATA['billing_minimum_pay'] < 0){
				$ERROR['error'] = true;
				$ERROR['errors']['billing_currency_decline'] = "Неверное значение поля";
			}
			
			
			
			if($ERROR['error']){
				goto settings_billing;
			}
			
			
			foreach($DATA as $k=>$v){
				$this->CONFIG->set($k,$v);
			}
			
			
		$AN['response'] = 'success';
		}else{
settings_billing:		
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
			foreach($ERROR['errors'] as $k=>$v){
					$AN['errors'][$k] = $ERROR['errors'][$k];
			}
		}
		return $AN;
	}
	
	private function generate()
	{
		$chars = 'ABDEFGHKNQRSTYZ23456789';

		return substr($chars, rand(1, strlen($chars)) - 1, 1);
	}
	
	function generate_prcode_billing(){
		$this->system->accessError('Admin Billing Prcode');
		$ERROR = array('error'=>false);
        $validation_rules = array(
            array('field' => 'count', 'label' => 'Количество', 'rules' => array('required','is_natural_no_zero','max_length[5]')),
            array('field' => 'amount', 'label' => 'Номинал', 'rules' => array('required','decimal','max_length[255]')),
            array('field' => 'mask', 'label' => 'Шаблон промокода', 'rules' => array('required','max_length[255]')),
            array('field' => 'time', 'label' => 'Время активации', 'rules' => array('required','checkDateFormat','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['count'] = $this->input->post('count');
			$DATA['amount'] = $this->billing->convert($this->input->post('amount'));
			$DATA['mask'] = $this->input->post('mask');
			$DATA['active_before'] = ($this->input->post('times')) ? strtotime($this->input->post('time')) : 0;
			$AN['response'] = 'success';
			$AN['location'] = '/admin/billing/prcode/';
			
			
			
			







			$_Answer = array();

			$_Declension = $this->system->declines($DATA['amount'],$this->CONFIG->get('billing_currency_decline'));

			for( $n = 1; $n <= intval( $DATA['count'] ); $n ++ )
			{
no_uniq_prcode:
				$_prCode = $DATA['mask'];

				while( true )
				{
					$pos = strripos($_prCode, '0');

					if( ! $pos )
					{
						break;
					}

					$_prCode = substr_replace($_prCode, $this->generate(), $pos, 1);
				}

				$_prCode = substr_replace($_prCode, $this->generate(), 0, 1);

				if($this->db->query("SELECT COUNT(*) as count FROM prcodes WHERE prcode_tag=?",array($_prCode))->row_array()['count'] > 0){
					goto no_uniq_prcode;
				}
				$_Answer[] = $_prCode;
			}
			foreach($_Answer as $k=>$v){
				$DATA['prcode_tag'] = $v;
				$this->billing->CreatePrcode($DATA);
			}

			//$this->Dashboard->ThemeMsg( $this->_Lang['ap_gen_ok'], '<table class="table table-normal table-hover">' . $_Answer . '</table>', '?mod=billing&c=prcode' );









			
			
			
			
			
			
			
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
			foreach($ERROR['errors'] as $k=>$v){
					$AN['errors'][$k] = $ERROR['errors'][$k];
			}			
		}
		return $AN;
	}




	
	
	
	function save_prcode_billing(){
		$this->system->accessError('Admin Billing Prcode');
        $validation_rules = array(
            array('field' => 'billing_module_prcode_active', 'label' => 'Включить', 'rules' => array('max_length[1]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['billing_module_prcode_active'] = ($this->input->post('billing_module_prcode_active')) ? 1 : 0;			

			foreach($DATA as $k=>$v){
				$this->CONFIG->set($k,$v);
			}
			
			
		$AN['response'] = 'success';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}




	
	
	
	function action_prcode_billing(){
		$this->system->accessError('Admin Billing Prcode');
        $validation_rules = array(
            array('field' => 'match[]', 'label' => 'Выбрано', 'rules' => array('required','max_length[255]')),
            array('field' => 'action', 'label' => 'Действие', 'rules' => array('required','max_length[255]','in_list[success,cancel,delete]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['match'] = $this->input->post('match');			
			$DATA['action'] = $this->input->post('action');		
			foreach($DATA['match'] as $id){
				switch ($DATA['action']) {
					case 'success':
						$this->db->query("UPDATE prcodes SET active_date=? WHERE id=?",array(time(),$id));
						break;
					case 'cancel':
						$this->db->query("UPDATE prcodes SET active_date=? AND user_id=? WHERE id=?",array(0,0,$id));
						break;
					case 'delete':
						$this->db->query("DELETE FROM prcodes  WHERE id=?",array($id));
						break;
				}
			}

		$AN['response'] = 'success';
		$AN['reload'] = 'true';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}	




	
	
	
	function save_refund_billing(){
		$this->system->accessError('Admin Billing Refund');
        $validation_rules = array(
            array('field' => 'billing_module_refund_active', 'label' => 'Включить', 'rules' => array('max_length[1]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['billing_module_refund_active'] = ($this->input->post('billing_module_refund_active')) ? 1 : 0;			

			foreach($DATA as $k=>$v){
				$this->CONFIG->set($k,$v);
			}
			
			
		$AN['response'] = 'success';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}




	
	
	
	function action_refund_billing(){
		$this->system->accessError('Admin Billing Refund');
        $validation_rules = array(
            array('field' => 'match[]', 'label' => 'Выбрано', 'rules' => array('required','max_length[255]')),
            array('field' => 'action', 'label' => 'Действие', 'rules' => array('required','max_length[255]','in_list[success,wait,cancel,delete]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['match'] = $this->input->post('match');			
			$DATA['action'] = $this->input->post('action');		
			foreach($DATA['match'] as $id){
				switch ($DATA['action']) {
					case 'success':
						$this->db->query("UPDATE `refund` SET date_return=? WHERE id=? AND date_return=?",array(time(),$id,0));
						break;
					case 'wait':
						$this->db->query("UPDATE `refund` SET date_return=? WHERE id=?",array(0,$id));
						break;
					case 'cancel':
						$REF = $this->db->query("SELECT * FROM refund WHERE id=? AND date_return=?",array($id,0))->row_array();
						$this->db->query("DELETE FROM `refund` WHERE id=?",array($REF['id']));
						$this->billing->Plus($REF['amount'],'refund',$REF['user_id'],'Запрос на вывод средств #'.$REF['id'].' отменён администратором');
						break;
					case 'delete':
						$this->db->query("DELETE FROM `refund` WHERE id=?",array($id));
						break;
				}
			}

		$AN['response'] = 'success';
		$AN['reload'] = 'true';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
		
	}
		
	
	
	
	function save_referrals_billing(){
		$this->system->accessError('Admin Billing Refferals');
        $validation_rules = array(
            array('field' => 'billing_module_referrals_active', 'label' => 'Включить', 'rules' => array('max_length[1]')),
            array('field' => 'billing_module_referrals_bonus', 'label' => 'Бонус за регистрацию', 'rules' => array('numeric','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['billing_module_referrals_active'] = ($this->input->post('billing_module_referrals_active')) ? 1 : 0;			
			$DATA['billing_module_referrals_bonus'] = ($this->input->post('billing_module_referrals_bonus') > 0) ? $this->billing->convert($this->input->post('billing_module_referrals_bonus')) : $this->billing->convert(0) ;			

			foreach($DATA as $k=>$v){
				$this->CONFIG->set($k,$v);
			}
			
			
		$AN['response'] = 'success';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}
		
	
	
	
	function create_referrals_billing(){
		$this->system->accessError('Admin Billing Refferals');
        $validation_rules = array(
            array('field' => 'action', 'label' => 'Действие', 'rules' => array('required','max_length[255]')),
            array('field' => 'description', 'label' => 'Описание', 'rules' => array('required','max_length[255]')),
            array('field' => 'plusminus', 'label' => 'Тип операции', 'rules' => array('required','in_list[0,1]','numeric','max_length[255]')),
            array('field' => 'type', 'label' => 'Тип операции', 'rules' => array('required','numeric','in_list[0,1,2,3]','max_length[255]')),
            array('field' => 'summ', 'label' => 'Сумма операции', 'rules' => array('required','numeric','greater_than[0]','max_length[255]')),
            array('field' => 'type2', 'label' => 'Тип вознаграждения', 'rules' => array('required','in_list[0,1]','numeric','max_length[255]')),
            array('field' => 'amount1', 'label' => 'Сумма вознаграждения', 'rules' => array('numeric','max_length[255]')),
            array('field' => 'amount2', 'label' => 'Сумма вознаграждения', 'rules' => array('numeric','less_than_equal_to[100]','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['plugin'] = $this->input->post('action');
			$DATA['description'] = $this->input->post('description');
			$DATA['type'] = $this->input->post('type');
			$DATA['plus'] = ($this->input->post('plusminus') == 1) ? 1 : 0;
			$DATA['minus'] = ($this->input->post('plusminus') == 0) ? 1 : 0;
			$DATA['summ'] = $this->input->post('summ');
			$DATA['amount'] = ($this->input->post('type2') == 0) ? $this->billing->convert($this->input->post('amount1')) : $this->billing->convert(0);
			$DATA['percent'] = ($this->input->post('type2') == 1) ? intval($this->input->post('amount2')) : 0;
			
			
			$this->billing->CreateReferralsRules($DATA);
		$AN['response'] = 'success';
		$AN['reload'] = 'true';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}	
		
	
	
	
	function save_transfer_billing(){
		$this->system->accessError('Admin Billing Transfer');
        $validation_rules = array(
            array('field' => 'billing_module_transfer_active', 'label' => 'Включить', 'rules' => array('max_length[1]')),
            array('field' => 'billing_transfer_minimum', 'label' => 'Минимальная сумма для перевода', 'rules' => array('required','numeric','max_length[255]')),
            array('field' => 'billing_transfer_comission', 'label' => 'Комиссия сайта', 'rules' => array('required','numeric','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			$DATA['billing_module_transfer_active'] = ($this->input->post('billing_module_transfer_active')) ? 1 : 0;			
			$DATA['billing_transfer_minimum'] = ($this->input->post('billing_transfer_minimum') > 0) ? $this->billing->convert($this->input->post('billing_transfer_minimum')) : $this->billing->convert(0) ;			
			$DATA['billing_transfer_comission'] = ($this->input->post('billing_transfer_comission') > 100 OR $this->input->post('billing_transfer_comission') < 0) ? $this->billing->convert(0) : $this->billing->convert($this->input->post('billing_transfer_comission')) ;			

			foreach($DATA as $k=>$v){
				$this->CONFIG->set($k,$v);
			}
			
			
		$AN['response'] = 'success';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}
		
	
	
	
	function users_pay_users_billing(){
		$this->system->accessError('Admin Billing Users');
        $validation_rules = array(
            array('field' => 'logins', 'label' => 'Пользователи', 'rules' => array('required')),
            array('field' => 'action', 'label' => 'Действие', 'rules' => array('required','in_list[0,1]','max_length[1]')),
            array('field' => 'amount', 'label' => 'Сумма', 'rules' => array('required','greater_than_equal_to[0]','max_length[255]')),
            array('field' => 'comment', 'label' => 'Комментарий', 'rules' => array('max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){

			$action = $this->input->post('action');
			$amount = $this->input->post('amount');
			$comment = $this->input->post('comment');
			$logins = explode(',',$this->input->post('logins'));
			foreach($logins as $v){
				$user = ($this->users->GetUserByUsername($v)['id']) ? $this->users->GetUserByUsername($v) : false ;
				if($user){
					if($action == 0){
						$this->billing->Minus($amount,'admin',$user['id'],$comment);
					}else{
						$this->billing->Plus($amount,'admin',$user['id'],$comment);
					}
				}
			}
			
		$AN['response'] = 'success';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}
		
	
	
	
	function group_pay_users_billing(){
		$this->system->accessError('Admin Billing Users');
		$ins = array();
		foreach($this->users->GetUserGroups() as $k=>$v){
			$ins[] = $v['id'];
		}
        $validation_rules = array(
            array('field' => 'logins', 'label' => 'Группа', 'rules' => array('required','in_list['.implode(',',$ins).']')),
            array('field' => 'action', 'label' => 'Действие', 'rules' => array('required','in_list[0,1]','max_length[1]')),
            array('field' => 'amount', 'label' => 'Сумма', 'rules' => array('required','greater_than_equal_to[0]','max_length[255]')),
            array('field' => 'comment', 'label' => 'Комментарий', 'rules' => array('max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){

			$logins = $this->input->post('logins');
			$action = $this->input->post('action');
			$amount = $this->input->post('amount');
			$comment = $this->input->post('comment');
			$logins = $this->db->query("SELECT * FROM users WHERE user_group=? AND active=1",array($logins))->result_array();
			foreach($logins as $k=>$v){
				$user = $v;
					if($action == 0){
						$this->billing->Minus($amount,'admin',$user['id'],$comment);
					}else{
						$this->billing->Plus($amount,'admin',$user['id'],$comment);
					}
			}
			
		$AN['response'] = 'success';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}
	
	
	function save_templates_mail(){
		$this->system->accessError('Admin Mail Templates Edit');
        $validation_rules = array(
            array('field' => 'reg_mail_text', 'label' => 'none', 'rules' => array('required')),
            array('field' => 'reg_mail_html', 'label' => 'none', 'rules' => array('max_length[1]')),
			
            array('field' => 'feed_mail_text', 'label' => 'none', 'rules' => array('required')),
            array('field' => 'feed_mail_html', 'label' => 'none', 'rules' => array('max_length[1]')),
			
            array('field' => 'lost_mail_text', 'label' => 'none', 'rules' => array('required')),
            array('field' => 'lost_mail_html', 'label' => 'none', 'rules' => array('max_length[1]')),
			
            array('field' => 'new_pm_text', 'label' => 'none', 'rules' => array('required')),
            array('field' => 'new_pm_html', 'label' => 'none', 'rules' => array('max_length[1]')),
			
            array('field' => 'new_newsletter_text', 'label' => 'none', 'rules' => array('required')),
            array('field' => 'new_newsletter_html', 'label' => 'none', 'rules' => array('max_length[1]')),
			
            array('field' => 'billing_notif_mail_balancechangeadmin_text', 'label' => 'none', 'rules' => array('required')),
            array('field' => 'billing_plus_mail_type', 'label' => 'none', 'rules' => array('max_length[1]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){	
			$DATA['reg_mail_text'] = $this->input->post('reg_mail_text') ;		
			$DATA['reg_mail_html'] = ($this->input->post('reg_mail_html')) ? 'html' : 'text';	
			
			$DATA['feed_mail_text'] = $this->input->post('feed_mail_text') ;		
			$DATA['feed_mail_html'] = ($this->input->post('feed_mail_html')) ? 'html' : 'text';	
			
			$DATA['lost_mail_text'] = $this->input->post('lost_mail_text') ;		
			$DATA['lost_mail_html'] = ($this->input->post('lost_mail_html')) ? 'html' : 'text';	
			
			$DATA['new_pm_text'] = $this->input->post('new_pm_text') ;		
			$DATA['new_pm_html'] = ($this->input->post('new_pm_html')) ? 'html' : 'text';	
			
			$DATA['new_newsletter_text'] = $this->input->post('new_newsletter_text') ;		
			$DATA['new_newsletter_html'] = ($this->input->post('new_newsletter_html')) ? 'html' : 'text';	
			
			$DATA['billing_notif_mail_balancechangeadmin_text'] = $this->input->post('billing_notif_mail_balancechangeadmin_text') ;		
			$DATA['billing_plus_mail_type'] = ($this->input->post('billing_plus_mail_type')) ? 'html' : 'text';			

			foreach($DATA as $k=>$v){
				$this->CONFIG->set($k,$v);
			}
			
			
		$AN['response'] = 'success';
		}else{	
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}
		}
		return $AN;
	}
	
	
	function save_settings(){
		$this->system->accessError('Admin Settings');
		$langs = array();
		foreach($this->system->get_lang_list() as $k=>$v){
			$langs[] = $v['SYMBOL'];
		}		
		
        $validation_rules = array(
            array('field' => 'site_title', 'label' => 'Название сайта', 'rules' => array('required','max_length[255]')),
            array('field' => 'default_language', 'label' => 'Язык сайта', 'rules' => array('required','in_list['.implode(',',$langs).']','max_length[255]')),
			
            array('field' => 'sys_mail_send_mail', 'label' => 'Системный E-Mail', 'rules' => array('required','valid_email','max_length[255]')),
            array('field' => 'sys_mail_subject', 'label' => 'Заголовок отправителя', 'rules' => array('max_length[255]')),
            array('field' => 'sys_mail_metod', 'label' => 'Метод отправки', 'rules' => array('required','in_list[php,smtp]','max_length[255]')),
			
            array('field' => 'sys_mail_smtp_host', 'label' => 'SMTP хост', 'rules' => array('max_length[255]')),
            array('field' => 'sys_mail_smtp_port', 'label' => 'SMTP порт', 'rules' => array('is_natural_no_zero','max_length[255]')),
            array('field' => 'sys_mail_smtp_user', 'label' => 'SMTP Имя пользователя', 'rules' => array('max_length[255]')),
            array('field' => 'sys_mail_smtp_pass', 'label' => 'SMTP пароль', 'rules' => array('max_length[255]')),
            array('field' => 'sys_mail_smtp_secure', 'label' => 'Защищенный протокол', 'rules' => array('in_list[,ssl,tls]','max_length[255]')),
            array('field' => 'sys_mail_smtp_mail', 'label' => 'E-mail для авторизации на SMTP сервере', 'rules' => array('valid_email','max_length[255]')),
            array('field' => 'sys_mail_bcc', 'label' => 'Использовать поле BCC для рассылки', 'rules' => array('in_list[1]','max_length[255]')),
            array('field' => 'sys_reg_allow_sec_code', 'label' => 'Код безопасности', 'rules' => array('in_list[1]','max_length[255]')),
			
            array('field' => 'sys_messages_allow_files_upload', 'label' => 'Разрешить загрузку файлов в сообщениях', 'rules' => array('in_list[1]','max_length[255]')),
            array('field' => 'messages_allow_files_upload', 'label' => 'Расширения файлов, разрешенных в сообщениях'),
            array('field' => 'messages_files_upload_max_size', 'label' => 'Максимальный размер файла допустимый к загрузке в сообщениях (в килобайтах):', 'rules' => array('is_natural','max_length[255]')),
			
            array('field' => 'avatar_allow_files_upload', 'label' => 'Расширения файлов, разрешенных для аватара'),
            array('field' => 'system_image_max_up_size', 'label' => 'Максимальный размер файла допустимый к загрузке для аватара:', 'rules' => array('is_natural','max_length[255]')),
            array('field' => 'sys_reg_group', 'label' => 'Группа регистрации', 'rules' => array('is_natural_no_zero','max_length[255]')),
            array('field' => 'registration_type', 'label' => 'Метод регистрации', 'rules' => array('is_natural','in_list[0,1]','max_length[255]')),
        );
		$this->form_validation->set_rules($validation_rules);
		if ($this->form_validation->run()){
			
			$DATA['site_title'] = $this->input->post('site_title');
			$DATA['default_language'] = $this->input->post('default_language');
			$DATA['sys_mail_send_mail'] = $this->input->post('sys_mail_send_mail');
			$DATA['sys_mail_subject'] = $this->input->post('sys_mail_subject');
			$DATA['sys_mail_metod'] = $this->input->post('sys_mail_metod');
			$DATA['sys_mail_smtp_host'] = $this->input->post('sys_mail_smtp_host');
			$DATA['sys_mail_smtp_port'] = $this->input->post('sys_mail_smtp_port');
			$DATA['sys_mail_smtp_user'] = $this->input->post('sys_mail_smtp_user');
			$DATA['sys_mail_smtp_pass'] = $this->input->post('sys_mail_smtp_pass');
			$DATA['sys_mail_smtp_secure'] = $this->input->post('sys_mail_smtp_secure');
			$DATA['sys_mail_smtp_mail'] = $this->input->post('sys_mail_smtp_mail');
			$DATA['sys_mail_bcc'] = ($this->input->post('sys_mail_bcc')) ? 1 : 0;
			$DATA['sys_reg_allow_sec_code'] = ($this->input->post('sys_reg_allow_sec_code')) ? 1 : 0;
			$DATA['sys_messages_allow_files_upload'] = ($this->input->post('sys_messages_allow_files_upload')) ? 1 : 0;
			$DATA['messages_allow_files_upload'] = $this->input->post('messages_allow_files_upload');
			$DATA['messages_files_upload_max_size'] = $this->input->post('messages_files_upload_max_size');
			$DATA['avatar_allow_files_upload'] = $this->input->post('avatar_allow_files_upload');
			$DATA['system_image_max_up_size'] = $this->input->post('system_image_max_up_size');
			$DATA['registration_type'] = $this->input->post('registration_type');
			$DATA['recaptcha_public_key'] = $this->input->post('recaptcha_public_key');
			$DATA['recaptcha_private_key'] = $this->input->post('recaptcha_private_key');
			foreach($DATA as $k=>$v){
				$this->CONFIG->set($k,$v);
			}			
			
			$AN['response'] = 'success';
			$AN['reload'] = 'true';
		}else{
			$AN['response'] = 'error';
			foreach($validation_rules as $k=>$v){
				if(form_error($v['field'])){
					$AN['errors'][$v['field']] = form_error($v['field']);
				}
			}			
		}	
		return $AN;
	}
	
	
	
	function send_mails($offset,$limit){
		$this->system->accessError('Admin Mail Send');
			$validation_rules = array(
				array('field' => 'type', 'label' => 'Тип сообщения', 'rules' => array('required','in_list[0,1]','max_length[255]')),
				array('field' => 'user_groups[]', 'label' => 'Группы', 'rules' => array('required','max_length[255]')),
				array('field' => 'start_reg', 'label' => 'Дата регистрации', 'rules' => array('max_length[255]')),
				array('field' => 'end_reg', 'label' => 'Дата регистрации', 'rules' => array('max_length[255]')),
				array('field' => 'start_online', 'label' => 'Дата последнего посещения', 'rules' => array('max_length[255]')),
				array('field' => 'end_online', 'label' => 'Дата последнего посещения', 'rules' => array('max_length[255]')),
				array('field' => 'title', 'label' => 'Заголовок', 'rules' => array('required','max_length[255]')),
				array('field' => 'message', 'label' => 'Сообщение', 'rules' => array('required')),
			);
			$this->form_validation->set_rules($validation_rules);
			if ($this->form_validation->run()){
				$type = $this->input->post('type');
				$user_groups = $this->input->post('user_groups');
				$start_reg = $this->input->post('start_reg');
				$end_reg = $this->input->post('end_reg');
				$start_online = $this->input->post('start_online');
				$end_online = $this->input->post('end_online');
				$message = $this->input->post('message');
				$title = $this->input->post('title');
				$WHERE = array();
				
				if(!in_array(0,$user_groups)){
					foreach($user_groups as $k=>$v){
						$group[] = 'user_group='.$v;
					}
					$WHERE[] = '('.implode(' OR ',$group).')';
				}
				
				if($start_reg){
					$start_reg = strtotime($start_reg.' 00:00:01');
					$WHERE[] = 'created_at>'.$start_reg;
				}
				
				if($end_reg){
					$end_reg = strtotime($end_reg.' 23:59:59');
					$WHERE[] = 'created_at<'.$end_reg;
				}
				
				if($start_online){
					$start_online = strtotime($start_online.' 00:00:01');
					$WHERE[] = 'last_online>'.$start_online;
				}
				
				if($end_online){
					$end_online = strtotime($end_online.' 23:59:59');
					$WHERE[] = 'last_online<'.$end_online;
				}
				
				$WHERE = (count($WHERE) > 0) ? implode(' AND ',$WHERE) : 1;
				
				$COUNT = $this->db->query("SELECT COUNT(*) as count FROM users WHERE {$WHERE}")->row_array();
				
				
				$USERS = $this->db->query("SELECT * FROM users WHERE {$WHERE} LIMIT {$offset},{$limit}")->result_array();
				
				
 
				
					if($type == 0){
						//EMAIL
						if($this->CONFIG->get('sys_mail_bcc') == 1){
							$mails = array();
							foreach($USERS as $k=>$v){
								$mails[] = $v['email'];
							}
							if(count($mails) > 1){
								$to = $mails[0];
								unset($mails[0]);
								$bcc = $mails;
							}else if(count($mails) > 0){
								$to = $mails[0];
								$bcc = false;
							}
							if(count($mails) > 0){
								$message = str_replace('{%user%}','Пользователь',$message);
								$this->mail->send($to,$message,array('mailtype'=>'html','subject'=>$title,'bcc'=>$bcc));
							}
						}else{
							foreach($USERS as $k=>$v){
								$message = str_replace('{%user%}',$v['username'],$message);
								$this->mail->send($v['email'],$message,array('mailtype'=>'html','subject'=>$title,));
							}
						}
					}else{
						//ПС
						foreach($USERS as $k=>$v){
								if($v['id'] != $_SESSION['id']){
									$ATA = array(
										null,
										$_SESSION['id'],
										$v['id'],
										strip_tags($message),
										time(),
										$this->input->ip_address()
										
									);
									$this->db->query("INSERT INTO `chat`(`id`, `sender_id`, `receiver_id`, `message`,`message_date_time`, `ip_address`) VALUES (?,?,?,?,?,?)",$ATA);
								}
						}
					}				
				
				$AN['response'] = 'success';
			}else{

				show_404();
			}
		return $AN;
	}
	
	function rules_save(){
		$this->system->accessError('Admin Rules Edit');
			$validation_rules = array(
				array('field' => 'rules', 'label' => 'Правила сайта', 'rules' => array('required')),
			);
			$this->form_validation->set_rules($validation_rules);
			if ($this->form_validation->run()){
				$rules = $this->input->post('rules');
				$this->CONFIG->set('rules',$rules);
				
				$AN['response'] = 'success';
			}else{
				$AN['response'] = 'error';
				foreach($validation_rules as $k=>$v){
					if(form_error($v['field'])){
						$AN['errors'][$v['field']] = form_error($v['field']);
					}
				}	
			}
			return $AN;
	}
	
}












