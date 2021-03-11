<?php
include ('AbstractGeocoder.php');
include ('Geocoder.php');

//use Geocoder;
$query = $_GET['selectedCountry'];
$key = 'db57f2c3ce9248a19b65d902a38db8cf';
$geocoder = new Geocoder\Geocoder($key);
$result = $geocoder->geocode($query);
$data = $result['results'][0];
foreach ($data['annotations']['DMS'] as $key => $val)
{
    if (!is_array($val))
    {
        if ($key === "lat")
        {
            echo "Latitude : " . $val . "<br><hr>";
        }

        if ($key === "lng")
        {
            echo "Longitude : " . $val . "<br><hr>";
        }

    }
}

$resultEncode = json_encode($data, true);
$data = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($resultEncode, true)) , RecursiveIteratorIterator::SELF_FIRST);
foreach ($data as $key => $val)
{
    if (!is_array($val))
    {
        if ($key === "flag")
        {
            echo "Flag : " . $val . "<br><hr>";
        }

        if ($key === "Maidenhead")
        {
            echo "Maidenhead : " . $val . "<br><hr>";
        }

        if ($key === "callingcode")
        {
            echo "Calling Code : " . $val . "<br><hr>";
        }

        if ($key === "iso_code")
        {
            echo "Currency : " . $val . "<br><hr>";
        }

        if ($key === "symbol")
        {
            echo "Currency Symbol: " . $val . "<br><hr>";
        }

        if ($key === "continent")
        {
            echo "Continent : " . $val . "<br><hr>";
        }

        if ($key === "country")
        {
            echo "Country : " . $val . "<br><hr>";
        }

        if ($key === "wikidata")
        {
            echo "Wikidata : <a target='blank' href='https://www.wikidata.org/wiki/$val'>" . $val . "</a><br><hr>";
        }

    }
}

echo "Temperature : ".$_GET['temp']. "<br><hr>";
echo "Weather : ".$_GET['weather']. "<br><hr>";
echo "Population : ".$_GET['population']. "<br><hr>";




