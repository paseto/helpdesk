<?php
// PHPLOCKITOPT NOENCODE
// PHPLOCKITOPT NOOBFUSCATE
// PHPLOCKITOPT NOSTRIPCOMMENTS
// PHPLOCKITOPT NOSTRIPWHITESPACE

// USER PAGES

// text on user navigation
$lang['u-nav-kb'] = 'БАЗА ЗНАНИЙ';
$lang['u-nav-s-request'] = 'ПОДАТЬ ЗАЯВКУ';
$lang['u-nav-t-request'] = 'ОТСЛЕДИТЬ ЗАЯВКУ';

// text on kb
$lang['u-kb-search'] = 'Поиск';
$lang['u-kb-search-na'] = '! Результатов нет';
$lang['u-kb-kb'] = 'База Знаний';
$lang['u-kb-more'] = 'ещё';
$lang['u-kb-top-articles'] = 'ТОП';
$lang['u-kb-late-articles'] = 'ПОСЛЕДНИЕ';

// text on kb article and search and group
$lang['u-kba-dateadd'] = 'по Дате';
$lang['u-kba-views'] = 'Просмотры';
$lang['u-kba-rating'] = 'Рейтинг';
$lang['u-kba-group'] = 'Группы';

// text on user track ticket page
$lang['u-ticket-track-title'] = 'Отследить заявку';
$lang['u-ticket-track-t-em'] = 'Email';
$lang['u-ticket-track-t-no'] = '№ заявки';
$lang['u-ticket-track-submit'] = 'Отследить';
$lang['u-ticket-track-error-req'] = '! Требуется адрес электронной почты и номер для отслеживания';
$lang['u-ticket-track-error-inv-em'] = '! Неверный адрес электронной почты';
$lang['u-ticket-track-error-inv-no'] = '! Неверный номер отслеживания. Отслеживаемый номер должен быть числовым';
$lang['u-ticket-track-error-not-found'] = '! Этот адрес электронной почты и номер заявки не были найдены';

// text on ticket form and ticket success admin and user
$lang['ticket-add-title'] = 'Подать Заявку';
$lang['ticket-add-name'] = 'Имя';
$lang['ticket-add-email'] = 'Email';
$lang['ticket-add-group'] = 'Группа';
$lang['ticket-add-priority'] = 'Важность';
$lang['ticket-add-subject'] = 'Тема';
$lang['ticket-add-msg'] = 'Сообщение';
$lang['ticket-add-files-add'] = 'Прикрепить файл';
$lang['ticket-add-files-ano'] = 'Прикрепить ещё';
$lang['ticket-add-sec-code'] = 'Проверочный код';
$lang['ticket-add-sec-code-ent'] = 'Укажите код';
$lang['ticket-add-submit'] = 'Отправить заявку';
$lang['ticket-add-success-new'] = 'Номер заявки';
$lang['ticket-add-success-breif'] = 'Проверьте электронную почту';

// ADMINS PAGES
$lang['generic-404'] = '<p class="e404">Простите...</p><p class="e404">Страница, которую вы ищете, не может быть найдена</p>';
$lang['generic-save'] = 'Сохранить';
$lang['generic-change'] = 'Изменить';
$lang["generic-yes"] = "Да";
$lang["generic-no"] = "Нет";
$lang["generic-edit"] = "Изменить";
$lang["generic-delete"] = "Удалить";
$lang['generic-enable'] = 'Вкл.';
$lang['generic-disable'] = 'Выкл.';
$lang["generic-mark"] = "По умолчанию";
$lang["generic-unassigned"] = "Не определен";
$lang["generic-error"] = "! Обязательное поле";
$lang['generic-error-invalid-em'] = '! Неверный адрес электронной почты';
$lang['generic-error-un-exists'] = '! Имя пользователя уже используется';
$lang['generic-error-pw-length'] = '! Пароль должен содержать 6 символов или больше';
$lang['generic-error-invalid-code'] = '! Неверный код';
$lang['generic-delete-warn'] = '! Не может быть удалена, пока все заявки не будут распределены';
$lang['generic-delete-warn-article'] = '! Не может быть удалена';
$lang['generic-file-size-exc'] = '! Размер файла превышает допустимый предел';
$lang['generic-success-u-add'] = 'Пользователь успешно добавлен';
$lang['generic-success-u-edit'] = 'Редактирование пользователя успешно';

// text on admin index page
$lang['index-login'] = 'Вход в консоль';
$lang['index-username'] = 'Имя';
$lang['index-password'] = 'Пароль';
$lang['index-langauge'] = 'Интерфейс';
$lang['index-forgotpwd'] = 'Забыли пароль?';
$lang['index-error'] = '! Имя пользователя или пароль не верны';

// text on admin password reset page
$lang['pwreset-title'] = 'Сброс пароля';
$lang['pwreset-unknown-u'] = '! Имя не найдено';
$lang['pwreset-email-succ'] = '! Отлично. <p>Письмо с новым паролем было отправлено на ваш адрес электронной почты</p>';
$lang['pwreset-email-fail'] = 'Не удалось отправить новый пароль';

