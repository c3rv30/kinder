<?php
/**
 * Define database parameters here
 */
define("DB_USER", 'root');
define("DB_PASSWORD", '');
define("DB_NAME", 'jardin2');
define("DB_HOST", 'localhost');
//C:/xampp/htdocs/restaurant/modules/Backups/Manual/
define("OUTPUT_DIR", 'C:/wamp/www/thomas/Administracion');
define("TABLES", '*');

class Backup_Database {
	/**
	 * Host where database is located
	 */
	var $host = '';

	/**
	 * Username used to connect to database
	 */
	var $username = '';

	/**
	 * Password used to connect to database
	 */
	var $passwd = '';

	/**
	 * Database to backup
	 */
	var $dbName = '';

	/**
	 * Database charset
	 */
	var $charset = '';

	/**
	 * Constructor initializes database
	 */
	function Backup_Database($host, $username, $passwd, $dbName, $charset = 'utf8')	{
		$this->host     = $host;
		$this->username = $username;
		$this->passwd   = $passwd;
		$this->dbName   = $dbName;
		$this->charset  = $charset;

		$this->initializeDatabase();
	}

	public function initializeDatabase(){
		$conn = mysql_connect($this->host, $this->username, $this->passwd);
		mysql_select_db($this->dbName, $conn);
		if (! mysql_set_charset ($this->charset, $conn)){
			mysql_query('SET NAMES '.$this->charset);
		}
	}

	/**
	 * Backup the whole database or just some tables
	 * Use '*' for whole database or 'table1 table2 table3...'
	 * @param string $tables
	 */
	public function backupTables($tables = '*', $outputDir = '.'){
		try{
			/**
			 * Tables to export
			 */
			if($tables == '*'){
				$tables = array();
				$result = mysql_query('SHOW TABLES');
				while($row = mysql_fetch_row($result)){
					$tables[] = $row[0];
				}
			}else{
				$tables = is_array($tables) ? $tables : explode(',',$tables);
			}

			$sql = 'CREATE DATABASE IF NOT EXISTS '.$this->dbName.";\n\n";
			$sql .= 'USE '.$this->dbName.";\n\n";

			/**
			 * Iterate tables
			 */
			foreach($tables as $table){
				//echo "Backing up ".$table." table...";

				$result = mysql_query('SELECT * FROM '.$table);
				$numFields = mysql_num_fields($result);

				$sql .= 'DROP TABLE IF EXISTS '.$table.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
				$sql.= "\n\n".$row2[1].";\n\n";

				for ($i = 0; $i < $numFields; $i++){
					while($row = mysql_fetch_row($result)){
						$sql .= 'INSERT INTO '.$table.' VALUES(';
						for($j=0; $j<$numFields; $j++){
							$row[$j] = addslashes($row[$j]);
							$row[$j] = ereg_replace("\n","\\n",$row[$j]);
							//$row[$j] = preg_replace("\n","\\n",$row[$j]);
							if (isset($row[$j])){
								$sql .= '"'.$row[$j].'"' ;
							}else{
								$sql.= '""';
							}
							if ($j < ($numFields-1)){
								$sql .= ',';
							}
						}

						$sql.= ");\n";
					}
				}
				$sql.="\n\n\n";				
				mysql_close($conn);
				//echo " OK" . "<br />";
			}

			$fecha= strftime( "%Y-%m-%d-%H-%M-%S", time());
			$filename = "$fecha";
			$handle = fopen('C:/wamp/www/new_interfaz/folders/dump_y_restore_db/'.$filename.'-manual.sql','w+');
			//$handle = fopen('C:\wamp\www\thomas\Administracion\jardin-manual-'.date("d-m-Y").'.sql','w+');
   			fwrite($handle,$sql);
   			fclose($handle);
   			header("location:exito.php"); 
		}catch (Exception $e){
			var_dump($e->getMessage());
			return false;
		}

		//return $this->saveFile($sql, $outputDir);
		return $sql;
	}
			
			//$fecha= strftime( "%d-%m-%Y-%H-%M-%S", time());
			//$filename = "$fecha";
			//$handle = fopen('C:\wamp\www\thomas\Administracion\$filename-manual.sql','w+');
   			//fwrite($handle,$sql);
   			//fclose($handle);
	/**
	 * Save SQL to file
	 * @param string $sql
	 */
	protected function saveFile(&$sql, $outputDir = 'C:\wamp\www\thomas\Administracion'){
		if (!$sql) {
			return false;
		}
		try{
			

			$handle = fopen($outputDir.date("ymd", time()).'-'.DB_NAME.'-Manual.sql','w+');
			fwrite($handle, $sql);
			fclose($handle);

		}catch (Exception $e){
			var_dump($e->getMessage());
			return false;
		}
		return true;
	}
}

error_reporting(0);

set_time_limit(120);

//include '../../core/conexion.php';

//SELECT * FROM backup where manual='2013-11-20'
//INSERT INTO backup(manual) values('2013-11-20')

$sql="Select * from backup where manual='".date("Ymd", time())."'";
$res = mysql_query($sql,$connection);

if (mysql_num_rows($res) > 0) { 
	while ($row = mysql_fetch_assoc($res)) { 
		//$fecha = $row['manual']; 
		
	}
}else{
	$sql="INSERT INTO backup(manual) VALUES ('".date("Ymd", time())."');";
	$res = mysql_query($sql,$connection);
	
}


/**
 * Instantiate Backup_Database and perform backup
*/
$backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//$status = $backupDatabase->backupTables(TABLES, OUTPUT_DIR) ? 'OK' : 'KO';
$content_SQL = $backupDatabase->backupTables(TABLES, OUTPUT_DIR);

//echo "<br /><br /><br />Backup result: ".$status;
header('Content-Type:text/plain; charset=ISO-8859-15');
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("content-disposition: attachment;filename=".'db-backup-'.DB_NAME.'-'.date("Ymd-His", time()).'.sql');
date_default_timezone_set("Chile/Continental");
//header("content-disposition: attachment;filename=".date("ymd", time()).'-'.DB_NAME.'-Manual.sql');

echo $content_SQL;
	

?>
