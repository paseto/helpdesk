<?php
// PHPLOCKITOPT NOENCODE
// PHPLOCKITOPT NOOBFUSCATE
// PHPLOCKITOPT NOSTRIPCOMMENTS
// PHPLOCKITOPT NOSTRIPWHITESPACE

// USER PAGES

// text on user navigation
$lang['u-nav-kb'] = 'BASE DE CONNAISSANCES';
$lang['u-nav-s-request'] = 'OUVRIR UN TICKET';
$lang['u-nav-t-request'] = 'MES TICKETS';

// text on kb
$lang['u-kb-search'] = 'Rechercher';
$lang['u-kb-search-na'] = 'Aucun résultat trouvé';
$lang['u-kb-kb'] = 'Base de connaissances';
$lang['u-kb-more'] = 'Plus';
$lang['u-kb-top-articles'] = 'Top Articles';
$lang['u-kb-late-articles'] = 'Derniers Articles';

// text on kb article and search and group
$lang['u-kba-dateadd'] = 'Ajouté le';
$lang['u-kba-views'] = 'Vues';
$lang['u-kba-rating'] = 'Evaluation';
$lang['u-kba-group'] = 'Groupe';

// text on user track ticket page
$lang['u-ticket-track-title'] = 'Mes Tickets';
$lang['u-ticket-track-t-em'] = 'Adresse E-mail';
$lang['u-ticket-track-t-no'] = 'Ticket n°';
$lang['u-ticket-track-submit'] = 'Rechercher';
$lang['u-ticket-track-error-req'] = 'Le numéro de ticket et une adresse mail sont requis';
$lang['u-ticket-track-error-inv-em'] = 'Adresse email invalide !';
$lang['u-ticket-track-error-inv-no'] = 'Numéro de ticket invalide. Veuillez saisir un nombre';
$lang['u-ticket-track-error-not-found'] = 'Aucun ticket ne correspond à votre demande';

// text on ticket form and ticket success admin and user
$lang['ticket-add-title'] = 'Créer un nouveau ticket';
$lang['ticket-add-name'] = 'Nom';
$lang['ticket-add-email'] = 'Adresse E-mail';
$lang['ticket-add-group'] = 'Groupe';
$lang['ticket-add-priority'] = 'Priorité';
$lang['ticket-add-subject'] = 'Sujet';
$lang['ticket-add-msg'] = 'Message';
$lang['ticket-add-msg-add'] = 'Répondre';
$lang['ticket-add-files-add'] = 'Document joint';
$lang['ticket-add-files-ano'] = 'Ajouter un autre document';
$lang['ticket-add-sec-code'] = 'Code de sécurité';
$lang['ticket-add-sec-code-ent'] = 'entrez le code';
$lang['ticket-add-submit'] = 'Envoyer';
$lang['ticket-add-success-new'] = 'Ticket N°';
$lang['ticket-add-success-breif'] = 'Les détails de votre ticket ont été envoyés à ';
$lang['ticket-new-no'] = 'Nouveau ticket n°';
$lang['ticket-new-submit'] = 'en attente d\'intervention';
$lang['ticket-new-link'] = 'Vous pouvez consulter les tickets en cours';
$lang['ticket-new-page'] = 'sur cette page';
$lang['ticket-add-error'] = 'Certains champs obligatoires sont vides! Veuillez les compléter.';
$lang['ticket-add-msg-error'] = 'Votre message ne doit pas être vide !';

// text rating
$lang['u-ticket-rate-neutral'] = 'Neutre';
$lang['u-ticket-rate-negative'] = 'Négative';
$lang['u-ticket-rate-positive'] = 'Positive';
$lang['u-ticket-rate-eval'] = 'L\'intervention a été jugée';