// text on header page
$lang['header-menu'] = 'СТАРТ';
$lang['header-search'] = 'Поиск по ID, Названию, Теме, и т.д.';

// text on dashboard page
$lang['dash-title-tickets'] = 'Обзор';
$lang['dash-title-activity'] = 'Последняя активность';
$lang['dash-load-more'] = 'ещё';
$lang['dash-avg-time'] = 'Средний Ответ';
$lang['dash-activity-new'] = 'отправил(а) новую заявку';
$lang['dash-activity-change'] = 'изменил(а) заявку';
$lang['dash-activity-note'] = 'добавил(а) коментарий к заявке';
$lang['dash-activity-closed'] = 'решил(а) заявку';
$lang['dash-activity-reply'] = 'отправил(а) ответ по заявке';
$lang['dash-activity-rating'] = 'оценил(а) заявку';
$lang['dash-activity-user-replied'] = 'ответил(а) на заявку';
$lang['dash-activity-you'] = 'Вы';
$lang['dash-activity-have'] = '';
$lang['dash-activity-has'] = '';

// text on admin tickets page
$lang['tickets-filter'] = 'Фильтр';
$lang['tickets-refresh'] = 'Обновить';
$lang['tickets-ID'] = 'ID';
$lang['tickets-agents'] = 'Агенты';
$lang['tickets-subject'] = 'Тема';
$lang['tickets-dateadd'] = 'Дата создания';
$lang['tickets-dateadd-anytime'] = 'Любое время';
$lang['tickets-dateadd-today'] = 'Сегодня';
$lang['tickets-dateadd-yesterday'] = 'Вчера';
$lang['tickets-dateadd-thisweek'] = 'Текущая неделя';
$lang['tickets-dateadd-lastweek'] = 'За последнюю неделю';
$lang['tickets-dateadd-thismonth'] = 'Текущий месяц';
$lang['tickets-dateadd-lastmonth'] = 'За последний месяц';
$lang['tickets-dateup'] = 'Дата обновления';
$lang['tickets-group'] = 'Группа';
$lang['tickets-group-desc'] = 'Выберите группу для просмотра';
$lang['tickets-status'] = 'Статус';
$lang['tickets-status-accept'] = 'Принята';
$lang['tickets-status-open'] = 'Открыта';
$lang['tickets-status-pending'] = 'В ожидании';
$lang['tickets-status-paused'] = 'Приостановлена';
$lang['tickets-status-closed'] = 'Решена';
$lang['tickets-status-delete'] = 'Удалена';
$lang['tickets-status-desc'] = 'Выберите статус для просмотра';
$lang['tickets-priority'] = 'Приоритет';
$lang['tickets-owner'] = 'Владелец';
$lang['tickets-sortby'] = 'Сортировать';
$lang['tickets-dir-asc'] = 'По возрастанию';
$lang['tickets-dir-dsc'] = 'По убыванию';
$lang['tickets-get-email'] = 'Получайть электронные сообщения';

// text on search
$lang['search-advanced'] = 'Детальный поиск';
$lang['search-subject'] = 'Тема';
$lang['search-msg'] = 'Сообщение';
$lang['search-cust'] = 'Заказчик';
$lang['search-any'] = 'Любой';
$lang['search-dateaddfrom'] = 'Дата добавления От';
$lang['search-dateaddto'] = 'Дата добавления До';
$lang['search-dateupfrom'] = 'Дата обновления От';
$lang['search-dateupto'] = 'Дата обновления До';
$lang['search-dateclosefrom'] = 'Дата Решения От';
$lang['search-datecloseto'] = 'Дата Решения До';
$lang['search-button-submit'] = 'Искать';
$lang['search-button-reset'] = 'Сбросить';
$lang['search-results'] = 'результаты поиска для';
$lang['search-no-results'] = 'Нет данных';
$lang['search-from'] = 'от';
$lang['search-added'] = 'Добавлена';
$lang['search-updated'] = 'Обновлена';
$lang['search-closed'] = 'Решена';

// text on reports
$lang['rep-filter'] = 'Пользовательский отчет';
$lang['rep-report'] = 'Показать';
$lang['rep-reset'] = 'Сбросить';
$lang['rep-period'] = 'Период отчета';
$lang['rep-period-from'] = 'Период с';
$lang['rep-period-to'] = 'Период до';
$lang['rep-graphic'] = 'Показать график';
$lang['rep-no-data'] = 'Нет данных по этим критериям';
$lang['rep-dd-ts'] = 'Заявки';
$lang['rep-dd-as'] = 'Сотрудники';
$lang['rep-dd-gs'] = 'Группы';
$lang['rep-dd-gl'] = 'Нагрузка на группы';
$lang['rep-dd-cs'] = 'Удовлетворение клиентов';
$lang['rep-dd-st'] = 'Тип источника';
$lang['rep-date-dd-cust'] = 'Пользовательский';
$lang['rep-download'] = 'Сохранить как CSV файл';
$lang['rep-total'] = 'Всего';
$lang['rep-feedback'] = 'Обратная связь';

