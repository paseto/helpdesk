<?php
// PHPLOCKITOPT NOENCODE
// PHPLOCKITOPT NOOBFUSCATE
// PHPLOCKITOPT NOSTRIPCOMMENTS
// PHPLOCKITOPT NOSTRIPWHITESPACE

// USER PAGES

// text on user navigation
$lang['u-nav-kb'] = 'BASE DE CONOCIMIENTOS';
$lang['u-nav-s-request'] = 'ENVIAR INCIDENCIA';
$lang['u-nav-t-request'] = 'CONSULTAR INCIDENCIA';

// text on kb
$lang['u-kb-search'] = 'Buscar';
$lang['u-kb-search-na'] = 'No se han encontrado conicidencias';
$lang['u-kb-kb'] = 'Base de Conocimientos';
$lang['u-kb-more'] = 'M&aacute;s';
$lang['u-kb-top-articles'] = 'Principales Art&iacute;culos';
$lang['u-kb-late-articles'] = 'Art&iacute;culos Recientes';

// text on kb article and search and group
$lang['u-kba-dateadd'] = 'Fecha';
$lang['u-kba-views'] = 'Visitas';
$lang['u-kba-rating'] = 'Valoraci&oacute;n';
$lang['u-kba-group'] = 'Grupo';

// text on user track ticket page
$lang['u-ticket-track-title'] = 'Consulta de incidencias';
$lang['u-ticket-track-t-em'] = 'Email';
$lang['u-ticket-track-t-no'] = 'C&oacute;digo de Ticket';
$lang['u-ticket-track-submit'] = 'Consultar';
$lang['u-ticket-track-error-req'] = '! Los campos Email y C&oacute;digo de Ticket son reqeridos';
$lang['u-ticket-track-error-inv-em'] = '! La direcci&oacute;n de correo introducida es err&oacute;nea';
$lang['u-ticket-track-error-inv-no'] = '! C&oacute;digo de Ticket erroacute;neo, debe ser un valor num&eacute;rico.';
$lang['u-ticket-track-error-not-found'] = '! No se encuentra ninguna incidencia con los datos proporcionados';

// text on ticket form and ticket success admin and user
$lang['ticket-add-title'] = 'Env&iacute;o de incidencias';
$lang['ticket-add-name'] = 'Nombre';
$lang['ticket-add-email'] = 'Email';
$lang['ticket-add-group'] = 'Departamento';
$lang['ticket-add-priority'] = 'Urgencia';
$lang['ticket-add-subject'] = 'Descripci&oacute;n';
$lang['ticket-add-msg'] = 'Mensaje';
$lang['ticket-add-files-add'] = 'Adjuntar fichero';
$lang['ticket-add-files-ano'] = 'Adjuntar otro fichero';
$lang['ticket-add-sec-code'] = 'C&oacute;digo de seguridad';
$lang['ticket-add-sec-code-ent'] = 'Introducir c&oacute;digo de seguridad';
$lang['ticket-add-submit'] = 'Enviar incidencia';
$lang['ticket-add-success-new'] = 'Su c&oacute;digo de incidencia';
$lang['ticket-add-success-breif'] = 'Los detalles de la incidencia incluyendo el c&oacute;digo de la misma han sido enviados por mail a';

// ADMINS PAGES
$lang['generic-404'] = '<p class="e404">Lo sentimos...</p><p class="e404">la p&aacute;gina solicitada no se encuentra disponible.</p>';
$lang['generic-save'] = 'Enviar';
$lang['generic-change'] = 'Cambiar';
$lang["generic-yes"] = "Si";
$lang["generic-no"] = "No";
$lang["generic-edit"] = "Editar";
$lang["generic-delete"] = "Borrar";
$lang['generic-enable'] = 'Activar';
$lang['generic-disable'] = 'Desactivar';
$lang["generic-mark"] = "Marcar como predeterminado";
$lang["generic-unassigned"] = "Sin asignar";
$lang["generic-error"] = "! Campo requerido";
$lang['generic-error-invalid-em'] = '! Direcci&oacute;n de correo electr&oacute;nico no v&aacute;lida ';
$lang['generic-error-un-exists'] = '! Nombre de usuario ya est&aacute; en uso ';
$lang['generic-error-pw-length'] = '! La contrase&ntilde;a debe contener 6 caracteres o m&aacute;s ';
$lang['generic-error-invalid-code'] = '! C&oacute;digo no v&aacute;lido '; 
$lang['generic-delete-warn'] = '! No se puede borrar hasta que todas las entradas est&eacute;n sin asignar '; 
$lang['generic-delete-warn-article'] = '! No se puede borrar hasta que todos los art&iacute;culos est&aacute;n sin asignar '; 
$lang['generic-file-size-exc'] = '! El tama&ntilde;o de archivo ha excedido los l&iacute;mite de subida '; 
$lang['generic-success-u-add'] = 'El usuario ha a&ntilde;adido correctamente'; 
$lang['generic-success-u-edit'] = 'Usuario editado con &eacute;xito';

