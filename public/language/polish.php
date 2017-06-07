<?php
// PHPLOCKITOPT NOENCODE
// PHPLOCKITOPT NOOBFUSCATE
// PHPLOCKITOPT NOSTRIPCOMMENTS
// PHPLOCKITOPT NOSTRIPWHITESPACE

// USER PAGES

// text on user navigation
$lang['u-nav-kb'] = 'Baza Wiedzy';
$lang['u-nav-s-request'] = 'Wyślij zgłoszenie';
$lang['u-nav-t-request'] = 'Śledź zgłoszenie';

// text on kb
$lang['u-kb-search'] = 'Szukaj';
$lang['u-kb-search-na'] = '! Brak wyników';
$lang['u-kb-kb'] = 'Baza Wiedzy';
$lang['u-kb-more'] = 'więcej';
$lang['u-kb-top-articles'] = 'Najpopularniejsze wpisy';
$lang['u-kb-late-articles'] = 'Ostatnie wpisy';

// text on kb article and search and group
$lang['u-kba-dateadd'] = 'Data dodania';
$lang['u-kba-views'] = 'Wyświetleń';
$lang['u-kba-rating'] = 'Ocena';
$lang['u-kba-group'] = 'Grupa';

// text on user track ticket page
$lang['u-ticket-track-title'] = 'Śledź zgłoszenie';
$lang['u-ticket-track-t-em'] = 'Adres Email';
$lang['u-ticket-track-t-no'] = 'Numer zgłoszenia';
$lang['u-ticket-track-submit'] = 'Śledź zgłoszenie';
$lang['u-ticket-track-error-req'] = '! Wymagany adres email i numer zgłoszenia';
$lang['u-ticket-track-error-inv-em'] = '! Błędny adres Email';
$lang['u-ticket-track-error-inv-no'] = '! Błędny numer zgłoszenia. Proszę podaj cyfry';
$lang['u-ticket-track-error-not-found'] = '! Ten email i numer zgłoszenia nie został znaleziony';

// text on ticket form and ticket success admin and user
$lang['ticket-add-title'] = 'Wyślij zgłoszenie';
$lang['ticket-add-name'] = 'Imie';
$lang['ticket-add-email'] = 'Adres E-mail';
$lang['ticket-add-group'] = 'Grupa';
$lang['ticket-add-priority'] = 'Priorytet';
$lang['ticket-add-subject'] = 'Temat';
$lang['ticket-add-msg'] = 'Wiadomość';
$lang['ticket-add-files-add'] = 'Dodaj plik';
$lang['ticket-add-files-ano'] = 'Dodaj kolejny plik';
$lang['ticket-add-sec-code'] = 'Kod bezpieczeństwa';
$lang['ticket-add-sec-code-ent'] = 'Wpisz kod bezpieczeństwa';
$lang['ticket-add-submit'] = 'Dodaj zgłoszenie';
$lang['ticket-add-success-new'] = 'Numer nowego zgłoszenia';
$lang['ticket-add-success-breif'] = 'Szczegóły nowego zgłoszenia wysłano na adres:';

// ADMINS PAGES
$lang['generic-404'] = '<p class="e404">We\'re Sorry...</p><p class="e404">The page you are looking for can not be found</p>';
$lang['generic-save'] = 'Wyślij';
$lang['generic-change'] = 'Zmień';
$lang["generic-yes"] = "Tak";
$lang["generic-no"] = "Nie";
$lang["generic-edit"] = "Edytuj";
$lang["generic-delete"] = "Usuń";
$lang['generic-enable'] = 'Włącz';
$lang['generic-disable'] = 'Wyłącz';
$lang["generic-mark"] = "Zaznacz jako domyślne";
$lang["generic-unassigned"] = "Nie przydzielone";
$lang["generic-error"] = "! Wymagane pole";
$lang['generic-error-number-req'] = '! wymagana liczba';
$lang['generic-error-invalid-em'] = '! Nieprawidłowy adres e-mail';
$lang['generic-error-un-exists'] = '! Nazwa użytkownika już w użyciu';
$lang['generic-error-pw-length'] = '! Hasło musi zawierać 6 lub więcej znaków';
$lang['generic-error-invalid-code'] = '! Błędny kod';
$lang['generic-delete-warn'] = '! Nie można usunąć, dopóki wszystkie bilety są nieprzydzielone';
$lang['generic-delete-warn-article'] = '! Nie można usunąć, dopóki wszystkie artykuły są nieprzydzielone';
$lang['generic-file-size-exc'] = '! Rozmiar pliku przekracza limit wysyłania';
$lang['generic-success-u-add'] = 'Użytkownik dodany pomyślnie';
$lang['generic-success-u-edit'] = 'Użytkownika zaktualizowano z powodzeniem';