// text on ticket page
$lang['ticket-details-title'] = 'Детали заявки';
$lang['ticket-dateintrep'] = 'Дата последнего ответа';
$lang['ticket-dateclosed'] = 'Дата решения';
$lang['ticket-customfields'] = 'Пользовательские поля';
$lang['ticket-fileuploads'] = 'Файлы';
$lang['ticket-status-closed'] = 'Заявка была решена, и больше не может быть обновлена​​.';
$lang['ticket-status-notskill'] = 'Вы не специалист в этом вопросе. Однако можете добавить примечание для исполнителя заявки.';
$lang['ticket-status-unassigned'] = 'Заявка в настоящее время не назначена. Для обновления примите заявку';
$lang['ticket-status-notowner'] = 'Заявка не назначается вами. Вы можете добавить примечание для нынешнего исполнителя или вы можете изменить исполнителя на себя, чтобы ответить заказчику.';
$lang['ticket-attachanother'] = 'Добавить ещё';
$lang['ticket-status-dd-note'] = 'Примечание';
$lang['ticket-status-dd-update'] = 'Обновить';
$lang['ticket-status-dd-pause'] = 'Приостановить';
$lang['ticket-status-dd-close'] = 'Решить';
$lang['ticket-show-detail'] = 'Детальнее'; // on user ticket page
$lang['ticket-rate'] = 'Рейтинг'; // on user ticket page
$lang['ticket-rate-p'] = 'Положительный';
$lang['ticket-rate-neu'] = 'Обычный';
$lang['ticket-rate-neg'] = 'Отрицательный';

// text on user profile page
$lang['profile-last-log'] = 'Последний визит';
$lang['profile-chg-pwd'] = 'Изменить пароль';
$lang['profile-cust-sat'] = 'Удовлетворенность клиентов';
$lang['profile-tickets-own'] = 'Заявки сотрудника';
$lang['profile-chg-pwd-desc'] = 'Введите новый пароль. Письмо будет отправлено подтверждающие ваш новый пароль.';
$lang['profile-chg-pwd-new'] = 'Новый пароль';
$lang['profile-chg-pwd-confirm'] = 'Подтвердите новый пароль';
$lang['profile-chg-pwd-succes'] = '! Хорошо. <p>Письмо с новым паролем было отправлено на ваш зарегистрированный адрес электронной почты</p>';
$lang['profile-chg-pwd-succes-mail-sub'] = 'Пароль изменен !';
$lang['profile-chg-pwd-succes-mail-body'] = 'Ваш новый пароль';
$lang['profile-chg-pwd-fail'] = 'Не удалось отправить новый пароль';

// text on knowledge base page
$lang['kb-title'] = 'База знаний';
$lang['kb-enabled'] = 'База знаний включена';
$lang['kb-disabled'] = 'База знаний в настоящее время отключена в Настройки > База знаний';
$lang['kb-db-aa-title'] = 'Добавить статью';
$lang['kb-db-ag-title'] = 'Добавить Группу';
$lang['kb-db-ag-title-desc'] = 'Добавить группу, чтобы помочь пользователям найти статьи.';
$lang["kb-db-eg"] = 'Существующие группы';
$lang['kb-db-article-title'] = 'Название';
$lang['kb-db-article-group'] = 'Группа';
$lang['kb-db-article-msg'] = 'Статья';

// text on menu
$lang['nav-dashboard'] = 'Обзор';
$lang['nav-tickets'] = 'Заявки';
$lang['nav-add'] = 'Добавить новую';
$lang['nav-search'] = 'Поиск';
$lang['nav-view'] = 'Просмотр';
$lang['nav-knowledge'] = 'База знаний';
$lang["nav-knowledge-articles"] = 'Добавить новую';
$lang["nav-knowledge-groups"] = 'Группы';
$lang['nav-reports'] = 'Отчеты';
$lang['nav-set'] = 'Настройки';
$lang['nav-set-general'] = 'Основные';
$lang['nav-set-tickets'] = 'Заявки';
$lang["nav-set-knowledge"] = 'База знаний';
$lang['nav-set-groups'] = 'Группы';
$lang['nav-set-priorities'] = 'Приоритеты';
$lang['nav-set-custom'] = 'Настраиваемые поля';
$lang['nav-set-can'] = 'Шаблоны ответов';
$lang['nav-set-inemail'] = 'Входящие письма';
$lang['nav-set-outemail'] = 'Исходящий письма';
$lang['nav-set-users'] = 'Сотрудники';
$lang['nav-set-profile'] = 'Профиль';
$lang['nav-set-logout'] = 'Выход';

// text on settings-general.php
$lang["set-general-title"] = "Основные";
$lang["set-general-db-cn"] = "Название компании";
$lang["set-general-db-fl"] = "Язык по умолчанию";
$lang["set-general-db-tz"] = "Часовой пояс";
$lang["set-general-db-df"] = "Формат даты";
$lang["set-general-db-rp"] = "Страница при входе";

