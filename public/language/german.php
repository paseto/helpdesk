<?php
// PHPLOCKITOPT NOENCODE
// PHPLOCKITOPT NOOBFUSCATE
// PHPLOCKITOPT NOSTRIPCOMMENTS
// PHPLOCKITOPT NOSTRIPWHITESPACE

// User Seiten

// Text für das user Menü
$lang['u-nav-kb'] = 'FAQ';
$lang['u-nav-s-request'] = 'TICKET ERSTELLEN';
$lang['u-nav-t-request'] = 'TICKET STATUS CHECKEN';

// text auf dem FAQ
$lang['u-kb-search'] = 'Suchen';
$lang['u-kb-search-na'] = '! Keine Ergebnisse gefunden!';
$lang['u-kb-kb'] = 'FAQ';
$lang['u-kb-more'] = 'Mehr';
$lang['u-kb-top-articles'] = 'Top Artikel';
$lang['u-kb-late-articles'] = 'Letzte Artikel';

// Text auf FAQ Artikel,Gruppe und Suche
$lang['u-kba-dateadd'] = 'Datum hinzugefügt';
$lang['u-kba-views'] = 'Views';
$lang['u-kba-rating'] = 'Bewertung';
$lang['u-kba-group'] = 'Gruppe';

// Text auf der Ticket status Seite
$lang['u-ticket-track-title'] = 'Ticket status checken';
$lang['u-ticket-track-t-em'] = 'Emailadresse';
$lang['u-ticket-track-t-no'] = 'Ticket Nummer';
$lang['u-ticket-track-submit'] = 'Ticket status checken';
$lang['u-ticket-track-error-req'] = '! Email oder Ticket Nummer erforderlich';
$lang['u-ticket-track-error-inv-em'] = 'Die Email Adresse wurde nicht gefunden';
$lang['u-ticket-track-error-inv-no'] = 'Die Ticket Nummer wurde nicht gefunden!';
$lang['u-ticket-track-error-not-found'] = 'Email und Ticket Nummer wurden nicht gefunden';

// Text auf für das Ticket Formular + Admin
$lang['ticket-add-title'] = 'Senden';
$lang['ticket-add-name'] = 'Name';
$lang['ticket-add-email'] = 'Email Addresse';
$lang['ticket-add-group'] = 'Abeteilung';
$lang['ticket-add-priority'] = 'Priorität';
$lang['ticket-add-subject'] = 'Betreff';
$lang['ticket-add-msg'] = 'Nachricht';
$lang['ticket-add-files-add'] = 'Datei anheften';
$lang['ticket-add-files-ano'] = 'Noch mehr Datein anheften';
$lang['ticket-add-sec-code'] = 'Sicherheits Code';
$lang['ticket-add-sec-code-ent'] = 'Gebe den Sicherheits Code ein';
$lang['ticket-add-submit'] = 'Ticket hinzufügen';
$lang['ticket-add-success-new'] = 'Deine Ticketnummer';
$lang['ticket-add-success-breif'] = 'Deine Ticketnummer + Details senden wir an';

// ADMIN SEITEN
$lang['generic-404'] = '<p class="e404">404</p><p class="e404">Diese seite existiert nicht</p>';
$lang['generic-save'] = 'Bestätigen';
$lang['generic-change'] = 'Ändern';
$lang["generic-yes"] = "Ja";
$lang["generic-no"] = "Nein";
$lang["generic-edit"] = "Editieren";
$lang["generic-delete"] = "Entfernen";
$lang['generic-enable'] = 'Aktivieren';
$lang['generic-disable'] = 'Deaktivieren';
$lang["generic-mark"] = "Markiere als Standart";
$lang["generic-unassigned"] = "Nicht zugeordnet";
$lang["generic-error"] = "Dieses Feld wird benötigt!";
$lang['generic-error-number-req'] = '! Nummer erforderlich';
$lang['generic-error-invalid-em'] = '! Email existiert nicht';
$lang['generic-error-un-exists'] = '! Username wird bereits verwendet';
$lang['generic-error-pw-length'] = '! Passowrt benötigt mindestens 6 zeichen';
$lang['generic-error-invalid-code'] = '! Falscher Code';
$lang['generic-delete-warn'] = '! Kann nicht gelöscht wird, bis alle Tickets vergeben werden';
$lang['generic-delete-warn-article'] = '! Kann nicht gelöscht wird, bis alle Artikel vergeben werden';
$lang['generic-file-size-exc'] = '! Ein Anhang hat die maximale Datei größe überschritten';
$lang['generic-success-u-add'] = 'Agent hinzugefügt!';
$lang['generic-success-u-edit'] = 'Agent erfolgreich editiert';