// text on admin index page
$lang['index-login'] = 'Zaloguj się';
$lang['index-username'] = 'Login';
$lang['index-password'] = 'Hasło';
$lang['index-langauge'] = 'Język';
$lang['index-forgotpwd'] = 'Zapomniałeś hasło?';
$lang['index-error'] = '! Login lub hasło jest niepoprawne';

// text on admin password reset page
$lang['pwreset-title'] = 'Resetowanie hasła';
$lang['pwreset-unknown-u'] = '! Użytkownik nie jest rozpoznawany';
$lang['pwreset-email-succ'] = '! Sukces. <p>E-mail z nowym hasłem został wysłany na podany podczas rejestracji adres e-mail</p>';

$lang['pwreset-email-fail'] = 'Nie udało się wysłać nowego hasła';

// text on header page
$lang['header-menu'] = 'MENU';
$lang['header-search'] = 'Szukaj przez ID, Nazwa, Temat, etc';

// text on dashboard page
$lang['dash-title-tickets'] = 'Podsumowanie zgłoszeń';
$lang['dash-title-activity'] = 'Ostatnia aktywność';
$lang['dash-load-more'] = 'Załaduj więcej';
$lang['dash-avg-time'] = 'Średnia odpowiedź';
$lang['dash-activity-new'] = 'dodał nowe zgłoszenie';
$lang['dash-activity-change'] = 'zmienił zgłoszenie';
$lang['dash-activity-note'] = 'dodano komentarz do zgłoszenia';
$lang['dash-activity-closed'] = 'zamknięte zgłoszenie';
$lang['dash-activity-reply'] = 'przesłał odpowiedź na zgłoszenie';
$lang['dash-activity-rating'] = 'ocenił zgłoszenie';
$lang['dash-activity-user-replied'] = 'odpowiedział na zgłoszenie';
$lang['dash-activity-you'] = 'Ty';
$lang['dash-activity-have'] = '';
$lang['dash-activity-has'] = 'miałeś';

// text on admin tickets page
$lang['tickets-filter'] = 'Filtr';
$lang['tickets-refresh'] = 'Odśwież';
$lang['tickets-ID'] = 'ID';
$lang['tickets-agents'] = 'Agenci';
$lang['tickets-subject'] = 'Temat';
$lang['tickets-dateadd'] = 'Data dodania';
$lang['tickets-dateadd-anytime'] = 'w dowolnym czasie';
$lang['tickets-dateadd-today'] = 'Dziś';
$lang['tickets-dateadd-yesterday'] = 'Wczoraj';
$lang['tickets-dateadd-thisweek'] = 'Ten tydzień';
$lang['tickets-dateadd-lastweek'] = 'Ostatni tydzień';
$lang['tickets-dateadd-thismonth'] = 'W tym miesiącu';
$lang['tickets-dateadd-lastmonth'] = 'Ostatni miesiąc';
$lang['tickets-dateup'] = 'Data aktualizacji';
$lang['tickets-group'] = 'Grupa';
$lang['tickets-group-desc'] = 'Wybierz grupy do wyświetlenia';
$lang['tickets-status'] = 'Status';
$lang['tickets-status-accept'] = 'Zaakceptowany';
$lang['tickets-status-open'] = 'Otwarty';
$lang['tickets-status-pending'] = 'Oczekuje';
$lang['tickets-status-paused'] = 'Pauza';
$lang['tickets-status-closed'] = 'Zamknięty';
$lang['tickets-status-delete'] = 'Skasowany';
$lang['tickets-status-desc'] = 'Wybierz statusy aby zobaczyć';
$lang['tickets-priority'] = 'Priorytet';
$lang['tickets-owner'] = 'Właściciel';
$lang['tickets-sortby'] = 'Sortuj po';
$lang['tickets-dir-asc'] = 'Rosnąco';
$lang['tickets-dir-dsc'] = 'Malejąco';
$lang['tickets-get-email'] = 'Otrzymuj e-maile';