// ADMINS PAGES
$lang['generic-404'] = '<p class="e404">Désolé...</p><p class="e404">La page demandée n\'existe pas</p>';
$lang['generic-save'] = 'Enregistrer';
$lang['generic-change'] = 'Modifier';
$lang['generic-cancel'] = 'Annuler';
$lang["generic-yes"] = "Oui";
$lang["generic-no"] = "Non";
$lang["generic-edit"] = "Editer";
$lang["generic-delete"] = "Supprimer";
$lang['generic-enable'] = 'Activer';
$lang['generic-disable'] = 'Désactiver';
$lang["generic-mark"] = "Sélectionner par défaut";
$lang["generic-unassigned"] = "Non-assigné";
$lang["generic-error"] = "Ce champ est requis !";
$lang['generic-error-number-req'] = 'Numéro requis !';
$lang['generic-error-invalid-em'] = 'Adresse email invalide !';
$lang['generic-error-un-exists'] = 'Ce nom est déjà utilisé';
$lang['generic-error-pw-length'] = 'Votre mot de passe doit contenir 6 caractères au minimum';
$lang['generic-error-invalid-code'] = 'Code invalide';
$lang['generic-delete-warn'] = 'Vous ne pouvez supprimer cet élément tant qu\'il a des tickets associés';
$lang['generic-delete-warn-article'] = 'Vous ne pouvez supprimer cet élément tant qu\'il a des articles associés';
$lang['generic-file-size-exc'] = 'La pièce-jointe dépasse la taille maximum';
$lang['generic-succes-update'] = 'Modification enregistrée avec succès !';
$lang['generic-error-update'] = 'Echec de la modification';
$lang['generic-success-u-te'] = 'Le technicien';
$lang['generic-success-u-add'] = 'a été ajouté avec succès';
$lang['generic-success-u-edit'] = 'a été modifié avec succès';
$lang['generic-error-no-results'] = 'Aucun résultat ne correspond à votre recherche';

// text on admin index page
$lang['index-login'] = 'Connexion';
$lang['index-username'] = 'Login';
$lang['index-password'] = 'Mot de passe';
$lang['index-language'] = 'langage';
$lang['index-forgotpwd'] = 'Mot de passe oublié ?';
$lang['index-error'] = '! Login ou Mot de passe incorrect';

// text on admin password reset page
$lang['pwreset-title'] = 'Réinitialiser le Mot de passe';
$lang['pwreset-unknown-u'] = 'Login inconnu !';
$lang['pwreset-email-succ'] = 'Mot de passe reinitialisé avec succès. <p>Votre nouveau mot de passe vous a été envoyé</p>';
$lang['pwreset-email-fail'] = 'Echec de l\'envoi';

// text on header page
$lang['header-menu'] = 'MENU';
$lang['header-search'] = 'Rechercher par ID, Nom, Sujet, etc';

// text on dashboard page
$lang['dash-title-activity'] = 'Activité récente';
$lang['dash-load-more'] = 'Voir plus';
$lang['dash-avg-time'] = 'Avg. Response';
$lang['dash-activity-new'] = 'a soumis un nouveau ticket';
$lang['dash-activity-change'] = 'a modifié le ticket';
$lang['dash-activity-note'] = 'a ajouté un message privé au ticket';
$lang['dash-activity-closed'] = 'a fermé le ticket';
$lang['dash-activity-reply'] = 'a envoyé une réponse au ticket';
$lang['dash-activity-rating'] = 'a évalué le ticket';
$lang['dash-activity-user-replied'] = 'a répondu au ticket';
$lang['dash-activity-you'] = 'Vous';
$lang['dash-activity-have'] = 'avez';
$lang['dash-activity-has'] = 'a';

