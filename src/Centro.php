<?php
/**
 * Tuisql - A dynamic php database builder
 *
 * @category   Tuisql Query Builder
 * @package    Rammy Labs
 *
 * @author     Moviet
 * @license    MIT Public License
 */
namespace Moviet\Base;

abstract class Centro
{
		const EMPTY_SET = null;

		const LOOP_ONE_SET = 1;
		
		const IN_BINDING = 'in';

		const LIMIT_PARAM = 'limit';

		const BINDING_PARAM = ':';	

		const SET_BINDING = '=:';

		const INSERT_TUISQL = 'INSERT';

		const UPDATE_TUISQL = 'UPDATE';

		const SELECT_TUISQL = 'SELECT';

		const DELETE_TUISQL = 'DELETE';

		/**
		 * Generate join param
		 * 
		 * @return array $joins
		 */
		protected static $joins = 
		[
				'join'		=>	'JOIN',
				'inner'		=>	'INNER JOIN',
				'cross'		=>	'CROSS JOIN',
				'left'		=>	'LEFT JOIN',
				'right'		=>	'RIGHT JOIN'
		];

		/**
		 * Generate In parameter
		 *
		 * @return string
		 */
		public static function withIn()
		{
				return 'IN';
		}

		/**
		 * Generate Set parameter
		 * 
		 * @return string
		 */
		public static function withSet()
		{
				return 'SET';
		}

		/**
		 * Generate From parameter
		 * 
		 * @return string
		 */
		public static function withFrom()
		{
				return 'FROM';
		}

		/**
		 * Generate Into parameter
		 * 
		 * @return string
		 */
		public static function withInto()
		{
				return 'INTO';		
		}

		/**
		 * Generate Like parameter
		 * 
		 * @return string
		 */
		public static function withLike()
		{
				return ' LIKE ';
		}

		/**
		 * Generate Count parameter
		 * 
		 * @return string
		 */
		public static function withCount()
		{
				return 'COUNT';
		}

		/**
		 * Generate Limit parameter
		 * 
		 * @return string
		 */
		public static function withLimit()
		{
				return ' LIMIT ';
		}

		/**
		 * Generate Values parameter
		 * 
		 * @return string
		 */
		public static function withValues()
		{
				return 'VALUES';	
		}

		/**
		 * Generate OrderBy parameter
		 * 
		 * @return string
		 */
		public static function withOrderBy()
		{
				return ' ORDER BY ';
		}

		/**
		 * Generate GroupBy parameter
		 * 
		 * @return string
		 */
		public static function withGroupBy()
		{
				return ' GROUP BY ';
		}

		/**
		 * Generate Distinct parameter
		 *  
		 * @return string
		 */
		public static function withDistinct()
		{
				return 'DISTINCT';
		}

		/**
		 * Generate Or parameter
		 * 
		 * @return string
		 */
		public static function withOrCondition()
		{
				return ' OR ';
		}

		/**
		 * Generate And parameter
		 * 
		 * @return string
		 */
		public static function withAndCondition()
		{
				return ' AND ';
		}

		/**
		 * Generate Between parameter
		 * 
		 * @return string
		 */
		public static function withBetween()
		{
				return 'BETWEEN';
		}

		/**
		 * Generate Where parameter
		 * 
		 * @return string
		 */
		public static function withWhereCondition()
		{
				return ' WHERE ';
		}

		/**
		 * Generate Having parameter
		 * 
		 * @return string
		 */
		public static function withHavingCondition()
		{
				return ' HAVING ';
		}

		/**
		 * Generate Join parameter
		 * 
		 * @return array $param
		 */
		public static function joins($param)
		{
				return self::$joins[$param];
		}

		/**
		 * Generate Join On parameter
		 * 
		 * @return string
		 */
		public static function onCondition()
		{
				return 'ON';
		}
}