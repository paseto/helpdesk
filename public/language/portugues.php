<?php
// PHPLOCKITOPT NOENCODE
// PHPLOCKITOPT NOOBFUSCATE
// PHPLOCKITOPT NOSTRIPCOMMENTS
// PHPLOCKITOPT NOSTRIPWHITESPACE

// USER PAGES

// text on user navigation
$lang['u-nav-kb'] = 'Base de conhecimento';
$lang['u-nav-s-request'] = 'Abrir chamado';
$lang['u-nav-t-request'] = 'Consultar chamado';

// text on kb
$lang['u-kb-search'] = 'Pesquisar';
$lang['u-kb-search-na'] = '!Nenhum resultado encontrado';
$lang['u-kb-kb'] = 'Base de conhecimento';
$lang['u-kb-more'] = 'Mais';
$lang['u-kb-top-articles'] = 'Principais artigos';
$lang['u-kb-late-articles'] = 'Artigos mais recentes';

// text on kb article and search and group
$lang['u-kba-dateadd'] = 'Data adicionada';
$lang['u-kba-views'] = 'Visualizar';
$lang['u-kba-rating'] = 'Classificação';
$lang['u-kba-group'] = 'Grupo';

// text on user track ticket page
$lang['u-ticket-track-title'] = 'Consultar chamado';
$lang['u-ticket-track-t-em'] = 'Endereço de e-mail';
$lang['u-ticket-track-t-no'] = 'Número do chamado';
$lang['u-ticket-track-submit'] = 'Consultar';
$lang['u-ticket-track-error-req'] = '!Obrigatório endereço de e-mail e número do chamado';
$lang['u-ticket-track-error-inv-em'] = '!Endereço de e-mail inválido';
$lang['u-ticket-track-error-inv-no'] = '!Número de chamado inválido. O número do chamado deve conter somente números';
$lang['u-ticket-track-error-not-found'] = '!Endereço de e-mail e número de chamado não encontrados';

// text on ticket form and ticket success admin and user
$lang['ticket-add-title'] = 'Enviar chamado';
$lang['ticket-add-name'] = 'Nome';
$lang['ticket-add-email'] = 'Endereço de e-mail';
$lang['ticket-add-group'] = 'Grupo';
$lang['ticket-add-priority'] = 'Prioridade';
$lang['ticket-add-subject'] = 'Assunto';
$lang['ticket-add-msg'] = 'Mensagem';
$lang['ticket-add-files-add'] = 'Anexar arquivo';
$lang['ticket-add-files-ano'] = 'Anexar outro arquivo';
$lang['ticket-add-sec-code'] = 'Código de segurança';
$lang['ticket-add-sec-code-ent'] = 'Digite o código de segurança';
$lang['ticket-add-submit'] = 'Adicionar chamado';
$lang['ticket-add-success-new'] = 'Novo número de chamado';
$lang['ticket-add-success-breif'] = 'Detalhes do chamado incluindo o número enviado por e-mail';

// ADMINS PAGES
$lang['generic-404'] = '<p class="e404">Desculpe...</p><p class="e404">A página que você está procurando não pôde ser encontrada</p>';
$lang['generic-save'] = 'Enviar';
$lang['generic-change'] = 'Alterar';
$lang["generic-yes"] = "Sim";
$lang["generic-no"] = "Não";
$lang["generic-edit"] = "Editar";
$lang["generic-delete"] = "Apagar";
$lang['generic-enable'] = 'Habilitar';
$lang['generic-disable'] = 'Desabilitar';
$lang["generic-mark"] = "Marcar como padrão";
$lang["generic-unassigned"] = "Não atribuído";
$lang["generic-error"] = "! Campo obrigatório";
$lang['generic-error-number-req'] = '!Número obrigatório';
$lang['generic-error-invalid-em'] = '!Endereço de e-mail inválido';
$lang['generic-error-un-exists'] = '! Conta já em uso';
$lang['generic-error-pw-length'] = '! Senha precisa conter 6 ou mais caracteres';
$lang['generic-error-invalid-code'] = '! Código inválido';
$lang['generic-delete-warn'] = '! Não pode ser apagado até todos os chamados estarem liberados';
$lang['generic-delete-warn-article'] = '! Não pode ser apagado até todos os artigos estarem liberados';
$lang['generic-file-size-exc'] = '! O tamanho do arquivo excede o limite de carregamento, ou é um formato de arquivo inválido';
$lang['generic-file-size-rule'] = 'Tamanho do arquivo permitido';
$lang['generic-file-type-rule'] = 'Tipos de arquivos permitidos';
$lang['generic-success-u-add'] = 'Usuário adicionado com sucesso';
$lang['generic-success-u-edit'] = 'Usuário editado com sucesso';