// text on admin tickets page
$lang['tickets-filter'] = 'Filtres';
$lang['tickets-refresh'] = 'Rafraichir';
$lang['tickets-ID'] = 'ID';
$lang['tickets-agents'] = 'Techniciens';
$lang['tickets-subject'] = 'Sujet';
$lang['tickets-dateadd'] = 'Date de création';
$lang['tickets-dateadd-anytime'] = 'Toutes';
$lang['tickets-dateadd-today'] = 'Aujourd\'hui';
$lang['tickets-dateadd-yesterday'] = 'Hier';
$lang['tickets-dateadd-thisweek'] = 'Cette semaine';
$lang['tickets-dateadd-lastweek'] = 'Semaine dernière';
$lang['tickets-dateadd-thismonth'] = 'Ce mois';
$lang['tickets-dateadd-lastmonth'] = 'Le mois dernier';
$lang['tickets-dateup'] = 'Mis à jour';
$lang['tickets-group'] = 'Catégorie';
$lang['tickets-group-desc'] = 'Cliquez pour ajouter un groupe';
$lang['tickets-status'] = 'Statut';
$lang['tickets-status-accept'] = 'Accepter';
$lang['tickets-status-open'] = 'Ouvert';
$lang['tickets-status-pending'] = 'En attente';
$lang['tickets-status-paused'] = 'En pause';
$lang['tickets-status-closed'] = 'Fermé';
$lang['tickets-status-delete'] = 'Supprimé';
$lang['tickets-status-desc'] = 'Cliquez pour ajouter un statut';
$lang['tickets-priority'] = 'Priorité';
$lang['tickets-owner'] = 'Technicien';
$lang['tickets-sortby'] = 'Trier par';
$lang['tickets-dir-asc'] = 'Ascendant';
$lang['tickets-dir-dsc'] = 'Descendant';
$lang['tickets-get-email'] = 'Emails -> Tickets';

// text on search
$lang['search-advanced'] = 'Recherche Avancée';
$lang['search-subject'] = 'Sujet';
$lang['search-msg'] = 'Contenu du message';
$lang['search-cust'] = 'Client';
$lang['search-any'] = 'Tous';
$lang['search-dateaddfrom'] = 'Ajouté depuis le';
$lang['search-dateaddto'] = 'Ajouté jusqu\'au';
$lang['search-dateupfrom'] = 'Mis à jour depuis le';
$lang['search-dateupto'] = 'Mis à jour jusqu\'au';
$lang['search-dateclosefrom'] = 'Fermé depuis le';
$lang['search-datecloseto'] = 'Fermé jusqu\'au';
$lang['search-button-submit'] = 'rechercher';
$lang['search-button-reset'] = 'Réinitialiser';
$lang['search-results'] = 'résultats trouvés pour';
$lang['search-no-results'] = 'Aucun résultats trouvés pour';
$lang['search-from'] = 'depuis';
$lang['search-added'] = 'Ajouté';
$lang['search-updated'] = 'Mis à jour';
$lang['search-closed'] = 'Fermé';

// text on reports
$lang['rep-filter'] = 'Rapports';
$lang['rep-report'] = 'Choix des données';
$lang['rep-reset'] = 'Ré-initialiser';
$lang['rep-period'] = 'Choix de la période';
$lang['rep-period-from'] = 'Rapport depuis le';
$lang['rep-period-to'] = 'Jusqu\'au';
$lang['rep-graphic'] = 'Voir le graphique';
$lang['rep-no-data'] = 'Aucune donnée trouvée avec ces critères';
$lang['rep-dd-ts'] = 'Tickets';
$lang['rep-dd-as'] = 'Techniciens';
$lang['rep-dd-gs'] = 'Catégories';
$lang['rep-dd-gl'] = 'Répartition par catégories';
$lang['rep-dd-cs'] = 'Satisfaction clientèle';
$lang['rep-dd-st'] = 'Type de source';
$lang['rep-date-dd-cust'] = 'Choisir...';
$lang['rep-download'] = 'Télécharger au format csv';
$lang['rep-total'] = 'Total';
$lang['rep-feedback'] = 'Retour';
$lang['rep-submit'] = 'Voir le rapport';
$lang['rep-title'] = 'Rapport des';

