<?php
/**
 * Tuisql - A dynamic php database query builder
 *
 * @category   Database Builder
 * @package    Rammy Labs
 *
 * @author     Moviet
 * @license    MIT Public License
 *
 * @version    Build @@version@@
 */
namespace Moviet\Base;

use Moviet\Puppen\Tui;
use Moviet\Base\Centro;

class Tuisql
{
    /**
     * Add database connection
     * 
     * @var Moviet\Puppen\Tui
     */
    protected $track;

    /**
     * Create select column
     * 
     * @param string $select
     */
    protected $select;

    /**
     * Create distinct with column
     * 
     * @param string $distinct
     */
    protected $distinct;

    /**
     * Create count column name
     * 
     * @param string $count
     */
    protected $count;

    /**
     * Create update column
     * 
     * @param string $column
     */
    protected $column;

    /**
     * Create parameter From
     * 
     * @param string $from
     */
    protected $from;

    /**
     * Create table name
     * 
     * @param string $table
     */
    protected $table;

    /**
     * Create custom query
     * 
     * @param string $draw
     */
    protected $draw;

    /**
     * Generate custum query
     * 
     * @param string $toDraw
     */
    protected $toDraw;

    /**
     * Generate where condition
     * 
     * @return string $isWhere
     */
    protected $isWhere;

    /**
     * Generate and/or condition
     * 
     * @return string $type
     */
    protected $type;

    /**
     * Create where parameter
     * 
     * @param string $where
     */
    protected $where;

    /**
     * Create where In parameter
     * 
     * @param string $whereIn
     */
    protected $whereIn;

    /**
     * Create where between
     * 
     * @param string $between
     */
    protected $between;

    /**
     * Generate where in query
     * 
     * @param string $addWhereIn
     */
    protected $addWhereIn;

    /**
     * Generate attribute like
     * 
     * @param string $attr
     */
    protected $attr;

    /**
     * Create like parameter
     * 
     * @param string $like
     */
    protected $like;

    /**
     * Create having parameter
     * 
     * @param string $having
     */
    protected $having;

    /**
     * Create join parameter
     * 
     * @param string $join
     */
    protected $join;

    /**
     * Create on condition
     * 
     * @param string $on
     */
    protected $on;

    /**
     * Generate join parameter
     * 
     * @param string $toJoin
     */
    protected $toJoin;

    /**
     * Create set parameter
     * 
     * @param string $set
     */
    protected $set;

    /**
     * Generate parameter binding
     * 
     * @param string $bind
     */
    protected $bind; 

    /**
     * Create group by parameter
     * 
     * @param string $groupBy
     */
    protected $groupBy;

    /**
     * Create order by parameter
     * 
     * @param string $orderBy
     */
    protected $orderBy;

    /**
     * Create limit parameter
     * 
     * @param int $limit
     */
    protected $limit;

    /**
     * Create multi limits
     * 
     * @param string $limits
     */
    protected $limits;

    /**
     * Create value parameter
     * 
     * @var string $value
     */
    protected $value;

    /**
     * @return string empty
     */
    const SPACE = " ";

    /**
     * Set optional database connection
     * use Moviet\Puppen\Driver
     * 
     * @param Moviet\Puppen\Tui
     */
    public function __construct($driver)	
    {
        if($driver instanceof Tui) {
            $this->track = $driver;
        }
    }

    /**
     * Create column name
     * with array or commas
     * 
     * @param string $select
     * @return self
     */
    public function select($select)
    {
        $selects = is_array($select) ?	implode(', ',$select) : $select;
        $this->select = "{$selects}";

        return $this;
    }

    /**
     * Create column name
     * with array or commas
     * 
     * @param string $column
     * @return self
     */
    public function column($column)
    {
        $columns = is_array($column) ?	implode(', ',$column) : $column;
        $this->column = "{$columns}";

        return $this;
    }

    /**
     * Create table name
     * with array or commas
     * 
     * @param string $table
     * @return self
     */
    public function table($table)
    {
        $tables = is_array($table) ?	$table = implode(', ',$table) : $table;
        $this->table = "{$tables}";

        return $this;
    }

    /**
     * Create column with distinct
     * with array or commas
     * 
     * @param string $distinct
     * @return self
     */
    public function distinct($distinct = [])
    {
        $distincts = is_array($distinct) ?	implode(', ',$distinct) : $distinct;

        $withDistinct = Centro::withDistinct();
        $this->distinct = "{$withDistinct} {$distincts}";		

        return $this;
    }