// text on admin index page
$lang['index-login'] = 'Conectar-se';
$lang['index-username'] = 'Endereço de e-mail';
$lang['index-password'] = 'Senha';
$lang['index-langauge'] = 'idioma';
$lang['index-forgotpwd'] = 'Esqueceu sua senha?';
$lang['index-error'] = '! Nome de usuário ou senha incorretos';

// text on admin password reset page
$lang['pwreset-title'] = 'Redefinir senha';
$lang['pwreset-unknown-u'] = '! Nome de usuário não reconhecido';
$lang['pwreset-email-succ'] = '! Sucesso. <p>Um e-mail com sua nova senha foi enviado para o seu endereço de e-mail cadastrado</p>';
$lang['pwreset-email-fail'] = 'Falha no envio da nova senha por e-mail';

// text on header page
$lang['header-menu'] = 'MENU';
$lang['header-search'] = 'Pesquisar por ID, nome, assunto, etc';

// text on dashboard page
$lang['dash-title-activity'] = 'Atividade recentes';
$lang['dash-load-more'] = 'Carregar mais';
$lang['dash-avg-time'] = 'Avg. Resposta';
$lang['dash-activity-new'] = 'Apresentar um novo chamado';
$lang['dash-activity-change'] = 'Alterar chamado';
$lang['dash-activity-note'] = 'Adicionada uma nota no chamado';
$lang['dash-activity-closed'] = 'Encerrar chamado';
$lang['dash-activity-reply'] = 'Enviado uma resposta ao chamado';
$lang['dash-activity-rating'] = 'Chamado avaliado';
$lang['dash-activity-user-replied'] = 'Chamado respondido';
$lang['dash-activity-you'] = 'Você';
$lang['dash-activity-have'] = 'Receber';
$lang['dash-activity-has'] = 'Receber';

// text on admin tickets page
$lang['tickets-filter'] = 'Filtro';
$lang['tickets-refresh'] = 'Renovar';
$lang['tickets-ID'] = 'ID';
$lang['tickets-agents'] = 'Representante';
$lang['tickets-subject'] = 'Assunto';
$lang['tickets-dateadd'] = 'Data do Chamado';
$lang['tickets-dateadd-anytime'] = 'Qualquer horário';
$lang['tickets-dateadd-today'] = 'Hoje';
$lang['tickets-dateadd-yesterday'] = 'Ontem';
$lang['tickets-dateadd-thisweek'] = 'Essa semana';
$lang['tickets-dateadd-lastweek'] = 'Última semana';
$lang['tickets-dateadd-thismonth'] = 'Esse mês';
$lang['tickets-dateadd-lastmonth'] = 'Último mês';
$lang['tickets-dateup'] = 'Atualização de data';
$lang['tickets-group'] = 'Grupo';
$lang['tickets-group-desc'] = 'Selecionar grupos para exibir';
$lang['tickets-status'] = 'Situação';
$lang['tickets-status-accept'] = 'Aceitar';
$lang['tickets-status-open'] = 'Abrir';
$lang['tickets-status-pending'] = 'Pendente';
$lang['tickets-status-paused'] = 'Pausado';
$lang['tickets-status-closed'] = 'Encerrado';
$lang['tickets-status-delete'] = 'Excluído';
$lang['tickets-status-desc'] = 'Selecione a situação para visualizar';
$lang['tickets-priority'] = 'Prioridade';
$lang['tickets-owner'] = 'Proprietário';
$lang['tickets-sortby'] = 'Classificar por';
$lang['tickets-dir-asc'] = 'Crescente';
$lang['tickets-dir-dsc'] = 'Decrescente';
$lang['tickets-get-email'] = 'Obter e-mails';

