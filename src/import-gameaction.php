<?php
/* 
 CREATE TABLE gamestate (
                timestamp text,
                action text,
                value text,
                user text
        );
*/
/*        
  This generates the SQL statements to add the data to the database, 
  but for some reason it wasn't adding on my version so the alternative was
  to read the file directly with sqlite3 command console
*/
try
{
	$dbh = new PDO('sqlite:exploding.db');
	
	$file = fopen('./GameActionDrossq.txt', 'r');
	$line_count=0;
	while($line = fgets($file))
	{
		$line_parts = explode(';', $line);
		// Take the first three elements of line as values
		reset($line_parts);
		$timestamp = current($line_parts);
		next($line_parts);
		$action = $dbh->quote(current($line_parts));
		$member_items = array();
		$line_count++;
		while(next($line_parts))
		{
			$member_items[] = current($line_parts);	
		}
		
		$value = $dbh->quote(implode(';', str_replace("\n", "", $member_items)));
		
		$query = "INSERT INTO gameaction (timestamp, action, member, user) VALUES ('$timestamp', $action, $value, 'Drossq');";
 		echo($query . "\n");
//		$result = $dbh->query($query);
	}
	$dbh = null;
}
catch (PDOException $e)
{
	 print "Error!: " . $e->getMessage() . "<br/>";
	 die();
}
echo("done");