// text on ticket page
$lang['ticket-details-title'] = 'Details';
$lang['ticket-dateintrep'] = 'Réponse initiale';
$lang['ticket-dateclosed'] = 'Fermeture';
$lang['ticket-customfields'] = 'Champs personnalisés';
$lang['ticket-fileuploads'] = 'Fichiers joints';
$lang['ticket-status-closed'] = 'Ce ticket est fermé et ne peut plus être modifié.';
$lang['ticket-status-closed-br'] = 'Ce ticket est fermé mais peut être réouvert.';
$lang['ticket-status-notskill'] = 'Vous n\'êtes pas inscrit dans ce groupe. Veuillez envoyer un message privé à l\'administrateur.';
$lang['ticket-status-unassigned'] = 'Ce ticket n\'est pas encore assigné. Cliquez ici pour y répondre';
$lang['ticket-status-notowner'] = 'Ce ticket ne vous est pas assigné. Vous pouvez envoyer un message privé au propriétaire.';
$lang['ticket-attachanother'] = 'Ajouter un autre document';
$lang['ticket-status-dd-note'] = 'Message privé';
$lang['ticket-status-dd-update'] = 'Mettre à jour';
$lang['ticket-status-dd-pause'] = 'Pause';
$lang['ticket-status-dd-close'] = 'Fermer';
$lang['ticket-show-detail'] = 'Détails'; // on user ticket page
$lang['ticket-rate-title'] = 'Mon avis'; // on user ticket page
$lang['ticket-rate'] = 'L\'intervention a été'; // on user ticket page
$lang['ticket-rate-p'] = 'Positive';
$lang['ticket-rate-neu'] = 'Neutre';
$lang['ticket-rate-neg'] = 'Négative';
$lang['ticket-required'] = 'Tous les champs marqués d\'une * sont requis';
$lang['ticket-canned-select'] = 'Modèles de réponse';
$lang['merge_tickets'] = 'Fusionner ce ticket';
$lang['merge_added'] = 'Ajouté le';
$lang['merge_with'] = 'Fusionner ce ticket avec';
$lang['merge_error_1'] = 'Un ticket ne peut être fusionné avec lui-même';

// text on user profile page
$lang['profile-last-log'] = 'Dernière connexion le';
$lang['profile-chg-pwd'] = 'Changer de mot de passe';
$lang['profile-cust-sat'] = 'Satisfaction clients';
$lang['profile-tickets-own'] = 'Mes tickets';
$lang['profile-chg-pwd-desc'] = 'Entrez votre nouveau mot de passe ci-dessous. Un email de confirmation vous sera envoyé';
$lang['profile-chg-pwd-new'] = 'Nouveau mot de passe';
$lang['profile-chg-pwd-confirm'] = 'Confirmez le mot de passe';
$lang['profile-chg-pwd-succes'] = 'Votre mot de passe a été modifié avec succès. <p>Un email vous a été envoyé.</p>';
$lang['profile-chg-pwd-succes-mail-sub'] = 'Mot de passe modifié !';
$lang['profile-chg-pwd-succes-mail-body'] = 'Votre nouveau mot de passe est';
$lang['profile-chg-pwd-fail'] = 'Echec lors de l\'envoi de l\'email';
$lang['profile-chg-pwd-succes-regards'] = 'Cordialement,';

// text on knowledge base page
$lang['kb-title'] = 'Base de connaissances';
$lang['kb-enabled'] = 'La base de connaissances est activée';
$lang['kb-disabled'] = 'La base de connaissances est actuellement désactivée, voir Paramètres > Base de connaissances';
$lang['kb-db-aa-title'] = 'Ajouter un article';
$lang['kb-db-ag-title'] = 'Ajouter une rubrique à la base de connaissances';
$lang['kb-db-ag-title-desc'] = 'Permet de classer les articles par rubrique pour faciliter la recherche.';
$lang["kb-db-eg"] = 'Rubriques existantes';
$lang['kb-db-article-title'] = 'Titre de l\'article';
$lang['kb-db-article-group'] = 'Titre de la rubrique';
$lang['kb-db-article-msg'] = 'Article';
$lang['kb-gp-error'] = 'Veuillez commencer par créer une rubrique';