// text on search
$lang['search-advanced'] = 'Busca avançada';
$lang['search-subject'] = 'Assunto';
$lang['search-msg'] = 'Conteúdo mensagem';
$lang['search-cust'] = 'Cliente';
$lang['search-any'] = 'Outros';
$lang['search-dateaddfrom'] = 'Data adicionada de';
$lang['search-dateaddto'] = 'Data adicionada para';
$lang['search-dateupfrom'] = 'Data de atualização de';
$lang['search-dateupto'] = 'Data de atualização para';
$lang['search-dateclosefrom'] = 'Data de encerramento de';
$lang['search-datecloseto'] = 'Data de encerramento para';
$lang['search-button-submit'] = 'Pesquisar';
$lang['search-button-reset'] = 'Reiniciar';
$lang['search-results'] = 'Resultados encontrados de';
$lang['search-no-results'] = 'Nenhum resultado encontrado de';
$lang['search-from'] = 'De';
$lang['search-added'] = 'Adicionado';
$lang['search-updated'] = 'Atualizado';
$lang['search-closed'] = 'Encerrado';

// text on reports
$lang['rep-filter'] = 'Relatório personalizado';
$lang['rep-report'] = 'Relatório';
$lang['rep-reset'] = 'Reiniciar';
$lang['rep-period'] = 'Período do relatório';
$lang['rep-period-from'] = 'Período do relatório de';
$lang['rep-period-to'] = 'Período do relatório para';
$lang['rep-graphic'] = 'Mostrar gráfico';
$lang['rep-no-data'] = 'Nenhum dado encontrado para critério de relatório';
$lang['rep-dd-ts'] = 'Resumo de chamado';
$lang['rep-dd-gl'] = 'Resumo do grupo';
$lang['rep-dd-cs'] = 'Satisfação do cliente';
$lang['rep-dd-st'] = 'Resumo da fonte';
$lang['rep-dd-tt'] = 'Tempo gasto';
$lang['rep-date-dd-cust'] = 'Personalizado';
$lang['rep-download'] = 'Download de arquivo como CSV';
$lang['rep-total'] = 'Total';
$lang['rep-feedback'] = 'Comentários';

// text on ticket page
$lang['ticket-details-title'] = 'Detalhes';
$lang['ticket-dateintrep'] = 'Data inicial respondida';
$lang['ticket-dateclosed'] = 'DData encerrada';
$lang['ticket-customfields'] = 'Campos personalizados';
$lang['ticket-fileuploads'] = 'Arquivos enviados';
$lang['ticket-status-closed'] = 'O chamado foi encerrado e não pode ser atualizado.';
$lang['ticket-status-notskill'] = 'Você não pertence ao grupo desejado. Você pode enviar um recado ao administrador.';
$lang['ticket-status-unassigned'] = 'O chamado não está atribuído. Para aceitar o chamado, clique em aceitar.';
$lang['ticket-status-notowner'] = 'O chamado não está atribuído a você. Você pode enviar um recado ao administrador ou você pode mudar o chamado para você mesmo para responder ao cliente.';
$lang['ticket-attachanother'] = 'Anexar outro';
$lang['ticket-status-dd-note'] = 'Marcar como privado.';
$lang['ticket-status-dd-update'] = 'Atualizar';
$lang['ticket-status-dd-pause'] = 'Pausar';
$lang['ticket-status-dd-close'] = 'Fechar';
$lang['ticket-show-detail'] = 'Mostrar detalhes'; // on user ticket page
$lang['ticket-rate'] = 'Avaliar'; // on user ticket page
$lang['ticket-rate-p'] = 'Positivo';
$lang['ticket-rate-neu'] = 'Neutro';
$lang['ticket-rate-neg'] = 'Negativo';