// Admin Login Seite 
$lang['index-login'] = 'Einloggen';
$lang['index-username'] = 'Username';
$lang['index-password'] = 'Passwort';
$lang['index-langauge'] = 'Sprache';
$lang['index-forgotpwd'] = 'Passwort vergessen?';
$lang['index-error'] = '! Username oder Passwort falsch';

// Passwort Reset seite (Admin)
$lang['pwreset-title'] = 'Passwort Zurücksetzen';
$lang['pwreset-unknown-u'] = '! Username existiert nicht';
$lang['pwreset-email-succ'] = '! Erfolgreich <p>Wir haben Eine Email versendet</p>';
$lang['pwreset-email-fail'] = 'Fehler';

// Text für den Header
$lang['header-menu'] = 'Menü';
$lang['header-search'] = 'Suche nach ID, Name, Betreff, etc';

// Text für die Übersicht
$lang['dash-title-tickets'] = 'Ticket verlauf';
$lang['dash-title-activity'] = 'Letzte Aktivität';
$lang['dash-load-more'] = 'Lade mehr';
$lang['dash-avg-time'] = 'Avg. Response';
$lang['dash-activity-new'] = 'submitted a new ticket';
$lang['dash-activity-change'] = 'Hat ein Ticket geändert';
$lang['dash-activity-note'] = 'Hat eine Notiz zu einem Ticket hinzugefügt';
$lang['dash-activity-closed'] = 'Hat ein Ticket geschlossen';
$lang['dash-activity-reply'] = 'Hat auf ein Ticket geantwortet';
$lang['dash-activity-rating'] = 'Hat ein Ticket bewertet';
$lang['dash-activity-user-replied'] = 'Neue User antwort auf ein Ticket';
$lang['dash-activity-you'] = 'Du';
$lang['dash-activity-have'] = 'hast';
$lang['dash-activity-has'] = 'hat';

// Tickets status Seite
$lang['tickets-filter'] = 'Filter';
$lang['tickets-refresh'] = 'Neu Laden';
$lang['tickets-ID'] = 'ID';
$lang['tickets-agents'] = 'Agenten';
$lang['tickets-subject'] = 'Betreff';
$lang['tickets-dateadd'] = 'Hinzugefügt';
$lang['tickets-dateadd-anytime'] = 'Veraltet';
$lang['tickets-dateadd-today'] = 'Heute';
$lang['tickets-dateadd-yesterday'] = 'Gestern';
$lang['tickets-dateadd-thisweek'] = 'diese Woche';
$lang['tickets-dateadd-lastweek'] = 'letzte Woche';
$lang['tickets-dateadd-thismonth'] = 'diesen Monat';
$lang['tickets-dateadd-lastmonth'] = 'letzten Monat';
$lang['tickets-dateup'] = 'Updatet am';
$lang['tickets-group'] = 'Abteilung';
$lang['tickets-group-desc'] = 'Wähle Abteilungen aus';
$lang['tickets-status'] = 'Status';
$lang['tickets-status-accept'] = 'Akzeptieren';
$lang['tickets-status-open'] = 'Offen';
$lang['tickets-status-pending'] = 'Wartend';
$lang['tickets-status-paused'] = 'Pausiert';
$lang['tickets-status-closed'] = 'Geschlossen';
$lang['tickets-status-delete'] = 'Entfernt';
$lang['tickets-status-desc'] = 'Wähle einen Status aus';
$lang['tickets-priority'] = 'Priorität';
$lang['tickets-owner'] = 'Zugeteilter Agent';
$lang['tickets-sortby'] = 'Sortiere nach';
$lang['tickets-dir-asc'] = 'aufsteigend';
$lang['tickets-dir-dsc'] = 'absteigend';
$lang['tickets-get-email'] = 'bekomme Emails';