// text on search
$lang['search-advanced'] = 'Szukanie zaawansowane';
$lang['search-subject'] = 'Temat';
$lang['search-msg'] = 'Treść wiadomości';
$lang['search-cust'] = 'Klient';
$lang['search-any'] = 'Każdy';
$lang['search-dateaddfrom'] = 'Data dodania Od';
$lang['search-dateaddto'] = 'Data dodania Do';
$lang['search-dateupfrom'] = 'Data aktualizacji Od';
$lang['search-dateupto'] = 'Data aktualizacji Do';
$lang['search-dateclosefrom'] = 'Data zamknięcia Od';
$lang['search-datecloseto'] = 'Data zamknięcia Do';
$lang['search-button-submit'] = 'Szukaj';
$lang['search-button-reset'] = 'Resetowanie';
$lang['search-results'] = 'Wyniki wyszukiwania dla';
$lang['search-no-results'] = 'Brak wyników znalezionych dla';
$lang['search-from'] = 'od';
$lang['search-added'] = 'Dodano';
$lang['search-updated'] = 'Zaktualizowany';
$lang['search-closed'] = 'Zamknięte';

// text on reports
$lang['rep-filter'] = 'Raport niestandardowy';
$lang['rep-report'] = 'Raport';
$lang['rep-reset'] = 'Reset';
$lang['rep-period'] = 'Okres raportu';
$lang['rep-period-from'] = 'Report Period From';
$lang['rep-period-to'] = 'Report Period To';
$lang['rep-graphic'] = 'Pokaż graficzne';
$lang['rep-no-data'] = 'No data found for report criteria';
$lang['rep-dd-ts'] = 'Podsumowanie zgłoszeń';
$lang['rep-dd-as'] = 'Agent summary';
$lang['rep-dd-gs'] = 'Group summary';
$lang['rep-dd-gl'] = 'Group load';
$lang['rep-dd-cs'] = 'Customer satisfaction';
$lang['rep-dd-st'] = 'Source type';
$lang['rep-date-dd-cust'] = 'Custom';
$lang['rep-download'] = 'Download as CSV file';
$lang['rep-total'] = 'Łącznie';
$lang['rep-feedback'] = 'Komentarze';

// text on ticket page
$lang['ticket-details-title'] = 'Detale';
$lang['ticket-dateintrep'] = 'Data wstępnej odpowiedzi';
$lang['ticket-dateclosed'] = 'Data zamknięcia';
$lang['ticket-customfields'] = 'Pola niestandardowe';
$lang['ticket-fileuploads'] = 'Wgrane załączniki';
$lang['ticket-status-closed'] = 'Zgłoszenie jest zamknięte i nie może być aktualizowane.';
$lang['ticket-status-notskill'] = 'Nie jesteś specjalistom z danej grupy. Możesz dodać notatkę dla właściciela.';
$lang['ticket-status-unassigned'] = 'Zgłoszenie jest obecnie nieprzypisane. Aby zaktualizować, zaakceptuj zgłoszenie klikając zaakceptuj';
$lang['ticket-status-notowner'] = 'Zgłoszenie nie jest przypisane do Ciebie. Możesz dodać notatkę dla obecnego właściciela lub możesz zmienić właściciela do siebie, aby odpowiedzieć klientowi.';
$lang['ticket-attachanother'] = 'Dołącz kolejny';
$lang['ticket-status-dd-note'] = 'Notka';
$lang['ticket-status-dd-update'] = 'Aktualizuj';
$lang['ticket-status-dd-pause'] = 'Pauza';
$lang['ticket-status-dd-close'] = 'Zamknij';
$lang['ticket-show-detail'] = 'Pokaż szczegóły'; // on user ticket page
$lang['ticket-rate'] = 'Oceń'; // on user ticket page
$lang['ticket-rate-p'] = 'Pozytyw';
$lang['ticket-rate-neu'] = 'Neutralny';
$lang['ticket-rate-neg'] = 'Negatywny';