// text on user profile page
$lang['profile-last-log'] = 'Último login';
$lang['profile-chg-pwd'] = 'Alterar senha';
$lang['profile-cust-sat'] = 'Satisfação do cliente';
$lang['profile-tickets-own'] = 'Chamados próprios';
$lang['profile-chg-pwd-desc'] = 'Digite sua nova senha abaixo. Um e-mail será enviado confirmando sua nova senha.';
$lang['profile-chg-pwd-new'] = 'Nova senha';
$lang['profile-chg-pwd-confirm'] = 'Confirmar nova senha';
$lang['profile-chg-pwd-succes'] = '! Sucesso. <p>Um e-mail com sua nova senha foi enviado para o endereço de e-mail cadastrado.</p>';
$lang['profile-chg-pwd-succes-mail-sub'] = 'Senha alterada !';
$lang['profile-chg-pwd-succes-mail-body'] = 'Sua nova senha é';
$lang['profile-chg-pwd-fail'] = 'Falha ao enviar nova senha por e-mail';

// text on knowledge base page
$lang['kb-title'] = 'Base de conhecimento';
$lang['kb-enabled'] = 'Base de conhecimento está ativada';
$lang['kb-disabled'] = 'Base de conhecimento está desativada nas configurações > Base de conhecimento';
$lang['kb-db-aa-title'] = 'Adicionar artigo';
$lang['kb-db-ag-title'] = 'Adicionar grupo em Base de conhecimento';
$lang['kb-db-ag-title-desc'] = 'Adicionar um grupo para auxiliar os usuários a encontrarem artigos.';
$lang["kb-db-eg"] = 'Grupos de Base de conhecimento existentes';
$lang['kb-db-article-title'] = 'Título do artigo';
$lang['kb-db-article-group'] = 'Grupo do artigo';
$lang['kb-db-article-msg'] = 'Artigo';

// text on menu
$lang['nav-dashboard'] = 'Painel';
$lang['nav-tickets'] = 'Chamados';
$lang['nav-add'] = 'Adicionar';
$lang['nav-search'] = 'Procurar';
$lang['nav-view'] = 'Visualizar';
$lang['nav-knowledge'] = 'Base de conhecimento';
$lang["nav-knowledge-articles"] = 'Adicionar artigo';
$lang["nav-knowledge-groups"] = 'Gerenciar grupos';
$lang['nav-reports'] = 'Relatórios';
$lang['nav-set'] = 'Configurações';
$lang['nav-set-general'] = 'Geral';
$lang['nav-set-tickets'] = 'Chamados';
$lang["nav-set-knowledge"] = 'Base de conhecimento';
$lang['nav-set-groups'] = 'Grupos';
$lang['nav-set-priorities'] = 'Prioridades';
$lang['nav-set-custom'] = 'Campos personalizados';
$lang['nav-set-can'] = 'Resposta automática';
$lang['nav-set-inemail'] = 'E-mails recebidos';
$lang['nav-set-outemail'] = 'E-mails enviados';
$lang['nav-set-users'] = 'Usuários';
$lang['nav-set-profile'] = 'Perfil';
$lang['nav-set-logout'] = 'Sair';

// text on settings-general.php
$lang["set-general-title"] = "Geral";
$lang["set-general-db-cn"] = "Nome da empresa";
$lang["set-general-db-fl"] = "Idioma padrão";
$lang["set-general-db-tz"] = "Fuso horário";
$lang["set-general-db-df"] = "Formato de data";
$lang["set-general-db-rp"] = "Página em log on";

