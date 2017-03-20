<?php
class ControllerModulebuyinoneclick extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/buyinoneclick');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('buyinoneclick_', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['field1_title'] = $this->language->get('field1_title');
		$data['field2_title'] = $this->language->get('field2_title');
		$data['field3_title'] = $this->language->get('field3_title');
		$data['field4_title'] = $this->language->get('field4_title');
		$data['field_required'] = $this->language->get('field_required');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_preorder_name'] = $this->language->get('entry_preorder_name');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_status_category'] = $this->language->get('entry_status_category');
		$data['entry_style_status'] = $this->language->get('entry_style_status');
		$data['entry_additional_field'] = $this->language->get('entry_additional_field');
		$data['additional_field_required'] = $this->language->get('additional_field_required');
		$data['additional_field_tooltip'] = $this->language->get('additional_field_tooltip');

		$data['entry_validation_type'] = $this->language->get('entry_validation_type');
		$data['value_validation_type1'] = $this->language->get('value_validation_type1');
		$data['value_validation_type2'] = $this->language->get('value_validation_type2');
		$data['text_validation_type1'] = $this->language->get('text_validation_type1');
		$data['text_validation_type2'] = $this->language->get('text_validation_type2');
		$data['entry_validation_status'] = $this->language->get('entry_validation_status');

		$data['ya_form_title'] = $this->language->get('ya_form_title');
		$data['ya_counter_title'] = $this->language->get('ya_counter_title');
		$data['ya_identificator_title'] = $this->language->get('ya_identificator_title');
		$data['yandex_target_status_title'] = $this->language->get('yandex_target_status_title');

		$data['sms_title'] = $this->language->get('sms_title');

		$data['turbosms_form_title'] = $this->language->get('turbosms_form_title');
		$data['turbosms_login_title'] = $this->language->get('turbosms_login_title');
		$data['turbosms_password_title'] = $this->language->get('turbosms_password_title');
		$data['turbosms_number_title'] = $this->language->get('turbosms_number_title');
		$data['turbosms_number_tooltip'] = $this->language->get('turbosms_number_tooltip');
		$data['turbosms_name_title'] = $this->language->get('turbosms_name_title');
		$data['turbosms_name_tooltip'] = $this->language->get('turbosms_name_tooltip');
		$data['turbosms_admin_sms_title'] = $this->language->get('turbosms_admin_sms_title');
		$data['turbosms_admin_sms_tooltip'] = $this->language->get('turbosms_admin_sms_tooltip');		
		$data['turbosms_client_sms_title'] = $this->language->get('turbosms_client_sms_title');
		$data['turbosms_client_sms_tooltip'] = $this->language->get('turbosms_client_sms_tooltip');			
		$data['turbosms_client_status_title'] = $this->language->get('turbosms_client_status_title');
		$data['turbosms_client_status_tooltip'] = $this->language->get('turbosms_client_status_tooltip');
		$data['turbosms_status_title'] = $this->language->get('turbosms_status_title');

		$data['smsru_form_title'] = $this->language->get('smsru_form_title');
		$data['smsru_api_title'] = $this->language->get('smsru_api_title');
		$data['smsru_api_tooltip'] = $this->language->get('smsru_api_tooltip');
		$data['smsru_login_title'] = $this->language->get('smsru_login_title');
		$data['smsru_password_title'] = $this->language->get('smsru_password_title');
		$data['smsru_number_title'] = $this->language->get('smsru_number_title');
		$data['smsru_number_tooltip'] = $this->language->get('smsru_number_tooltip');
		$data['smsru_name_title'] = $this->language->get('smsru_name_title');
		$data['smsru_name_tooltip'] = $this->language->get('smsru_name_tooltip');
		$data['smsru_admin_sms_title'] = $this->language->get('smsru_admin_sms_title');
		$data['smsru_admin_sms_tooltip'] = $this->language->get('smsru_admin_sms_tooltip');		
		$data['smsru_client_sms_title'] = $this->language->get('smsru_client_sms_title');
		$data['smsru_client_sms_tooltip'] = $this->language->get('smsru_client_sms_tooltip');			
		$data['smsru_client_status_title'] = $this->language->get('smsru_client_status_title');
		$data['smsru_client_status_tooltip'] = $this->language->get('smsru_client_status_tooltip');
		$data['smsru_status_title'] = $this->language->get('smsru_status_title');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/buyinoneclick', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/buyinoneclick', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$languages = $this->model_localisation_language->getLanguages();

		foreach ($languages as $language) {
			if (isset($this->request->post['buyinoneclick_name_'.$language['language_id']])) {
				$data['buyinoneclick_name_'.$language['language_id']] = $this->request->post['buyinoneclick_name_'.$language['language_id']];
				$data['buyinoneclick_preorder_name_'.$language['language_id']] = $this->request->post['buyinoneclick_preorder_name_'.$language['language_id']];
				$data['buyinoneclick_additional_field_'.$language['language_id']] = $this->request->post['buyinoneclick_additional_field_'.$language['language_id']];
				$data['buyinoneclick_additional_field_required_'.$language['language_id']] = $this->request->post['buyinoneclick_additional_field_required_'.$language['language_id']];
			} else {
				$data['buyinoneclick_name_'.$language['language_id']] = $this->config->get('buyinoneclick_name_'.$language['language_id']);
				$data['buyinoneclick_preorder_name_'.$language['language_id']] = $this->config->get('buyinoneclick_preorder_name_'.$language['language_id']);
				$data['buyinoneclick_additional_field_'.$language['language_id']] = $this->config->get('buyinoneclick_additional_field_'.$language['language_id']);
				$data['buyinoneclick_additional_field_required_'.$language['language_id']] = $this->config->get('buyinoneclick_additional_field_required_'.$language['language_id']);
			}
		}

		if (isset($this->request->post['buyinoneclick_field1_status'])) {
			$data['buyinoneclick_field1_status'] = $this->request->post['buyinoneclick_field1_status'];
		} else {
			$data['buyinoneclick_field1_status'] = $this->config->get('buyinoneclick_field1_status');
		}

		if (isset($this->request->post['buyinoneclick_field1_required'])) {
			$data['buyinoneclick_field1_required'] = $this->request->post['buyinoneclick_field1_required'];
		} else {
			$data['buyinoneclick_field1_required'] = $this->config->get('buyinoneclick_field1_required');
		}

		if (isset($this->request->post['buyinoneclick_field2_status'])) {
			$data['buyinoneclick_field2_status'] = $this->request->post['buyinoneclick_field2_status'];
		} else {
			$data['buyinoneclick_field2_status'] = $this->config->get('buyinoneclick_field2_status');
		}

		if (isset($this->request->post['buyinoneclick_field2_required'])) {
			$data['buyinoneclick_field2_required'] = $this->request->post['buyinoneclick_field2_required'];
		} else {
			$data['buyinoneclick_field2_required'] = $this->config->get('buyinoneclick_field2_required');
		}

		if (isset($this->request->post['buyinoneclick_field3_status'])) {
			$data['buyinoneclick_field3_status'] = $this->request->post['buyinoneclick_field3_status'];
		} else {
			$data['buyinoneclick_field3_status'] = $this->config->get('buyinoneclick_field3_status');
		}

		if (isset($this->request->post['buyinoneclick_field3_required'])) {
			$data['buyinoneclick_field3_required'] = $this->request->post['buyinoneclick_field3_required'];
		} else {
			$data['buyinoneclick_field3_required'] = $this->config->get('buyinoneclick_field3_required');
		}

		if (isset($this->request->post['buyinoneclick_field4_status'])) {
			$data['buyinoneclick_field4_status'] = $this->request->post['buyinoneclick_field4_status'];
		} else {
			$data['buyinoneclick_field4_status'] = $this->config->get('buyinoneclick_field4_status');
		}

		if (isset($this->request->post['buyinoneclick_field4_required'])) {
			$data['buyinoneclick_field4_required'] = $this->request->post['buyinoneclick_field4_required'];
		} else {
			$data['buyinoneclick_field4_required'] = $this->config->get('buyinoneclick_field4_required');
		}


		if (isset($this->request->post['buyinoneclick_validation_type'])) {
			$data['buyinoneclick_validation_type'] = $this->request->post['buyinoneclick_validation_type'];
		} else {
			$data['buyinoneclick_validation_type'] = $this->config->get('buyinoneclick_validation_type');
		}
		if (isset($this->request->post['buyinoneclick_validation_status'])) {
			$data['buyinoneclick_validation_status'] = $this->request->post['buyinoneclick_validation_status'];
		} else {
			$data['buyinoneclick_validation_status'] = $this->config->get('buyinoneclick_validation_status');
		}

		/********************* STATUS *********************/

		if (isset($this->request->post['buyinoneclick_status'])) {
			$data['buyinoneclick_status'] = $this->request->post['buyinoneclick_status'];
		} else {
			$data['buyinoneclick_status'] = $this->config->get('buyinoneclick_status');
		}

		if (isset($this->request->post['buyinoneclick_status_category'])) {
			$data['buyinoneclick_status_category'] = $this->request->post['buyinoneclick_status_category'];
		} else {
			$data['buyinoneclick_status_category'] = $this->config->get('buyinoneclick_status_category');
		}

		if (isset($this->request->post['buyinoneclick_style_status'])) {
			$data['buyinoneclick_style_status'] = $this->request->post['buyinoneclick_style_status'];
		} else {
			$data['buyinoneclick_style_status'] = $this->config->get('buyinoneclick_style_status');
		}

		/********************* Yandex.ru *********************/

		if (isset($this->request->post['buyinoneclick_ya_counter'])) {
			$data['buyinoneclick_ya_counter'] = $this->request->post['buyinoneclick_ya_counter'];
		} else {
			$data['buyinoneclick_ya_counter'] = $this->config->get('buyinoneclick_ya_counter');
		}

		if (isset($this->request->post['buyinoneclick_ya_identificator'])) {
			$data['buyinoneclick_ya_identificator'] = $this->request->post['buyinoneclick_ya_identificator'];
		} else {
			$data['buyinoneclick_ya_identificator'] = $this->config->get('buyinoneclick_ya_identificator');
		}

		if (isset($this->request->post['buyinoneclick_yandex_status'])) {
			$data['buyinoneclick_yandex_status'] = $this->request->post['buyinoneclick_yandex_status'];
		} else {
			$data['buyinoneclick_yandex_status'] = $this->config->get('buyinoneclick_yandex_status');
		}

		/********************* TusrboSMS.ua *********************/

		if (isset($this->request->post['buyinoneclick_turbosms_login'])) {
			$data['buyinoneclick_turbosms_login'] = $this->request->post['buyinoneclick_turbosms_login'];
		} else {
			$data['buyinoneclick_turbosms_login'] = $this->config->get('buyinoneclick_turbosms_login');
		}

		if (isset($this->request->post['buyinoneclick_turbosms_password'])) {
			$data['buyinoneclick_turbosms_password'] = $this->request->post['buyinoneclick_turbosms_password'];
		} else {
			$data['buyinoneclick_turbosms_password'] = $this->config->get('buyinoneclick_turbosms_password');
		}

		if (isset($this->request->post['buyinoneclick_turbosms_number'])) {
			$data['buyinoneclick_turbosms_number'] = $this->request->post['buyinoneclick_turbosms_number'];
		} else {
			$data['buyinoneclick_turbosms_number'] = $this->config->get('buyinoneclick_turbosms_number');
		}

		if (isset($this->request->post['buyinoneclick_turbosms_name'])) {
			$data['buyinoneclick_turbosms_name'] = $this->request->post['buyinoneclick_turbosms_name'];
		} elseif ($this->config->get('buyinoneclick_turbosms_name') != '') {
			$data['buyinoneclick_turbosms_name'] = $this->config->get('buyinoneclick_turbosms_name');
		} else {
			$data['buyinoneclick_turbosms_name'] = 'Msg';
		}
		
		if (isset($this->request->post['buyinoneclick_turbosms_admin_sms'])) {
			$data['buyinoneclick_turbosms_admin_sms'] = $this->request->post['buyinoneclick_turbosms_admin_sms'];
		} else {
			$data['buyinoneclick_turbosms_admin_sms'] = $this->config->get('buyinoneclick_turbosms_admin_sms');
		}	

		if (isset($this->request->post['buyinoneclick_turbosms_client_sms'])) {
			$data['buyinoneclick_turbosms_client_sms'] = $this->request->post['buyinoneclick_turbosms_client_sms'];
		} else {
			$data['buyinoneclick_turbosms_client_sms'] = $this->config->get('buyinoneclick_turbosms_client_sms');
		}		

		if (isset($this->request->post['buyinoneclick_turbosms_client_status'])) {
			$data['buyinoneclick_turbosms_client_status'] = $this->request->post['buyinoneclick_turbosms_client_status'];
		} else {
			$data['buyinoneclick_turbosms_client_status'] = $this->config->get('buyinoneclick_turbosms_client_status');
		}

		if (isset($this->request->post['buyinoneclick_turbosms_status'])) {
			$data['buyinoneclick_turbosms_status'] = $this->request->post['buyinoneclick_turbosms_status'];
		} else {
			$data['buyinoneclick_turbosms_status'] = $this->config->get('buyinoneclick_turbosms_status');
		}

		/********************* SMS.ru *********************/

		if (isset($this->request->post['buyinoneclick_smsru_api'])) {
			$data['buyinoneclick_smsru_api'] = $this->request->post['buyinoneclick_smsru_api'];
		} else {
			$data['buyinoneclick_smsru_api'] = $this->config->get('buyinoneclick_smsru_api');
		}

		if (isset($this->request->post['buyinoneclick_smsru_login'])) {
			$data['buyinoneclick_smsru_login'] = $this->request->post['buyinoneclick_smsru_login'];
		} else {
			$data['buyinoneclick_smsru_login'] = $this->config->get('buyinoneclick_smsru_login');
		}

		if (isset($this->request->post['buyinoneclick_smsru_password'])) {
			$data['buyinoneclick_smsru_password'] = $this->request->post['buyinoneclick_smsru_password'];
		} else {
			$data['buyinoneclick_smsru_password'] = $this->config->get('buyinoneclick_smsru_password');
		}

		if (isset($this->request->post['buyinoneclick_smsru_number'])) {
			$data['buyinoneclick_smsru_number'] = $this->request->post['buyinoneclick_smsru_number'];
		} else {
			$data['buyinoneclick_smsru_number'] = $this->config->get('buyinoneclick_smsru_number');
		}

		if (isset($this->request->post['buyinoneclick_smsru_name'])) {
			$data['buyinoneclick_smsru_name'] = $this->request->post['buyinoneclick_smsru_name'];
		} else {
			$data['buyinoneclick_smsru_name'] = $this->config->get('buyinoneclick_smsru_name');
		}
		
		if (isset($this->request->post['buyinoneclick_smsru_admin_sms'])) {
			$data['buyinoneclick_smsru_admin_sms'] = $this->request->post['buyinoneclick_smsru_admin_sms'];
		} else {
			$data['buyinoneclick_smsru_admin_sms'] = $this->config->get('buyinoneclick_smsru_admin_sms');
		}	

		if (isset($this->request->post['buyinoneclick_smsru_client_sms'])) {
			$data['buyinoneclick_smsru_client_sms'] = $this->request->post['buyinoneclick_smsru_client_sms'];
		} else {
			$data['buyinoneclick_smsru_client_sms'] = $this->config->get('buyinoneclick_smsru_client_sms');
		}		

		if (isset($this->request->post['buyinoneclick_smsru_client_status'])) {
			$data['buyinoneclick_smsru_client_status'] = $this->request->post['buyinoneclick_smsru_client_status'];
		} else {
			$data['buyinoneclick_smsru_client_status'] = $this->config->get('buyinoneclick_smsru_client_status');
		}

		if (isset($this->request->post['buyinoneclick_smsru_status'])) {
			$data['buyinoneclick_smsru_status'] = $this->request->post['buyinoneclick_smsru_status'];
		} else {
			$data['buyinoneclick_smsru_status'] = $this->config->get('buyinoneclick_smsru_status');
		}



		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/buyinoneclick.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/buyinoneclick')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}