// Text für Suche
$lang['search-advanced'] = 'erweiterte Suche';
$lang['search-subject'] = 'Betreff';
$lang['search-msg'] = 'Nachrichten Inhalt';
$lang['search-cust'] = 'Kunde';
$lang['search-any'] = 'Jeder';
$lang['search-dateaddfrom'] = 'Hinzugefügt am';
$lang['search-dateaddto'] = 'Hinzugefügt zum';
$lang['search-dateupfrom'] = 'Geupdatet am';
$lang['search-dateupto'] = 'Geupdatet zum';
$lang['search-dateclosefrom'] = 'Geschlossen seit';
$lang['search-datecloseto'] = 'Geschlossen seit';
$lang['search-button-submit'] = 'Suche';
$lang['search-button-reset'] = 'Reset';
$lang['search-results'] = 'results found for';
$lang['search-no-results'] = 'No results found for';
$lang['search-from'] = 'Vom';
$lang['search-added'] = 'Hinzugefügt am';
$lang['search-updated'] = 'letzte Nachricht am';
$lang['search-closed'] = 'Geschlossen am';

// Text für Berichte
$lang['rep-filter'] = 'Berichte';
$lang['rep-report'] = 'Bericht anzeigen';
$lang['rep-reset'] = 'Zurücksetzen';
$lang['rep-period'] = 'Bericht Zeit';
$lang['rep-period-from'] = 'Bericht vom';
$lang['rep-period-to'] = 'Bericht bis';
$lang['rep-graphic'] = 'Zeige mir eine Grafik';
$lang['rep-no-data'] = 'Hier stehen keine Daten zu verfügung';
$lang['rep-dd-ts'] = 'Ticket summary';
$lang['rep-dd-as'] = 'Agent summary';
$lang['rep-dd-gs'] = 'Group summary';
$lang['rep-dd-gl'] = 'Group load';
$lang['rep-dd-cs'] = 'Kunden Zufriedenheit';
$lang['rep-dd-st'] = 'Quelle';
$lang['rep-date-dd-cust'] = 'Erweitert';
$lang['rep-download'] = 'Lade dieen bericht als CSV Herunter ';
$lang['rep-total'] = 'Instgesamt';
$lang['rep-feedback'] = 'Rückmeldung';

// Text auf der Ticket Seite
$lang['ticket-details-title'] = 'Details';
$lang['ticket-dateintrep'] = 'letzte Antwort';
$lang['ticket-dateclosed'] = 'Geschlossen am';
$lang['ticket-customfields'] = 'mehr Felder';
$lang['ticket-fileuploads'] = 'Anhäng uploads';
$lang['ticket-status-closed'] = 'Dein Ticket wurde geschlossen und es kann nicht mehr Geantwortet werden.';
$lang['ticket-status-notskill'] = 'Du bist nich für diese Abteilung zusändig.';
$lang['ticket-status-unassigned'] = 'Das Ticket ist noch keinem Agenten zugeordnet, du kannst es mit einem Klicka auf Akzeptieren übernehmen.';
$lang['ticket-status-notowner'] = 'Du bist nicht für dieses Ticket zuständig du kannst eine Notiz für den Agenten schreiben, oder du übernimmst das Ticket.';
$lang['ticket-attachanother'] = 'Mehr Anheftungen hinzufügen';
$lang['ticket-status-dd-note'] = 'Notiz';
$lang['ticket-status-dd-update'] = 'Ändern';
$lang['ticket-status-dd-pause'] = 'Pause';
$lang['ticket-status-dd-close'] = 'Schließen';
$lang['ticket-show-detail'] = 'Sehe details'; // on user ticket page
$lang['ticket-rate'] = 'Nimm dir bitte noch etwas Zeit um useren Support zu Bewerten.wie fandest du Unseren Support?'; // on user ticket page
$lang['ticket-rate-p'] = 'Prositiv';
$lang['ticket-rate-neu'] = 'Neutral';
$lang['ticket-rate-neg'] = 'Neagtiv';

// Text auf der User Profiel Seite
$lang['profile-last-log'] = 'Letzter login';
$lang['profile-chg-pwd'] = 'Passwort ändern';
$lang['profile-cust-sat'] = 'Kundenzufriedenheit';
$lang['profile-tickets-own'] = 'Tickets';
$lang['profile-chg-pwd-desc'] = 'Gebe bitte dein neues Passwort ein, du bekommst eine bestätigungs Mail.';
$lang['profile-chg-pwd-new'] = 'Neues Passwort';
$lang['profile-chg-pwd-confirm'] = 'Bestätige neues Passwort';
$lang['profile-chg-pwd-succes'] = '! Erfolg. <p>Eine Email mit deinem neuen Passwort wurde dir gesendet!</p>';
$lang['profile-chg-pwd-succes-mail-sub'] = 'Passwort geändert !';
$lang['profile-chg-pwd-succes-mail-body'] = 'Dein neues Passwort lautet:';
$lang['profile-chg-pwd-fail'] = 'Fehler wir konnten keine Email versenden';

