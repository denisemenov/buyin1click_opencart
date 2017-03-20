<?php
// Heading
$_['heading_title']                  = 'Buy in One Click by <a href="https://opencartforum.com/index.php?app=core&module=search&do=user_activity&search_app=downloads&mid=11962">Wadamir</a>';

// Text
$_['text_module']                    = 'Модули';
$_['text_success']                   = 'Настройки успешно изменены!';
$_['text_edit']                      = 'Настройки модуля';

// Fields
$_['field1_title']                   = 'Имя';
$_['field2_title']                   = 'Телефон';
$_['field3_title']                   = 'E-mail';
$_['field4_title']                   = 'Комментарий';
$_['field_required']                 = 'Обязательное поле';

// Phone validation
$_['entry_validation_type']          = 'Маска проверки номера телефона';
$_['value_validation_type1']         = '+7 (000) 000-00-00';
$_['value_validation_type2']         = '+38 (000) 000-00-00';
$_['text_validation_type1']          = 'Россия: +7 (000) 000-00-00';
$_['text_validation_type2']          = 'Украина: +38 (000) 000-00-00';
$_['entry_validation_status']        = 'Включить проверку номера';

// SMS Settings
$_['sms_title']                      = 'Настройки SMS';

// SMS.ru
$_['smsru_form_title']               = 'Настройка <strong>SMS.ru</strong>';
$_['smsru_api_title']                = 'Ваш api_id';
$_['smsru_api_tooltip']              = 'По умолчанию для отправки SMS используется Ваш api_id (вид: XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX), который Вы можете найти у себя в личном кабинете SMS.ru. В этом случае заполнять поля логин и пароль не требуется. Если Вы хотите использовать авторизацию через логин и пароль, то не заполняйте данное поле. В этом случае будут использованы поля логин и пароль.';
$_['smsru_login_title']              = 'Ваш логин на SMS.ru';
$_['smsru_password_title']           = 'Ваш пароль на SMS.ru';
$_['smsru_number_title']             = 'Номер администратора';
$_['smsru_number_tooltip']           = 'Обязательно используйте международный формат: +79876543210. Сообщения на собственный номер бесплатны до 5 SMS в день при условии, что каждое сообщение помещается в 1 SMS (до 70 русских / 160 латинских символов) и <strong>совпадает с собственным номером, указанным в личном кабинете SMS.ru</strong>! При превышении этих лимитов, сообщения оплачиваются согласно тарифу. Для отправки сообщений администраторам на несколько номеров необходимо указать их разделяя запятой. Если вы указываете несколько номеров и один из них указан неверно, то на остальные номера сообщения также не отправляются.';
$_['smsru_name_title']               = 'Подпись отправителя';
$_['smsru_name_tooltip']             = 'По умолчанию: Ваш номер телефона. Для использования буквенного отправителя (например, название вашего магазина) необходимо быть юридическим лицом или ИП и иметь договор с с администрацией sms.ru и согласовать отправителя с операторами связи. Подробнее читайте в разделе "Отправители" Вашего личного кабинета SMS.ru. Согласование бесплатное. Абонентской платы за пользование отправителем нет.';
$_['smsru_admin_sms_title']          = 'Шаблон сообщения администратору';
$_['smsru_admin_sms_tooltip']        = 'По умолчанию: "Заказ: {product}. Покупатель: {name}, {phone}, {email}". <br /><strong>Если не знаете, что вписать - оставьте поле пустым!</strong> Подробнее о шаблонах Вы можете прочитать здесь: <a href="http://ocshop.xdomus.ru/buy_one_click.htm" target="_blank">FAQ по модулю</a>.';
$_['smsru_client_sms_title']         = 'Шаблон сообщения покупателю';
$_['smsru_client_sms_tooltip']       = 'По умолчанию: "Спасибо за Ваш заказ на {product} в интернет-магазине {shop_name}! Мы свяжемся с Вами для подтверждения заказа!" <br /><strong>Если не знаете, что вписать, то оставьте поле пустым!</strong> Подробнее о шаблонах Вы можете прочитать здесь: <a href="http://ocshop.xdomus.ru/buy_one_click.htm" target="_blank">FAQ по модулю</a>.';
$_['smsru_client_status_title']      = 'Включить отправку SMS покупателю';
$_['smsru_client_status_tooltip']    = 'Обязательно включите проверку номера телефона!';
$_['smsru_status_title']             = '<strong>Включить отправку сообщений через SMS.ru</strong>';

