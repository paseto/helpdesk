<?php
// PHPLOCKITOPT NOENCODE
// PHPLOCKITOPT NOOBFUSCATE
// PHPLOCKITOPT NOSTRIPCOMMENTS
// PHPLOCKITOPT NOSTRIPWHITESPACE

// USER PAGES

// text on user navigation
$lang['u-nav-kb'] = 'KNOWLEDGE BASE';
$lang['u-nav-s-request'] = 'SUBMIT REQUEST';
$lang['u-nav-t-request'] = 'TRACK REQUEST';

// text on kb
$lang['u-kb-search'] = 'Search';
$lang['u-kb-search-na'] = '! No results found';
$lang['u-kb-kb'] = 'Knowledge Base';
$lang['u-kb-more'] = 'More';
$lang['u-kb-top-articles'] = 'Top Articles';
$lang['u-kb-late-articles'] = 'Latest Articles';

// text on kb article and search and group
$lang['u-kba-dateadd'] = 'Date Added';
$lang['u-kba-views'] = 'Views';
$lang['u-kba-rating'] = 'Rating';
$lang['u-kba-group'] = 'Group';

// text on user track ticket page
$lang['u-ticket-track-title'] = 'Track Request';
$lang['u-ticket-track-t-em'] = 'Email address';
$lang['u-ticket-track-t-no'] = 'Ticket number';
$lang['u-ticket-track-submit'] = 'Track ticket';
$lang['u-ticket-track-error-req'] = '! Email address and tracking number required';
$lang['u-ticket-track-error-inv-em'] = '! Invalid email address entered';
$lang['u-ticket-track-error-inv-no'] = '! Invalid tracking number. Tracking number must be nummeric';
$lang['u-ticket-track-error-not-found'] = '! That email address and ticket number have not been found';

// text on ticket form and ticket success admin and user
$lang['ticket-add-title'] = 'Submit Request';
$lang['ticket-add-name'] = 'Name';
$lang['ticket-add-email'] = 'Email Address';
$lang['ticket-add-group'] = 'Group';
$lang['ticket-add-priority'] = 'Priority';
$lang['ticket-add-subject'] = 'Subject';
$lang['ticket-add-msg'] = 'Message';
$lang['ticket-add-files-add'] = 'Attach Files';
$lang['ticket-add-files-ano'] = 'Attach another';
$lang['ticket-add-sec-code'] = 'Security code';
$lang['ticket-add-sec-code-ent'] = 'Enter security code';
$lang['ticket-add-submit'] = 'Add ticket';
$lang['ticket-add-success-new'] = 'New ticket number';
$lang['ticket-add-success-breif'] = 'Ticket details including number emailed to';

// ADMINS PAGES
$lang['generic-404'] = '<p class="e404">We\'re Sorry...</p><p class="e404">The page you are looking for can not be found</p>';
$lang['generic-save'] = 'Submit';
$lang['generic-change'] = 'Change';
$lang["generic-yes"] = "Yes";
$lang["generic-no"] = "No";
$lang["generic-edit"] = "Edit";
$lang["generic-delete"] = "Delete";
$lang['generic-enable'] = 'Enable';
$lang['generic-disable'] = 'Disable';
$lang["generic-mark"] = "Mark as default";
$lang["generic-unassigned"] = "Unassigned";
$lang["generic-error"] = "! Required field";
$lang['generic-error-number-req'] = '! Number required';
$lang['generic-error-invalid-em'] = '! Invalid email address';
$lang['generic-error-un-exists'] = '! Account already in use';
$lang['generic-error-pw-length'] = '! Password must contain 6 characters or more';
$lang['generic-error-invalid-code'] = '! Invalid code';
$lang['generic-delete-warn'] = '! Can not be deleted until all tickets are unallocated';
$lang['generic-delete-warn-article'] = '! Can not be deleted until all articles are unallocated';
$lang['generic-file-size-exc'] = '! A file size has exceeded the upload limit or is an invalid file format';
$lang['generic-file-size-rule'] = 'File size allowed is';
$lang['generic-file-type-rule'] = 'File types allowed are';
$lang['generic-success-u-add'] = 'User added successfully';
$lang['generic-success-u-edit'] = 'User editted successfully';