// text on admin index page
$lang['index-login'] = 'Acceso al servidor';
$lang['index-username'] = 'Usuario';
$lang['index-password'] = 'Contrase&ntilde;a';
$lang['index-langauge'] = 'Idioma';
$lang['index-forgotpwd'] = 'No recuerda su contrase&ntilde;a?';
$lang['index-error'] = '! Usuario o contrase&ntilde;a incorrecto';

// text on admin password reset page
$lang['pwreset-title'] = 'Cambio de clave';
$lang['pwreset-unknown-u'] = '! No se ha encontrado ning&uacute;n usuario con ese nombre';
$lang['pwreset-email-succ'] = '! Hecho. <p>Se ha enviado un correo con su nueva contrase&ntilde;a a su correo electr&oacute;nico</p>';
$lang['pwreset-email-fail'] = 'Ha ocurrido un error al enviar su nueva contrase&ntilde;a';

// text on header page
$lang['header-menu'] = 'MENU';
$lang['header-search'] = 'Buscar por ID, Nombre, Asunto, etc';

// text on dashboard page
$lang['dash-title-tickets'] = 'Resumen de incidencias';
$lang['dash-title-activity'] = 'Actividad reciente';
$lang['dash-load-more'] = 'Cargar m&aacute;s';
$lang['dash-avg-time'] = 'Tiempo de respuesta';
$lang['dash-activity-new'] = 'ha enviado una nueva incidencia';
$lang['dash-activity-change'] = 'ha realizado un cambio en la incidencia';
$lang['dash-activity-note'] = 'ha a&ntilde;adido una nota a la incidencia';
$lang['dash-activity-closed'] = 'incidencia cerrada';
$lang['dash-activity-reply'] = 'respondido a la incidencia';
$lang['dash-activity-rating'] = 'valorado la incidencia';
$lang['dash-activity-user-replied'] = 'respondido a la incidencia';
$lang['dash-activity-you'] = 'Usted';
$lang['dash-activity-have'] = 'ha';
$lang['dash-activity-has'] = 'tiene';

// text on admin tickets page
$lang['tickets-filter'] = 'Filtros';
$lang['tickets-refresh'] = 'Actualizar';
$lang['tickets-ID'] = 'ID';
$lang['tickets-agents'] = 'Usuarios';
$lang['tickets-subject'] = 'Asunto';
$lang['tickets-dateadd'] = 'Fecha';
$lang['tickets-dateadd-anytime'] = 'Cualquier fecha';
$lang['tickets-dateadd-today'] = 'Hoy';
$lang['tickets-dateadd-yesterday'] = 'Ayer';
$lang['tickets-dateadd-thisweek'] = 'Esta semana';
$lang['tickets-dateadd-lastweek'] = 'Semana anterior';
$lang['tickets-dateadd-thismonth'] = 'Este mes';
$lang['tickets-dateadd-lastmonth'] = 'Mes anterior';
$lang['tickets-dateup'] = 'Fecha de actualizaci&oacute;n';
$lang['tickets-group'] = 'Departamento';
$lang['tickets-group-desc'] = 'Seleccione los departamentos a visualizar';
$lang['tickets-status'] = 'Estado';
$lang['tickets-status-accept'] = 'Aceptado';
$lang['tickets-status-open'] = 'Abierta';
$lang['tickets-status-pending'] = 'Pendiente';
$lang['tickets-status-paused'] = 'Pausado';
$lang['tickets-status-closed'] = 'Finalizado';
$lang['tickets-status-delete'] = 'Borrado';
$lang['tickets-status-desc'] = 'Seleccione los estados a visualizar';
$lang['tickets-priority'] = 'Prioridad';
$lang['tickets-owner'] = 'Propietario';
$lang['tickets-sortby'] = 'Ordenar por';
$lang['tickets-dir-asc'] = 'Ascenciente';
$lang['tickets-dir-dsc'] = 'Descendiente';
$lang['tickets-get-email'] = 'Obtener correos';

