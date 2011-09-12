<?php
require_once 'Calendar.php';
require_once 'Event.php';
require_once 'RssParser.php';
//lol
date_default_timezone_set('Europe/Kiev');
$rssParser = new RssParser();
$rssParser->generateCalendarFromRss();
$rssParser->getCalendar()->setX_WR_CALNAME("Kalendaryk.if.ua@gmail.com");
$rssParser->getCalendar()->generateIcsFile();
$file = ($rssParser->getCalendar()->getCalendarFile());
header('Location:'.$file.'');
?>