// text on admin index page
$lang['index-login'] = 'Sign In';
$lang['index-username'] = 'Email Address';
$lang['index-password'] = 'Password';
$lang['index-langauge'] = 'Langauge';
$lang['index-forgotpwd'] = 'Forgotten Password?';
$lang['index-error'] = '! Username or password incorrect';

// text on admin password reset page
$lang['pwreset-title'] = 'Password Reset';
$lang['pwreset-unknown-u'] = '! Username not recognised';
$lang['pwreset-email-succ'] = '! Success. <p>An email with your new password has been sent to your registered email address</p>';
$lang['pwreset-email-fail'] = 'Failed to email new password';

// text on header page
$lang['header-menu'] = 'MENU';
$lang['header-search'] = 'Search by ID, Name, Subject, etc';

// text on dashboard page
$lang['dash-title-activity'] = 'Recent Activity';
$lang['dash-load-more'] = 'Load More';
$lang['dash-avg-time'] = 'Avg. Response';
$lang['dash-activity-new'] = 'submitted a new ticket';
$lang['dash-activity-change'] = 'changed ticket';
$lang['dash-activity-note'] = 'added a note to ticket';
$lang['dash-activity-closed'] = 'closed ticket';
$lang['dash-activity-reply'] = 'sent a reply to ticket';
$lang['dash-activity-rating'] = 'rated ticket';
$lang['dash-activity-user-replied'] = 'replied to ticket';
$lang['dash-activity-you'] = 'You';
$lang['dash-activity-have'] = 'have';
$lang['dash-activity-has'] = 'has';

// text on admin tickets page
$lang['tickets-filter'] = 'Filter';
$lang['tickets-refresh'] = 'Refresh';
$lang['tickets-ID'] = 'ID';
$lang['tickets-agents'] = 'Agents';
$lang['tickets-subject'] = 'Subject';
$lang['tickets-dateadd'] = 'Date Added';
$lang['tickets-dateadd-anytime'] = 'Anytime';
$lang['tickets-dateadd-today'] = 'Today';
$lang['tickets-dateadd-yesterday'] = 'Yesterday';
$lang['tickets-dateadd-thisweek'] = 'This Week';
$lang['tickets-dateadd-lastweek'] = 'Last Week';
$lang['tickets-dateadd-thismonth'] = 'This Month';
$lang['tickets-dateadd-lastmonth'] = 'Last Month';
$lang['tickets-dateup'] = 'Date Updated';
$lang['tickets-group'] = 'Group';
$lang['tickets-group-desc'] = 'Select groups to view';
$lang['tickets-status'] = 'Status';
$lang['tickets-status-accept'] = 'Accept';
$lang['tickets-status-open'] = 'Open';
$lang['tickets-status-pending'] = 'Pending';
$lang['tickets-status-paused'] = 'Paused';
$lang['tickets-status-closed'] = 'Closed';
$lang['tickets-status-delete'] = 'Delete';
$lang['tickets-status-desc'] = 'Select statuses to view';
$lang['tickets-priority'] = 'Priority';
$lang['tickets-owner'] = 'Owner';
$lang['tickets-sortby'] = 'Sort by';
$lang['tickets-dir-asc'] = 'Ascending';
$lang['tickets-dir-dsc'] = 'Desending';
$lang['tickets-get-email'] = 'Get emails';

// text on search
$lang['search-advanced'] = 'Advanced Search';
$lang['search-subject'] = 'Subject';
$lang['search-msg'] = 'Message content';
$lang['search-cust'] = 'Customer';
$lang['search-any'] = 'Any';
$lang['search-dateaddfrom'] = 'Date Added From';
$lang['search-dateaddto'] = 'Date Added To';
$lang['search-dateupfrom'] = 'Date Updated From';
$lang['search-dateupto'] = 'Date Updated To';
$lang['search-dateclosefrom'] = 'Date Closed From';
$lang['search-datecloseto'] = 'Date Closed From';
$lang['search-button-submit'] = 'Search';
$lang['search-button-reset'] = 'Reset';
$lang['search-results'] = 'results found for';
$lang['search-no-results'] = 'No results found for';
$lang['search-from'] = 'from';
$lang['search-added'] = 'Added';
$lang['search-updated'] = 'Updated';
$lang['search-closed'] = 'Closed';