// text on user profile page
$lang['profile-last-log'] = 'Ostatnio zalogowany';
$lang['profile-chg-pwd'] = 'Zmień hasło';
$lang['profile-cust-sat'] = 'Satysfakcja klienta';
$lang['profile-tickets-own'] = 'Jest właścicielem takich zgłoszeń';
$lang['profile-chg-pwd-desc'] = 'Wpisz poniżej swoje nowe hasło. E-mail zostanie wysłane potwierdzenie nowego hasła.';
$lang['profile-chg-pwd-new'] = 'Nowe hasło';
$lang['profile-chg-pwd-confirm'] = 'Potwierdź nowe hasło';
$lang['profile-chg-pwd-succes'] = '! Sukces. <p>E-mail z nowym hasłem został wysłany na zarejestrowany adres e-mail</p>';
$lang['profile-chg-pwd-succes-mail-sub'] = 'Hasło zostało zmienione !';
$lang['profile-chg-pwd-succes-mail-body'] = 'Twoje nowe hasło';
$lang['profile-chg-pwd-fail'] = 'Nie udało się wysłać nowego hasła';

// text on knowledge base page
$lang['kb-title'] = 'Baza wiedzy';
$lang['kb-enabled'] = 'Baza wiedzy jest włączona';
$lang['kb-disabled'] = 'Baza wiedzy jest obecnie wyłączona w Ustawienia > Baza wiedzy';
$lang['kb-db-aa-title'] = 'Dodaj artykuł';
$lang['kb-db-ag-title'] = 'Dodaj grupę w bazie wiedzy';
$lang['kb-db-ag-title-desc'] = 'Dodaj grupę aby pomóc użytkownikom znaleźć artykuły.';
$lang["kb-db-eg"] = 'Istniejące grupy bazy wiedzy';
$lang['kb-db-article-title'] = 'Tytuł artykułu';
$lang['kb-db-article-group'] = 'Artykuł w grupie';
$lang['kb-db-article-msg'] = 'Artykuł';

// text on menu
$lang['nav-dashboard'] = 'Pulpit';
$lang['nav-tickets'] = 'Zgłoszenia';
$lang['nav-add'] = 'Dodaj';
$lang['nav-search'] = 'Szukaj';
$lang['nav-view'] = 'Widok';
$lang['nav-knowledge'] = 'Baza wiedzy';
$lang["nav-knowledge-articles"] = 'Dodaj artykuł';
$lang["nav-knowledge-groups"] = 'Zarządzaj grupami';
$lang['nav-reports'] = 'Raporty';
$lang['nav-set'] = 'Ustawienia';
$lang['nav-set-general'] = 'Ogólne';
$lang['nav-set-tickets'] = 'Zgłoszenia';
$lang["nav-set-knowledge"] = 'Baza wiedzy';
$lang['nav-set-groups'] = 'Grupy';
$lang['nav-set-priorities'] = 'Priorytety';
$lang['nav-set-custom'] = 'Pola niestandardowe';
$lang['nav-set-can'] = 'Gotowe odpowiedzi';
$lang['nav-set-inemail'] = 'Inbound emails';
$lang['nav-set-outemail'] = 'Outbound email';
$lang['nav-set-users'] = 'Użytkownicy';
$lang['nav-set-profile'] = 'Profile';
$lang['nav-set-logout'] = 'Wyloguj się';

// text on settings-general.php
$lang["set-general-title"] = "Ogólne";
$lang["set-general-db-cn"] = "Nazwa firmy";
$lang["set-general-db-fl"] = "Język";
$lang["set-general-db-tz"] = "Strefa czasu";
$lang["set-general-db-df"] = "Format daty";
$lang["set-general-db-rp"] = "Strona do logowania";