// text on settings-tickets.php
$lang["set-tickets-title"] = "Chamado";
$lang["set-tickets-db-an"] = "Nova atribuição de chamado";
$lang["set-tickets-db-an-desc"] = "Selecione se um novo chamado não está definido ou definido automaticamente a um usuário selecionado";
$lang["set-tickets-db-up"] = "Permitir que os usuários selecionem uma prioridade";
$lang["set-tickets-db-as"] = "Usar código matemático aleatório anti-spam para usuários";
$lang["set-tickets-db-rc"] = "Reabertura de chamados encerrados permitida";
$lang["set-tickets-db-tr"] = "Permitir avaliações de chamados";
$lang["set-tickets-db-fa"] = "Permitir anexos de chamados";
$lang["set-tickets-db-fa-desc0"] = "Número de arquivos anexos permitidos";
$lang["set-tickets-db-fa-desc1"] = "Caminho relativo de anexos permitidos";
$lang["set-tickets-db-fa-desc2"] = "Tamanho máximo de cada arquivo. Tamanho permitido para cada arquivo em megabytes (MB)";
$lang["set-tickets-db-fa-desc3"] = "Formatos de arquivos permitidos e.g. txt,doc,docx,xls,xlsx";

// text on settings-kb.php
$lang['set-kb-title'] = 'Base de conhecimento';
$lang['set-kb-title-desc'] = 'A base de conhecimento pode ser usada para responder perguntas frequentes (FAQ), evitando a necessidade de repetir as solicitações de suporte.';
$lang['set-kb-db-enkb'] = 'Habilitar base de conhecimento';
$lang['set-kb-db-cokb'] = 'Exibir contagem de páginas para cada artigo.';
$lang['set-kb-db-rakb'] = 'Permitir botão de avaliação para cada artigo.';
$lang['set-kb-db-apkb'] = 'Número de artigos a serem exibidos por grupo.';

// text on settings-priorites.php
$lang['set-priorities-title'] = 'Prioridade';
$lang['set-priorities-title-desc'] = '<p>As prioridades podem ser definidas para indicar a importância de um pedido.</p>';
$lang['set-priorities-db-ap'] = 'Adicionar priridade';
$lang['set-priorities-db-ap-desc'] = 'Inserir prioridade';
$lang['set-priorities-db-cp'] = 'Prioridades existentes';

// text on settings-groups.php
$lang['set-groups-title'] = 'Grupos';
$lang['set-groups-desc'] = '<p>Por padrão pelo menos um grupo deve existir. Os grupos permitem agrupar os seus chamados nos grupos desejados.</p><p>Para que os usuários editem um chamado dentro de um grupo, eles devem ser qualificados. Se um usuário não é qualificado em um grupo, ele poderá apenas adicionar observações. Para qualificar um usuário vá em Configurações de usuários.</p>';
$lang['set-groups-add'] = 'Adicionar grupo';
$lang['set-groups-enter'] = 'Inserir novo grupo';
$lang['set-groups-exist'] = 'Grupos existentes';

$lang["set-groups-db-ie"] = "Nenhum endereço de e-mail de entrada está configurado para este grupo <a href=\"#\">Editar</a>";
$lang["set-groups-db-sl"] = "Definir SLA para grupo";
$lang["set-groups-db-rb"] = "Responder por";
$lang["set-groups-db-fb"] = "Fixar por";

// text on settings-customfields.php
$lang["set-custom-title"] = "Campos personalizados";
$lang["set-custom-title-desc"] = "<p>Um campo ilimitado de números de campos personalizados pode ser adicionado para coletar informações adicionais dos usuários.</p><p>Os campos personalizados aparecerão antes do campo do assunto.</p>";
$lang["set-custom-db-af"] = "Adicionar campo personalizado";
$lang["set-custom-db-ef"] = "Campos personalizados existentes";
$lang["set-custom-db-fn"] = "Nome do campo";
$lang["set-custom-db-fn-error"] = "O nome personalizado do campo já existe";
$lang["set-custom-db-fn-sql-error"] = "Erro! O campo personalizado não pode ser adicionado. Por favor tente outro nome de campo";
$lang["set-custom-db-ft"] = "Tipo de campo";
$lang["set-custom-db-fr"] = "Campo requerido";
$lang["set-custom-db-fl"] = "Comprimento máximo do campo";
$lang["set-custom-db-fl-error"] = "Valor numérico necessário!. Insira um número entre 1 e 255.";
$lang["set-custom-db-fo"] = "Opções de campo";
$lang["set-custom-db-fo-desc"] = "(Separar cada opção com vírgula).";