// Text auf der FAQ Seite
$lang['kb-title'] = 'FAQ';
$lang['kb-enabled'] = 'FAQ ist online';
$lang['kb-disabled'] = 'Das FAQ ist ausgeschaltet';
$lang['kb-db-aa-title'] = 'Artikel hinzufügen';
$lang['kb-db-ag-title'] = 'Füge FAQ Gruppe hinzu';
$lang['kb-db-ag-title-desc'] = 'Füge eine Gruppe hinzu damit User den beitrag besser finden.';
$lang["kb-db-eg"] = 'Existierende FAQ Gruppen';
$lang['kb-db-article-title'] = 'Artikel Titel';
$lang['kb-db-article-group'] = 'Artikel Gruppe';
$lang['kb-db-article-msg'] = 'Artikel';

// Admin seite Menü
$lang['nav-dashboard'] = 'Übersicht';
$lang['nav-tickets'] = 'Tickets';
$lang['nav-add'] = 'Hinzufügen';
$lang['nav-search'] = 'Suchen';
$lang['nav-view'] = 'Ansicht';
$lang['nav-knowledge'] = 'FAQ';
$lang["nav-knowledge-articles"] = 'Artikel Hinzufügen';
$lang["nav-knowledge-groups"] = 'Gruppen Bearbeiten';
$lang['nav-reports'] = 'Meldungen';
$lang['nav-set'] = 'Einstellungen';
$lang['nav-set-general'] = 'General';
$lang['nav-set-tickets'] = 'Tickets';
$lang["nav-set-knowledge"] = 'FAQ';
$lang['nav-set-groups'] = 'Gruppen';
$lang['nav-set-priorities'] = 'Prioritäten';
$lang['nav-set-custom'] = 'Mehr Felder';
$lang['nav-set-can'] = 'Canned replies';
$lang['nav-set-inemail'] = 'Eingehende E-Mails';
$lang['nav-set-outemail'] = 'Ausgehende E-Mails';
$lang['nav-set-users'] = 'Users';
$lang['nav-set-profile'] = 'Profile';
$lang['nav-set-logout'] = 'Ausloggen';

// Text auf settings-general.php
$lang["set-general-title"] = "General";
$lang["set-general-db-cn"] = "Geschäftsname";
$lang["set-general-db-fl"] = "Standart Sprache";
$lang["set-general-db-tz"] = "Zeitzone";
$lang["set-general-db-df"] = "Datum Format";
$lang["set-general-db-rp"] = "Startseite";

// Text auf settings-tickets.php
$lang["set-tickets-title"] = "Ticket";
$lang["set-tickets-db-an"] = "Neue Ticket Zuordnung";
$lang["set-tickets-db-an-desc"] = "Wählen Sie, ob neue Tickets unbelegt sind oder automatisch an einen ausgewählten Benutzer zugewiesen werdeb";
$lang["set-tickets-db-up"] = "Benutzern erlauben, eine Priorität wählen";
$lang["set-tickets-db-as"] = "Verwenden Sie Anti-Spam Bild für Anwender";
$lang["set-tickets-db-rc"] = "Wiedereröffnung von geschlossenen Tickets erlaubtén";
$lang["set-tickets-db-tr"] = "Erlaube Ticket Feedback";
$lang["set-tickets-db-fa"] = "erlaube Dateianhänge";
$lang["set-tickets-db-fa-desc1"] = "Speicherort für Dateianhänge";
$lang["set-tickets-db-fa-desc2"] = "maximale größe von Dateianhängen";

// Text auf settings-kb.php
$lang['set-kb-title'] = 'FAQ';
$lang['set-kb-title-desc'] = 'Ein FAQ kann die häufig gestellte Fragen beantworten. Verhinderung von Wiederholungs Support-Anfragen.';
$lang['set-kb-db-enkb'] = 'FAQ aktiviren?';
$lang['set-kb-db-cokb'] = 'wieviele Artikel pro Seite.';
$lang['set-kb-db-rakb'] = 'Arktikel Bewertungen aktivieren.';
$lang['set-kb-db-apkb'] = 'Nummer von Artikeln die angetzeigt werden in einer Gruppe.';

// Text auf settings-priorites.php
$lang['set-priorities-title'] = 'Priorität';
$lang['set-priorities-title-desc'] = '<p>Priorität.</p>';
$lang['set-priorities-db-ap'] = 'füge Priorität hinzu';
$lang['set-priorities-db-ap-desc'] = 'Füge eine Priorität hinzu';
$lang['set-priorities-db-cp'] = 'Existierende Prioritäten';