// text on settings-tickets.php
$lang["set-tickets-title"] = "Zgłoszenia";
$lang["set-tickets-db-an"] = "Przydzielanie nowego zgłoszenia";
$lang["set-tickets-db-an-desc"] = "Wybierz, czy nowe zgłoszenia są nieprzypisane lub automatycznie przypisane do wybranego użytkownika";
$lang["set-tickets-db-up"] = "Pozwól użytkownikom wybrać priorytet";
$lang["set-tickets-db-as"] = "Użyj obrazu antyspamowych dla użytkowników";
$lang["set-tickets-db-rc"] = "Ponowne otwarcie zamkniętych zgłoszeń jest dostępne";
$lang["set-tickets-db-tr"] = "Priorytet może zostać ustawiony, aby wskazywał ważne żądania.";
$lang["set-tickets-db-fa"] = "Zezwól na załączniki";
$lang["set-tickets-db-fa-desc1"] = "Względna ścieżka dla plików załączników";
$lang["set-tickets-db-fa-desc2"] = "Maksymalna wielkość każdego pliku. Wartości dozwolone dla każdego pliku w megabajtach (MB)";

// text on settings-kb.php
$lang['set-kb-title'] = 'Baza wiedzy';
$lang['set-kb-title-desc'] = 'Baza wiedzy może być użyta do odpowiedzieli na najczęściej zadawane pytania (FAQ), unikając potrzeby powtarzających się wniosków wsparcia.';
$lang['set-kb-db-enkb'] = 'Włącz bazę wiedzy';
$lang['set-kb-db-cokb'] = 'Wyświetlanie liczy stron dla każdego artykułu.';
$lang['set-kb-db-rakb'] = 'Zezwól na oceny dla każdego artykułu.';
$lang['set-kb-db-apkb'] = 'Liczba artykułów wyświetlanych na grupę.';

// text on settings-priorites.php
$lang['set-priorities-title'] = 'Priorytety';
$lang['set-priorities-title-desc'] = '<p>Priorytety może zostać ustawiony, aby wskazywał ważne żądania.</p>';
$lang['set-priorities-db-ap'] = 'Dodaj Priorytet';
$lang['set-priorities-db-ap-desc'] = 'Wprowadź priorytet';
$lang['set-priorities-db-cp'] = 'Obowiązujące Priorytety';

// text on settings-groups.php
$lang['set-groups-title'] = 'Grupy';
$lang['set-groups-desc'] = '<p>Domyślnie musi istnieć co najmniej jedna grupa. Grupy pozwalają na grupowanie zgłoszeń w obszary wiedzy. </p> <p> Aby agenci edytowali zgłoszenia w grupie muszą być w niej zaznaczeni. Jeżeli agent nie jest zaznaczony w danej grupie będą oni ograniczeni do dodania tylko notatki. Aby zaznaczyć przejdź do ustawień użytkownika.</p>';
$lang['set-groups-add'] = 'Dodaj grupę';
$lang['set-groups-enter'] = 'Wpisz nową grupę';
$lang['set-groups-exist'] = 'Istniejące Grupy';

$lang["set-groups-db-ie"] = "No inbound email address are configured for this group <a href=\"#\">Edit</a>";
$lang["set-groups-db-sl"] = "Set SLA for group";
$lang["set-groups-db-rb"] = "Reply By";
$lang["set-groups-db-fb"] = "Fix By";

