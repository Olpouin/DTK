<?php
class Quote {
	private $_id;
	private $_text;
	private $_date;
	private $_source;
	private $_approved;

	function __construct($quote) {
		$this->_id = $quote['id'];
		$this->_text = $quote['text'];
		$this->_date = $quote['date'];
		$this->_source = $quote['source-type'];
		$this->_approved = $quote['approved'];
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
		$icons = "<img class='quote-icon usable-icon' onclick='share(\"".Config::read('gene.path')."/page/quotes/share?p=".$this->_id."\");' src='".$iconsPath."share.svg' alt='Icône partage' title=\"Partager\">";
		if ($this->_source == 1) $icons .= "<img class='quote-icon' src='".$iconsPath."voice.svg' alt='Icône chat vocal' title=\"Chat vocal\">";

		$text = $this->textSafe();
		$text = preg_replace('/^&lt;(.*)&gt;/Um', '<span class="t-u">$0</span>', $text); // Username -> Light blue
		$text = preg_replace('/\/\*(.*)\*\//Us', '<span class="t-d">$1</span>', $text); // Desciption -> Dark blue

		if ($this->_date == NULL) $date = "Date inconnue";
		else $date = date("d/m/Y", strtotime($this->_date));

		$quote = "<div class='quote' id='{$this->_id}'><div class='quote-h'><span>#{$this->_id} | <span>{$date}</span></span>{$icons}</div><pre>{$text}</pre></div>";
		return $quote;
	}
}

?>