// text on settings-tickets.php
$lang["set-tickets-title"] = "Настройки - Заявки";
$lang["set-tickets-db-an"] = "Назначить новую заявку";
$lang["set-tickets-db-an-desc"] = "Выберите, если новые заявки должны быть автоматически назначены выбранному пользователю";
$lang["set-tickets-db-up"] = "Разрешить пользователям выбирать приоритет";
$lang["set-tickets-db-as"] = "Анти-СПАМ";
$lang["set-tickets-db-rc"] = "Повторное открытие закрытых заявок";
$lang["set-tickets-db-tr"] = "Разрешить рейтинги заявок";
$lang["set-tickets-db-fa"] = "Разрешить загрузку файлов";
$lang["set-tickets-db-fa-desc1"] = "Относительный путь для вложенных файлов";
$lang["set-tickets-db-fa-desc2"] = "Максимальный размер каждого файла в мегабайтах (MB)";

// text on settings-kb.php
$lang['set-kb-title'] = 'Настройки - База знаний';
$lang['set-kb-title-desc'] = 'База знаний может быть использована для ответов на часто задаваемых вопросов (FAQ), избегая необходимости отвечать на повторные заявки.';
$lang['set-kb-db-enkb'] = 'Включить базу знаний';
$lang['set-kb-db-cokb'] = 'Показывать количество страниц для каждой статьи.';
$lang['set-kb-db-rakb'] = 'Разрешить рейтинги каждой статьи.';
$lang['set-kb-db-apkb'] = 'Количество статей, отображаемых в каждой группе.';

// text on settings-priorites.php
$lang['set-priorities-title'] = 'Настройки - Приоритеты';
$lang['set-priorities-title-desc'] = '<p>Приоритеты могут иметь значение для указания важности заявки.</p>';
$lang['set-priorities-db-ap'] = 'Добавить приоритет';
$lang['set-priorities-db-ap-desc'] = 'Название';
$lang['set-priorities-db-cp'] = 'Существующие Приоритеты';

// text on settings-groups.php
$lang['set-groups-title'] = 'Настройки - Группы';
$lang['set-groups-desc'] = '<p>По умолчанию, по меньшей мере, одна группа должна существовать. Группы позволяют вам группировать свои заявки в желаемые группы.</p><p>Для квалифицированных сотрудников в группе разрешено редактировать заявки. Если сотрудник не опытный для этой группы он будет ограничены добавлением только заметки. Для настройки навыков перейдите в меню Настройки - Сотрудники.</p>';
$lang['set-groups-add'] = 'Добавить группу';
$lang['set-groups-enter'] = 'Название группы';
$lang['set-groups-exist'] = 'Существующие группы';

$lang["set-groups-db-ie"] = "Нет входящего адреса электронной почты, настроеного для этой группы <a href=\"#\">Изменить</a>";
$lang["set-groups-db-sl"] = "Установите SLA для группы";
$lang["set-groups-db-rb"] = "Ответ от";
$lang["set-groups-db-fb"] = "Решение от";

// text on settings-customfields.php
$lang["set-custom-title"] = "Настройки - Настраиваемые поля";
$lang["set-custom-title-desc"] = "<p>Неограниченное количество пользовательских полей можно добавить для сбора дополнительной информации у заказчика.</p><p>Пользовательские поля показываются перед темой заявки.</p>";
$lang["set-custom-db-af"] = "Добавить настраиваемое поле";
$lang["set-custom-db-ef"] = "Существующие пользовательские поля";
$lang["set-custom-db-fn"] = "Имя поля";
$lang["set-custom-db-fn-error"] = "Имя поля уже существует";
$lang["set-custom-db-fn-sql-error"] = "Ошибка! Не может быть добавлено пользовательское поле. Пожалуйста, попробуйте другое название для поля";
$lang["set-custom-db-ft"] = "Тип поля";
$lang["set-custom-db-fr"] = "Обязательное для заполнения";
$lang["set-custom-db-fl"] = "Макс длина";
$lang["set-custom-db-fl-error"] = "Цифровое значение!. Введите число от 1 до 255.";
$lang["set-custom-db-fo"] = "Параметры поля";
$lang["set-custom-db-fo-desc"] = "(Отдельный вариант через запятую).";

// text on settings-canned.php
$lang["set-canned-title"] = "Настройки - Шаблоны ответов";
$lang["set-canned-title-desc"] = "Шаблоны ответов обычно используются для ответов на однотипные вопросы. Здесь вы можете добавить и управлять шаблонами. Они могут быть использованы для экономии времени.";
$lang["set-canned-db-ac"] = "Добавить шаблон";
$lang["set-canned-db-ec"] = "Существующие шаблоны";
$lang["set-canned-db-ct"] = "Заголовок";
$lang["set-canned-db-cm"] = "Шаблон сообщения";

