<?php
function getPlaceName($latitude, $longitude)
{
   $geocode = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $latitude . ',' . $longitude . '&sensor=false');
   $output= json_decode($geocode);

   // return formatted addresss of json response
   return $output->results[0]->formatted_address;
}
?>