// text on menu
$lang['nav-dashboard'] = 'Tableau de Bord';
$lang['nav-tickets'] = 'Tickets';
$lang['nav-add'] = 'Ajouter';
$lang['nav-search'] = 'Rechercher';
$lang['nav-view'] = 'Voir';
$lang['nav-knowledge'] = 'Base de connaissances';
$lang["nav-knowledge-articles"] = 'Ajouter un Article';
$lang["nav-knowledge-groups"] = 'Ajouter une rubrique';
$lang['nav-reports'] = 'Rapports';
$lang['nav-set'] = 'Paramètres';
$lang['nav-set-general'] = 'Général';
$lang['nav-set-tickets'] = 'Tickets';
$lang["nav-set-knowledge"] = 'Base de connaissances';
$lang['nav-set-groups'] = 'Groupes';
$lang['nav-set-priorities'] = 'Priorités';
$lang['nav-set-custom'] = 'Champs personnalisés';
$lang['nav-set-can'] = 'Réponses types';
$lang['nav-set-inemail'] = 'Emails entrants';
$lang['nav-set-outemail'] = 'Emails sortants';
$lang['nav-set-users'] = 'Techniciens';
$lang['nav-set-profile'] = 'Profil';
$lang['nav-set-logout'] = 'Déconnexion';

// text on settings-general.php
$lang["set-general-title"] = "Général";
$lang["set-general-db-cn"] = "Nom du site";
$lang["set-general-db-su"] = "Url du site (avec le / final)";
$lang["set-general-db-fl"] = "Langage par défaut";
$lang["set-general-db-tz"] = "Timezone";
$lang["set-general-db-df"] = "Format de date";
$lang["set-general-db-rp"] = "Page par défaut";

// text on settings-tickets.php
$lang["set-tickets-title"] = "Ticket";
$lang["set-tickets-db-an"] = "Assignation des nouveaux tickets";
$lang["set-tickets-db-an-desc"] = "Choisissez si les nouveaux tickets doivent être assignés automatiquement ou non";
$lang["set-tickets-db-up"] = "Autoriser les clients à choisir la priorité";
$lang["set-tickets-db-as"] = "Utiliser l'antispam mathématique";
$lang["set-tickets-db-rc"] = "Permettre la ré-ouverture de tickets fermés";
$lang["set-tickets-db-tr"] = "Activer le vote des clients";
$lang["set-tickets-db-fa"] = "Permettre l'upload de fichiers joints";
$lang["set-tickets-db-fa-desc1"] = "Chemin relatif du dossier de stockage des fichiers joints:";
$lang["set-tickets-db-fa-desc2"] = "Taille maximum autorisée (Taille autorisée pour chaque fichier en megabytes (MB))";

// text on settings-kb.php
$lang['set-kb-title'] = 'Base de connaissances';
$lang['set-kb-title-desc'] = 'Une base de connaissances permet de répondre aux questions les plus courantes (FAQ), ceci dans le but de limiter les demandes de support.';
$lang['set-kb-db-enkb'] = 'Activer la base de connaissances';
$lang['set-kb-db-cokb'] = 'Afficher le compteur pour chaque page.';
$lang['set-kb-db-rakb'] = 'Autoriser le vote pour chaque article.';
$lang['set-kb-db-apkb'] = 'Nombre d\'articles à afficher par rubrique.';
$lang['set-kb-db-add'] = 'Ajouter une rubrique';
$lang['set-kb-db-enter'] = 'Nom de la rubrique';