// Text auf settings-groups.php
$lang['set-groups-title'] = 'Abteilungen';
$lang['set-groups-desc'] = '<p>Es muss 1 Abteilung existieren. Abteilungen sind super um Tickets zu Sortieren.</p><p>Du Musst zudem Agenten Abeteilungen hinzufügen sonst können sie nur Notizen hinzufügen.</p>';
$lang['set-groups-add'] = 'Abteilung hinzufügen';
$lang['set-groups-enter'] = 'Abteilungsname';
$lang['set-groups-exist'] = 'Existierende Abeteilungen';

$lang["set-groups-db-ie"] = "Kein Posteingang wurde für diese Abeteilung gesetzt <a href=\"#\">Editieren</a>";
$lang["set-groups-db-sl"] = "Setze SLA für diese Abteilung";
$lang["set-groups-db-rb"] = "Antwort von";
$lang["set-groups-db-fb"] = "Fix von";

// Text auf settings-customfields.php
$lang["set-custom-title"] = "mehr Felder";
$lang["set-custom-title-desc"] = "<p>Hier kannst du neue Felder hinzufügen.</p><p>Neue Felder werden vor dem Betreff angezeigt.</p>";
$lang["set-custom-db-af"] = "Füge ein Feld hinzu.";
$lang["set-custom-db-ef"] = "Existierende Felder";
$lang["set-custom-db-fn"] = "Feld Name";
$lang["set-custom-db-fn-error"] = "Feld existiert bereits";
$lang["set-custom-db-fn-sql-error"] = "Error! Das Feld konnte nicht erstellt werden, versuche einen anderen Namen";
$lang["set-custom-db-ft"] = "Feld typ";
$lang["set-custom-db-fr"] = "Pflichtfeld";
$lang["set-custom-db-fl"] = "Maximale Feld länge";
$lang["set-custom-db-fl-error"] = "Nummer erforderlich!. Gebe eine nummer zwischen 1 und 255 ein.";
$lang["set-custom-db-fo"] = "Feld optionen";
$lang["set-custom-db-fo-desc"] = "(Trenne alle mit einem Komma Z.b Ja,Nein,Villeicht,Ist mir egal).";

// Text auf settings-canned.php
$lang["set-canned-title"] = "vorgefertigte Nachrichten";
$lang["set-canned-title-desc"] = "vorgefertigte Nachrichten sparen Zeit.Hier kannst du vorgefertigte Nachrichten verwalten. Diese können benutzt werden um Zeit zu Sparen.";
$lang["set-canned-db-ac"] = "Füge eine vorgefertigte Nachricht hinzu";
$lang["set-canned-db-ec"] = "Existierende vorgefertigte Nachrichten";
$lang["set-canned-db-ct"] = "Titel";
$lang["set-canned-db-cm"] = "vorgefertigte Nachrichten";

// Text auf settings-iemail.php
$lang["set-iemail-title"] = "Eingehende E-Mails";
$lang["set-iemail-title-desc"] = "Hier kannst du ein Mail Konto anlegen für eine Abteilung";
$lang['set-iemail-manual'] = 'Manuellen Abruf von eingehenden E-Mails erlauben?.';
$lang['set-iemail-manual-warn'] = 'Nicht empfehlenswert, wenn du einen Cron-Job-Setup benutzt für den automatischen Abruf.';
$lang['set-iemail-add-acc'] = 'Füge Account hinzu';
$lang['set-iemail-exist-title'] = 'Existiere Email Adressen';
$lang['set-iemail-exist-test'] = 'Test';
$lang['set-iemail-exist-act'] = 'Erfolg';
$lang['set-iemail-exist-dec'] = 'Fehler,überprüfe deine Einstellungen';
$lang['set-iemail-exist-en'] = 'Account Aktiviert';
$lang['set-iemail-exist-dis'] = 'Account Deaktiviert';
$lang['set-iemail-add-title'] = 'E-Mail Accound hinzufügen';
$lang["set-iemail-db-ea"] = "Email Addresse";
$lang["set-iemail-db-ho"] = "Host Addresse";
$lang["set-iemail-db-pn"] = "Port Nummer";
$lang["set-iemail-db-pr"] = "Protokoll";
$lang["set-iemail-db-ssl"] = "SSL";
$lang["set-iemail-db-tls"] = "TLS";
$lang["set-iemail-db-vc"] = "Fuktionierendes Zertifikat";
$lang["set-iemail-db-af"] = "Account Ordner";
$lang["set-iemail-db-au"] = "Account Username";
$lang["set-iemail-db-ap"] = "Account Passwort";
$lang["set-iemail-db-tg"] = "Abteilung";
$lang["set-iemail-db-tp"] = "Priorität";
$lang['set-iemail-db-na'] = '! Keine Email Kofiguriert';