// TurboSMS.ua
$_['turbosms_form_title']            = 'Настройка <strong>TurboSMS.ua</strong>';
$_['turbosms_login_title']           = 'Логин шлюза';
$_['turbosms_password_title']        = 'Пароль шлюза';
$_['turbosms_number_title']          = 'Номер получателя SMS';
$_['turbosms_number_tooltip']        = 'Обязательно используйте международный формат: +79876543210';
$_['turbosms_name_title']            = 'Подпись отправителя';
$_['turbosms_name_tooltip']          = 'По умолчанию: Msg. Если Вы хотите установить своё имя в имени отправителя - изучите документацию, а именно раздел "Подписи". Видеоинструкция - <a href="https://youtu.be/RpC4aLpLHZM" target="_blank">YouTube</a>.';
$_['turbosms_admin_sms_title']       = 'Шаблон сообщения администратору';
$_['turbosms_admin_sms_tooltip']     = 'По умолчанию: "Заказ: {product}. Покупатель: {name}, {phone}, {email}."<br /><strong>Если не знаете, что вписать - оставьте поле пустым!</strong> Подробнее о шаблонах Вы можете прочитать здесь: <a href="http://ocshop.xdomus.ru/buy_one_click.htm" target="_blank">FAQ по модулю</a>.';
$_['turbosms_client_sms_title']      = 'Шаблон сообщения покупателю';
$_['turbosms_client_sms_tooltip']    = 'По умолчанию: "Спасибо за Ваш заказ на {product} в интернет-магазине {shop_name}! Мы свяжемся с Вами для подтверждения заказа!" <br /><strong>Если не знаете, что вписать - оставьте поле пустым!</strong> Подробнее о шаблонах Вы можете прочитать здесь: <a href="http://ocshop.xdomus.ru/buy_one_click.htm" target="_blank">FAQ по модулю</a>';
$_['turbosms_client_status_title']   = 'Включить отправку SMS покупателю';
$_['turbosms_client_status_tooltip'] = 'Обязательно включите проверку номера телефона!';
$_['turbosms_status_title']          = '<strong>Включить отправку сообщений через TurboSMS</strong>';

// Yandex
$_['ya_form_title']                  = 'Настройка цели в <strong><span style="color:red;">Я</span>ндекс.Метрике</strong> ';
$_['ya_counter_title']               = 'Номер Вашего счётчика Яндекс.Метрики';
$_['ya_identificator_title']         = 'Идентификатор Вашей цели в Яндекс.Метрике';
$_['yandex_target_status_title']     = 'Включить цель в Яндекс.Метрике';

// Entry
$_['entry_name']                     = 'Название кнопки "Купить" (при наличии товара в магазине)';
$_['entry_preorder_name']            = 'Название кнопки "Заказать" (при отсутствии товара в магазине)';
$_['entry_status']                   = '"Купить в 1 клик" в карточке товара';
$_['entry_status_category']          = '"Купить в 1 клик" в категории';
$_['entry_style_status']             = 'Использовать стили buyinoneclick.css (Blue Edition)';
$_['entry_additional_field']         = 'Текст в дополнительном поле';
$_['additional_field_required']      = 'Включено';
$_['additional_field_tooltip']       = 'Допустимо использовать html-теги';

// Error
$_['error_permission']               = 'У Вас нет прав для управления данным модулем!';
$_['error_name']                     = 'Название модуля должно содержать от 3 до 64 символов!';