// text on settings-priorites.php
$lang['set-priorities-title'] = 'Priorités';
$lang['set-priorities-title-desc'] = '<p>Les priorités permettent de déterminer l\'urgence du ticket.</p>';
$lang['set-priorities-db-ap'] = 'Ajouter une priorité';
$lang['set-priorities-db-ap-desc'] = 'Nom de la priorité';
$lang['set-priorities-db-cp'] = 'Priorités existantes';
$lang["edit-priorities-db-ap"] = 'Renommer la priorité';

// text on settings-groups.php
$lang['set-groups-title'] = 'Groupes';
$lang['set-groups-desc'] = '<p>Un groupe est obligatoire au minimum. Les groupes permettent de rassembler les tickets par type de demande.</p><p>Les techniciens ne peuvent répondre qu\'aux tickets appartenant à leurs groupes respectifs. Si un technicien n\'est pas inscrit dans ce groupe, il pourra uniquement ajouter un message privé. Pour associer un technicien à un groupe, voir dans Paramètres -> Techniciens.</p>';
$lang['set-groups-add'] = 'Ajouter un groupe';
$lang['set-groups-enter'] = 'Nom du groupe';
$lang['set-groups-exist'] = 'Groupes existants';
$lang['group-nb'] = 'Nombre de tickets dans ce groupe';
$lang["set-groups-db-ie"] = "Aucune adresse email entrante n\'est configurée pour ce groupe <a href=\"#\">Editer</a>";
$lang["set-groups-db-sl"] = "Set SLA for group";
$lang["set-groups-db-rb"] = "Reply By";
$lang["set-groups-db-fb"] = "Fix By";

// text on settings-customfields.php
$lang["set-custom-title"] = "Champs personnalisés";
$lang["set-custom-title-desc"] = "<p>Vous pouvez ajouter autant de champs personnalisés que nécessaire pour obtenir des renseignements de la part de vos clients.</p><p>Les champs personnalisés apparaitront juste sous le sujet.</p>";
$lang["set-custom-db-af"] = "Ajouter un champ personnalisé";
$lang["set-custom-db-ef"] = "Champs personnalisés existants";
$lang["set-custom-db-fn"] = "Nom du champ";
$lang["set-custom-db-fn-error"] = "Ce nom de champ est déjà utilisé";
$lang["set-custom-db-fn-sql-error"] = "Erreur! Ce nom ne peut être enregistré, veuillez en choisir un autre.";
$lang["set-custom-db-ft"] = "Type de champ";
$lang["set-custom-db-fr"] = "Champ requis";
$lang["set-custom-db-fl"] = "Nombre de caractères maximum";
$lang["set-custom-db-fl-error"] = "Veuillez saisir un nombre ! (Entre 1 et 255)";
$lang["set-custom-db-fo"] = "Options du champ";
$lang["set-custom-db-fo-desc"] = "(Entrer chaque option, séparée par une virgule).";

// text on settings-canned.php
$lang["set-canned-title"] = "Réponses types";
$lang["set-canned-title-desc"] = "Les réponses types correspondent aux questions les plus fréquemment posées. Vous pouvez ici, ajouter ou editer ces réponses. Cela vous permet d\'éviter à avoir à ré-écrire toujours les mêmes réponses.";
$lang["set-canned-db-ac"] = "Ajouter un message type";
$lang["set-canned-db-ec"] = "Messages disponibles";
$lang["set-canned-db-ct"] = "Titre";
$lang["set-canned-db-cm"] = "Message type";

