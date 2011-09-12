<?php
require_once 'Calendar.php';
require_once 'Event.php';

class RssParser{
	private $rssUrl = "http://kalendaryk.if.ua/rss";
	private $calendar;
	private $event;
	public function __construct(){
		$this->calendar = new Calendar();
	}
	public function getIcalFile()
	{
		if(!file_exists($this->calendar->getCalendarFile()))
		{
		$this->generateIcalFromRss();
		$this->calendar->getIcsCalendar();
		}
	}
	public function generateCalendarFromRss(){

		$patternDate = '/(?<=Початок:|Закінчення:)[^0-9]*((\d{2})\.(\d{2})\.(\d{4}))\,\s(\d{1,2})\:(\d{2})/';
		$patternLocation = '/(?<=\">).*(?=<\/a>)/';
		$patternDescription = '/(?<=<p>)[^<]*(?=<\/p>)/';
		$rss = simplexml_load_file($this->rssUrl);
		$dateTimeZone = new DateTimeZone(date_default_timezone_get());

		foreach ($rss->channel->item as $item){
			$event = new Event();
			$item->description = htmlspecialchars_decode($item->description, ENT_NOQUOTES);
			$item->description = html_entity_decode($item->description, ENT_QUOTES, 'UTF-8');
			preg_match_all($patternDate, $item->description, $matches);
			preg_match($patternLocation, $item->description, $location);
			preg_match($patternDescription, $item->description, $descr);
			$descr = preg_replace('/\n/', '\\n', $descr[0]);
			$descr = preg_replace('/,/', '\,', $descr);
			$descr = preg_replace('/;/', '\;', $descr);
			$location = preg_replace('/,/', '\,', $location[0]);
			$item->title = preg_replace('/,/', '\,', $item->title);
			$dateStart = new DateTime();
			$dateEnd = new DateTime();
			$date = new DateTime();			
			$date->setTimezone($dateTimeZone);		
			$dateStart->setTimezone($dateTimeZone);
			$dateEnd->setTimezone($dateTimeZone);
			$dateStart->setDate($matches[4][0], $matches[3][0], $matches[2][0]);
			$dateEnd->setDate($matches[4][1], $matches[3][1], $matches[2][1]);
			$dateStart->setTime($matches[5][0], $matches[6][0]);
			$dateEnd->setTime($matches[5][1], $matches[6][1]);
			$today = getdate(time());
			$date->setDate($today['year'], $today['mon'], $today['mday']);
			$date->setTime($today['hours'], $today['minutes'], $today['seconds']);	
			$inputId = $item->title.$location.$dateStart->format('Y-m-d H:i:s').$dateEnd->format('Y-m-d H:i:s');
			$uidGen = md5($inputId);	
			
			$event->setCREATED($rss->channel->pubDate);
			$event->setDESCRIPTION($descr);
			$event->setDTEND($dateEnd);
			$event->setDTSTAMP($dateStart);
			$event->setDTSTART($dateStart);
			$event->setLAST_MODIFIED($date);
			$event->setLOCATION($location);
			$event->setSUMMARY($item->title);
			$event->setSEQUENCE();
			$event->setSTATUS();
			$event->setTRANSP();
			$event->setUID($uidGen);
			$this->calendar->addEvent($event);				
		}
	}
	
	public function getRssUrl()
	{
	    return $this->rssUrl;
	}

	public function setRssUrl($rssUrl)
	{
	    $this->rssUrl = $rssUrl;
	}

	public function getCalendar()
	{
	    return $this->calendar;
	}

	public function setCalendar($calendar)
	{
	    $this->calendar = $calendar;
	}


	
}