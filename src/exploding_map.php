<?php

define('SITE_ROOT', 'http://www.mrl.nott.ac.uk/~mcp/exploding');

/*

CREATE TABLE location (
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
		<StyleMap id="gps_fix">
			<Pair>
				<key>normal</key>
				<styleUrl>#gps_fix_normal</styleUrl>
			</Pair>
			<Pair>
				<key>highlight</key>
				<styleUrl>#gps_fix_highlight</styleUrl>
			</Pair>
		</StyleMap>
		<Style id="gps_fix_normal">
			<BalloonStyle>
				<text><![CDATA[<p align="left" style="white-space:nowrap;"><font size="+1"><b>$[name]</b></font></p> <p align="left">$[description]</p>]]></text>
			</BalloonStyle>
			<IconStyle>
				<Icon>
					<href>http://maps.google.ca/mapfiles/kml/pal2/icon26.png</href>
				</Icon>
				<scale>0.3</scale>
				<color>FF0073E6</color>
			</IconStyle>
			<LabelStyle>
				<color>FF0073E6</color>
				<scale>0</scale>
			</LabelStyle>
			<LineStyle>
				<color>990073E6</color>
				<width>2</width>
			</LineStyle>
		</Style>
		<Style id="gps_fix_highlight">
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
		<StyleMap id="game_state">
			<Pair>
				<key>normal</key>
				<styleUrl>#game_state_normal</styleUrl>
			</Pair>
			<Pair>
				<key>highlight</key>
				<styleUrl>#game_state_highlight</styleUrl>
			</Pair>
		</StyleMap>
		<Style id="game_state_normal">
			<IconStyle>
				<color>ff00ffaa</color>
				<scale>0.6</scale>
				<Icon>
					<href>http://maps.google.ca/mapfiles/kml/pal2/icon26.png</href>
				</Icon>
			</IconStyle>
			<LabelStyle>
				<color>ff9dffb7</color>
				<scale>1</scale>
			</LabelStyle>
			<BalloonStyle>
				<text><![CDATA[<p align="left" style="white-space:nowrap;"><font size="+1"><b>$[name]</b></font></p> <p align="left">$[description]</p>]]></text>
			</BalloonStyle>
			<LineStyle>
				<color>a90a7ae6</color>
				<width>4</width>
			</LineStyle>
		</Style>
		<Style id="game_state_highlight">
			<IconStyle>
				<color>ff00ffff</color>
				<scale>0.8</scale>
				<Icon>
					<href>http://maps.google.ca/mapfiles/kml/pal2/icon26.png</href>
				</Icon>
			</IconStyle>
			<LabelStyle>
				<color>ff5fbf81</color>
				<scale>1</scale>
			</LabelStyle>
			<BalloonStyle>
				<text><![CDATA[<p align="left" style="white-space:nowrap;"><font size="+1"><b>$[name]</b></font></p> <p align="left">$[description]</p>]]></text>
			</BalloonStyle>
			<LineStyle>
				<color>a90a7ae6</color>
				<width>4</width>
			</LineStyle>
		</Style>
		<StyleMap id="game_action">
			<Pair>
				<key>normal</key>
				<styleUrl>#game_action_normal</styleUrl>
			</Pair>
			<Pair>
				<key>highlight</key>
				<styleUrl>#game_action_highlight</styleUrl>
			</Pair>
		</StyleMap>
		<Style id="game_action_normal">
			<IconStyle>
				<color>f00000f0</color>
				<scale>0.6</scale>
				<Icon>
					<href>http://maps.google.ca/mapfiles/kml/pal2/icon26.png</href>
				</Icon>
			</IconStyle>
			<LabelStyle>
				<color>ffffaaff</color>
				<scale>1</scale>
			</LabelStyle>
			<BalloonStyle>
				<text><![CDATA[<p align="left" style="white-space:nowrap;"><font size="+1"><b>$[name]</b></font></p> <p align="left">$[description]</p>]]></text>
			</BalloonStyle>
			<LineStyle>
				<color>a90a7ae6</color>
				<width>4</width>
			</LineStyle>
		</Style>
		<Style id="game_action_highlight">
			<IconStyle>
				<color>fff07e41</color>
				<scale>1</scale>
				<Icon>
					<href>http://maps.google.ca/mapfiles/kml/pal2/icon26.png</href>
				</Icon>
			</IconStyle>
			<LabelStyle>
				<color>ffbc7dbc</color>
				<scale>1</scale>
			</LabelStyle>
			<BalloonStyle>
				<text><![CDATA[<p align="left" style="white-space:nowrap;"><font size="+1"><b>$[name]</b></font></p> <p align="left">$[description]</p>]]></text>
			</BalloonStyle>
			<LineStyle>
				<color>a90a7ae6</color>
				<width>4</width>
			</LineStyle>
		</Style>
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
';
	return $output; 
}

/**
 * Make a KML folder with id and name containing the content kml
 * @param string $id these are not escaped, so make sure you do this beforehand
 * @param string $name
 * @param string $content KML placemark contents
 */
