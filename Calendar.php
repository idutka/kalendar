<?php
include 'Event.php';
class Calendar{
	private $eventArray = array();
	private $VERSION = "2.0";
	private $CALSCALE = "GREGORIAN";
	private $METHOD = "PUBLISH";
	private $X_WR_CALNAME = "SoftJournCalendar@gmail.com";
	private $X_WR_TIMEZONE = "Europe/Kiev";
	private $PRODID = "-//ABC Corporation//NONSGML My Product//EN";
	private $calendarFile = "calendar.ics";
	

	public function setCalendarFile($calendarFile){
		$this->calendarFile = $calendarFile;
	}
	public function generateIcsFile(){
		if(file_exists($this->calendarFile))
		unlink($this->calendarFile);
		$calendarHandler = fopen($this->calendarFile, 'w');
		$fh = $calendarHandler;
			
		fwrite($fh,"BEGIN:VCALENDAR\r\n");
		fwrite($fh,"VERSION:".$this->getVERSION()."\r\n");
		fwrite($fh,"PRODID:".$this->getPRODID()."\r\n");
		fwrite($fh, "CALSCALE:".$this->getCALSCALE()."\r\n");
		fwrite($fh, "METHOD:".$this->getMETHOD()."\r\n");
		fwrite($fh, "X-WR-CALNAME:".$this->getX_WR_CALNAME()."\r\n");
		fwrite($fh, "X-WR-TIMEZONE:".$this->getX_WR_TIMEZONE()."\r\n");		
		//event
		foreach($this->eventArray as $event){
			fwrite($fh,"BEGIN:VEVENT\r\n");
			fwrite($fh,"DTSTART:".$event->getDTSTART()."\r\n");
			fwrite($fh,"DTEND:".$event->getDTEND()."\r\n");
			fwrite($fh,"DTSTAMP:".$event->getDTSTAMP()."\r\n");
			fwrite($fh,"UID:".$event->getUID()."\r\n");
			fwrite($fh,"CREATED:".$event->getCREATED()."\r\n");
			fwrite($fh,"DESCRIPTION:".$event->getDESCRIPTION()."\r\n");
			fwrite($fh,"LAST-MODIFIED:".$event->getLAST_MODIFIED()."\r\n");
			fwrite($fh,"LOCATION:".$event->getLOCATION()."\r\n");
			fwrite($fh,"SEQUENCE:".$event->getSEQUENCE()."\r\n");
			fwrite($fh,"STATUS:".$event->getSTATUS()."\r\n");
			fwrite($fh,"SUMMARY:".$event->getSUMMARY()."\r\n");
			fwrite($fh,"TRANSP:".$event->getTRANSP()."\r\n");
			fwrite($fh,"END:VEVENT\r\n");
		}
		//event		
		fwrite($fh,"END:VCALENDAR\r");
		fclose($fh);
	}
	
	public function __construct(){

	}
	public function getVERSION()
	{
		return $this->VERSION;
	}

	public function setVERSION($VERSION)
	{
		if($VERSION == null)
		$this->VERSION = "2.0";
		else
		$this->VERSION = $VERSION;
	}

	public function getCALSCALE()
	{
		return $this->CALSCALE;
	}

	public function setCALSCALE($CALSCALE)
	{
		if($CALSCALE == null)
		$this->CALSCALE = "GREGORIAN";
		$this->CALSCALE = $CALSCALE;
	}

	public function getMETHOD()
	{
		return $this->METHOD;
	}

	public function setMETHOD($METHOD)
	{
		if($METHOD == null)
		$this->METHOD = "PUBLISH";
		else
		$this->METHOD = $METHOD;
	}

	public function getX_WR_CALNAME()
	{
		return $this->X_WR_CALNAME;
	}

	public function setX_WR_CALNAME($X_WR_CALNAME)
	{
		$this->X_WR_CALNAME = $X_WR_CALNAME;
	}

	public function getX_WR_TIMEZONE()
	{
		return $this->X_WR_TIMEZONE;
	}

	public function setX_WR_TIMEZONE($X_WR_TIMEZONE)
	{
		if($X_WR_TIMEZONE == null)
		$this->X_WR_TIMEZONE = "Europe/Kiev";
		else
		$this->X_WR_TIMEZONE = $X_WR_TIMEZONE;
	}
	public function addEvent(Event $event){
		array_push($this->eventArray, $event);

	}

	public function deleteAllEvent(){
		foreach ($eventArray as $i => $value) {
			unset($eventArray[$i]);
		}
	}

	public function showAllEvents(){
		foreach ($this->eventArray as $event){
			var_dump($event);
		}
	}

	public function getCalendarFile()
	{
	    return $this->calendarFile;
	}

	public function getPRODID()
	{
	    return $this->PRODID;
	}

	public function setPRODID($PRODID)
	{
	    $this->PRODID = $PRODID;
	}
}