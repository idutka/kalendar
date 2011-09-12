<?php
class Event{
	private $DTSTART;
	private $DTEND;
	private $DTSTAMP;
	private $UID = "";
	private $CREATED;
	private $DESCRIPTION;
	private $LAST_MODIFIED;
	private $LOCATION;
	private $SEQUENCE = "0";
	private $SUMMARY = "";
	private $TRANSP = "OPAQUE";
	private $STATUS = "CONFIRMED";
	public function __construct(){
	}
	public function getDTSTART()
	{
		$this->DTSTART->setTimezone(new DateTimeZone('UTC'));
		return $this->DTSTART->format('Ymd\THis\Z');
	}

	public function setDTSTART($DTSTART)
	{
		$this->DTSTART = $DTSTART;
	}

	public function getDTEND()
	{
		$this->DTEND->setTimezone(new DateTimeZone('UTC'));
		return $this->DTEND->format('Ymd\THis\Z');
	}

	public function setDTEND($DTEND)
	{
		$this->DTEND = $DTEND;
	}

	public function getDTSTAMP()
	{
		$this->DTSTAMP->setTimezone(new DateTimeZone('UTC'));
		return $this->DTSTAMP->format('Ymd\THis\Z');
	}

	public function setDTSTAMP($DTSTAMP)
	{

		$this->DTSTAMP = $DTSTAMP;
	}

	public function getUID()
	{
		return $this->UID;
	}

	public function setUID($UID)
	{
		
		$UID .= "@kalendaryk.if.ua";
		
		$this->UID = $UID;
	}

	public function getCREATED()
	{
		$this->CREATED->setTimezone(new DateTimeZone('UTC'));
		return $this->CREATED->format('Ymd\THis\Z');
	}

	public function setCREATED($CREATED)
	{
		$dtcreated = new DateTime(date("Ymd\THis\Z", strtotime($CREATED)));
		$this->CREATED = $dtcreated;
	}

	public function getDESCRIPTION()
	{
		return $this->DESCRIPTION;
	}

	public function setDESCRIPTION($DESCRIPTION)
	{
		$this->DESCRIPTION = $DESCRIPTION;
	}

	public function getLAST_MODIFIED()
	{
		$this->LAST_MODIFIED->setTimezone(new DateTimeZone('UTC'));
		return $this->LAST_MODIFIED->format('Ymd\THis\Z');
	}

	public function setLAST_MODIFIED($LAST_MODIFIED)
	{
		$this->LAST_MODIFIED = $LAST_MODIFIED;
	}

	public function getLOCATION()
	{
		return $this->LOCATION;
	}

	public function setLOCATION($LOCATION)
	{
		$this->LOCATION = $LOCATION;
	}

	public function getSEQUENCE()
	{
		return $this->SEQUENCE;
	}

	public function setSEQUENCE($SEQUENCE = null)
	{
		if($SEQUENCE == null)
		$this->SEQUENCE = "0";
		else
		$this->SEQUENCE = $SEQUENCE;
	}

	public function getSUMMARY()
	{
		return $this->SUMMARY;
	}

	public function setSUMMARY($SUMMARY)
	{
		$this->SUMMARY = $SUMMARY;
	}

	public function getTRANSP()
	{
		return $this->TRANSP;
	}

	public function setTRANSP($TRANSP = null)
	{
		if($TRANSP == null)
		$this->TRANSP = "OPAQUE";
		else
		$this->TRANSP = $TRANSP;
	}
	public function getSTATUS()
	{
		return $this->STATUS;
	}

	public function setSTATUS($STATUS = null)
	{
		if($STATUS == null)
		$this->STATUS = "CONFIRMED";
		else
		$this->STATUS = $STATUS;
	}

}