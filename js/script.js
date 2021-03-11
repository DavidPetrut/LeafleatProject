$(document).ready(function() {
    navigator.geolocation.getCurrentPosition(function(location) {

    //Getting user current location lat and lng
    var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
    console.log(latlng);

    //let latlng = new L.LatLng(51.584050, -0.019740);

    //For get user current location
    //   var map = L.map('map').locate({
    //       setView: true,
    //       maxZoom: 16
    //   });
    //   console.log(map);

    let map = L.map('map').setView([location.coords.latitude, location.coords.longitude], 13);
    var options = {
        key: 'db57f2c3ce9248a19b65d902a38db8cf',
        limit: 10
    };

    //Search box

    let geocoder = L.Control.OpenCageSearch.geocoder(options);
    let control = L.Control.openCageSearch(options).addTo(map);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoia2FtbmEtbWFkaHdhbmkiLCJhIjoiY2tsdXlrODN4MmwxajJ2bjFrMXl1M2phNyJ9._IUb-tsXBVe2UFiAyDpcuA'
    }).addTo(map);

    //Adding marker to user current location
    let marker = L.marker(latlng).addTo(map);

    //Adding marker and show popup when user click on any location on map
    map.on('click', function(e) {
        let location;
        let query = e.latlng.lat.toString() + ',' + e.latlng.lng.toString();
        geocoder.geocode(query, function(results) {
            let r = results[0];
            if (r) {
                if (location) {
                    location.setLatLng(r.center).setPopupContent(r.name).openPopup();
                } else {
                    location = L.marker(r.center).bindPopup(r.name).addTo(map).openPopup();
                }
            }
        })
    })
    })    
    $('#country').change(function() {
        let selectedCountry = $(this).val(); 
            $.getJSON("https://api.openweathermap.org/data/2.5/weather?q=" + selectedCountry + "&appid=eb880ddfec72947d4ea6345bab2b4de0" , function(data){
            $.getJSON("https://api.openweathermap.org/data/2.5/forecast?id=" + data.id + "&units=metric&appid=eb880ddfec72947d4ea6345bab2b4de0" , function(data){
            $.getJSON("https://restcountries.eu/rest/v2/name/" + selectedCountry + "?fullText=true" , function(country){
            console.log(country);
            console.log(country[0].population);
            let icon = 'https://openweathermap.org/img/w/' + data.list[0].weather[0].icon + '.png';
            let temp = Math.floor(data.list[0].main.temp);
            let weather = data.list[0].weather[0].description;
            let population = country[0].population;
    
        $.ajax({
                    url:'geocode.php',
                    type:'GET',
                    data:{selectedCountry: selectedCountry, temp: temp, weather:weather,icon:icon,population:population},
                    success:function (result) {                    
                        $("#myModal").modal('show');
                        $("#results").html(result);
                    }
                });

            });
        });
    });
                
    });

    $('.btn-secondary, .close').click(function(){
        $('#country').find('option:selected').remove();
    });
 });
    