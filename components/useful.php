<?php
function czechtime($time) {
    return (new DateTime($time, new DateTimeZone('UTC')))
        ->setTimezone(new DateTimeZone('Europe/Prague'))
        ->format('Y/m/d H:i');
}