<?php

require_once "../lib/db.php";
require_once "../lib/global.php";
$pdo_conn = pdo_conn();

$sql = "SELECT * FROM ".$pdo_t['t_iemail']." WHERE disabled IS NULL";
$q = $pdo_conn->prepare($sql);
$q->execute();
$imail_account = $q->fetchAll();

foreach ($imail_account as $imail) {

	/* connect to mail */
	$email_addr = $imail['Email_Addr'];
	$host = $imail['Email_Host'];
	$port = $imail['Port_No']; // port
	$service = "/".$imail['Protocol']; // imap, imap2, imap2bis, imap4, imap4rev1, pop3, nntp
	
	// ssl
	if($imail['Email_SSL'] == 1) {
		$ssl = "/ssl";
	} else {
		$ssl = "";
	}
	
	// tls, notls
	if($imail['Email_TLS'] == 1) {
		$tls = "/tls";
	} else {
		$tls = "/notls";
	}

	// /novalidate-cert, /validate-cert
	$cert = $imail['Val_Cert'];

	// email folder
	$folder = $imail['Email_Folder'];
	
	// group and level for email to be place into
	$group = $imail['Email_Group'];
	$priority = $imail['Priority'];
	
	$server = "{".$host.":".$port.$service.$cert.$ssl.$tls."}".$folder;
	$login = $imail['Email_User'];
	$pwd = $imail['Email_Pass'];
	
	// count for each account
	$i=0;

	// open connection for each account
	$connection[$i] = imap_open($server, $login, $pwd);

	// count number of emails in each account / connection
	$emails[$i] = imap_search($connection[$i],'UNSEEN');
	//$emails[$i] = imap_sort($connection[$i], SORTARRIVAL,1);
	@rsort($emails[$i]);
	
	if (empty($emails[$i])) {
		
		echo '<p style="color:red">No messages to get from mailbox '.$email_addr.'</p>
			<p><hr></p>';
	
	// if more than one message in mailbox		
	} else if ($emails[$i] > 0) {
		
		foreach($emails[$i] as $e) {
		    //custom mark email as seen
            $status = imap_setflag_full($connection[$i], $e, "\\Seen");

			$emailMessage = new EmailMessage($pdo_conn, $pdo_t, $connection[$i], $e);
			// set to true to get the message parts (or don't set to false, the default is true)
			$emailMessage->getAttachments = true;
			$emailMessage->fetch();
			$emailMessage->fetchoverview();
													
			// set variables from mail to use in sql		
			$user = $emailMessage->fromname;
			$user_email = $emailMessage->fromaddress;	
			$customer = ($user == "") ? $user_email : $user; // if email from no display name then use email address as customer.			
			$subject = $emailMessage->subject;			
			$emailbody = (!empty($emailMessage->bodyHTML)) ? $emailMessage->bodyHTML : $emailMessage->bodyPlain;
			$emailbody = clean(strip_html_tags($emailbody, FALSE)); // strip unallowed html tags							
			$files = ""; // default variable for files
			$owner_assignment = aaModelGetTicketAssignment($group); // get owner assignment by group
			
			list ($slar, $slaf) = aaModelGetTicketSLA(timezone_time(), $group, $priority); // get SLA reply and fix by group and priority
			
			//echo 'REPLY - '.$slar.' - FIX - '.$slaf;
			
			// cut off any text after reply above
			if (strpos($emailbody, '---- reply above this line ---') !== false) {
				$emailbody = substr($emailbody, 0, strpos($emailbody, '---- reply above this line ---'));
			}
			
			if (preg_match("/([0-9]{7})/", $subject, $matches)) {
				
				// select existing tickets
				$sql = "SELECT ID, Status FROM ".$pdo_t['t_ticket']." WHERE ID = :tid AND Status != :status";
				$q = $pdo_conn->prepare($sql);
				$q->execute(array('tid' => $matches[0], 'status' => "Closed"));
				$existing_id = $q->rowCount();			
				
				if ($existing_id > 0) {
					// if subject matches and an open ticket exists
					$sqlid = $emailMessage->updateSQL ($matches[0], $customer, $emailbody);
					
					// If file uploads are enabled and a directory exists
					if (aaFileUpDir()) {
						$updateid = ltrim($matches[0], "0");
						$files = $emailMessage->uploadFileAttachments( $updateid ); // upload any files attached to upload folder
					} else {
						$files = "";
					}
					echo "<h1>".$files." === ".$sqlid."</h1>";
					// update inserted ticket with files
					$update_files = "UPDATE ".$pdo_t['t_ticket_updates']." SET Update_Files = :files WHERE ID = :tid";
					$q_update_files = $pdo_conn->prepare($update_files);
					$q_update_files->execute(array('files' => $files, 'tid' => $sqlid));			
					
				} else {
					// if subject matches but not an existing ticket
					$sqlid = $emailMessage->insertSQL ($customer, $user_email, $group, $priority, $subject, $emailbody, $files, $owner_assignment, $slar, $slaf);
					
					// If file uploads are enabled and a directory exists
					if (aaFileUpDir()) {
						$files = $emailMessage->uploadFileAttachments( $sqlid ); // upload any files attached to upload folder
					} else {
						$files = "";
					}
					
					// update inserted ticket with files
					$update_files = "UPDATE ".$pdo_t['t_ticket']." SET Files = :files WHERE ID = :tid";
					$q_update_files = $pdo_conn->prepare($update_files);
					$q_update_files->execute(array('files' => $files, 'tid' => $sqlid));			
					
				}
				
			} else {
				
				// if new email
				$sqlid = $emailMessage->insertSQL ($customer, $user_email, $group, $priority, $subject, $emailbody, $files, $owner_assignment, $slar, $slaf);
				
				// If file uploads are enabled and a directory exists
				if (aaFileUpDir()) {
					$files = $emailMessage->uploadFileAttachments( $sqlid ); // upload any files attached to upload folder
				} else {
					$files = "";
				}
				
				// update inserted ticket with files
				$update_files = "UPDATE ".$pdo_t['t_ticket']." SET Files = :files WHERE ID = :tid";
				$q_update_files = $pdo_conn->prepare($update_files);
				$q_update_files->execute(array('files' => $files, 'tid' => $sqlid));					
				
			}
			
				
			echo '<p>'.$customer." - ".$emailMessage->subject.'</p>
			'.html_entity_decode($emailbody).'
			<p><hr></p>';	
										
		}
	
	// else unknown error		
	} else {

		echo 'ERROR Unknown error whilst getting emails';
	
	}
	
	
imap_errors();
imap_alerts();
imap_close($connection[$i]);
// increase count
$i++;
// end while
	
}