// text on reports
$lang['rep-filter'] = 'Custom Report';
$lang['rep-report'] = 'Report';
$lang['rep-reset'] = 'Reset';
$lang['rep-period'] = 'Report Period';
$lang['rep-period-from'] = 'Report Period From';
$lang['rep-period-to'] = 'Report Period To';
$lang['rep-graphic'] = 'Show Graphic';
$lang['rep-no-data'] = 'No data found for report criteria';
$lang['rep-dd-ts'] = 'Ticket Summary';
$lang['rep-dd-gl'] = 'Group Summary';
$lang['rep-dd-cs'] = 'Customer Satisfaction';
$lang['rep-dd-st'] = 'Source Summary';
$lang['rep-dd-tt'] = 'Time Spent';
$lang['rep-date-dd-cust'] = 'Custom';
$lang['rep-download'] = 'Download as CSV file';
$lang['rep-total'] = 'Total';
$lang['rep-feedback'] = 'Feedback';

// text on ticket page
$lang['ticket-details-title'] = 'Details';
$lang['ticket-dateintrep'] = 'Date Initally Replied';
$lang['ticket-dateclosed'] = 'Date Closed';
$lang['ticket-customfields'] = 'Custom Fields';
$lang['ticket-fileuploads'] = 'File Uploads';
$lang['ticket-status-closed'] = 'The ticket has been closed and can no longer be updated.';
$lang['ticket-status-notskill'] = 'You\'re not skilled in the desired group. You may add a note for the owner.';
$lang['ticket-status-unassigned'] = 'The ticket is currectly unassigned. To update accept the ticket by clicking accept';
$lang['ticket-status-notowner'] = 'The ticket is not assigned to you. You may add a note for the current owner or you can change the ownership to yourself to reply to the customer.';
$lang['ticket-attachanother'] = 'Attach another';
$lang['ticket-status-dd-note'] = 'Mark as private.';
$lang['ticket-status-dd-update'] = 'Update';
$lang['ticket-status-dd-pause'] = 'Pause';
$lang['ticket-status-dd-close'] = 'Close';
$lang['ticket-show-detail'] = 'Show detail'; // on user ticket page
$lang['ticket-rate'] = 'Rate'; // on user ticket page
$lang['ticket-rate-p'] = 'Positive';
$lang['ticket-rate-neu'] = 'Neutrel';
$lang['ticket-rate-neg'] = 'Negative';

// text on user profile page
$lang['profile-last-log'] = 'Last logged in';
$lang['profile-chg-pwd'] = 'Change password';
$lang['profile-cust-sat'] = 'Customer Satisfaction';
$lang['profile-tickets-own'] = 'Tickets Owned';
$lang['profile-chg-pwd-desc'] = 'Enter your new password below. An email will be sent confirming your new password.';
$lang['profile-chg-pwd-new'] = 'New password';
$lang['profile-chg-pwd-confirm'] = 'Confirm new password';
$lang['profile-chg-pwd-succes'] = '! Success. <p>An email with your new password has been sent to your registered email address</p>';
$lang['profile-chg-pwd-succes-mail-sub'] = 'Password changed !';
$lang['profile-chg-pwd-succes-mail-body'] = 'Your new password is';
$lang['profile-chg-pwd-fail'] = 'Failed to email new password';

// text on knowledge base page
$lang['kb-title'] = 'Knowledge Base';
$lang['kb-enabled'] = 'Knowledge base is enabled';
$lang['kb-disabled'] = 'Knowledge base is currently disabled in Settings > Knowledge Base';
$lang['kb-db-aa-title'] = 'Add Article';
$lang['kb-db-ag-title'] = 'Add Knowledge Base Group';
$lang['kb-db-ag-title-desc'] = 'Add a group to help users find articles.';
$lang["kb-db-eg"] = 'Existing Knowledge Base Groups';
$lang['kb-db-article-title'] = 'Article Title';
$lang['kb-db-article-group'] = 'Article Group';
$lang['kb-db-article-msg'] = 'Article';

