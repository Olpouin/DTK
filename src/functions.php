<?php
class Quote {
	private $_id;
	private $_text;
	private $_date;
	private $_source;
	private $_subject;
	private $_approved;

	private $_password;
	private $_accessName;
	private $_accessLoc;

	function __construct() {
		$this->_accessName = "Inconnu";
		$this->_accessLoc = "Inconnue";
	}

	public function notifyQuote($id) {
		$url = 'https://canary.discordapp.com/api/webhooks/443529154529591306/r-JUOn4_7v3_0ZFm69Sz8H0VaJLbVY4EEwLSuuVeld2JgpHTDS-pKX-EBM4TqRPvKa49';
		$data = array(
			'content' => '',
			'username' => 'Notifications DTK',
			'embeds' => array(
				array(
					'title' => 'Nouvelle quote !',
					'url' => 'https://'.$_SERVER['HTTP_HOST'].Config::read('gene.path')."/share/".$id,
					'description' => $this->_text,
					'color' => '3447003',
					'fields' => [['name'=>'Type d\'accès','value'=>$this->_accessName,'inline'=>true],['name'=>'Source','value'=>$this->_accessLoc,'inline'=>true]],
					'footer' => array('text' => 'Dans Ton Kévain - Parce que la boutade n\'attend pas')
				)
			)
		);

		$options = array(
				'http' => array(
				'header'  => "Content-type: application/json\r\n",
				'method'  => 'POST',
				'content' => json_encode($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
	}

	public function load($quote) {
		$this->_id = $quote['id'];
		$this->_text = $quote['text'];
		$this->_date = $quote['date'];
		$this->_source = $quote['source-type'];
		$this->_subject = $quote['subject'];
		$this->_approved = $quote['approved'];
	}
	public function upload($accessLoc) {
		$core = Core::getInstance();
		try {
			$request = $core->db->prepare('INSERT INTO DTK(text,date,`source-type`, subject, approved) VALUES(:text,:date,:sourceType,:subject,:approved)');
			$request->execute(array(
				'text' => $this->_text,
				'date' => $this->_date,
				'sourceType' => $this->_source,
				'subject' => $this->_subject,
				'approved' => '1'
			));
			$this->_accessLoc = $accessLoc;
			$this->notifyQuote($core->db->lastInsertId());
			return true;
		} catch (Exception $e) {
			die('Error : '.$e->getMessage());
			return false;
		}
	}

	public function checkPass($pass) {
		foreach (Config::read('gene.passwords') as $key => $value) {
			if (password_verify($pass, $key)) {
				$this->_password = $pass;
				$this->_accessName = $value['txt'];
				return [
					'answer' => true,
					'txt' => $value['txt'],
					'lvl' => $value['lvl']
				];
			}
		} return [
			'answer' => false
		];
	}

	public function setText($txt) {
		if (strlen($txt) <= 10 || strlen($txt) >= 2000) return false;
		$this->_text = $txt;
		return true;
	}
	public function setDate($date) {
		if (($timestamp = strtotime($date)) == "false") return false;
		$dateFormatted = date("Y-m-d", $timestamp);
		$this->_date = $dateFormatted;
		return true;
	}
	public function setSource($src) {
		if ($src == "true") $this->_source = 1;
		else $this->_source = 0;
	}
	public function setSubject($subj) {
		if ($subj == "true") $this->_subject = 1;
		else $this->_subject = 0;
	}

	public function id() {
		return $this->_id;
	}
	public function textSafe()	{
		return htmlentities($this->_text);
	}

	public function quoteNear($type) {
		$core = Core::getInstance();
		$quotePrepare = ($type == "next") ?
			$core->db->prepare("SELECT * FROM `DTK` WHERE id > ".$this->_id." AND approved = 1 ORDER BY id LIMIT 1") : //next quote
			$core->db->prepare("SELECT * FROM `DTK` WHERE id < ".$this->_id." AND approved = 1 ORDER BY id DESC LIMIT 1"); //previous quote
		$quotePrepare->execute();
		if ($quotePrepare->rowCount() == 0) return NULL;
		$quoteArray = $quotePrepare->fetch();
		return $quoteArray['id'];
	}

	public function toHTML() {
		$iconsPath = Config::read('gene.path')."/content/icons/";
		$icons = "<img class='quote-icon usable-icon' onclick='share(\"".Config::read('gene.path')."/share/".$this->_id."\");' src='".$iconsPath."share.svg' alt='Icône partage' title=\"Partager\">";
		if ($this->_source == 1) $icons .= "<img class='quote-icon' src='".$iconsPath."voice.svg' alt='Icône chat vocal' title=\"Chat vocal\">";
		if ($this->_subject == 1) $icons .= "<img class='quote-icon' src='".$iconsPath."RP.svg' alt='Icône chat vocal' title=\"En rapport avec un RP\">";

		$text = $this->textSafe();
		$text = preg_replace('/^&lt;(.*)&gt;/Um', '<span class="t-u">$0</span>', $text); // Username -> Light blue
		$text = preg_replace('/\/\*(.*)\*\//Us', '<span class="t-d">$1</span>', $text); // Desciption -> Dark blue

		if ($this->_date == NULL) $date = "Date inconnue";
		else $date = date("d/m/Y", strtotime($this->_date));

		$quote = "<div class='quote' id='{$this->_id}'><div class='quote-h'><span>#{$this->_id} | <span>{$date}</span></span>{$icons}</div><pre>{$text}</pre></div>";
		return $quote;
	}
}

function APIresponse($title, $msg) {
	$resp = [
		'title'=>$title,
		'message'=>$msg
	];
	return json_encode($resp);
}
?>