class EmailMessage {

	protected $connection;
	protected $messageNumber;
	protected $pdo_conn;
	protected $pdo_t;

	public $fromname = '';
	public $fromaddress = '';
	public $subject = '';	
	public $bodyHTML = '';
	public $bodyPlain = '';
	public $attachments;
	
	public $getAttachments = true;
	
	public function __construct($pdo_conn, $pdo_t, $connection, $messageNumber) {
		
		$this->pdo_conn = $pdo_conn;
		$this->pdo_t = $pdo_t;
		$this->connection = $connection;
		$this->messageNumber = $messageNumber;
		
	}
	
	
	// upload email attachments
	public function uploadFileAttachments($tid) {
	
		$dir = get_settings("File_Path");
		
		// UPLOAD FILES			
			if (isset($this->attachments)) {
				
				if(!is_file($dir.$tid)) {
					mkdir($dir.$tid);
				}
						
				foreach($this->attachments as $file) {
					// unique id for filenames from each email
					$uqid = uniqid();
					$file["filename"] = str_replace(" ", "_", $file["filename"]); // remove spaces from filename
					// prefix attached filename with unique id
					@$filename .= $uqid.'___'.$file["filename"].";";
					$file_upload = $uqid.'___'.$file["filename"];
					
					// move file attachment to folder
					file_put_contents($dir.$tid."/".$file_upload, $file['data']);
					
					// match any html emails with embedded images
					preg_match_all('/src="cid:(.*)"/Uims', $this->bodyHTML, $matches);
					
					if(count($matches)) {
					
						$search = array();
						$replace = array();
						
						foreach($matches[1] as $match) {
							$uniqueFilename = $match.".".$this->attachments[$match]['type'];
							file_put_contents($dir.$tid."/".$uniqueFilename, $this->attachments[$match]['data']);
						}
										
					}
					
				}
			}
			return rtrim(@$filename,";");
		// END UPLOAD FILES	
	}
	
	
	public function updateSQL ($tid, $u, $message) {
		
		$now = timezone_time();			

		// set update ticket
		$sql_up = "UPDATE ".$this->pdo_t['t_ticket']." SET Status = :status, Date_Updated = :dateup WHERE ID = :tid";
		$q_up = $this->pdo_conn->prepare($sql_up);
		
		if ($q_up->execute(array('status' => "Awaiting Reply",
								'dateup' => $now,
								'tid' => $tid))) {
								
			echo "<p><b>SUCCESS Updated ticket status and date updated</b></p>";
			
			// insert update into ticket updates
			$sql_in = "INSERT INTO ".$this->pdo_t['t_ticket_updates']." (Ticket_ID, Update_By, Updated_At, Update_Type, Notes, Update_Emailed)
			VALUES (:tid, :u, :dateup, :type, :message, :public)";
			$q_in = $this->pdo_conn->prepare($sql_in);
			
			if ($q_in->execute(array('tid' => $tid,
									'u' => $u,
									'dateup' => $now,
									'type' => "Update",
									'message' => $message,																											
									'public' => 1))) {
									
				echo "<p><b>SUCCESS Inserted ticket update via email</b></p>";
				// notify the owner of the updates
				//send_email_notification_up_ticket($matches[0]);
				$lastId = $this->pdo_conn->lastInsertId();					
				aaSendEmailUpdateTicketNotification($tid);
				
			} else {
			
				echo '<p><b>ERROR inserting ticket update via email'.print_r($this->pdo_conn->errorInfo()).'</b></p>';
			
			}					
		
		} else {
		
			echo '<p><b>ERROR updating master ticket status via email'.print_r($this->pdo_conn->errorInfo()).'</b></p>';
			
		}
		
		return $lastId;
	
	}
	