// text on search
$lang['search-advanced'] = 'B&uacute;squeda avanzada';
$lang['search-subject'] = 'Asunto';
$lang['search-msg'] = 'Contenido del mensaje';
$lang['search-cust'] = 'Cliente';
$lang['search-any'] = 'Todo';
$lang['search-dateaddfrom'] = 'A&ntilde;adido desde la fecha';
$lang['search-dateaddto'] = 'A&ntilde;adido hasta la fecha';
$lang['search-dateupfrom'] = 'Actualizado desde la fecha';
$lang['search-dateupto'] = 'Actualizado hasta la fecha';
$lang['search-dateclosefrom'] = 'Cerrado desde la fecha';
$lang['search-datecloseto'] = 'Cerrado hasta la fecha';
$lang['search-button-submit'] = 'Buscar';
$lang['search-button-reset'] = 'Borrar';
$lang['search-results'] = 'resultados encontados para';
$lang['search-no-results'] = 'No se han encontrado resultados para';
$lang['search-from'] = 'desde';
$lang['search-added'] = 'A&ntilde;adido';
$lang['search-updated'] = 'Actualizado';
$lang['search-closed'] = 'Cerrado';

// text on reports
$lang['rep-filter'] = 'Informe personalizado';
$lang['rep-report'] = 'Informe';
$lang['rep-reset'] = 'Borrar';
$lang['rep-period'] = 'Fecha del informe';
$lang['rep-period-from'] = 'Fecha de inico';
$lang['rep-period-to'] = 'Fecha fin';
$lang['rep-graphic'] = 'Mostrar gr&aacute;fico';
$lang['rep-no-data'] = 'No se han encontrado datos para los par&aacute;metros seleccionados';
$lang['rep-dd-ts'] = 'Resumen de incidencias';
$lang['rep-dd-as'] = 'Resumen por usuario';
$lang['rep-dd-gs'] = 'Resumen por grupo';
$lang['rep-dd-gl'] = 'Volumen por departamento';
$lang['rep-dd-cs'] = 'Satisfacci&oacute;n del cliente';
$lang['rep-dd-st'] = 'Tipo de origen.';
$lang['rep-date-dd-cust'] = 'Personalizado';
$lang['rep-download'] = 'Descargar como fichero CSV';
$lang['rep-total'] = 'Total';
$lang['rep-feedback'] = 'Feedback';

// text on ticket page
$lang['ticket-details-title'] = 'Detalles';
$lang['ticket-dateintrep'] = 'Fecha de respuesta inicial';
$lang['ticket-dateclosed'] = 'Fecha de cierre';
$lang['ticket-customfields'] = 'Campos actualizados';
$lang['ticket-fileuploads'] = 'Ficheros subidos';
$lang['ticket-status-closed'] = 'La incidencia ha sido cerrada y no puede actualizarse.';
$lang['ticket-status-notskill'] = 'No tiene acceso a este grupo, puede dejar una nota para el supervisor.';
$lang['ticket-status-unassigned'] = 'La incidencia no se encuentra asignada, para actualizarla puede aceptar la incidencia pulsando acceptar';
$lang['ticket-status-notowner'] = 'No tiene asignada esta incidencia, puede realizar una anotaci&oacute;n para el propietario o puede asignarse la incidencia para responder directamente al usuario.';
$lang['ticket-attachanother'] = 'Adjuntar otro fichero';
$lang['ticket-status-dd-note'] = 'Nota';
$lang['ticket-status-dd-update'] = 'Actualizar';
$lang['ticket-status-dd-pause'] = 'Pausar';
$lang['ticket-status-dd-close'] = 'Cerrar';
$lang['ticket-show-detail'] = 'Mostrar descripci&oacute;n'; // on user ticket page
$lang['ticket-rate'] = 'Valorar'; // on user ticket page
$lang['ticket-rate-p'] = 'Positivo';
$lang['ticket-rate-neu'] = 'Neutro';
$lang['ticket-rate-neg'] = 'Negativo';