// text on settings-iemail.php
$lang["set-iemail-title"] = "Настройки - Входящая почта как Заявка";
$lang["set-iemail-title-desc"] = "Преобразование входящих писем в заявки или обновление существующих заявок. ID заявки должен быть включен в заголовке";
$lang['set-iemail-manual'] = 'Разрешить ручной прием входящих писем.';
$lang['set-iemail-manual-warn'] = 'Not recommended if cron job setup for automatic retrieval.';
$lang['set-iemail-add-acc'] = 'Добавить учетную запись';
$lang['set-iemail-exist-title'] = 'Существующие адреса электронной почты';
$lang['set-iemail-exist-test'] = 'Тест';
$lang['set-iemail-exist-act'] = 'Успешное соединение';
$lang['set-iemail-exist-dec'] = 'Сбой подключения. Проверьте настройки учетной записи';
$lang['set-iemail-exist-en'] = 'Учетная запись включена';
$lang['set-iemail-exist-dis'] = 'Учетная запись выключена';
$lang['set-iemail-add-title'] = 'Адрес электронной почты Учетной записи';
$lang["set-iemail-db-ea"] = "Адрес электронной почты";
$lang["set-iemail-db-ho"] = "Адресс Хоста";
$lang["set-iemail-db-pn"] = "Номер порта";
$lang["set-iemail-db-pr"] = "Протокол";
$lang["set-iemail-db-ssl"] = "SSL";
$lang["set-iemail-db-tls"] = "TLS";
$lang["set-iemail-db-vc"] = "Проверка сертификата";
$lang["set-iemail-db-af"] = "Папка учетной записи";
$lang["set-iemail-db-au"] = "Логин учетной записи";
$lang["set-iemail-db-ap"] = "Пароль учетной записи";
$lang["set-iemail-db-tg"] = "Группа";
$lang["set-iemail-db-tp"] = "Приоритет";
$lang['set-iemail-db-na'] = '! Адрес электронной почты не настроен';

// text on settings-oemail.php
$lang["set-oemail-title"] = "Настройки - Уведомления по электронной почте";
$lang["set-oemail-title-desc"] = "Настроить автоматическую электронную почту для новых, обновленных, приостановленных и решенных заявок. Следующие коды могут быть использованы для вставки в тело сообщения. Письма отправляются в текстовом формате.";
$lang["set-oemail-code-tn"] = "Номер заявки";
$lang["set-oemail-code-da"] = "Дата и время добавления заявки";
$lang["set-oemail-code-du"] = "Дата и время обновления заявки";
$lang["set-oemail-code-ts"] = "Тема заявки";
$lang["set-oemail-code-te"] = "The original ticket enquiry";
$lang["set-oemail-code-u"] = "Имя заказчика";
$lang["set-oemail-code-tu"] = "ОБЯЗАТЕЛЬНОЕ! Обновление получать по электронной почте";
$lang["set-oemail-code-tc"] = "Назначенная Группа";
$lang["set-oemail-code-tp"] = "Назначенный Приоритет";
$lang["set-oemail-db-enable"] = "Включить исходящие email";
$lang["set-oemail-db-name"] = "Отображаемое Имя";
$lang["set-oemail-db-email"] = "E-mail адрес";
$lang["set-oemail-db-remail"] = "Ответить на E-mail адрес";
$lang["set-oemail-db-tn-sub"] = "Тема новой Заявки";
$lang["set-oemail-db-tn-body"] = "Текст новой Заявки";
$lang["set-oemail-db-tu-sub"] = "Тема обновленной Заявки";
$lang["set-oemail-db-tu-body"] = "Текст обновленной Заявки";
$lang["set-oemail-db-tp-sub"] = "Тема приостановленной Заявки";
$lang["set-oemail-db-tp-body"] = "Текст приостановленной Заявки";
$lang["set-oemail-db-tc-sub"] = "Тема решенной Заявки";
$lang["set-oemail-db-tc-body"] = "Текст решенной Заявки";

// text on settings users page
$lang['set-users-title'] = 'Настройки - Сотрудники';
$lang['set-users-title-desc'] = '<p>Сотрудники могут управлять заявками в своих группах. Вы можете добавлять, редактировать и удалять сотрудников. Каждому сотруднику может быть назначена роль. По умолчанию, по крайней мере, один администратор должен существовать. Администраторы имеют полный контроль, руководители могут получать доступ к отчетам, а операторы могут управлять только заявками.</p>'; 
$lang['set-users-add-agent'] = 'Добавить сотрудника';
$lang['set-users-name'] = 'Имя';

// text on settings add / edit user page
$lang['set-user-title'] = 'Добавить сотрудника';
$lang['set-user-notif'] = 'Уведомление';
$lang['set-user-skill'] = 'Группы навыков';
$lang['set-user-skill-desc'] = '<p>Выбрав группу для сотрудника, они могут принять, обновлять, объединять, удалять заявки в выбранной группе.</p><p>Все названия групп будут видны сотрудником, но они будут смогут добавлять заявки только в выбранную группу.</p>';
$lang['set-user-db-un'] = 'Логин';
$lang['set-user-db-pw'] = 'Пароль';
$lang['set-user-db-fn'] = 'Имя';
$lang['set-user-db-ln'] = 'Фамилия';
$lang['set-user-db-ea'] = 'Email';
$lang['set-user-db-role'] = 'Роль';
$lang['set-user-role-admin'] = 'Администратор';
$lang['set-user-role-super'] = 'Руководитель';
$lang['set-user-role-agent'] = 'Оператор';
$lang['set-user-db-tn'] = 'Сообщать о новых заявках';
$lang['set-user-db-tu'] = 'Сообщать о обновленных заявках назначенных оператору';
$lang['set-user-db-pm'] = 'Сообщать о добавлении личных сообщений в назначенных заявках';

