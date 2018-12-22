<?php
    include_once 'includes/dbh.inc';
?>

<html>
<head>
    
    <title> Solent Air Watch - Community Map</title>
    <link rel="stylesheet" type="text/css" href="css/leaflet.css"/>

    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/leaflet.awesome-markers.css">
    <link rel="stylesheet"  type="text/css" href="css/inputPoints.css" />
    <script src="js/leaflet.js"></script>
    <script src="js/leaflet.awesome-markers.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
</head>
<body>

<?php


    $conn = mysqli_connect($dbServername,$dbUsername, $dbPassword, $dbName);
    if(! $conn ){
        die('Could not connect: ' . mysqli_error());
    }
    echo 'Connected successfully' . "<br>";
    $sql = 'SELECT * FROM geoData';

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
           // echo json_encode($row) . "<br>";
        }
     } else {
        echo "0 results";
     } 

     // echo json_encode($rows);

    mysqli_close($conn);

?>

<!-- Output the result to javaScript  -->
<script type="text/javascript">
        var data = JSON.parse( '<?php echo json_encode($rows); ?> ' ); 
</script>
    <h1>
            Click the map to add points
        </h1>
        <p>
            <div id="map" data-mode="">
                <input type="hidden" data-map-markers="" value="" name="map-geojson-data" />
            </div>
        </p>

        <p>
            <b>Please note: </b> Contributions without or not meeting our community guidelines will be removed. By contributing you allow us to store your data. Your contribution is annonomous but you can serperatly join our mailing list. Please read our privacy policy for more details.
        </p> 
        
        <div id="container">
            <div>
                <input class="btn-done" type="button" value="I'm done - save my points" />
            </div>
        </div>


        <script src="js/input_points3.js"></script>
</body>
</html>