// text on user profile page
$lang['profile-last-log'] = '&Uacute;ltimo acceso';
$lang['profile-chg-pwd'] = 'Cambiar contrase&ntilde;a';
$lang['profile-cust-sat'] = 'SAtisfacci&oacute;n del cliente';
$lang['profile-tickets-own'] = 'Incidencias asignadas';
$lang['profile-chg-pwd-desc'] = 'Introduzca su nueva contrase&ntilde;a a continuaci&oacute;n. Se le enviar&aacute; un correo confirmando su nueva contrase&ntilde;a.';
$lang['profile-chg-pwd-new'] = 'Nueva contrase&ntilde;a';
$lang['profile-chg-pwd-confirm'] = 'Confirme su nueva contrase&ntilde;a';
$lang['profile-chg-pwd-succes'] = '! Completado. <p>Se ha enviado un correo con su nueva contrase&ntilde;a a la direcci&oacute;n que tiene registrada en el sistema</p>';
$lang['profile-chg-pwd-succes-mail-sub'] = 'Su contrase&ntilde;a ha sido cambiada !';
$lang['profile-chg-pwd-succes-mail-body'] = 'Su nueva contrase&ntilde;a es';
$lang['profile-chg-pwd-fail'] = 'Ha ocurrido un error al mandar su nueva contrase&ntilde;a';

// text on Base de Conocimientos page
$lang['kb-title'] = 'Base de Conocimientos';
$lang['kb-enabled'] = 'La Base de Conocimientos est&aacute; activada';
$lang['kb-disabled'] = 'Base de Conocimientos est&aacute; desactivada en Ajustes > Base de Conocimientos';
$lang['kb-db-aa-title'] = 'A&ntilde;adir Art&iacute;culo';
$lang['kb-db-ag-title'] = 'A&ntilde;adir &aacute;rea a la Base de Conocimientos';
$lang['kb-db-ag-title-desc'] = 'A&ntilde;ada un &aacute;rea a la base de Conocimientos para facilitar a los usuarios la b&uacute;squeda.';
$lang["kb-db-eg"] = '&Aacute;reas existentes en la Base de Conocimientos';
$lang['kb-db-article-title'] = 'T&iacute;tulo de la entrada';
$lang['kb-db-article-group'] = 'Area de la entrada';
$lang['kb-db-article-msg'] = 'Entrada';

// text on menu
$lang['nav-dashboard'] = 'Panel de control';
$lang['nav-tickets'] = 'Incidencias';
$lang['nav-add'] = 'A&ntilde;adir';
$lang['nav-search'] = 'Buscar';
$lang['nav-view'] = 'Ver';
$lang['nav-knowledge'] = 'Base de Conocimientos';
$lang["nav-knowledge-articles"] = 'A&ntilde;adir entradas';
$lang["nav-knowledge-groups"] = 'Administrar &aacute;reas de conocimientos';
$lang['nav-reports'] = 'Informes';
$lang['nav-set'] = 'Ajustes';
$lang['nav-set-general'] = 'General';
$lang['nav-set-tickets'] = 'Incidencias';
$lang["nav-set-knowledge"] = 'Base de Conocimientos';
$lang['nav-set-groups'] = 'Departamentos';
$lang['nav-set-priorities'] = 'Prioridades';
$lang['nav-set-custom'] = 'Campos adicionales';
$lang['nav-set-can'] = 'Respuestas predefinidas';
$lang['nav-set-inemail'] = 'Correos entrantes';
$lang['nav-set-outemail'] = 'Correos salientes';
$lang['nav-set-users'] = 'Operadores';
$lang['nav-set-profile'] = 'Perfil';
$lang['nav-set-logout'] = 'Salir';

// text on settings-general.php
$lang["set-general-title"] = "General";
$lang["set-general-db-cn"] = "Nombre de la empresa";
$lang["set-general-db-fl"] = "Idioma por defecto";
$lang["set-general-db-tz"] = "Huso Horario";
$lang["set-general-db-df"] = "Formato reloj";
$lang["set-general-db-rp"] = "P&aacute;gina al iniciar sesi&oacute;n";

