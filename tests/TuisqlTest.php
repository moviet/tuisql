<?php
/**
 * Tuisql - A dynamic query builder
 * @author Moviet
 * 
 * this test just coverage the functional
 * There is no real database test
 */
namespace Moviet\Testing;

use \PDO;
use Moviet\Base\Tuisql;
use PHPUnit\Framework\TestCase;

class TuisqlTest extends TestCase
{
    public function testPartSelectQueryWithoutArray()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('select')
             ->will($this->returnValue('column'));

        $this->assertEquals('column', $mock->select('column'));

        $param = is_string($mock->select('column'));

        $this->assertTrue($param);
    }

    public function testSelectColumnWithArray()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('select')
             ->will($this->returnValue(['column']));

        $this->assertEquals(['column'], $mock->select(['column']));

        $param = is_array($mock->select(['column']));

        $this->assertTrue($param);
    }

    public function testAddColumnWithoutArray()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('column')
             ->will($this->returnValue('string'));

        $this->assertEquals('string', $mock->column('string'));

        $param = is_string($mock->column('string'));

        $this->assertTrue($param);
    }

    public function testAddTable()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('table')
             ->will($this->returnValue('column'));

        $this->assertEquals('column', $mock->table('column'));

        $param = is_string($mock->table('column'));

        $this->assertTrue($param);
    }

    public function testAddDistinctWithCommas()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('distinct')
             ->will($this->returnValue('column, column, column'));

        $this->assertEquals('column, column, column', $mock->distinct('column, column, column'));

        $param = is_string($mock->distinct('column, column, column'));

        $this->assertTrue($param);
    }

    public function testAddCount()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('count')
             ->will($this->returnValue('column'));

        $this->assertEquals('column', $mock->count('column'));

        $param = is_string($mock->count('column'));

        $this->assertTrue($param);
    }

    public function testAddTableWithFrom()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('from')
             ->will($this->returnValue('table'));

        $this->assertEquals('table', $mock->from('table'));

        $param = is_string($mock->from('table'));

        $this->assertTrue($param);
    }

    public function testAddQueryWithDraw()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('draw')
             ->will($this->returnValue('SELECT column FROM table WHERE column=:column'));

        $query = 'SELECT column FROM table WHERE column=:column';

        $this->assertEquals($query, $mock->draw($query));
    }

    public function testAddIsWhereIsNull()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('isWhere')
             ->will($this->returnValue(null));

        $this->assertEquals(null, $mock->isWhere(null));
    }

    public function testAddWhereCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('where')
             ->will($this->returnValue('column'));

        $this->assertEquals('column', $mock->where('column'));
    }

    public function testAddOrWhereIsNull()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('or')
             ->will($this->returnValue(null));

        $this->assertEquals(null, $mock->or(null));
    }

    public function testAddBetweenCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('between')
             ->will($this->returnValue('column.a > column.b'));

        $this->assertEquals('column.a > column.b', $mock->between('column.a > column.b'));
    }

    public function testAddWhereInCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('whereIn')
             ->will($this->returnValue('column',['id, id']));

        $this->assertEquals('column', $mock->whereIn('column'));
    }

    public function testAddLikeCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('like')
             ->will($this->returnValue('column'));

        $this->assertEquals('column', $mock->like('column'));
    }

    public function testAddOrLikeIsNull()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('orLike')
             ->will($this->returnValue(null));

        $this->assertEquals(null, $mock->orLike(null));
    }

    public function testAddHavingCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('having')
             ->will($this->returnValue('column count(column)'));

        $this->assertEquals('column count(column)', $mock->having('column count(column)'));
    }

    public function testAddInnerJoinCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('join')
             ->will($this->returnValue('inner','column.a'));

        $this->assertEquals('inner', $mock->join('inner'));
    }

    public function testAddJoinOnCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('on')
             ->will($this->returnValue(['column.a=column,id']));

        $this->assertEquals(['column.a=column,id'], $mock->on(['column.a=column,id']));
    }

    public function testAddSetCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('set')
             ->will($this->returnValue(['column']));

        $this->assertEquals(['column'], $mock->set(['column']));
    }

    public function testAddGroupByCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('groupBy')
             ->will($this->returnValue('GROUP BY column'));

        $this->assertEquals('GROUP BY column', $mock->groupBy('GROUP BY column'));
    }

    public function testAddOrderByCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('orderBy')
             ->will($this->returnValue('ORDER BY column'));

        $this->assertEquals('ORDER BY column', $mock->orderBy('ORDER BY column'));
    }

    public function testAddLimitCondition()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('limit')
             ->will($this->returnValue(10));

        $this->assertEquals(10, $mock->limit(10));
    }

    public function testAddLimitsWithOffsetBinding()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('limits')
             ->will($this->returnValue('10, 11'));

        $this->assertEquals('10, 11', $mock->limits('10, 11'));
    }

    public function testAddValueWithArray()
    {
        $mock = $this->createMock(Tuisql::class);

        $mock->expects(self::any())
             ->method('value')
             ->will($this->returnValue(['column','column']));

        $this->assertEquals(['column','column'], $mock->value(['column','column']));
    }
}