// text on settings-iemail.php
$lang["set-iemail-title"] = "Inbound Email to Ticket";
$lang["set-iemail-title-desc"] = "Convert your incoming emails to tickets or update existing tickets. Ticket ID must be included with the header";
$lang['set-iemail-manual'] = 'Allow manual retrieval of inbound emails.';
$lang['set-iemail-manual-warn'] = 'Not recommended if cron job setup for automatic retrieval.';
$lang['set-iemail-add-acc'] = 'Add account';
$lang['set-iemail-exist-title'] = 'Existing email addresses';
$lang['set-iemail-exist-test'] = 'Test';
$lang['set-iemail-exist-act'] = 'Connection successful';
$lang['set-iemail-exist-dec'] = 'Connection failed. Check account settings';
$lang['set-iemail-exist-en'] = 'Account enabled';
$lang['set-iemail-exist-dis'] = 'Account disabled';
$lang['set-iemail-add-title'] = 'Email address account';
$lang["set-iemail-db-ea"] = "Email Address";
$lang["set-iemail-db-ho"] = "Host Address";
$lang["set-iemail-db-pn"] = "Port Number";
$lang["set-iemail-db-pr"] = "Protocol";
$lang["set-iemail-db-ssl"] = "SSL";
$lang["set-iemail-db-tls"] = "TLS";
$lang["set-iemail-db-vc"] = "Validate Certificate";
$lang["set-iemail-db-af"] = "Account Folder";
$lang["set-iemail-db-au"] = "Account Username";
$lang["set-iemail-db-ap"] = "Account Password";
$lang["set-iemail-db-tg"] = "Group";
$lang["set-iemail-db-tp"] = "Priority";
$lang['set-iemail-db-na'] = '! No email addresses configured';

// text on settings-oemail.php
$lang["set-oemail-title"] = "Notifications par email";
$lang["set-oemail-title-desc"] = "Vous pouvez ici personnaliser les emails envoyés aux clients. Les codes ci-dessous peuvent être insérés dans les textes.";
$lang["set-oemail-email"] = "Email client";
$lang["set-oemail-code-tn"] = "Numéro du ticket";
$lang["set-oemail-code-da"] = "Date et heure de la création du ticket";
$lang["set-oemail-code-du"] = "Date et heure de la mise à jour du ticket";
$lang["set-oemail-code-ts"] = "Sujet du ticket";
$lang["set-oemail-code-te"] = "Demande initiale";
$lang["set-oemail-code-u"] = "Nom du client";
$lang["set-oemail-code-tu"] = "Contient les nouveaux éléments. Requis pour tous les modèles sauf le 1er.";
$lang["set-oemail-code-tc"] = "La catégorie du ticket";
$lang["set-oemail-code-tp"] = "Le niveau de priorité";
$lang["set-oemail-url"] = 'Url du site';
$lang["set-oemail-db-enable"] = "Activer la boite sortante";
$lang["set-oemail-db-name"] = "Nom du site";
$lang["set-oemail-db-email"] = "Adresse de l'expéditeur";
$lang["set-oemail-db-remail"] = "Adresse de réponse";
$lang["set-oemail-db-tn-sub"] = "Sujet pour un nouveau ticket";
$lang["set-oemail-db-tn-body"] = "Corps du message Nouveau ticket";
$lang["set-oemail-db-tu-sub"] = "Sujet pour Réponse au ticket";
$lang["set-oemail-db-tu-body"] = "Corps du message Réponse au ticket";
$lang["set-oemail-db-tp-sub"] = "Sujet pour Ticket en pause";
$lang["set-oemail-db-tp-body"] = "Corps du message Ticket en pause";
$lang["set-oemail-db-tc-sub"] = "Sujet pour Ticket fermé";
$lang["set-oemail-db-tc-body"] = "Corps du message Ticket fermé";

// text on settings users page
$lang['set-users-title'] = 'Techniciens';
$lang['set-users-title-desc'] = '<p>Les techniciens peuvent gérer les tickets dans leurs groupes respectifs. Vous pouvez ajouter, éditer et supprimer des techniciens. Chacun peut être assigné un rôle. Par défaut, au moins un utilisateur administrateur doit exister. Les administrateurs ont un contrôle total, les superviseurs peuvent avoir accès aux rapports et les techniciens peuvent seulement gérer leurs tickets.</p>'; 
$lang['set-users-add-agent'] = 'Ajouter un technicien';
$lang['set-users-name'] = 'Nom';

