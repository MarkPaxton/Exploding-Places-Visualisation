<?php

define('SITE_ROOT', 'http://www.mrl.nott.ac.uk/~mcp/exploding');

/**
 * Return a string with the KML file prefix for usese with open layers
 * based on sundials.kml example
 */
function make_kml_head($coordinates)
{
	$output = '<?xml version="1.0" standalone="yes"?>
<kml xmlns="http://earth.google.com/kml/2.2">
	<Document>
		<Snippet><![CDATA[<p>Created with: ' . SITE_ROOT . '</p>]]></Snippet>
		<Style id="gv_waypoint_normal">
				<BalloonStyle>
				<text><![CDATA[<p>Description</p>]]></text>
			</BalloonStyle>
			<IconStyle>
				<Icon>
					<href>http://maps.google.ca/mapfiles/kml/pal4/icon56.png</href>
				</Icon>
				<color>FFFFFFFF</color>
				<hotSpot x="0.5" xunits="fraction" y="0.5" yunits="fraction" />
			</IconStyle>
			<LabelStyle>
				<color>FFFFFFFF</color>
				<scale>1</scale>
			</LabelStyle>
		</Style>
		 <Style id="gv_waypoint_highlight">
			<BalloonStyle>
			  <text><![CDATA[<p align="left" style="white-space:nowrap;"><font size="+1"><b>$[name]</b></font></p> <p align="left">$[description]</p>]]></text>
			</BalloonStyle>
			<IconStyle>
			  <Icon>
				 <href>http://maps.google.ca/mapfiles/kml/pal4/icon56.png</href>
			  </Icon>
			  <color>FFFFFFFF</color>
			  <hotSpot x="0.5" xunits="fraction" y="0.5" yunits="fraction" />
			  <scale>1.2</scale>
			</IconStyle>
			<LabelStyle>
			  <color>FFFFFFFF</color>
			  <scale>1</scale>
			</LabelStyle>
		 </Style>
		 <Style id="gv_trackpoint_normal">
			<BalloonStyle>
			  <text><![CDATA[<p align="left" style="white-space:nowrap;"><font size="+1"><b>$[name]</b></font></p> <p align="left">$[description]</p>]]></text>
			</BalloonStyle>
			<IconStyle>
			  <Icon>
				 <href>http://maps.google.ca/mapfiles/kml/pal2/icon26.png</href>
			  </Icon>
			  <scale>0.3</scale>
			</IconStyle>
			<LabelStyle>
			  <scale>0</scale>
			</LabelStyle>
		 </Style>
		 <Style id="gv_trackpoint_highlight">
			<BalloonStyle>
			  <text><![CDATA[<p align="left" style="white-space:nowrap;"><font size="+1"><b>$[name]</b></font></p> <p align="left">$[description]</p>]]></text>
			</BalloonStyle>
			<IconStyle>
			  <Icon>
				 <href>http://maps.google.ca/mapfiles/kml/pal2/icon26.png</href>
			  </Icon>
			  <scale>0.4</scale>
			</IconStyle>
			<LabelStyle>
			  <scale>1</scale>
			</LabelStyle>
		 </Style>
		 <StyleMap id="gv_waypoint">
			<Pair>
			  <key>normal</key>
			  <styleUrl>#gv_waypoint_normal</styleUrl>
			</Pair>
			<Pair>
			  <key>highlight</key>
			  <styleUrl>#gv_waypoint_highlight</styleUrl>
			</Pair>
		</StyleMap>
		<StyleMap id="gv_trackpoint">
			<Pair>
				<key>normal</key>
				<styleUrl>#gv_trackpoint_normal</styleUrl>
			</Pair>
			<Pair>
				<key>highlight</key>
				<styleUrl>#gv_trackpoint_highlight</styleUrl>
			</Pair>
		 </StyleMap>
		<name><![CDATA[Drossq]]></name>
		<open>1</open>
		<visibility>1</visibility>
		<Placemark>
			<name><![CDATA[<p>Route</p>]]></name>
			<description><![CDATA[<p>Rough route based on joining GPS readings</p>]]></description>
			<MultiGeometry>
				<LineString>
					<altitudeMode>clampToGround</altitudeMode>
					<coordinates>' . $coordinates . '</coordinates>
					<tessellate>1</tessellate>
				</LineString>
			</MultiGeometry>
			<Snippet></Snippet>
			<Style>
				<LineStyle>
					<color>ff00008b</color>
					<width>4</width>
				</LineStyle>
			</Style>
		</Placemark>
		<Folder id="track 1 points">
			<name>GPS Points</name>		  
';
	return $output; 
}

