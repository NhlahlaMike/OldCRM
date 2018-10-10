<?php
include_once 'google-api-php-client/vendor/autoload.php';

$client = new Google_Client();

$application_creds = 'service-account-credentials.json';

$credentials_file = file_exists($application_creds) ? $application_creds : false;
define("SCOPE",Google_Service_Calendar::CALENDAR);
define("APP_NAME","Google Calendar API PHP");

$client->setAuthConfig($credentials_file);
$client->setApplicationName(APP_NAME);
$client->setScopes([SCOPE]);

$service = new Google_Service_Calendar($client);

$event = new Google_Service_Calendar_Event(array(
	'summary' => 'Google I/O 2015',
  	'location' => '800 Howard St., San Francisco, CA 94103',
  	'description' => 'A chance to hear more about Google\'s developer products.',
  	'start' => array(
    	'dateTime' => '2015-12-01T10:00:00.000-05:00',
    	'timeZone' => 'America/Los_Angeles',
  	),
  	'end' => array(
    	'dateTime' => '2015-12-01T10:00:00.000-05:00',
    	'timeZone' => 'America/Los_Angeles',
  	),
  	'attendees' => array(
    	array(
    		'email' => 'mail@gmail.com',
    		'organizer' => true
    		),
    	array(
    		'email' => 'tobias@gmail.com',
    		'resource' => true
		),
  	),
  	"creator"=> array(
    	"email" => "email@example.com",
    	"displayName" => "Example",
    	"self"=> true
  	),
  	"guestsCanInviteOthers" => false,
  	"guestsCanModify" => false,
  	"guestsCanSeeOtherGuests" => false,
));

$calendarId = 'primary';
$event = $service->events->insert($calendarId, $event);
printf('Event created: %s', $event->htmlLink);