// Text auf settings-oemail.php
$lang["set-oemail-title"] = "Email Benachrichtigungen";
$lang["set-oemail-title-desc"] = "Verändere die Automatiesierten Emails.";
$lang["set-oemail-code-tn"] = "Die Ticket nummer";
$lang["set-oemail-code-da"] = "Datum und Zeit hinzugefügt";
$lang["set-oemail-code-du"] = "Datum und Zeit geupdatet";
$lang["set-oemail-code-ts"] = "Ticket Betreff";
$lang["set-oemail-code-te"] = "Die Original-Ticket-Anfrage";
$lang["set-oemail-code-u"] = "Der name des Users";
$lang["set-oemail-code-tu"] = "REQUIRED! Das update wird Gemailt";
$lang["set-oemail-code-tc"] = "Die Abteilung zugeordnet";
$lang["set-oemail-code-tp"] = "Die Priorität zugeordnet";
$lang["set-oemail-db-enable"] = "Erlaube augehende Emails";
$lang["set-oemail-db-name"] = "Anzeigename";
$lang["set-oemail-db-email"] = "Email Addresse";
$lang["set-oemail-db-remail"] = "Antworte auf Emails";
$lang["set-oemail-db-tn-sub"] = "Ticket hat ein Betreff";
$lang["set-oemail-db-tn-body"] = "Ticket hat einen neuen Email body";
$lang["set-oemail-db-tu-sub"] = "Ticket Aktuelisiert Betreff";
$lang["set-oemail-db-tu-body"] = "Ticket Aktuelisiert Body";
$lang["set-oemail-db-tp-sub"] = "Ticket Pausiert Betreff";
$lang["set-oemail-db-tp-body"] = "Ticket Pausiert Body";
$lang["set-oemail-db-tc-sub"] = "Ticket Geschlossen Betreff";
$lang["set-oemail-db-tc-body"] = "Ticket Geschlossen Body";

// Text auf UserPage
$lang['set-users-title'] = 'Agenten';
$lang['set-users-title-desc'] = '<p>Agenten haben die Rechte Tickets zu beantworten die an Ihre Abteilung gesendet wurden. Du kannst Users Hinzufügen,Editieren,Löschen. Jedem User kann eine Rolle zugewiesen werden. Administratoren haben alle Rechte ,Moderatoren können Berichte einsehen und Agenten Tickets beantworten.</p>'; 
$lang['set-users-add-agent'] = 'Agent hinzufügen';
$lang['set-users-name'] = 'Name';

// Text auf User editieren/hinzufügen Seite
$lang['set-user-title'] = 'Agent hinzufügen';
$lang['set-user-notif'] = 'Benachrichtigungen';
$lang['set-user-skill'] = 'Abeteilungen';
$lang['set-user-skill-desc'] = '<p>Wenn du die Abeteilungen auswählst können Agenten ,ihre eigenen Tickets verwalten In dieser Abteilung.</p><p>Agenten können alle Tickets sehen aber nur Notizen hinzufügen.</p>';
$lang['set-user-db-un'] = 'Username';
$lang['set-user-db-pw'] = 'Passwort';
$lang['set-user-db-fn'] = 'Vorname';
$lang['set-user-db-ln'] = 'Nachname';
$lang['set-user-db-ea'] = 'E-Mail';
$lang['set-user-db-role'] = 'Rolle';
$lang['set-user-role-admin'] = 'Admin';
$lang['set-user-role-super'] = 'Moderator';
$lang['set-user-role-agent'] = 'Agent';
$lang['set-user-db-tn'] = 'Benachritige Agent wenn neue Tickets erstellt wurden';
$lang['set-user-db-tu'] = 'Benachrichtige Agent wenn Tickets geantwortet sind die ihm zugeteilt wurden';
$lang['set-user-db-pm'] = 'Benachritige Agent wenn er eine PM erhält';

// Text auf Editiere Agent
$lang['set-user-edit-title'] = 'Editiere Agent';
$lang['set-user-edit-pwres'] = 'Passwort zurücksetzen';
//
// -- Translation made by Martin Becker for ACORN AID
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