// text on settings-customfields.php
$lang["set-custom-title"] = "Pola niestandardowe";
$lang["set-custom-title-desc"] = "<p>Nieograniczoną liczba pól niestandardowych można dodać do zbierania dodatkowych informacji od użytkowników.</p><p>Dodatkowe pola pojawią się przed tematem.</p>";
$lang["set-custom-db-af"] = "Dodaj niestandardowe pole";
$lang["set-custom-db-ef"] = "Obecne pola niestandardowe";
$lang["set-custom-db-fn"] = "Nazwa pola";
$lang["set-custom-db-fn-error"] = "Nazwa pola niestandardowego już istnieje";
$lang["set-custom-db-fn-sql-error"] = "Błąd!Pola wybory nie mogą być dodawane. Spróbuj inną nazwę pola";
$lang["set-custom-db-ft"] = "Typ pola";
$lang["set-custom-db-fr"] = "Pole wymagane";
$lang["set-custom-db-fl"] = "Maksymalna długość pola";
$lang["set-custom-db-fl-error"] = "Wymagana wartość liczbowa!. Wprowadź numer od 1 do 255.";
$lang["set-custom-db-fo"] = "Opcje pola";
$lang["set-custom-db-fo-desc"] = "(Oddzielić poszczególne opcje z przecinkami).";

// text on settings-canned.php
$lang["set-canned-title"] = "Gotowe odpowiedzi";
$lang["set-canned-title-desc"] = "Gotowe odpowiedzi są powszechnie stosowanymi odpowiedziami. Tutaj możesz dodać i nimi zarządzać. Mogą one być wykorzystane w celu oszczędności czasu ponownego wpisywania tej samej wiadomości wielokrotnie.";
$lang["set-canned-db-ac"] = "Dodaj gotową odpowiedź";
$lang["set-canned-db-ec"] = "Obecne gotowe odpowiedzi";
$lang["set-canned-db-ct"] = "Tytuł";
$lang["set-canned-db-cm"] = "Gotowa odpowiedź";

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
$lang["set-iemail-db-ea"] = "Adres E-mail";
$lang["set-iemail-db-ho"] = "Host Address";
$lang["set-iemail-db-pn"] = "Port Number";
$lang["set-iemail-db-pr"] = "Protocol";
$lang["set-iemail-db-ssl"] = "SSL";
$lang["set-iemail-db-tls"] = "TLS";
$lang["set-iemail-db-vc"] = "Validate Certificate";
$lang["set-iemail-db-af"] = "Account Folder";
$lang["set-iemail-db-au"] = "Account Username";
$lang["set-iemail-db-ap"] = "Account Password";
$lang["set-iemail-db-tg"] = "Grupa";
$lang["set-iemail-db-tp"] = "Priorytet";
$lang['set-iemail-db-na'] = '! No email addresses configured';

// text on settings-oemail.php
$lang["set-oemail-title"] = "Email Notifications";
$lang["set-oemail-title-desc"] = "Customise the automated email for new, updated, paused and closed tickets. The following codes can be used to insert ticket data. Emails are sent in plain text format.";
$lang["set-oemail-code-tn"] = "The ticket number";
$lang["set-oemail-code-da"] = "The date and time the ticket was added";
$lang["set-oemail-code-du"] = "The date and time the ticket was updated";
$lang["set-oemail-code-ts"] = "The ticket subject";
$lang["set-oemail-code-te"] = "The original ticket enquiry";
$lang["set-oemail-code-u"] = "The name of the user";
$lang["set-oemail-code-tu"] = "REQUIRED! The update to be emailed";
$lang["set-oemail-code-tc"] = "The group assinged";
$lang["set-oemail-code-tp"] = "The prrority assigned";
$lang["set-oemail-db-enable"] = "Enable Outbound Email";
$lang["set-oemail-db-name"] = "Display Name";
$lang["set-oemail-db-email"] = "Adres E-mail";
$lang["set-oemail-db-remail"] = "Reply To Email Address";
$lang["set-oemail-db-tn-sub"] = "Ticket New Subject";
$lang["set-oemail-db-tn-body"] = "Ticket New Email Body";
$lang["set-oemail-db-tu-sub"] = "Ticket Updated Subject";
$lang["set-oemail-db-tu-body"] = "Ticket Updated Body";
$lang["set-oemail-db-tp-sub"] = "Ticket Paused Subject";
$lang["set-oemail-db-tp-body"] = "Ticket Paused Body";
$lang["set-oemail-db-tc-sub"] = "Ticket Closed Subject";
$lang["set-oemail-db-tc-body"] = "Ticket Closed Body";