// text on menu
$lang['nav-dashboard'] = 'Dashboard';
$lang['nav-tickets'] = 'Tickets';
$lang['nav-add'] = 'Add';
$lang['nav-search'] = 'Search';
$lang['nav-view'] = 'View';
$lang['nav-knowledge'] = 'Knowledge Base';
$lang["nav-knowledge-articles"] = 'Add Article';
$lang["nav-knowledge-groups"] = 'Manage Groups';
$lang['nav-reports'] = 'Reports';
$lang['nav-set'] = 'Settings';
$lang['nav-set-general'] = 'General';
$lang['nav-set-tickets'] = 'Tickets';
$lang["nav-set-knowledge"] = 'Knowledge Base';
$lang['nav-set-groups'] = 'Groups';
$lang['nav-set-priorities'] = 'Priorities';
$lang['nav-set-custom'] = 'Custom Fields';
$lang['nav-set-can'] = 'Canned replies';
$lang['nav-set-inemail'] = 'Inbound emails';
$lang['nav-set-outemail'] = 'Outbound email';
$lang['nav-set-users'] = 'Users';
$lang['nav-set-profile'] = 'Profile';
$lang['nav-set-logout'] = 'Log out';

// text on settings-general.php
$lang["set-general-title"] = "General";
$lang["set-general-db-cn"] = "Company Name";
$lang["set-general-db-fl"] = "Default Langauge";
$lang["set-general-db-tz"] = "Timezone";
$lang["set-general-db-df"] = "Date Format";
$lang["set-general-db-rp"] = "Page on log on";

// text on settings-tickets.php
$lang["set-tickets-title"] = "Ticket";
$lang["set-tickets-db-an"] = "New Ticket Assignment";
$lang["set-tickets-db-an-desc"] = "Select if new tickets are to be unassigned or automatically assigned to a selected user";
$lang["set-tickets-db-up"] = "Allow users to select a priority";
$lang["set-tickets-db-as"] = "Use anti-spam random mathematical code for users";
$lang["set-tickets-db-rc"] = "Re-opening of closed tickets allowed";
$lang["set-tickets-db-tr"] = "Allow ticket ratings";
$lang["set-tickets-db-fa"] = "Allow file attachments";
$lang["set-tickets-db-fa-desc0"] = "Number of file attachments allowed";
$lang["set-tickets-db-fa-desc1"] = "Relative path for file attachments";
$lang["set-tickets-db-fa-desc2"] = "Max size of each file. File sized allowed for each file in megabytes (MB)";
$lang["set-tickets-db-fa-desc3"] = "File types allowed e.g. txt,doc,docx,xls,xlsx";

// text on settings-kb.php
$lang['set-kb-title'] = 'Knowledge Base';
$lang['set-kb-title-desc'] = 'A knowledge base can be used to answered frequently asked questions (FAQ), avoiding the need for repeat support requests.';
$lang['set-kb-db-enkb'] = 'Enable knowledge base';
$lang['set-kb-db-cokb'] = 'Display page counts for each article.';
$lang['set-kb-db-rakb'] = 'Allow like and dislike buttons for each article.';
$lang['set-kb-db-apkb'] = 'Number of articles to display per group.';

// text on settings-priorites.php
$lang['set-priorities-title'] = 'Priority';
$lang['set-priorities-title-desc'] = '<p>Priorities can be set to indicate the important of a request.</p>';
$lang['set-priorities-db-ap'] = 'Add Priority';
$lang['set-priorities-db-ap-desc'] = 'Enter priority';
$lang['set-priorities-db-cp'] = 'Existing Priorities';

// text on settings-groups.php
$lang['set-groups-title'] = 'Groups';
$lang['set-groups-desc'] = '<p>By default at least one group must exist. Groups allow you to group your tickets into your desired groups.</p><p>For agents to edit tickets within a group they must be skilled. If an agent isn\'t skilled in a group they will be restricted to adding notes only. For skills go to User Settings.</p>';
$lang['set-groups-add'] = 'Add Group';
$lang['set-groups-enter'] = 'Enter new group';
$lang['set-groups-exist'] = 'Existing Groups';

$lang["set-groups-db-ie"] = "No inbound email address are configured for this group <a href=\"#\">Edit</a>";
$lang["set-groups-db-sl"] = "Set SLA for group";
$lang["set-groups-db-rb"] = "Reply By";
$lang["set-groups-db-fb"] = "Fix By";

