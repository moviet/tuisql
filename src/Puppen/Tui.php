<?php
/**
 * Tui - A dynamic php database builder
 *
 * @category   Database Connection
 *
 * @author     Moviet
 * @license    MIT Public License
 */
namespace Moviet\Base\Puppen;

use \PDO;
use \PDOException as InvalidConnectionException;
	
abstract class Tui
{
		/**
		 * Generate sql connection
		 * 
		 * @return object
		 */
		protected static $pdo;

		/**
		 * Generate sqlite connection
		 * 
		 * @return object
		 */
		protected static $sqlite;

		/**
		 * Create database connection
		 * 
		 * @param array $connect
		 * @return object
		 * @throws InvalidConnectionException
		 */
		public static function click($connect = [])
		{
				$connects = is_array($connect) ? $connect : explode(',',$connect); 

				foreach ($connects as $key => &$value) {
						$data[$key] = $value;
				}

				if (count($data) < 5) {
						throw new InvalidConnectionException("Database configuration does not valid");
				}			

				// Use try catch to prevent connection failed
				// that can reveal your credential data
				// to the user browser 
				try {
						self::$pdo = new PDO(
							 "{$data[0]}:host={$data[1]};port={$data[2]};dbname={$data[3]};charset=utf8", "{$data[4]}","{$data[5]}"
						);

						self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
						self::$pdo->setAttribute(PDO::ATTR_PERSISTENT, true); 
						self::$pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');

						return self::$pdo;
				}

				catch (InvalidConnectionException $message) {
						error_log($message);
						throw new InvalidConnectionException("Connection database {$data[0]} does not established ?");
				}
		}

		/**
		 * Create sqlite database connection
		 * 
		 * @param string $path eg. path1/path2/path3
		 * @param string $database eg. (dbname).ext
		 * @return object
		 * @throws InvalidConnectionException
		 */
		public static function sqlite($path = null, $database)
		{
				try {
						self::$sqlite = new PDO(
							 "".self::DEFAULT_SQLITE.":".__DIR__."/{$path}/{$database}"
						);

						self::$sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						self::$sqlite->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
						self::$sqlite->setAttribute(PDO::ATTR_PERSISTENT, true); 
						self::$sqlite->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');

						return self::$sqlite;
				}

				catch (InvalidConnectionException $message) {
						error_log($message);
						throw new InvalidConnectionException("Connection database sqlite does not established ?");
				}
		}

		/**
		 * Close database connection
		 * 
		 * @return null
		 */
		public static function close()
		{
				return self::$pdo = NULL;
		}

		/**
		 * Close sqlite connection
		 * 
		 * @return null
		 */
		public static function closeSqlite()
		{
				return self::$sqlite = NULL;
		}
}