    /**
     * Create column with count
     * with array or commas
     * 
     * @param string $count
     * @return self
     */
    public function count($count = [])
    {
        $counts = is_array($count) ?	implode(', ',$count) : $count;

        $withCount = Centro::withCount();
        $this->count = self::SPACE . "{$withCount}($counts)";		

        return $this;
    }

    /**
     * Create parameter From table
     * with array or commas
     * 
     * @param string $param
     * @return self
     */
    public function from($param)
    {
        $params = is_array($param) ?	implode(', ',$param) : $param;
        $this->from = "{$params}";

        return $this;
    }

    /**
     * Create custom query database
     * and must be add ":" as :param
     * 
     * @param string $param
     * @return self
     */
    public function draw($param)
    {
        $params = is_array($param) ?	implode('',$param) : $param;
        $this->draw[] = self::SPACE . $params;			

        return $this;
    }

    /**
     * Generate custom query database
     * and join all as one
     * 
     * @param string $param
     * @return string
     */
    protected function toDraw($param)
    {
        $params = is_array($this->draw) ? [$this->draw] : [$param];

        foreach ($params as $key => &$value) {
            $params[$key] = implode('',$value);
        }

        $this->toDraw = join('',$params);

        return $this->toDraw;
    }

    /**
     * Add custom where condition
     * if where methods doesn't use
     * 
     * @return string
     * @return self
     */
    public function isWhere()
    {
        $this->isWhere = Centro::withWhereCondition();

        return $this;
    }

    /**
     * Add custom Or condition
     * as optional parameter
     * 
     * @param null $withOr
     * @return self
     */
    public function or($withOr = null)
    {
        $withOrs = is_null($withOr) ? Centro::withOrCondition() : $withOr;
        $this->type = $withOrs;

        return $this;
    }

    /**
     * Create where condition and add binding
     * and loop binding as necessary
     * with array or commas
     * 
     * @param string $param
     * @param null $and
     * @param null $where
     * @return self
     */
    public function where($param, $where = null)
    {
        $where = is_null($this->isWhere) ? Centro::withWhereCondition() : null;
        $type = is_null($this->type) ? Centro::withAndCondition() : $this->type;

        $params = is_array($param) ?	$param : explode(',',$param); 
        $params = array_map('trim', $params);
        $number = Centro::LOOP_ONE_SET;

        foreach ($params as $key => &$parameter) {
            $value = Centro::SET_BINDING . $parameter . $number;
            $colon = str_replace('.','',$value);						
            $binding[$key] = $parameter . $colon;
            $number++;		
        }

        $this->where = $where . join($type, $binding) . Centro::withAndCondition();

        return $this;						
    }

    /**
     * Create where condition and add binding
     * and loop binding as necessary
     * with array or commas
     * 
     * @param string $param
     * @param null $and
     * @param null $where
     * @return self
     */
    public function between($param)
    {
        $type = is_null($this->type) ? Centro::withAndCondition() : $this->type;

        $params = is_array($param) ?	$param : explode(',',$param); 
        $params = array_map('trim', $params);
        $number = Centro::LOOP_ONE_SET;
        $between = Centro::withBetween();

        foreach ($params as $key => &$parameter) {
            $value = Centro::BINDING_PARAM . $parameter . $number;
            $colon = str_replace('.','',$value);						
            $binding[$key] = "{$parameter} {$between} " . $colon;
            $number++;		
        }

        $this->between = join($type, $binding) . Centro::withAndCondition();

        return $this;						
    }

    /**
     * Create whereIn condition and add binding
     * use param as binding :id 
     * with array or commas
     * 
     * @param string $id
     * @param string $param
     * @return self
     */
    public function whereIn($column = null, $param = [])
    {
        $ids = is_array($column) ? implode(', ',$column) : $column; 
        $params = is_array($param) ?	$param : explode(',',$param); 
        $params = array_map('trim', $params);
        $number = Centro::LOOP_ONE_SET;

        foreach ($params as $key => &$bind) {
            $colon = Centro::BINDING_PARAM . Centro::IN_BINDING . $bind . $number;
            $colon = str_replace('.','',$colon);			
            $binding[$key] = $colon;
            $number++;		
        }

        $this->whereIn[] = "{$ids} " . Centro::withIn() . '('.join(',',$binding).')';

        return $this;						
    }