// text on settings edit user page
$lang['set-user-edit-title'] = 'Редактировать пользователя';
$lang['set-user-edit-pwres'] = 'Установить пароль';

// version 1.1
$lang['set-oemail-db-method-mail'] = 'PHP Mail Function';
$lang['set-oemail-db-method-smtp'] = 'SMTP Server';
$lang['set-oemail-db-smtp-host'] = 'SMTP Server Address';
$lang['set-oemail-db-smtp-auth'] = 'SMTP Authenticate';
$lang['set-oemail-db-smtp-user'] = 'SMTP User';
$lang['set-oemail-db-smtp-pass'] = 'SMTP Password';
$lang['set-oemail-db-smtp-encr'] = 'Encryption';
$lang['set-oemail-db-smtp-port'] = 'SMTP Port';

$lang['set-kb-db-aukb'] = 'Display knowledge base author on article?';

$lang['dash-group-sum'] = 'Group Summary';
$lang['dash-group-table-text'] = 'Click on the quantity to view tickets by group and status';

$lang["set-tickets-db-tv"] = 'Ticket View';
$lang["set-tickets-db-tv-opt1"] = 'Latest at the bottom';
$lang["set-tickets-db-tv-opt2"] = 'Latest at the top';

$lang["set-tickets-db-trp"] = 'Ticket Reply Form';
$lang["set-tickets-db-trp-opt1"] = 'Top of page';
$lang["set-tickets-db-trp-opt2"] = 'Bottom of page';

$lang['tickets-viewby'] = 'View by';
$lang['tickets-viewby-opt1'] = 'Expanded';
$lang['tickets-viewby-opt2'] = 'List';
$lang['tickets-exp-noup'] = '** Awaiting update **';

$lang['ticket-rating'] = 'Rating'; // on admin ticket page
$lang['ticket-rating-waiting'] = 'Awaiting feedback from user';

$lang['u-kba-author'] = 'Author';
$lang['u-kba-helpful'] = 'Helpful?';
$lang['u-kba-out'] = 'out of';
$lang['u-kba-found'] = 'found this helpful';

// version 1.2
$lang['u-aachat-help'] = 'Help!';
$lang['u-aachat-online'] = 'Chat Online';
$lang['u-aachat-offline'] = 'Chat Offline';
$lang['u-aachat-email'] = 'Email';
$lang['u-aachat-close'] = 'Close';
$lang['u-aachat-offline-desc'] = 'Please leave a message and we\'ll get back to you shortly.';
$lang['u-aachat-send'] = 'Send Message';
$lang['u-aachat-advisor'] = 'An advisor will be with you shortly.';

$lang['nav-set-aachat'] = 'Live Chat';

$lang['set-aachat-title'] = 'Live Chat';
$lang['set-aachat-title-desc'] = 'Live Chat is an instant chat widget for any of your web pages.';
$lang['set-aachat-db-enlc'] = 'Enable live chat';
$lang['set-aachat-db-lcit'] = 'Allowed agent idle time (in minutes)';
$lang['set-aachat-db-lcit-desc'] = 'The idle time is the time an agent can remain idle before being automatically set to offline on chat. This will stop chat remaining online if agents have navigated away from Acorn Aid or forgotten to go offline.';
$lang['set-aachat-newchat'] = 'New Chats';
$lang['set-aachat-mychat'] = 'My Chats';
$lang['set-aachat-otherchat'] = 'Other Chats';
$lang['set-aachat-unread'] = 'Unread';

// chat page
$lang['aachat-name'] = 'Name';
$lang['aachat-subject'] = 'Subject';
$lang['aachat-dt'] = 'Date / Time';
$lang['aachat-ip'] = 'IP Address';
$lang['aachat-refer'] = 'Referrer Page';
$lang['aachat-browser'] = 'Broswer';
$lang['aachat-chatting-with'] = 'You are now chatting with';
$lang['aachat-chatting-ended'] = 'Chat ended by';
$lang['aachat-status-closed'] = 'This chat has been closed and can no longer be updated.';
$lang['aachat-status-unassigned'] = 'This chat is currently unaccepted. Accept the ticket by clicking accept';
$lang['aachat-status-notowner'] = 'This chat is not owned by you.';

// ticket settings page
$lang["set-tickets-db-tt"] = 'Request agent time spent on ticket updates';