// text on settings-canned.php
$lang["set-canned-title"] = "Respostas filtradas";
$lang["set-canned-title-desc"] = "Respostas filtradas são respostadas usadas frequentemente. Aqui você pode adicionar e gerenciar suas respostas filtradas. Estas respostas podem ser usadas para economizar tempo, sem precisar reescrever a mesma mensagem repetidamente.";
$lang["set-canned-db-ac"] = "Adicionar mensagem filtrada";
$lang["set-canned-db-ec"] = "Mensagens filtradas existentes";
$lang["set-canned-db-ct"] = "Título";
$lang["set-canned-db-cm"] = "Mensagem filtrada";

// text on settings-iemail.php
$lang["set-iemail-title"] = "E-mail de entrada para chamados";
$lang["set-iemail-title-desc"] = "Converta seus e-mails recebidos em chamados ou atualize os chamados existentes. O ID do chamado deve ser incluído no cabeçalho";
$lang['set-iemail-manual'] = 'Permitir a recuperação manual de e-mails de entrada.';
$lang['set-iemail-manual-warn'] = 'Not recommended if cron job setup for automatic retrieval.';
$lang['set-iemail-add-acc'] = 'Adicionar conta';
$lang['set-iemail-exist-title'] = 'Endereços de e-mail existentes';
$lang['set-iemail-exist-test'] = 'Teste';
$lang['set-iemail-exist-act'] = 'Conexão bem sucedida';
$lang['set-iemail-exist-dec'] = 'Conexão fallhou. Verificar configurações de conta';
$lang['set-iemail-exist-en'] = 'Conta ativada';
$lang['set-iemail-exist-dis'] = 'Conta desativada';
$lang['set-iemail-add-title'] = 'Conta de endereço de e-mail';
$lang["set-iemail-db-ea"] = "Endereço de e-mail";
$lang["set-iemail-db-ho"] = "Endereço do host";
$lang["set-iemail-db-pn"] = "Número da porta";
$lang["set-iemail-db-pr"] = "Protocolo";
$lang["set-iemail-db-ssl"] = "SSL";
$lang["set-iemail-db-tls"] = "TLS";
$lang["set-iemail-db-vc"] = "Validar certificado";
$lang["set-iemail-db-af"] = "Pasta da conta";
$lang["set-iemail-db-au"] = "Usuário da conta";
$lang["set-iemail-db-ap"] = "Senha da conta";
$lang["set-iemail-db-tg"] = "Grupo";
$lang["set-iemail-db-tp"] = "Prioridade";
$lang['set-iemail-db-na'] = '! Nenhum endereço de e-mail configurado';

// text on settings-oemail.php
$lang["set-oemail-title"] = "Notificação de e-mail";
$lang["set-oemail-title-desc"] = "Personalize o e-mail automatizado para novos, atualizados, pausados e fechados. Os códigos a seguir podem ser usados para inserir dados de chamado. Os e-mails são enviados em formato de texto sem formatação.";
$lang["set-oemail-code-tn"] = "O número do chamado";
$lang["set-oemail-code-da"] = "A data e a hora em que o chamado foi adicionado";
$lang["set-oemail-code-du"] = "A data e a hora em que o chamado foi atualizado";
$lang["set-oemail-code-ts"] = "O assunto do chamado";
$lang["set-oemail-code-te"] = "O pedido de chamado original";
$lang["set-oemail-code-u"] = "O nome do usuário";
$lang["set-oemail-code-tu"] = "REQUERIDOS! A atualização a ser enviada por e-mail";
$lang["set-oemail-code-tc"] = "o grupo atribuído";
$lang["set-oemail-code-tp"] = "A prioridade atribuída";
$lang["set-oemail-db-enable"] = "Ativar e-mail de saída";
$lang["set-oemail-db-name"] = "Mostrar nome";
$lang["set-oemail-db-email"] = "Endereço de e-mail";
$lang["set-oemail-db-remail"] = "Responder ao endereço de e-mail";
$lang["set-oemail-db-tn-sub"] = "Novo assunto de chamado";
$lang["set-oemail-db-tn-body"] = "Novo texto de e-mail de chamado";
$lang["set-oemail-db-tu-sub"] = "Assunto de chamado atualizado";
$lang["set-oemail-db-tu-body"] = "Texto de chamado atualizado";
$lang["set-oemail-db-tp-sub"] = "Assunto de chamado pausado";
$lang["set-oemail-db-tp-body"] = "Texto de chamado pausado";
$lang["set-oemail-db-tc-sub"] = "Assunto de chamado encerrado";
$lang["set-oemail-db-tc-body"] = "texto de chamado encerrado";