// text on settings-tickets.php
$lang["set-tickets-title"] = "Incidencias";
$lang["set-tickets-db-an"] = "Asignar nueva incidencia";
$lang["set-tickets-db-an-desc"] = "Seleccione si las incidencias se asignan automáticamente a un usuario o si quedan pendientes de asignar.";
$lang["set-tickets-db-up"] = "Permitir a los usuarios asignar la prioridad.";
$lang["set-tickets-db-as"] = "Utilizar imagen anti-spam para los usuarios";
$lang["set-tickets-db-rc"] = "Reapertura de incidencias permitida";
$lang["set-tickets-db-tr"] = "Permitir valorar las incidencias";
$lang["set-tickets-db-fa"] = "Permitir el uso de ficheros adjutos";
$lang["set-tickets-db-fa-desc1"] = "Ruta de acceso (relativa) para los dicheros adjuntos ";
$lang["set-tickets-db-fa-desc2"] = "Tama&ntilde;o MAX. para cada fichero adjunto en megabytes (MB)";

// text on settings-kb.php
$lang['set-kb-title'] = 'Base de Conocimientos';
$lang['set-kb-title-desc'] = 'La base de conocimientos puede ser utilizada para consultar preguntas frecuentes, permitiendo a los usuarios encontrar las respuestas y evitando la apertura de incidencias recurrentes.';
$lang['set-kb-db-enkb'] = 'Habilitar la Base de Conocimientos';
$lang['set-kb-db-cokb'] = 'Mostrar visitas para las entradas.';
$lang['set-kb-db-rakb'] = 'Permitir valoraciones para las entradas.';
$lang['set-kb-db-apkb'] = 'N&uacute;mero de entradas a mostrar por &aacute;rea.';

// text on settings-priorites.php
$lang['set-priorities-title'] = 'Prioridad';
$lang['set-priorities-title-desc'] = '<p>Las prioridades pueden ser configuradas para indicar la importancia de una solicitud..</p>';
$lang['set-priorities-db-ap'] = 'A&ntilde;adir prioridad';
$lang['set-priorities-db-ap-desc'] = 'Introducir prioridad';
$lang['set-priorities-db-cp'] = 'Prioridades existentes';

// text on settings-groups.php
$lang['set-groups-title'] = 'Departamentos';
$lang['set-groups-desc'] = '<p>Por defecto debe existir al menos un departamento. Los departamentos le permiten agrupar las incidencias.</p><p>Para que los operadores puedan editar las incidencias de un grupo deben haber sido asignados a ese grupo. Si un agente no ha sido asignado al grupo al que corresponde la incidencia estar&aacute; limitado a crear notas para los agentes asignados.<br /> Para la asignaci&oacute;n de usuarios a los grupos debe acceder al men&uacute; <b>Ajustes de usuario</b>.</p>';
$lang['set-groups-add'] = 'A&ntilde;adir';
$lang['set-groups-enter'] = 'Introducir nuevo departamento';
$lang['set-groups-exist'] = 'Departamentos existentes';
// texto no traducido a la espera de verlo en su contexto.
$lang["set-groups-db-ie"] = "No inbound email address are configured for this group <a href=\"#\">Edit</a>";
$lang["set-groups-db-sl"] = "Set SLA for group";
$lang["set-groups-db-rb"] = "Reply By";
$lang["set-groups-db-fb"] = "Fix By";

// text on settings-customfields.php
$lang["set-custom-title"] = "Campos adicionales";
$lang["set-custom-title-desc"] = "<p>Se puede establecer un n&uacute;mero ilimitado de campos adicionales para complementar la informaci&oacute;n facilitada por los usuarios.</p><p>Los campos adicionales se muestran antes del campo Asunto.</p>";
$lang["set-custom-db-af"] = "A&ntilde;adir campo adicional";
$lang["set-custom-db-ef"] = "Campos adicionales creados";
$lang["set-custom-db-fn"] = "Nombre";
$lang["set-custom-db-fn-error"] = "Ya existe un campo con ese nombre";
$lang["set-custom-db-fn-sql-error"] = "Error! El campo no puede ser creado. Pruebe a crearlo con otro nombre";
$lang["set-custom-db-ft"] = "Tipo";
$lang["set-custom-db-fr"] = "Requerido";
$lang["set-custom-db-fo-desc"] = "(Separe cada opci&oacute;n con una coma).";