/**
 * Return the actual kml data for an individual placemark for use with openlayers
 * based on sundials.kml example
 * @param array $row array of ptp_data table row data
 * @param string &$coordinates a string containing the coordinats of a line along the gps locations 
 * CREATE TABLE location (
		timestamp text,
		accuracy real,
		altitude real,
		bearing real,
		latitude real,
		longitude real,
		provider text,
		speed real,
		extras text,
		user text
	);
 */
function make_kml_item($row)
{
	$output = '';
	ob_start();
?>
			<Placemark>
				<Point>
					<altitudeMode>clampToGround</altitudeMode>
					<coordinates><?php echo(htmlspecialchars($row['longitude']) . ', ' . htmlspecialchars($row['latitude'])); ?></coordinates>
					<extrude>1</extrude>
				</Point>
				<name><?php echo(htmlspecialchars($row['timestamp'] . " " . $row['user'])); ?></name>
				<description><![CDATA[<b>trackpoint #1</b><br/>
				<i>Latitude:</i> longitude<?php echo(htmlspecialchars($row['latitude'])); ?>&#176;<br/>
				<i>Longitude:</i> <?php echo(htmlspecialchars($row['latitude'])); ?>&#176;<br/>
				<i>Elevation:</i> <?php echo(htmlspecialchars($row['altitude'])); ?>m<br/>
				<i>Speed:</i> <?php echo(htmlspecialchars($row['speed'])) ?>km/h<br/>
				<i>Time:</i> <?php echo(htmlspecialchars($row['timestamp'])); ?> ]]></description>
				<TimeStamp>
					<when><?php echo(htmlspecialchars($row['timestamp'])); ?></when>
				</TimeStamp>
				<styleUrl>#gv_trackpoint</styleUrl>
				<Snippet></Snippet>
				<Style>
					<IconStyle>
						<color>FF0073E6</color>
				 	</IconStyle>
				 	<LabelStyle>
						<color>FF0073E6</color>
				 	</LabelStyle>
				 	<LineStyle>
						<color>990073E6</color>
						<width>2</width>
				 	</LineStyle>
				</Style>
			</Placemark>
<?php 
	$output = ob_get_clean();
	return $output;
}

/**
 * Return a string with the KML file suffix for usese with open layers
 * based on sundials.kml example
 */
function make_kml_tail()
{
	$output = '
		</Folder>
	</Document>
</kml>';
	return $output;
}


try {
	 $dbh = new PDO('sqlite:./exploding.db');
	 // set a mode parameter in the URL to select which subset of points to use...
	 $query = "SELECT * from location;";

	 if(array_key_exists('debug', $_GET))
	 {
	 	echo($query);
		exit;
	 }
	 
	 $rows = array();
	 foreach($dbh->query($query) as $row) {
		  //print_r($row);
		  $rows[] = $row;
	 }
	 $dbh = null;
} catch (PDOException $e) {
	 print "Error!: " . $e->getMessage() . "<br/>";
	 die();
}

header("Content-Type: application/vnd.google-earth.kml+xml kml; charset=utf8");
header("Content-disposition: attachment; filename=exploding-location.kml"); 
$coordinates_array = array();
$body = '';
foreach($rows as $row)
{
	$coordinates_array[] = $row['longitude'] . ', ' . $row['latitude'];	
	$body .= make_kml_item($row);
}
$coordinates = implode(' ', $coordinates_array);
$output = make_kml_head($coordinates);
$output .= $body;
$output .= make_kml_tail();

ob_start("ob_gzhandler");
echo $output;
ob_flush();
?>