// text on settings users page
$lang['set-users-title'] = 'Representante / Usuário';
$lang['set-users-title-desc'] = '<p>Agentes podem gerenciar chamados nos seus grupos qualificados. Você pode adicionar, editar e excluir usuários. Cada usuário pode ser atribuído uma função. Deve exisitir pelo menos um usuário administrador. Administradores tem total controle, supervisores podem acessar relatórios e representantes podem somente gerenciar chamados.</p>'; 
$lang['set-users-add-agent'] = 'Adicionar usuário / Representante';
$lang['set-users-name'] = 'Nome';

// text on settings add / edit user page
$lang['set-user-title'] = 'Adicionar usuário / Representante';
$lang['set-user-notif'] = 'Notificações';
$lang['set-user-skill'] = 'Habilidades';
$lang['set-user-skill-desc'] = '<p>Selecionando os grupos em que os representantes estão qualificados, estes podem aceitar, atualizar, mesclar, excluir chamados no grupo selecionado.</p><p>Grupos não selecionados serão visíveis pelo representante, mas eles serão restritos para adicionar apenas notas a um chamado no grupo não selecionado.</p>';
$lang['set-user-db-un'] = 'Nome de usuário';
$lang['set-user-db-pw'] = 'Senha';
$lang['set-user-db-fn'] = 'Nome completo';
$lang['set-user-db-ln'] = 'Último nome';
$lang['set-user-db-ea'] = 'Endereço de e-mail';
$lang['set-user-db-role'] = 'Função';
$lang['set-user-role-admin'] = 'Administrador';
$lang['set-user-role-super'] = 'Supervisor';
$lang['set-user-role-agent'] = 'Representate';
$lang['set-user-db-not-tn'] = 'Notificar representantes de novos chamados';
$lang['set-user-db-tu'] = 'Notificar o representante quando um chamado atribuído à ele for atualizado';
$lang['set-user-db-pm'] = 'Notificar um representante sobre mensagens privadas adicionadas ao chamado atribuído';

// text on settings edit user page
$lang['set-user-edit-title'] = 'Editar representante / Usuário';
$lang['set-user-edit-pwres'] = 'Redefinir senha';

// version 1.1
$lang['set-oemail-db-method-mail'] = 'PHP Mail Function';
$lang['set-oemail-db-method-smtp'] = 'SMTP Server';
$lang['set-oemail-db-smtp-host'] = 'SMTP Server Address';
$lang['set-oemail-db-smtp-auth'] = 'SMTP Authenticate';
$lang['set-oemail-db-smtp-user'] = 'SMTP User';
$lang['set-oemail-db-smtp-pass'] = 'SMTP Password';
$lang['set-oemail-db-smtp-encr'] = 'Encryption';
$lang['set-oemail-db-smtp-port'] = 'SMTP Port';

$lang['set-kb-db-aukb'] = 'Exibir o autor da base de conhecimento no artigo?';

$lang['dash-group-sum'] = 'Resumo do grupo';
$lang['dash-group-table-text'] = 'Clique na quantidade para visualizar por grupo e estado de chamados';

