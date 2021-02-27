<?php
session_start();
include ("dbFunctions.php");
ini_set('max_execution_time', 0);

$queryLatLng = "SELECT latitude, longitude, ambient_temp FROM datal where latitude != 'N/A'";
$resultLatLng = mysqli_query($link, $queryLatLng) or die("Error in query: $queryLatLng");
?>
<html>
    <head>
        <title>Heat Map Temperature</title>
        <style>
            body{font-family: Helvetica, Arial; font-weight: regular; font-size: 15px; color: #555; background-color: #FFF; margin: 0;}
            h1{font-weight: bold; font-size: 31px; letter-spacing: -1px; color: #333; line-height: 33px;}
            h3{font-weight: bold; font-size: 12px; color: #CCC; text-transform: uppercase; margin: 10px 0 0 0;}
            p{margin: 8px 0 20px 0; line-height: 18px;}
            a, a:visited{color: #397DB8; text-decoration: none;}
            a:hover{text-decoration: underline;}

            .wrapper{display: block; padding: 4px 30px 0 30px;}

            .map{background-color:#eee; top: 0; left: 0; bottom: 0; width: 100%; *height:100%;}

            .context{font-family: Helvetica, Arial; font-size: 13px; color: #999; padding: 10px 0 0 0;}
            .subheader{border-bottom: 1px solid #ddd;}
            .footer{border-top: 1px solid #ddd; margin-top: 30px;}
            .titleBlock{text-align: right;}
        </style>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="scripts/heatmap.js" type="text/javascript"></script>
        <script src="scripts/heatmap-gmaps.js" type="text/javascript"></script>
        <script src="scripts/jquery-1.11.1.min.js" type="text/javascript"></script>
        <!--<link rel="stylesheet" href="http://libs.cartocdn.com/cartodb.js/v3/themes/css/cartodb.css" />-->
        <!--<script src="http://libs.cartocdn.com/cartodb.js/v3/cartodb.js"></script> -->

        <script type="text/javascript">
            $(document).ready(function () {
                var map;
                var heatmap;

                //Go to http://snazzymaps.com/ for GMap styles for free
                //var style_array = [{"featureType": "water", "stylers": [{"visibility": "on"}, {"color": "#acbcc9"}]}, {"featureType": "landscape", "stylers": [{"color": "#f2e5d4"}]}, {"featureType": "road.highway", "elementType": "geometry", "stylers": [{"color": "#c5c6c6"}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#e4d7c6"}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#fbfaf7"}]}, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#c5dac6"}]}, {"featureType": "administrative", "stylers": [{"visibility": "on"}, {"lightness": 33}]}, {"featureType": "road"}, {"featureType": "poi.park", "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": 20}]}, {}, {"featureType": "road", "stylers": [{"lightness": 20}]}]

                //Google Maps
                var mapOptions = {
                    zoom: 11,
                    center: new google.maps.LatLng(1.37985, 103.783572),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                            //styles: style_array
                };
                map = new google.maps.Map(document.getElementById('map'), mapOptions);

                heatmap = new HeatmapOverlay(map, {
                    "radius": 10,
                    "visible": true,
                    "opacity": 60
                });

                //Note the usage of "lng" for GMaps
                var mylist = [];
                var mydict = {};
<?php while ($rowLatLng = mysqli_fetch_array($resultLatLng)) { ?>
    <?php $normalize = (($rowLatLng['ambient_temp'] - 19.4) / (36 - 19.4)) * 5; ?>

                    //create a list that stores dict
                    mydict = {'lat':<?php echo $rowLatLng['latitude']; ?>, 'lng':<?php echo $rowLatLng['longitude']; ?>, 'count': <?php echo $normalize; ?>};
                    mylist.push(mydict);

<?php } mysqli_close($link); ?>
                var testData = {
                    max: 5,
                    data: mylist
                };

                // in the docs, but means redrawing points (and reloading all the data) each pan/zoom
                // now we can set the data
                google.maps.event.addListenerOnce(map, "idle", function () {
                    // this is important, because if you set the data set too early, the latlng/pixel projection doesn't work
                    heatmap.setDataSet(testData);
                });

            });
        </script>
    </head>
    <body>
        <?php include ('navi.php'); ?>
        <div class="map" id="map" style="width:100%; height:100%;"></div> 
    </body>    
</html>
