<html>
<head>
   <title>Leaflet Events Example</title>

   <link rel="stylesheet" href="leaflet/leaflet.css" />
   <!--[if lte IE 8]><link rel="stylesheet" href="leaflet/leaflet.ie.css" /><![endif]-->

   <script src="leaflet/leaflet.js"></script>

   <script language="javascript">
      var map;
      var popup = L.popup();

      function init() {

         map = new L.Map('map');
         popup = new L.Popup();

         L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
            maxZoom: 18
         }).addTo(map);
         map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.

         var london = new L.LatLng(51.505, -0.09); 
         map.setView(london, 13);


         map.on('click', onMapClick);
      }

      //Listener function taking an event object 
      function onMapClick(e) {
         //map click event object (e) has latlng property which is a location at which the click occured.
         popup
           .setLatLng(e.latlng)
           .setContent("You clicked the map at " + e.latlng.toString())
           .openOn(map);
      }

   </script>

</head>
<body onLoad="javascript:init();">
   <div id="map" style="height: 200px"></div> <!-- width equals available horizontal space by default -->

</body>                                                                                                                          
</html>