// text on settings add / edit user page
$lang['set-user-title'] = 'Modifier le technicien';
$lang['set-user-title-add'] = 'Ajouter un technicien';
$lang['set-user-notif'] = 'Notifications';
$lang['set-user-skill'] = 'Catégories associées';
$lang['set-user-skill-desc'] = '<p>En assignant les techniciens à une catégorie, ils pourront accepter, mettre à jour, fusionner, supprimer des billets dans celle-ci.</p><p>Les catégories non-assignées resterons visibles par le technicien.Il ne pourra pas intervenir dans le suivi du ticket, mais aura la possibilité d\'y ajouter des messages privés.</p>';
$lang['set-user-db-un'] = 'Pseudo';
$lang['set-user-db-pw'] = 'Mot de passe';
$lang['set-user-db-fn'] = 'Prénom';
$lang['set-user-db-ln'] = 'Nom';
$lang['set-user-db-ea'] = 'Adresse email';
$lang['set-user-db-role'] = 'Niveau';
$lang['set-user-role-1'] = 'Administrateur';
$lang['set-user-role-2'] = 'Superviseur';
$lang['set-user-role-3'] = 'Technicien';
$lang['set-user-db-tn'] = 'Prévenir le technicien des nouveaux tickets';
$lang['set-user-db-tu'] = 'Prévenir le technicien lorsqu\'un ticket est assigné';
$lang['set-user-db-pm'] = 'Prévenir le technicien si un message privé est ajouté à l\'un de ses tickets';

// text on settings edit user page
$lang['set-user-edit-title'] = 'Modifier le technicien';
$lang['set-user-edit-pwres'] = 'Nouveau mot de passe';
$lang['succes-pw-change'] = 'Le mot de passe a également été modifié';
$lang['succes-delete'] = 'Le technicien a été supprimé avec succès';

// version 1.1
$lang['set-oemail-db-method-mail'] = 'PHP Mail Function';
$lang['set-oemail-db-method-smtp'] = 'SMTP Server';
$lang['set-oemail-db-smtp-host'] = 'SMTP Server Address';
$lang['set-oemail-db-smtp-auth'] = 'SMTP Authenticate';
$lang['set-oemail-db-smtp-user'] = 'SMTP User';
$lang['set-oemail-db-smtp-pass'] = 'SMTP Password';
$lang['set-oemail-db-smtp-encr'] = 'Encryption';
$lang['set-oemail-db-smtp-port'] = 'SMTP Port';

$lang['set-kb-db-aukb'] = 'Afficher l\'auteur de l\'article dans la base de connaissance ?';

$lang['dash-group-sum'] = 'Etat des tickets';
$lang['dash-group-table-text'] = 'Cliquez sur les quantités pour voir le détail';

$lang["set-tickets-db-tv"] = 'Affichage des tickets';
$lang["set-tickets-db-tv-opt1"] = 'Le plus ancien en premier';
$lang["set-tickets-db-tv-opt2"] = 'Le plus récent en premier';

$lang["set-tickets-db-trp"] = 'Fenêtre de l\'éditeur';
$lang["set-tickets-db-trp-opt1"] = 'Au dessus de la liste des messages';
$lang["set-tickets-db-trp-opt2"] = 'Après la liste des messages';

$lang['tickets-viewby'] = 'Affichage en';
$lang['tickets-viewby-opt1'] = 'Détails';
$lang['tickets-viewby-opt2'] = 'Liste';
$lang['tickets-exp-noup'] = '** Ce ticket n\'est pas encore assigné **';

$lang['ticket-rating'] = 'Evaluation Client'; // on admin ticket page
$lang['ticket-rating-waiting'] = 'Le client n\'a pas encore évalué ce ticket';

$lang['u-kba-author'] = 'Auteur';
$lang['u-kba-helpful'] = 'Cette réponse vous a été utile ?';
$lang['u-kba-out'] = 'sur';
$lang['u-kba-found'] = 'ont trouvé cette réponse pertinente';

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