    /**
     * Generate custom whereIn condition
     * use isWhere condition to bind
     *
     * @param string $param
     * @return string
     */
    protected function addWhereIn($param)
    {
        $params = is_null($this->whereIn) ? [Centro::EMPTY_SET] : $this->whereIn;
        $type = is_null($this->type) ? Centro::withAndCondition() : $this->type;
        $and = (is_null($this->like) || is_null($this->whereIn)) ? null : Centro::withAndCondition();

        foreach ($params as $k => &$value) {
            $params[$k] = $value;
        }

        $this->addWhereIn = join($type, $params) . $and;

        return $this->addWhereIn;
    }

    /**
     * Generate like with Or condition
     * 
     * @param null $withOr
     * @return self
     */
    public function orLike($withOr = null)
    {
        $withOrs = is_null($withOr) ? Centro::withOrCondition() : $withOr;
        $this->attr = "{$withOrs}";

        return $this;
    }

    /**
     * Create custom like and add binding
     * use isWhere condition to bind
     * with array or commas
     * 
     * @param string $like
     * @return self
     */
    public function like($like)
    {
        $likes = is_array($like) ? $like : explode(',',$like); 
        $likes = array_map('trim', $likes);

        $attrib = is_null($this->attr) ? Centro::withAndCondition() : $this->attr;
        $number = Centro::LOOP_ONE_SET;

        foreach ($likes as $key => &$param) {
            $value = Centro::BINDING_PARAM . $param . $number;
            $colon = str_replace('.','',$value);
            $binding[$key] = $param . Centro::withLike() .  $colon;
            $number++;		
        }

        $this->like = join($attrib, $binding);

        return $this;
    }

    /**
     * Create custom having condition
     * and add binding with :param
     * 
     * @param string $param
     * @return self
     */
    public function having($having)
    {
        $having = is_array($having) ? $having : explode(',',$having); 
        $haves = array_map('trim', $having);

        foreach ($haves as $key => &$bind) {
            $binding[$key] = $bind;	
        }

        $this->having = Centro::withHavingCondition() . join(',',$binding);

        return $this;
    }

    /**
     * Create join parameter
     * 
     * @param string $param
     * @return self
     */
    public function join($column)
    {
        $columns = is_array($column) ? $column : explode(',',$column); 
        $columns = array_map('trim', $columns);

        foreach ($columns as $key => &$params) {
            $columns[0] = $params;
            $columns[1] = $params;
        }

        $this->join = Centro::joins($columns[0]) . " {$columns[1]}";

        return $this;
    }

    /**
     * Create join with on value
     * 
     * @param string $param
     * @return self
     */
    public function on($param = [])
    {
        $params = is_array($param) ? $param : explode(',',$param); 
        $params = array_map('trim', $params);
        $type = !is_array($params) ? : Centro::withAndCondition();
        $onCondition = Centro::onCondition();

        foreach ($params as $key => &$value) {
            $join[$key] = $value;
        }

        $this->on[] = " {$this->join} {$onCondition} " . join($type, $join);

        return $this;
    }

    /**
     * Compact all joins parameter
     * 
     * @param string $param
     * @return string
     */
    protected function toJoin($param)
    {
        $params = is_array($this->on) ? [$this->on] : [$param];

        foreach ($params as $key => &$value) {
            $params[$key] = join('',$value);
        }

        $this->toJoin = join('',$params);

        return $this->toJoin;
    }

    /**
     * Create set param to update query
     * with array or commas
     * 
     * @param string $param
     * @return self
     */
    public function set($param)
    {
        $params = is_array($param) ? $param : explode(',',$param); 
        $params = array_map('trim', $params);
        $number = Centro::LOOP_ONE_SET;

        foreach ($params as $key => &$parameter) {
            $value = Centro::SET_BINDING . $parameter . $number;
            $colon = str_replace('.','',$value);
            $binding[$key] = $parameter . $colon;
            $number++;
        }

        $this->set = join(', ',$binding);

        return $this;
    }	

    /**
     * Generate insert parameter binding
     * and set with loop as necessary
     * with array or commas
     * 
     * @param string $param
     * @return string
     */
    protected function bind($param = null)
    {
        $params = is_array($this->column) ?	$this->column : explode(',',$this->column); 
        $params = array_map('trim', $params);
        $number = Centro::LOOP_ONE_SET;

        foreach ($param as $key => &$parameter) {
            $colon = Centro::BINDING_PARAM . $parameter;
            $binding[$key] = $colon . $number;
            $number++;
        }

        $this->bind = join(',',$binding);

        return $this->bind;
    }	