// text on settings-canned.php
$lang["set-canned-title"] = "Respuestas predefinidas";
$lang["set-canned-title-desc"] = "Respuestas predefinidas son respuesas de uso com&uacute;n. Aqu&iacute; puede a&ntilde;dir y gestionar sus respuestas predefinidas. &Eacute;stas pueden utilizarse para ahorrar tiempo volviendo a escribir el mismo mensaje varias veces.";
$lang["set-canned-db-ac"] = "A&ntilde;adir respuesta predefinida";
$lang["set-canned-db-ec"] = "Respuestas predefinidas";
$lang["set-canned-db-ct"] = "T&iacute;tulo";
$lang["set-canned-db-cm"] = "Respuesta predefinida";

// text on settings-iemail.php
$lang["set-iemail-title"] = "Correo entrante con incidencias";
$lang["set-iemail-title-desc"] = "<p>Convierta sus mensajes de correo electr&oacute;nico entrantes en incidencias o actualice incidencias existentes. El c&oacute;digo de incidencia debe incluirse en el asunto del correo para su actualizaci&oacute;n</p><p>Si va a utilizar una cuenta de GMail esta es la configuraci&oacute;n del servidor que debe utilizar:<br /> <ul><li>Host Address: imap.gmail.com</li><li>Port Number: 993</li><li>Protocol: imap</li><li>SSL: &#10003;</li><li>Validate Certificate: /novalidate-cert</li><li>TLS: &#10007;</li></ul></p>";
$lang['set-iemail-manual'] = 'Permitir la comprobaci&oacute;n manual de los correos entrantes.';
$lang['set-iemail-manual-warn'] = 'No recomendado si se ha establecido una tarea <b>CRON</b> para la recolecci&oacute; autom&aacute;tica del correo.';
$lang['set-iemail-add-acc'] = 'A&ntilde;adir cuenta';
$lang['set-iemail-exist-title'] = 'Direcciones de correo existentes';
$lang['set-iemail-exist-test'] = 'Probar';
$lang['set-iemail-exist-act'] = 'Conexi&oacute;n correcta';
$lang['set-iemail-exist-dec'] = 'Imposible contectar. Compruebe los ajustes de la cuenta.';
$lang['set-iemail-exist-en'] = 'Cuenta activada';
$lang['set-iemail-exist-dis'] = 'Cuenta desactivada';
$lang['set-iemail-add-title'] = 'Email address account';
$lang["set-iemail-db-ea"] = "Direcci&oacute;n de correo";
$lang["set-iemail-db-ho"] = "Direcci&oacute;n del servidor";
$lang["set-iemail-db-pn"] = "Puerto de conexi&oacute;n";
$lang["set-iemail-db-pr"] = "Protocolo";
$lang["set-iemail-db-ssl"] = "SSL";
$lang["set-iemail-db-tls"] = "TLS";
$lang["set-iemail-db-vc"] = "Validaci&oacute;n del Certificado";
$lang["set-iemail-db-af"] = "Carpeta de correo";
$lang["set-iemail-db-au"] = "Nombre de usuario";
$lang["set-iemail-db-ap"] = "Contrase&ntilde;a";
$lang["set-iemail-db-tg"] = "Departamento";
$lang["set-iemail-db-tp"] = "Prioridad";
$lang['set-iemail-db-na'] = '! No tiene cuentas de correo configuradas';