$lang["set-tickets-db-tv"] = 'Visualizar chamado';
$lang["set-tickets-db-tv-opt1"] = 'Últimos na parte inferior';
$lang["set-tickets-db-tv-opt2"] = 'Últimos na parte superior';

$lang["set-tickets-db-trp"] = 'Formulário de resposta do chamado';
$lang["set-tickets-db-trp-opt1"] = 'Topo da página';
$lang["set-tickets-db-trp-opt2"] = 'Parte inferior da página';

$lang['tickets-viewby'] = 'Exibir por';
$lang['tickets-viewby-opt1'] = 'Expandido';
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
$lang['ticket-status-acceptby'] = 'Aceito por';
$lang['ticket-status-chg-status'] = 'Ticket status changed from';
$lang['ticket-status-chg-group'] = 'Ticket group changed from';
$lang['ticket-status-chg-owner'] = 'Owner changed from';
$lang['ticket-status-chg-priority'] = 'Ticket priority changed from';
$lang['ticket-status-chg-to'] = 'to';
$lang['ticket-forward'] = 'Encaminhar';
$lang['ticket-forward-to'] = 'Forward ticket to 3rd party';
$lang['ticket-forwarded-to-3rd-party'] = 'Forwarded to 3rd party';
$lang['ticket-forwarded-to'] = 'Encaminhar para:';
$lang['ticket-time-spent'] = 'Tempo gasto em minutos (h:mm)';
$lang['ticket-duration'] = 'Duração';
$lang['ticket-merge'] = 'Merge Ticket';
$lang['ticket-merge-detail'] = 'Merge ticket selected with the following:';
$lang['ticket-merge-na'] = 'No results found';
$lang['ticket-merge-closed'] = 'Ticket ID closed and cannot be merged';
$lang['ticket-status-collide'] = 'está com este chamado em aberto';
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
$lang['profile-teleno'] = 'Telephone number';
$lang['profile-date-add'] = 'Date created';
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
$lang['tickets-status-ar'] = "Aguardando Resposta";

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
$lang['generic-settings-saved'] = 'Configurações salvas!';
$lang['generic-error-required-fields'] = 'Preencha todos os campos obrigatórios (*)';
$lang['generic-error-cancel'] = 'Cancelar alterações';
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
//$lang['u-kb-nakb'] = "No knowledge base groups or articles currently available";
$lang['u-kb-nakb'] = "";

$lang['u-access-title'] = "Acessar Help Desk";
$lang['u-access-error'] = "Conta não encontrada ou usuário não habilitado. Entre em contato com o administrador.";
$lang['u-access-disabled'] = "Conta desabilitada";
$lang['u-signin'] = "Acessar";
$lang['u-register-user'] = "Registrar conta";
$lang['u-guest'] = "Acessar como convidado";
$lang['u-guest-desc'] = "Don't have an account with us? Submit and track a ticket without registering.";
$lang['u-guest-link'] = "Continuar como convidado";

$lang['ticket-add-pwd'] = "Senha";
$lang['u-nav-dashboard'] = "Meus Chamados";
$lang['u-nav-profile'] = "Meu Perfil";
$lang['u-nav-logout'] = "Sair";

$lang['u-dashboard'] = 'Dashboard';
$lang['u-dashboard-sub'] = 'Assunto';
$lang['u-dashboard-stat'] = 'Status';
$lang['u-dashboard-da'] = 'Adicionado em';
$lang['u-dashboard-du'] = 'Atualizado em';
$lang['u-dashboard-not'] = 'Sem chamados disponíveis.';

$lang['u-profile'] = 'Perfil';

$lang['u-register-title'] = 'Registrar';
$lang['u-register-name'] = 'Full name';
$lang['u-register-email'] = 'Endereço de email';
$lang['u-register-tele'] = 'Telefone';
$lang['u-register-pwd'] = 'Senha';
$lang['u-register-cpwd'] = 'Confirmar senha';
$lang['u-register-btn'] = 'Salvar';

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