// ticket page
$lang['ticket-status-acceptby'] = 'Accepted by';
$lang['ticket-status-chg-status'] = 'Ticket status changed from';
$lang['ticket-status-chg-group'] = 'Ticket group changed from';
$lang['ticket-status-chg-owner'] = 'Owner changed from';
$lang['ticket-status-chg-priority'] = 'Ticket priority changed from';
$lang['ticket-status-chg-to'] = 'to';
$lang['ticket-forward'] = 'Forward';
$lang['ticket-forward-to'] = 'Forward ticket to 3rd party';
$lang['ticket-forwarded-to-3rd-party'] = 'Forwarded to 3rd party';
$lang['ticket-forwarded-to'] = 'Forwarded to:';
$lang['ticket-time-spent'] = 'Time spent in minutes (h:mm)';
$lang['ticket-duration'] = 'Duration';
$lang['ticket-merge'] = 'Merge Ticket';
$lang['ticket-merge-detail'] = 'Merge ticket selected with the following:';
$lang['ticket-merge-na'] = 'No results found';
$lang['ticket-merge-closed'] = 'Ticket ID closed and cannot be merged';
$lang['ticket-status-collide'] = 'began handling this ticket';
$lang['ticket-type-form'] = 'Form';
$lang['ticket-type-email'] = 'Email';
$lang['ticket-type-widget'] = 'Widget';
$lang['ticket-type-chat'] = 'Chat';

// errors
$lang['generic-error-inv-format'] = '! Invalid format';
$lang['generic-error-inv-date'] = '! Invalid date';

// report page
$lang['report-groupby'] = 'Group By';
$lang['report-groupby-agent'] = 'Agents';
$lang['report-groupby-group'] = 'Group';
$lang['report-groupby-date'] = 'Date';

// user profile
$lang['profile-email'] = 'Email';
$lang['set-user-db-us'] = 'Signature';

$lang["set-oemail-db-tf-sub"] = "Ticket Forward Subject";
$lang["set-oemail-db-tf-body"] = "Ticket Forward Body";

// dashboard
$lang['dash-activity-year'] = 'year';
$lang['dash-activity-month'] = 'month';
$lang['dash-activity-week'] = 'week';
$lang['dash-activity-day'] = 'day';
$lang['dash-activity-hour'] = 'hour';
$lang['dash-activity-minute'] = 'minute';
$lang['dash-activity-second'] = 'second';
$lang['dash-activity-now'] = 'just now';
$lang['dash-activity-ago'] = 'ago';
//
// version 2
//
// dashboard
$lang['dash-group-click'] = 'Click on the quantity to view tickets by group and status';

$lang['set-user-role-user'] = 'User';
$lang['tickets-status-ar'] = "Awaiting Reply";

// global functions
$lang['ticket-add-autoassign'] = 'Ticket automatically assigned to agent';
$lang['ticket-add-sla'] = 'Service Level Agreements (SLAs)';
$lang['ticket-add-slar'] = 'Reply due by';
$lang['ticket-add-slaf'] = 'Fix due by';
$lang['ticket-add-search-u'] = 'Search for registered user';
$lang['ticket-add-guest'] = 'or continue to submit the ticket as a guest';

// ticket page
$lang['ticket-status-chg-slar'] = 'Ticket reply SLA changed from';
$lang['ticket-status-chg-slaf'] = 'Ticket fix SLA changed from';

// settings
$lang['generic-settings-saved'] = 'Settings Saved';
$lang['generic-error-required-fields'] = '! Please enter all required fields marked with a star (*)';
$lang['generic-error-cancel'] = 'Cancel Changes';
$lang['generic-error-invalid-esr'] = '! Invalid time format for SLA Reply. Format must be HH:MM:SS e.g. 12:30:00';
$lang['generic-error-invalid-esf'] = '! Invalid time format for SLA Fix. Format must be HH:MM:SS e.g. 12:30:00';

// admin page - settings - tickets
$lang["set-tickets-db-sla"] = "Show service level agreement (SLAs) to user. Set <a href='p.php?p=settings-slas'>SLAs</a>";

// admin page - settings - slas
$lang["nav-set-slas"] = "SLAs";
$lang["set-slas-title"] = "Service Level Agreements (SLAs)";
$lang["set-slas-title-desc"] = "A service level agreement can be set by group and priority to define an expected time to reply and fix an enquiry. This can be used to monitor staff performance and also give the end user an expected handle time.<p>If an SLA is nearing it's expiry then an email notification can be sent to a nominated email address. If an SLA breaches the expected time then the enquiry can be escalated into another group.";
$lang["set-slas-gp"] = "Group / Priority";
$lang["set-slas-ttr"] = "Time to reply";
$lang["set-slas-ttf"] = "Time to fix";
$lang["set-slas-erg"] = "Reply escalation group";
$lang["set-slas-efg"] = "Fix escalation group";
$lang["set-slas-aea"] = "Alert email address";

// admin page - settings - outbound email
$lang["set-oemail-code-slar"] = "The date and time expected to reply within. Set in SLAs";
$lang["set-oemail-code-slaf"] = "The date and time expected to fix within. Set in SLAs";

// user profile in admin
$lang['set-user-db-tn'] = 'Telephone number';

