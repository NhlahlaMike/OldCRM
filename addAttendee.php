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

$id = 'event-id';
$event = $service->events->get('primary',$id);

$attendeeNew = new Google_Service_Calendar_EventAttendee();
$attendeeNew->setEmail('mail@test.com');
$attendeeNew->setResponseStatus('accepted');
$attendeeNew->setOrganizer(true);

$attedess = $event->getAttendees();
array_push($attedess,$attendeeNew);
$event->setAttendees($attedess);

$updatedEvent = $service->events->update('primary', $id, $event);

var_dump($updatedEvent->getAttendees());