// text on settings-oemail.php
$lang["set-oemail-title"] = "Notificaciones";
$lang["set-oemail-title-desc"] = "Personalice los correos electr&oacute;nicos automatizados para las incidencias nuevas, actualizaciones, pausas e incidencias cerradas. Los siguientes c&oacute;digos se pueden utilizar para insertar datos de entradas. Los correos electr&oacute;nicos se env&iacute;an como texto plano sin formato.";
$lang["set-oemail-code-tn"] = "N&uacute;mero de incidencia";
$lang["set-oemail-code-da"] = "Fecha y hora de creaci&oacute;n de la incidencia";
$lang["set-oemail-code-du"] = "Fehca y hora de actualizaci&oacute;n de la incidencia";
$lang["set-oemail-code-ts"] = "Asunto de la incidencia";
$lang["set-oemail-code-te"] = "Texto original de la incidencia";
$lang["set-oemail-code-u"] = "Nombre del usuario";
$lang["set-oemail-code-tu"] = "<b>REQUERIDO!</b> La actualizaci&oacute;n que se enviar&aacute; al usuario";
$lang["set-oemail-code-tc"] = "Departamento asignado";
$lang["set-oemail-code-tp"] = "Prioridad asignada";
$lang["set-oemail-db-enable"] = "Habilitar el env&iacute;o de mensajes";
$lang["set-oemail-db-name"] = "Nombre a mostrar";
$lang["set-oemail-db-email"] = "Direci&oacute;n de env&iacute;o";
$lang["set-oemail-db-remail"] = "Responder a la direcci&oacute;n";
$lang["set-oemail-db-tn-sub"] = "Asunto a mostrar en la apertura de incidencia";
$lang["set-oemail-db-tn-body"] = "Mensaje de notificaci&oacute;n de incidencia recibida";
$lang["set-oemail-db-tu-sub"] = "Asunto a mostrar en la actualizaci&oacute;n de incidencia";
$lang["set-oemail-db-tu-body"] = "Mensaje de notificaci&oacute;n de incidencia <b>actualizada</b>";
$lang["set-oemail-db-tp-sub"] = "Asunto a mostrar en la pausa de incidencia";
$lang["set-oemail-db-tp-body"] = "Mensaje de notificaci&oacute;n de incidencia <b>pausada</b>";
$lang["set-oemail-db-tc-sub"] = "Asunto a mostrar en el cierre de incidencia";
$lang["set-oemail-db-tc-body"] = "Mensaje de notificaci&oacute;n de incidencia <b>cerrada</b>";

// text on settings users page
$lang['set-users-title'] = 'Operadores';
$lang['set-users-title-desc'] = '<p>Los operadores pueden gestionar las incidencias de los departamentos que tienen asignados. Desde aqu&iacute; puede a&ntilde;adir, modificar o borrar operadores. A cada operador se le puede asignar un <b>rol</b>.<br />Por defecto debe existir al menos un usuario administrador. Los administradores tienen control completo del sistema, los supervisores pueden acceder a los informes y los operadores s&oacute;lo pueden gestionar entradas.</p>'; 
$lang['set-users-add-agent'] = 'A&ntilde;adir operador';
$lang['set-users-name'] = 'Nombre';

// text on settings A&ntilde;adir / edit user page
$lang['set-user-title'] = 'A&ntilde;adir operador';
$lang['set-user-notif'] = 'Notificaciones';
$lang['set-user-skill'] = 'Departamentos';
$lang['set-user-skill-desc'] = '<p>Mediante la asignaci&oacute;n de departamentos los agentes pueden gestionar las incidencias de los mismos: aceptar, actualizar, fusionar o eliminarlas.<br/>Las incidencias de los grupos no asignados ser&aacute;n visibles por el operador pero estar&aacute;n limitados a leer la incidenca y s&oacute;lo podr&aacute;n a&ntilde;adir notas internas para los operadores asignados al grupo.</p>';
$lang['set-user-db-un'] = 'Usuario';
$lang['set-user-db-pw'] = 'Contrase&ntilde;a';
$lang['set-user-db-fn'] = 'Nombre';
$lang['set-user-db-ln'] = 'Apellido(s)';
$lang['set-user-db-ea'] = 'Email';
$lang['set-user-db-role'] = 'Rol';
$lang['set-user-role-admin'] = 'Administrador';
$lang['set-user-role-super'] = 'Supervisor';
$lang['set-user-role-agent'] = 'Operador';
$lang['set-user-db-tn'] = 'Notificar al operador nuevas incidencias';
$lang['set-user-db-tu'] = 'Notificar al operador la actualizaci&oacute;n de una incidencia que tenga asignada';
$lang['set-user-db-pm'] = 'Notificar al operador cuando se a&ntilde;adan notas internas a las incidencias asignadas';

// text on settings edit user page
$lang['set-user-edit-title'] = 'Editar operador';
$lang['set-user-edit-pwres'] = 'Borrar Contrase&ntilde;a';

$lang["set-custom-db-fl"] = "Longitud";
$lang["set-custom-db-fl-error"] = "Se require un valor num&eacute;rico!. Introduzca un n&uacute;mero entre el 1 y el 255.";
$lang["set-custom-db-fo"] = "Opciones";

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