// text on settings users page
$lang['set-users-title'] = 'Agenci';
$lang['set-users-title-desc'] = '<p>Agents are able to manage tickets in their skilled groups. You can add, edit and delete users. Each user can be assigned a role. By default at least one admin user must exist. Administrators have full contol, supervisors can access reports and agents can only manage tickets.</p>'; 
$lang['set-users-add-agent'] = 'Dodaj Agenta';
$lang['set-users-name'] = 'Imie';

// text on settings add / edit user page
$lang['set-user-title'] = 'Dodaj Agenta';
$lang['set-user-notif'] = 'Powiadomienia';
$lang['set-user-skill'] = 'Umiejętności';
$lang['set-user-skill-desc'] = '<p>By selecting the groups agents are skilled in, agents can accept, update, merge, delete tickets in the selected group.</p><p>Non selected groups will be visible by the agent but they will be restricted to add only notes to a ticket in the non selected group.</p>';
$lang['set-user-db-un'] = 'Nazwa użytkownika';
$lang['set-user-db-pw'] = 'Hasło';
$lang['set-user-db-fn'] = 'Imię';
$lang['set-user-db-ln'] = 'Nazwisko';
$lang['set-user-db-ea'] = 'Adres E-mail';
$lang['set-user-db-role'] = 'Rola';
$lang['set-user-role-admin'] = 'Admin';
$lang['set-user-role-super'] = 'Supervisor';
$lang['set-user-role-agent'] = 'Agent';
$lang['set-user-db-tn'] = 'Notify agent of new tickets';
$lang['set-user-db-tu'] = 'Notify agent of update tickets assigned to agent';
$lang['set-user-db-pm'] = 'Notify agent of private messages added to assigned tickets';

// text on settings edit user page
$lang['set-user-edit-title'] = 'Edycja agenta';
$lang['set-user-edit-pwres'] = 'Resetowanie hasła';
// version 1.1
$lang['set-oemail-db-method-mail'] = 'PHP Mail Function';
$lang['set-oemail-db-method-smtp'] = 'SMTP Server';
$lang['set-oemail-db-smtp-host'] = 'SMTP Server Address';
$lang['set-oemail-db-smtp-auth'] = 'SMTP Authenticate';
$lang['set-oemail-db-smtp-user'] = 'SMTP User';
$lang['set-oemail-db-smtp-pass'] = 'SMTP Password';
$lang['set-oemail-db-smtp-encr'] = 'Encryption';
$lang['set-oemail-db-smtp-port'] = 'SMTP Port';

$lang['set-kb-db-aukb'] = 'Podać autora w  artykule bazy wiedzy?';

$lang['dash-group-sum'] = 'Podsumowanie grup';
$lang['dash-group-table-text'] = 'Kliknij, aby zobaczyć ilość zgłoszeń według grup i statusu';

$lang["set-tickets-db-tv"] = 'Podgląd zgłoszeń';
$lang["set-tickets-db-tv-opt1"] = 'Najnowsze na dole';
$lang["set-tickets-db-tv-opt2"] = 'Najnowsze na górze';

$lang["set-tickets-db-trp"] = 'Formularz odpowiedzi na zgłoszenie';
$lang["set-tickets-db-trp-opt1"] = 'Góra strony';
$lang["set-tickets-db-trp-opt2"] = 'Dół strony';

$lang['tickets-viewby'] = 'Wyświetl poprzez';
$lang['tickets-viewby-opt1'] = 'Rozwinięty';
$lang['tickets-viewby-opt2'] = 'List';
$lang['tickets-exp-noup'] = '** <font color="red"><b>Oczekuje na aktualizację</b></font> **';

$lang['ticket-rating'] = 'Ranking'; // on  admin ticket page
$lang['ticket-rating-waiting'] = 'Oczekiwanie na informacje zwrotne od użytkowników';

$lang['u-kba-author'] = 'Author';
$lang['u-kba-helpful'] = 'Była pomocna?';
$lang['u-kba-out'] = 'z';
$lang['u-kba-found'] = 'uznało tę pomocne';

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