// settings knowledge base
$lang['set-kb-db-shkb'] = 'Allow social media share buttons on articles';
$lang['kb-db-article-sticky'] = 'Sticky';
$lang['kb-db-article-position'] = 'Sticky Position';
$lang['kb-db-article-meta'] = 'Meta Tags (comma seperated)';
$lang['kb-db-article-hidden'] = 'Hidden';

// settings user agent page
$lang['set-users-guest-access'] = 'Allow guests to submit tickets';
$lang['set-users-reg-access'] = 'Allow registered users';

// user page - knowledge base
$lang['u-kb-nakb'] = "No knowledge base groups or articles currently available";

$lang['u-access-title'] = "Access";
$lang['u-access-error'] = "! Account not found. Please try again.";
$lang['u-access-disabled'] = "! Account disabled. Please contact site admin";
$lang['u-signin'] = "Sign In";
$lang['u-register-user'] = "Register Account";
$lang['u-guest'] = "Guest Access";
$lang['u-guest-desc'] = "Don't have an account with us? Submit and track a ticket without registering.";
$lang['u-guest-link'] = "Continue as a guest";

$lang['ticket-add-pwd'] = "Password";
$lang['u-nav-dashboard'] = "MY TICKETS";
$lang['u-nav-profile'] = "MY PROFILE";
$lang['u-nav-logout'] = "LOG OUT";

$lang['u-dashboard'] = 'Dashboard';
$lang['u-dashboard-sub'] = 'Subject';
$lang['u-dashboard-stat'] = 'Status';
$lang['u-dashboard-da'] = 'Date Added';
$lang['u-dashboard-du'] = 'Date Updated';
$lang['u-dashboard-not'] = 'No tickets available.';

$lang['u-profile'] = 'Profile';

$lang['u-register-title'] = 'Register';
$lang['u-register-name'] = 'Full name';
$lang['u-register-email'] = 'Email address';
$lang['u-register-tele'] = 'Telephone number';
$lang['u-register-pwd'] = 'Your password';
$lang['u-register-cpwd'] = 'Confirm your password';
$lang['u-register-btn'] = 'Register';

$lang["set-custom-delete-con"] = "Any previous information associated with this field will be deleted. Do you wish to continue?"; //js

$lang['profile-role'] = 'Role';
$lang['profile-ticket-layout'] = 'Preferred Ticket Layout';
$lang['profile-style'] = 'Style';
$lang['profile-edit'] = 'Edit';
$lang['profile-chg-sign'] = 'Change Signature';

$lang['set-user-role-user'] = 'User';

$lang['ticket-details-slar'] = 'SLA Reply';
$lang['ticket-details-slaf'] = 'SLA Fix';
$lang['ticket-details-sla-suc'] = 'SLA achieved on';
$lang['ticket-details-sla-fail'] = 'SLA failed on';
$lang['ticket-details-sla-rem'] = 'Remaining';
$lang['ticket-details-sla-ex'] = 'Expired';
$lang['ticket-details-sla-days'] = 'days';
$lang['ticket-details-sla-hours'] = 'hours';
$lang['ticket-details-sla-mins'] = 'minutes';

$lang['ticket-rating-post'] = 'Ticket rated as ';

// Report page
$lang['report-groupby-user'] = 'Users';
$lang['report-data-guest'] = 'Guest';

// error messages
$lang["generic-na"] = 'N/A';
$lang['generic-error-invalid-tn'] = '! Invalid telephone number';
$lang['generic-error-pw-match'] = '! Your password and confirmed password must match';
$lang['generic-error-em-conflict'] = '! Your email address is already registered. Please try another or use Forgotten Password';
$lang['set-user-edit-pwres-success'] = 'Password changed successfully';

// cron sla
$lang['cron-sla-slar-alert'] = 'SLA Reply alert has been sent';
$lang['cron-sla-slar-es-alert'] = 'SLA Reply Expiring'; // ticket id follows
$lang['cron-sla-slar-eb-alert'] = 'Ticket reply due to expire at'; // sla reply date to follow

$lang['cron-sla-slar-expired'] = 'SLA Reply has expired. Excalated to group'; // group name follows
$lang['cron-sla-slar-es-expired'] = 'SLA Reply Expired'; // ticket id follows
$lang['cron-sla-slar-eb-expired'] = 'Ticket reply expired at'; // sla reply date to follow

$lang['cron-sla-slaf-alert'] = 'SLA Fix alert has been sent';
$lang['cron-sla-slaf-es-alert'] = 'SLA Fix Expiring'; // ticket id follows
$lang['cron-sla-slaf-eb-alert'] = 'Ticket fix due to expire at'; // sla reply date to follow

$lang['cron-sla-slaf-expired'] = 'SLA Fix has expired. Excalated from to group'; //group name follows;
$lang['cron-sla-slaf-es-expired'] = 'SLA Fix Expired'; // ticket id follows
$lang['cron-sla-slaf-eb-expired'] = 'Ticked expired at'; // sla reply date to follow
?>