<?php
include_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();

$application_creds = 'service-account-credentials.json';

$credentials_file = file_exists($application_creds) ? $application_creds : false;
define("SCOPE",Google_Service_Calendar::CALENDAR);
define("APP_NAME","Google Calendar API PHP");

$client->setAuthConfig($credentials_file);
$client->setApplicationName(APP_NAME);
$client->setScopes([SCOPE]);

$service = new Google_Service_Calendar($client);

$event = new Google_Service_Calendar_Event();  
$event->setSummary('Halloween');
$event->setLocation('The Neighbourhood');
$event->setSummary('Evento creado desde el API');

$start = new Google_Service_Calendar_EventDateTime();
$start->setDateTime('2015-12-01T10:00:00.000-05:00');
$event->setStart($start);

$end = new Google_Service_Calendar_EventDateTime();
$end->setDateTime('2015-12-02T10:25:00.000-05:00');
$event->setEnd($end);

$attendee = new Google_Service_Calendar_EventAttendee();
$attendee->setEmail('mail2@gmail.com');
$attendees = array($attendee);
$event->setAttendees($attendees);

$organizer = new Google_Service_Calendar_EventOrganizer();
$organizer->setEmail('mai1@gmail.com');
$organizer->getDisplayName("Full Name");

$event->setOrganizer($organizer);

$createdEvent = $service->events->insert('primary', $event);
echo "ID => <br>"; 
echo $createdEvent->getId() . "<br>";
echo "HTML => <br>";
echo $createdEvent->getHtmlLink() . "<br>";

?>