    /**
     * Create group-by column name
     * 
     * @param string $group
     * @return self
     */
    public function groupBy($group)
    {
        $groups = is_array($group) ?	$group : explode(',',$group); 				

        foreach ($groups as $key => &$params) {
            $param[$key] = $params;
        }

        $this->groupBy = Centro::withGroupBy() . join(', ',$param) . self::SPACE;

        return $this;
    }

    /**
     * Create order-by column name
     * 
     * @param string $order
     * @return self
     */
    public function orderBy($order)
    {
        $orders = is_array($order) ?	$order : explode(',',$order); 

        foreach ($orders as $key => &$params) {
            $param[$key] = $params;
        }

        $this->orderBy = Centro::withOrderBy() . join(', ',$param) . self::SPACE;

        return $this;
    }

    /**
     * Create a single limit
     *
     * @param int $limit
     * @return self
     */
    public function limit($limit)
    {
        $limits = is_array($limit) ? implode(' ',$limit) : $limit;
        $this->limit = Centro::withLimit() . "{$limits}";

        return $this;
    }

    /**
     * Create offset and limit
     * generate :parameter binding
     * with array or commas
     * 
     * @param string $limit
     * @return self
     */
    public function limits($limit)
    {
        $limit = is_array($limit) ? $limit : explode(',',$limit); 
        $limits = array_map('trim', $limit);
        $number = Centro::LOOP_ONE_SET;

        foreach ($limits as $key => &$param) {
            $binding[$key] = Centro::BINDING_PARAM . Centro::LIMIT_PARAM . $number;
            $number++;		
        }

        $this->limits = Centro::withLimit() . join(',',$binding);

        return $this;
    }

    /**
     * Create all values with binding sets
     * it will execute depend on :params
     * compact all using Pdo String as quickly
     * with array or commas
     * 
     * @param array|string $value
     * @return self
     */
    public function value($value = [])
    {
        if (is_array($value)) {
            $this->value = array($value);
        }

        foreach ($this->value as $value) {
            $this->value = array_values($value);
        }		

        return $this;
    }

    /**
     * Generate select query with prepare statement
     * and execute all acceptable values
     * replace unexpected characters for query
     * when there is no parameter binding
     *
     * @return object
     */
    public function run()
    {
        $selTuisql = Centro::SELECT_TUISQL;
        $drawing = is_null($this->draw) ? Centro::EMPTY_SET : $this->toDraw($this->draw);

        $statement = implode(array(
            "{$selTuisql} ".$this->select."".$this->distinct."".$this->count." ".Centro::withFrom()." " . $this->from 
            . $drawing . $this->toJoin([$this->on]) . $this->isWhere . $this->where . $this->between 
            . $this->addWhereIn($this->whereIn) . $this->like .	$this->groupBy . $this->orderBy . $this->having 
            . $this->limits . $this->limit
        ));

        $statement = str_replace("'",'```',$statement);
        $statement = $this->track->prepare($statement);
        $statement->execute($this->value);

        return $statement;
    }

    /**
     * Generate deletion query with prepare statement
     * and execute all acceptable values
     * 
     * @return object
     */
    public function del()
    {
        $delTuisql = Centro::DELETE_TUISQL;

        $statement = implode(array(						
            "{$delTuisql} {".Centro::withFrom()."} {$this->from}" . $this->where . $this->limit . $this->limits
        ));

        $statement = $this->track->prepare($statement);
        $statement->execute($this->value);

        return $statement;
    }

    /**
     * Generate update query with prepare statement
     * and execute all acceptable values
     * 
     * @return object
     */
    public function fresh()
    {
        $newTuisql = Centro::UPDATE_TUISQL;

        $statement = implode(array(
            "{$newTuisql} {$this->table}{$this->toJoin([$this->on])} ".Centro::withSet()." $this->set" 
            . $this->where . $this->limit . $this->limits
        ));

        //$statement = $this->track->prepare($statement);
        //$statement->execute($this->value);

        return $statement;
    }

    /**
     * Generate insert query with prepare statement
     * and execute all acceptable values
     * 
     * @return object
     */
    public function add()
    {
        $inTuisql = Centro::INSERT_TUISQL;

        $statement = implode(array(
            "{$inTuisql} ".Centro::withInto()." {$this->table} ({$this->column}) ".Centro::withValues()." ({$this->bind()})"
        ));

        $statement = $this->track->prepare($statement);
        $statement->execute($this->value);

        return $statement;
    }
}