function make_kml_folder($id, $name, $content)
{
	$output ="
	 	<Folder id='$id'>
			<name>$name</name>
			$content
		</Folder>
";		  
	return $output;		
}

/**
 * Return the actual kml data for an GPS update individual placemark 
 * @param array $row array of location data table row data
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
function make_location_item($row)
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
				<description><![CDATA[<b>GPS fix for <?php echo(htmlspecialchars($row['user'])); ?></b><br/>
				<i>Latitude:</i> <?php echo(htmlspecialchars($row['latitude'])); ?>&#176;<br/>
				<i>Longitude:</i> <?php echo(htmlspecialchars($row['latitude'])); ?>&#176;<br/>
				<i>Elevation:</i> <?php echo(htmlspecialchars($row['altitude'])); ?>m<br/>
				<i>Speed:</i> <?php echo(htmlspecialchars($row['speed'])) ?>km/h<br/>
				<i>Time:</i> <?php echo(htmlspecialchars($row['timestamp'])); ?> ]]></description>
				<TimeStamp>
					<when><?php echo(htmlspecialchars($row['timestamp'])); ?>+01:00</when>
				</TimeStamp>
				<styleUrl>#gps_fix</styleUrl>
			</Placemark>
<?php 
	$output = ob_get_clean();
	return $output;
}


/**
 * Return the actual kml data for a set of game states
 * @param array $row array of game state rows
 	CREATE TABLE gamestate (
                timestamp text,
                action text,
                value text,
                user text
        );
 */
function make_gamestates_item($rows, $lon, $lat, $alt)
{
	$output = '';
	$actions = array();
	$descriptions = '';
	foreach($rows as $row)
	{
		$actions[] = $row['action'];
		$descriptions .= 
			"<b><i>Action:</i>" . htmlspecialchars($row['action']) . "</b><br/>\n" .
			"<i>Time:</i>" . htmlspecialchars($row['timestamp']) . "<br/>\n" .
			"<i>Value:</i>" . htmlspecialchars($row['value']) . "<br/>\n";
	}
	$name = implode(" ", $actions);
	
	ob_start();	
?>
			<Placemark>
				<Point>
					<altitudeMode>clampToGround</altitudeMode>
					<coordinates><?php echo(htmlspecialchars($lon) . ', ' . htmlspecialchars($lat)); ?></coordinates>
					<extrude>1</extrude>
				</Point>
				<name><?php echo(htmlspecialchars( $name . "(" . $row['user'] . ")")); ?></name>
				<description><![CDATA[<b> Game State for <?php echo(htmlspecialchars($row['user'])); ?></b><br/>
				<?php echo($descriptions); ?>
				 ]]></description>
				<TimeStamp>
					<when><?php echo(htmlspecialchars($row['timestamp'])); ?></when>
				</TimeStamp>
				<styleUrl>#game_state</styleUrl>	
			</Placemark>
<?php 
	$output = ob_get_clean();
	return $output;
}

/**
 * 
 * 
 */

/**
 * Similar to make_gamestates_item this function creates placemarks for a group of game
 * actions at a particular location.
 * @param $rows
 * @param $lat
 * @param $lon
 * @param $alt
 *  	CREATE TABLE gameaction (
                timestamp text,
                action text,
                member text,
                user text
        );
 */
function make_gameactions_item($rows, $lon, $lat, $alt)
{
	$output = '';
	$actions = array();
	$descriptions = '';
	foreach($rows as $row)
	{
		$actions[] = $row['action'];
		$descriptions .= 
			"<b><i>Action:</i>" . htmlspecialchars($row['action']) . "</b><br/>\n" .
			"<i>Time:</i>" . htmlspecialchars($row['timestamp']) . "<br/>\n" .
			"<i>Member:</i>" . htmlspecialchars($row['member']) . "<br/>\n";
	}
	$name = implode(" ", $actions);
	
	ob_start();	
?>
			<Placemark>
				<Point>
					<altitudeMode>clampToGround</altitudeMode>
					<coordinates><?php echo(htmlspecialchars($lon) . ', ' . htmlspecialchars($lat)); ?></coordinates>
					<extrude>1</extrude>
				</Point>
				<name><?php echo(htmlspecialchars( $name . "(" . $row['user'] . ")")); ?></name>
				<description><![CDATA[<b> Game Action for <?php echo(htmlspecialchars($row['user'])); ?></b><br/>
				<?php echo($descriptions); ?>
				 ]]></description>
				<TimeStamp>
					<when><?php echo(htmlspecialchars($row['timestamp'])); ?></when>
				</TimeStamp>
				<styleUrl>#game_action</styleUrl>	
			</Placemark>
<?php 
	$output = ob_get_clean();
	return $output;}