// text on settings-customfields.php
$lang["set-custom-title"] = "Custom Fields";
$lang["set-custom-title-desc"] = "<p>An unlimited number of custom fields can be added to collect additional information from users.</p><p>Custom fields will appear before the subject field.</p>";
$lang["set-custom-db-af"] = "Add custom field";
$lang["set-custom-db-ef"] = "Existing custom fields";
$lang["set-custom-db-fn"] = "Field name";
$lang["set-custom-db-fn-error"] = "Custom field name already exists";
$lang["set-custom-db-fn-sql-error"] = "Error! The custom field cannot be added. Please try another field name";
$lang["set-custom-db-ft"] = "Field type";
$lang["set-custom-db-fr"] = "Field required";
$lang["set-custom-db-fl"] = "Field max length";
$lang["set-custom-db-fl-error"] = "Numeric value required!. Enter a number between 1 and 255.";
$lang["set-custom-db-fo"] = "Field options";
$lang["set-custom-db-fo-desc"] = "(Seperate each option with a comma).";

// text on settings-canned.php
$lang["set-canned-title"] = "Canned Replies";
$lang["set-canned-title-desc"] = "Canned replies are commonly used replies. Here you can add and manage your canned replies. These can be used to save you time retyping the same message repeatedly.";
$lang["set-canned-db-ac"] = "Add canned message";
$lang["set-canned-db-ec"] = "Existing canned messages";
$lang["set-canned-db-ct"] = "Title";
$lang["set-canned-db-cm"] = "Canned Message";

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
$lang["set-oemail-title"] = "Email Notifications";
$lang["set-oemail-title-desc"] = "Customise the automated email for new, updated, paused and closed tickets. The following codes can be used to insert ticket data. Emails are sent in plain text format.";
$lang["set-oemail-code-tn"] = "The ticket number";
$lang["set-oemail-code-da"] = "The date and time the ticket was added";
$lang["set-oemail-code-du"] = "The date and time the ticket was updated";
$lang["set-oemail-code-ts"] = "The ticket subject";
$lang["set-oemail-code-te"] = "The original ticket enquiry";
$lang["set-oemail-code-u"] = "The name of the user";
$lang["set-oemail-code-tu"] = "REQUIRED! The update to be emailed";
$lang["set-oemail-code-tc"] = "The group assigned";
$lang["set-oemail-code-tp"] = "The prrority assigned";
$lang["set-oemail-db-enable"] = "Enable Outbound Email";
$lang["set-oemail-db-name"] = "Display Name";
$lang["set-oemail-db-email"] = "Email Address";
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
$lang['set-users-title'] = 'Agents / Users';
$lang['set-users-title-desc'] = '<p>Agents are able to manage tickets in their skilled groups. You can add, edit and delete users. Each user can be assigned a role. By default at least one admin user must exist. Administrators have full control, supervisors can access reports and agents can only manage tickets.</p>'; 
$lang['set-users-add-agent'] = 'Add User / Agent';
$lang['set-users-name'] = 'Name';

// text on settings add / edit user page
$lang['set-user-title'] = 'Add User / Agent';
$lang['set-user-notif'] = 'Notifications';
$lang['set-user-skill'] = 'Skills';
$lang['set-user-skill-desc'] = '<p>By selecting the groups agents are skilled in, agents can accept, update, merge, delete tickets in the selected group.</p><p>Non selected groups will be visible by the agent but they will be restricted to add only notes to a ticket in the non selected group.</p>';
$lang['set-user-db-un'] = 'Username';
$lang['set-user-db-pw'] = 'Password';
$lang['set-user-db-fn'] = 'Full name';
$lang['set-user-db-ln'] = 'Last name';
$lang['set-user-db-ea'] = 'Email address';
$lang['set-user-db-role'] = 'Role';
$lang['set-user-role-admin'] = 'Admin';
$lang['set-user-role-super'] = 'Supervisor';
$lang['set-user-role-agent'] = 'Agent';
$lang['set-user-db-not-tn'] = 'Notify agent of new tickets';
$lang['set-user-db-tu'] = 'Notify agent of update tickets assigned to agent';
$lang['set-user-db-pm'] = 'Notify agent of private messages added to assigned tickets';

// text on settings edit user page
$lang['set-user-edit-title'] = 'Edit Agent / User';
$lang['set-user-edit-pwres'] = 'Reset Password';

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