	public function insertSQL ($u, $u_email, $group, $priority, $subject, $emailbody, $files = NULL, $assignment, $slar, $slaf) {
					
		$now = timezone_time();		

		// add new ticket
		$sql = "INSERT INTO ".$this->pdo_t['t_ticket']." (User, User_Email, Cat_ID, t_GID_Origin, Level_ID, Type, Subject, Message, Status, Owner, SLA_Reply, SLA_Fix, Date_Added, Date_Updated) 
		VALUES (:u, :u_email, :group, :gid_o, :priority, :type, :subject, :message, :status, :assignment, :slar, :slaf, :dateadd, :dateup)";  
		$q = $this->pdo_conn->prepare($sql);
		
		if ($q->execute(array('u' => $u,
							'u_email' => $u_email, 
							'group' => $group,
							'gid_o' => $group,
							'priority' => $priority,
							'type' => "Email",
							'subject' => $subject,
							'message' => $emailbody,
							'status' => "Open", 
							'assignment' => $assignment,
							'slar' => $slar,
							'slaf' => $slaf,							
							'dateadd' => $now, 
							'dateup' => $now))) {
								
			echo '<p><b>SUCCESS Inserted new ticket via email</b></p>';	
			
			$lastId = $this->pdo_conn->lastInsertId();
			
			aaSendEmailTicketUpdate($lastId, "Open", $u_email, $emailbody);			
			//send_email_update($lastid, "Open", $user_email, $emailbody);
			
			// send notification of new ticket to selected users
			// send_email_notification_new_ticket('A new ticket ['.$lastid.'] has been submitted', $subject.'<p>---</p><p>'.decode_entities($emailbody).'</p>'); 			
			aaSendEmailNewTicketNotification('A new ticket ['.$lastId.'] has been submitted', $subject.'<p>---</p><p>'.decode_entities($emailbody).'</p>'); 				
			
		} else {
		
			echo '<p><b>ERROR insert new ticket status via email'.print_r($this->pdo_conn->errorInfo()).'</b></p>';
			
		}
		return $lastId;

	}	