/**
 * Return a string with the KML file suffix for usese with open layers
 * based on sundials.kml example
 */
function make_kml_tail()
{
	$output = '
	</Document>
</kml>';
	return $output;
}


/**
 * This function collectes game states from the database that are within a particular time peroid
 * which is between two GPS readings - used to show a placemark at the last known GPS reading before 
 * the state was logged 
 * @param $db PDO database connection (to the sqlite db...)
 * @param $start start tiemstamp in sql friedly format
 * @param $end end timestamp in sqlite format
 * @param $user (optional) userneame to restrict results to a particular user
 */
function get_gamestates_between_times($db, $start, $end, $user=NULL)
{
	$query = "SELECT * FROM gamestate WHERE (timestamp>=" . $db->quote($start)
		. " AND timestamp<=" . $db->quote($end);
	if(!is_null($user))
	{
		$query .= ' AND user =' . $db->quote($user);
	}
	$query .= ');';
	//echo($query . "<br/>");
	$rows = array();
	foreach($db->query($query) as $row)
	{
		$rows[] = $row;
	}
	return $rows;
}

/**
 * This function collectes game actions from the database that are within a particular time peroid
 * which is between two GPS readings - used to show a placemark at the last known GPS reading before 
 * the action was logged 
 *  @param $db PDO database connection (to the sqlite db...)
 * @param $start start tiemstamp in sql friedly format
 * @param $end end timestamp in sqlite format
 * @param $user (optional) userneame to restrict results to a particular user
 */
function get_gameactions_between_times($db, $start, $end, $user=NULL)
{
	$query = "SELECT * FROM gameaction WHERE (timestamp>=" . $db->quote($start)
		. " AND timestamp<=" . $db->quote($end);
	if(!is_null($user))
	{
		$query .= ' AND user =' . $db->quote($user);
	}
	$query .= ');';
	//echo($query . "<br/>");
	$rows = array();
	foreach($db->query($query) as $row)
	{
		$rows[] = $row;
	}
	return $rows;
}

/***************************************************************************************************
 * 
 * 
 * *************************************************************************************************/
 

try
{
	$db = new PDO('sqlite:./exploding.db');
	// set a mode parameter in the URL to select which subset of points to use...
	$location_query = "SELECT * from location;";
	
	$location_results = $db->query($location_query);
	$location_rows = $location_results->fetchAll();
	
	$coordinates_array = array();
	$track_folder = '';
	$gamestate_folder = '';
	$gameaction_folder = '';
	
	$start_date = NULL;
	$end_date = NULL;
	
	foreach($location_rows as $row)
	{
		$coordinates_array[] = $row['longitude'] . ', ' . $row['latitude'];
		
		$track_folder .= make_location_item($row);
		$start_date=$end_date;
		$end_date = $row['timestamp'];
		
		$state_rows = get_gamestates_between_times($db, $start_date, $end_date);
		$action_rows = get_gameactions_between_times($db, $start_date, $end_date);
		if(count($state_rows)>0)
		{
			$gamestate_folder .= make_gamestates_item($state_rows, $row['longitude'], $row['latitude'], $row['altitude']);
			//echo($gamestate_folder);
		}
		if(count($action_rows)>0)
		{
			$gameaction_folder .= make_gameactions_item($action_rows, $row['longitude'], $row['latitude'], $row['altitude']);
			//echo($gameaction_folder);
		}
	}
	$db = null;
}
catch (PDOException $e)
{
	 print "Error!: " . $e->getMessage() . "<br/>";
	 exit;
}

$coordinates = implode(' ', $coordinates_array);
$output = make_kml_head($coordinates);
$output .= make_kml_folder('GPS_Track', "GPS Readings", $track_folder);
$output .= make_kml_folder('game_state', "Game State", $gamestate_folder);
$output .= make_kml_folder('game_action', "Game Actions", $gameaction_folder);
$output .= make_kml_tail();

header("Content-Type: application/vnd.google-earth.kml+xml kml; charset=utf8");
header("Content-disposition: attachment; filename=exploding-location.kml");
ob_start("ob_gzhandler");
echo $output;
ob_flush();

?>