	// fetch email details
	public function fetchoverview() {
	
		$overview = imap_headerinfo($this->connection, $this->messageNumber);
		
		$from = $overview->from;
		foreach ($from as $object) {
			@$this->fromname =iconv_mime_decode($object->personal,0,"UTF-8");
			$this->fromaddress = $object->mailbox . "@" . $object->host;
		}
		
		$this->subject = iconv_mime_decode($overview->subject,0,"UTF-8");
		
	}
	
	// fetch email body	
	public function fetch() {
	
		$structure = @imap_fetchstructure($this->connection, $this->messageNumber);
		
		if(!$structure) {
		
			return false;
		
		} else {
		
			$myobj = get_object_vars($structure);
		
			if(isset($myobj['parts'])){
			
			$this->recurse($structure->parts);
			
			} else{
			
			$this->norecurse($structure);
			
			}
		
			return true;
		
		}
		
	}
		
	public function norecurse($structure) {
		
		$body=imap_body($this->connection, $this->messageNumber);
		
		//decode if quoted-printable
		if ($structure->encoding==4) { 
		
			$body=quoted_printable_decode($body);
		
		} 
		
		//PROCESSING
		if (strtoupper($structure->subtype)=='PLAIN') {
		
			$this->bodyPlain .= nl2br($body);
		
		} else if (strtoupper($structure->subtype)=='HTML') {
			
			$this->bodyHTML .= $body;
		
		}
		
	}
	
	public function recurse($messageParts, $prefix = '', $index = 1, $fullPrefix = true) {

		foreach($messageParts as $part) {
			
			$partNumber = $prefix . $index;
			
			$disposition = (isset($part->disposition) ? $part->disposition : null);
			
			if($part->type == 0 && $disposition != 'attachment') {
				if($part->subtype == 'PLAIN') {
					$this->bodyPlain .= $this->getPart($partNumber, $part->encoding);
				}
				else {
				
					$this->bodyHTML .= $this->getPart($partNumber, $part->encoding);
				}
			}
			elseif($part->type == 2) {
				$msg = new EmailMessage($this->connection, $this->messageNumber);
				$msg->getAttachments = $this->getAttachments;
				$msg->recurse($part->parts, $partNumber.'.', 0, false);
				$this->attachments[] = array(
					'type' => $part->type,
					'subtype' => $part->subtype,
					'filename' => '',
					'data' => $msg,
					'inline' => false,
				);
			}
			elseif(isset($part->parts)) {
				if($fullPrefix) {
					$this->recurse($part->parts, $prefix.$index.'.');
				}
				else {
					$this->recurse($part->parts, $prefix);
				}
			}
			elseif($part->type > 2 || $disposition == 'attachment') {
				if(isset($part->id)) {
					$id = str_replace(array('<', '>'), '', $part->id);
					$this->attachments[$id] = array(
						'type' => $part->type,
						'subtype' => $part->subtype,
						'filename' => $this->getFilenameFromPart($part),
						'data' => $this->getAttachments ? $this->getPart($partNumber, $part->encoding) : '',
						'inline' => true,
					);
				}
				else {
					$this->attachments[] = array(
						'type' => $part->type,
						'subtype' => $part->subtype,
						'filename' => $this->getFilenameFromPart($part),
						'data' => $this->getAttachments ? $this->getPart($partNumber, $part->encoding) : '',
						'inline' => false,
					);
				}
			}
			
			$index++;
			
		}
		
	}
	
	function getPart($partNumber, $encoding) {

		$data = imap_fetchbody($this->connection, $this->messageNumber, $partNumber);
		switch($encoding) {
			case 0: return $data; // 7BIT
			case 1: return $data; // 8BIT
			case 2: return $data; // BINARY
			case 3: return base64_decode($data); // BASE64
			case 4: return quoted_printable_decode($data); // QUOTED_PRINTABLE
			case 5: return $data; // OTHER
		}


	}
	
	function getFilenameFromPart($part) {

		$filename = '';

		if($part->ifdparameters) {
			foreach($part->dparameters as $object) {
				if(strtolower($object->attribute) == 'filename') {
					$filename = $object->value;
				}
			}
		}

		if(!$filename && $part->ifparameters) {
			foreach($part->parameters as $object) {
				if(strtolower($object->attribute) == 'name') {
					$filename = $object->value;
				}
			}
		}

		return $filename;

	}

}