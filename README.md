Tuisql - A dynamic query builder
======================================================
[![Build Status](https://travis-ci.org/moviet/tuisql.svg?branch=master)](https://travis-ci.org/moviet/tuisql)
[![License](http://img.shields.io/:license-mit-blue.svg?style=flat-square)](http://doge.mit-license.org)
[![Usage](https://img.shields.io/badge/usage-easy-ff69b4.svg)](https://github.com/moviet/tuisql)
[![codecov](https://codecov.io/gh/moviet/tuisql/branch/master/graph/badge.svg)](https://codecov.io/gh/moviet/tuisql)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/fe6415f880494880b69cf574d9248f9d)](https://www.codacy.com/app/moviet/tuisql?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=moviet/tuisql&amp;utm_campaign=Badge_Grade)

**Tuisql** is a fast database query builder, scalable and portability, based on PDO (PHP Data Object)
as quick prepare statement also build on minimalize source codes with _richest usage_ it may will help 
an efficient development and reduce any complexity, just the first you must understand how's PDO works
for security against **_sql injection_**, we will explain through this docs as detail as we can, so
you must read and follow by **_carefully_** and we hope you **happy** using this lib

## Already

* [Composer](https://getcomposer.org) 

## Install
```
composer require "moviet/tuisql"
```

## Features

* Build Connection
* Simple C.R.U.D
* Various Of Query
* Hardcodes Query
* Retrieve Query

## Usage

### Build Connection

* You can simply write database configuration like below

  | Setting        |
  |:---------------| 
  | Driver         |
  | Hostname       |
  | Port Number    | 
  | Database Name  | 
  | Username       |
  | Password       |

  ```php
  require __DIR__ . '/vendor/autoload.php';

  use Moviet\Base\Tuisql;
  use Moviet\Base\Puppen\Tui;
  
  $connect = Tui::click(
      ['mysql','localhost','3306','dbname','username','password']
  );  
  ```

* For **sqlite** database you can use like simple
  ```php
  $connect = Tui::sqlite('folder/folder/folder','mysqlite.db');
  ```
  Path location is your mind on your own directory by using _simply format_ like above

### Simple CRUD (Create, Read, Update, Delete)

* To insert a database you can use **Add** like just below
  ```php
  require __DIR__ . '/vendor/autoload.php';

  use Moviet\Base\Tuisql;
  use Moviet\Base\Puppen\Tui;

  $build = Tui::click(
      ['mysql','localhost','3306','dbname','username','password']
  );

  $connect = new Tuisql($build);

  $column = ['category','material','color'];

  $values = ['jacket','cotton','brown'];
  $connect->from('table')
          ->column($column)
          ->value($values)
          ->add();
  ```

  `
  INSERT INTO table (category, material, color) VALUES (:category1, :material2, :color3) 
  `

* Then to read a simple database you can use **Run** as simply like
  ```php
  $values = [$varOne, $varTwo, $varNext];  

  $connect->select('*')
          ->from('table')
          ->where('id, product')
          ->value($values)
          ->run();
  ```

  `
  SELECT * FROM table WHERE id=:id1 AND product=:product2 etc.
  `

* To update database and don't want to make a hard, use **Fresh** method
  ```php
   // use array
   $connect->select(['table'])
           ->set(['column','column','column','column'])
           ->where(['column'])
           ->value(['work','easy','stay','writable'])
           ->fresh();
  ```

* And last to delete database you can express **Del** with stay on smile
  ```php
   // use commas
   $connect->from('table')
           ->where('column, column')
           ->value([$anyId, $anyVariable])
           ->del();
  ```

  By example codes on above, you are **_totally free_** to express your styles

### Various Of Query

* Add **Limit** Condition
  ```php
  $select  = ['column','column','column'];
  $wheres  = ['where','yougo'];
   
  $values  = ['pretty','easy'];  

  $connect->select($select)
          ->from('table')
          ->where($wheres)
          ->limit(10) // <= Optional integer/string
          ->value($data)
          ->run();
  ```     

* Add **Offset Or Limits** Condition
  ```php
  $select  = 'column, column, column';
  $wheres  = 'hotel, motel';

  $values  = ['not','hard', 10, 20];  // <= Add binding values

  $connect->select($select)
          ->from('table')
          ->where($wheres)
          ->limits('one, two') // <= add uniques :bind
          ->value($values)
          ->run();
  ```   

  `
  SELECT column, column, column FROM table WHERE hotel=:hotel1 AND motel=:motel2 LIMIT :one, :two
  `

* Add **Count** Condition
  ```php
  $connect->select('column, column, column')
          ->count('column')
          ->from('table')
          ->where('column')
          ->limits('11, 12') // must be unique :naming
          ->value(['something', 11, 12])
          ->run();
  ```  

* Add **Distinct** Condition
  ```php
  $connect->distinct('column AS price')
          ->from('table')
          ->where('something')
          ->limit(22)
          ->value(['something'])
          ->run();
  ```  

* Add **Group By** Condition
  ```php
  $select  = ['column','column','column'];
  $wheres  = ['column','column','column'];

  $values  = ['make','ease','readable']; 

  $connect->select($select)
          ->from('table')
          ->where($wheres)
          ->groupBy('hashtable')
          ->value($values)
          ->run();
  ``` 

* Add **Order By** Condition
  ```php
  $select  = ['column','column','column'];
  $wheres  = ['column','column','column'];

  $values  = ['free','styles','whatever']; 

  $connect->select($select)
          ->from('table')
          ->where($wheres)
          ->groupBy('column')
          ->OrderBy('date ASC') // <= sorting
          ->limit('15')
          ->value($values)
          ->run();
  ``` 

* Add **Like** Condition
  ```php
  $select  = 'column, column, column';
  $likes   = 'chocolato, coffee';

  $values  = ['delicious','groovy'];

  $connect->select($select)
          ->from('table')
          ->isWhere()  // <= require Where condition
          ->like($likes)
          ->value($data)
          ->run();
  ```

  The above will add auto LIKE with **AND** condition, you can put **->orLike()** to create OR condition

* Add **Having** Condition
  ```php
  $connect->select('column, column, column')
          ->from('table')
          ->having('count(column) > :ten') // <= add optional :bind
          ->groupBy('column count(a, b, c)')
          ->value([10]) // <= get :bind value
          ->run();
  ```

* Add **Between** Condition
  ```php
  $select  = 'column, column, column';  
  $where   = 'column, column';
  $between = 'column, column'; // <= add between column name

  $values  = ['distract','damages','between_val','between_val'];

  $connect->select($select)
          ->from('table')
          ->where($where)
          ->between($between)
          ->value($values)
          ->run();
  ```

* Add **OR** with Where Condition
  ```php
  $select  = 'column, column, column';  
  $where   = 'column, column';

  $values  = ['magnum','doritos'];

  $connect->select($select)
          ->from('table')
          ->or()
          ->where($where)
          ->value($values)
          ->run();
  ```

* Add **Where In** Condition
  ```php
  $select  = ['column AS A','column'];  
  $whereIn = ['column'];
  $addIn   = ['ca, ca, ca, ca']; // add uniques :binding

  $values  = ['cheese','sauce','salt','sugar']; // call values

  $connect->select($select)
          ->from('table')
          ->isWhere()  // <= must be add where condition
          ->whereIn($whereIn, $addIn)
          ->value($values)
          ->run();
  ```

* Add **Not In** Condition
  ```php
  $select  = ['column','column'];
  $notIn   = ['column NOT'];
  $addIn   = ['id, id, id, id'];

  $values  = ['homies','sweet','home','selfie','sussie'];

  $connect->select($select)
          ->from('table')
          ->isWhere()
          ->whereIn($notIn, $addIn)
          ->value($values)
          ->run();
  ```

* Join Tables Without Attributes
  ```php
  $select  = ['column.a','column.b','column.id as col'];
  $wheres  = ['column.a','column.b'];

  $values  = ['yayy','mooo'];

  $connect->select($select)
          ->from('table.a')
          ->where($wheres)
          ->value($values)
          ->run();
  ```

* Inner Join Tables
  ```php
  $select  = ['column.a*','column.b*'];
  $table   = ['mytable'];
  $join    = ['inner','column.b'];
  $addOn   = ['column.a=column.id','column.b=column.id']; 
  $wheres  = ['column.aid','column.bid']; // <= add 2 binds column

  $values  = [11, 12]; // <= send 2 values

  $connect->select($select)
          ->from($table)
          ->join($join)
          ->on($addOn)
          ->where($where)
          ->value($values)
          ->run();
  ```

  You can join many table with parameter and add attribute eg. [join, inner, left, cross, right]

* Join Multi Table With Where In
  ```php
  $select  = ['column.a*','column.b*'];
  $table   = ['mytable'];
  $join    = ['left','column.b']; 
  $addOn   = ['column.a=column.id','column.b=column.id','column.b=column.a']; 
  $whereIn = ['column.a']; // <= add column
  $inValue = ['id','id','id','id']; // <= add uniques :binds
  $order   = ['date'];

  $values  = [5, 20, 40, 48]; // <= add values

  $connect->select($select)
          ->from($table)
          ->join($join)
          ->on($addOn)
          ->isWhere()
          ->whereIn($whereIn, $inValue)
          ->orderBy($order)
          ->value($values)
          ->run();
  ```

  **Quotes** :
   > With various examples on above you can create many styles by your self

### Hardcodes Query

* We don't know what's the possible you want, so you can make a _hardcode_ like this
  ```php
  $select  = ['column','column'];
  $table   = ['tableA']
  $join1   = ['join','column.b']; 
  $On_1    = ['column.a=column.id','column.a=column.id','column.a=column.e']; 
  $join2   = ['inner','column.b']; 
  $On_2    = ['column.b=column.id','column.b=column.id','column.b=column.a']; 
  $join3   = ['left','column.b']; 
  $On_3    = ['column.c=column.id','column.c=column.id','column.c=column.b']; 
  $join4   = ['cross','column.c']; 
  $On_4    = ['column.d=column.id','column.d=column.id','column.d=column.c']; 
  $join5   = ['right','column.c']; 
  $On_5    = ['column.e=column.id','column.e=column.id','column.e=column.d']; 
  $wereIn1 = ['column.a'];
  $withIn1 = ['a','a','a']; // <= add unique string binds => a = :ina1,..
  $wereIn2 = ['column.b'];
  $withIn2 = ['b','b','b']; // <= add unique string binds => b = :inb1,..
  $group   = ['date.a'];
  $order   = ['date.a ASC'];
  $limit   = [20];

  $values  = [1, 2, 3, 4, 8, 16, 24, 32]; // <= depends on total parameter :binding

  $connect->select($select)
          ->from($table)
          ->join($join1)
          ->on($On_1)
          ->join($join2)
          ->on($On_2)
          ->join($join3)
          ->on($On_3)
          ->join($join4)
          ->on($On_4)
          ->join($join5)
          ->on($On_5)
          ->isWhere()
          ->or()
          ->whereIn($wereIn1, $withIn1)
          ->whereIn($wereIn1, $withIn2)
          ->groupBy($group)
          ->orderBy($order)
          ->limit($limit)
          ->value($values)
          ->run();
  ```

* You can create a **Badass** query that still possible and use **DRAW** with hardcode _manually_
  ```php
  $colom   = ['columnA','columnB AS Badass'];
  $count   = ['columnD'];
  $table   = ['columnA'];
  $draw1   = ['INNER JOIN column.b AS Bad ON column.id, column.di WHERE columnA.id=:param']; // <= add binding ":" name
  $draw2   = ['UNION ALL'];
  $draw3   = ['(SELECT column.id FROM columnC'];
  $join1   = ['left','column.b']; 
  $addOn1  = ['column.b=column.id','column.b=column.id','column.b=column.a']; 
  $join2   = ['cross','column.c']; 
  $addOn2  = ['column.c=column.id','column.c=column.id','column.c=column.a']; 
  $join3   = ['right','column.d']; 
  $addOn3  = ['column.d=column.id','column.d=column.id','column.d=column.a']; 
  $where   = ['column.a','column.b','column.c'];
  $among   = ['a.date','b.date'];
  $whereIn = ['column.a'];
  $withIn  = ['id','id','id'];
  $likes   = ['column.b', 'column.c'];
  $groups  = ['columnA.date','columnB.date','columnC.date'];
  $orders  = ['column.a ASC','column.b ASC','column.c ASC'];
  $limit   = [':hundred)']; // <= add limit binding ":" name

  $values  = ['home','sweet','home','makes', date('Y-m-d'), date('Y-m-d'), 1, 2, 3, 'badass','speed', 100]; // in sequence 

  $connect->select($colom)
          ->count($count)
          ->from($table)
          ->draw($draw1)
          ->draw($draw2)
          ->draw($draw3)
          ->join($join1)
          ->on($addOn1)
          ->join($join2)
          ->on($addOn2)
          ->join($join3)
          ->on($addOn3)
          ->where($where)
          ->between($among)
          ->whereIn($whereIn, $withIn)
          ->orLike()
          ->like($likes)
          ->groupBy($groups)
          ->orderBy($orders)
          ->limit($limit)
          ->value($values)
          ->run();
  ```
  **Notes** :
   > You must add uniques **:name** as binding when you get _values_ from **outside** to prevent **_sql injection_**

  The example on above will produces a hardcode query like below

  ```php
  SELECT columnA, columnB AS Badass, 
  COUNT(columnD)
  FROM columnA
  INNER JOIN column.b AS Bad
  ON column.id, column.date 
  WHERE columnA.id=:bindparam
  UNION ALL
        (SELECT column.id 
         FROM columnC
         LEFT JOIN column.b 
         ON column.b=column.id, column.b=column.id, column.b=column.a
         CROSS JOIN column.c
         ON column.c=column.id, column.c=column.id, column.c=column.a
         RIGHT JOIN column.d
         ON column.d=column.id, column.d=column.id, column.d=column.a
         WHERE column.a=:columna1 AND column.b=:columnb2 AND column.c=:columnc3 
         AND a.date BETWEEN :bdate AND b.date BETWEEN :bdate 
         AND column.a IN(:inid1, :inid2, :inid3)
         AND column.b LIKE :columnb1 OR column.c LIKE :columnc2
         GROUP BY columnA.date, columnB.date, columnC.date
         ORDER BY column.a ASC, column.b ASC, column.c ASC
         LIMIT :hundred)
  ``` 

#### Joins

| Attributes     | Values          | 
| -------------- |:----------------| 
| join           | JOIN            |
| inner          | INNER JOIN      | 
| left           | LEFT JOIN       | 
| right          | RIGHT JOIN      |
| cross          | CROSSS JOIN     | 

### Retrieve Query

* You can retrieve a _single row_ from **Tuisql** as simply as below
  ```php
  require __DIR__ . '/vendor/autoload.php';

  use Moviet\Base\Tuisql;
  use Moviet\Base\Puppen\Tui;
  use Moviet\Base\Fetchs\Rtui;

  $database = Tui::click(
      ['mysql','localhost','3306','dbname','username','password']
  );

  $connect = new Tuisql($database);

  $column = ['myid','type','color'];
  $values = [123456];

  $query  = $connect->select($column)
                    ->from('house')
                    ->where('id')
                    ->value($values)
                    ->run();

  $getRow = Rtui::oneRow($query);

  $myid   = $getRow['myid'];
  $type   = $getRow['type'];
  $color  = $getRow['color'];

  $direct = Rtui::notFound($getRow, '404.shtml'); // Direct url eg. url/404.shtml
  ```

* And to retrieve _more data_ you can use like this
  ```php
  $database = Tui::click(
      ['mysql','localhost','3306','dbname','username','password']
  );

  $connect = new Tuisql($database);

  $column = ['code','shoes','color'];
  $values = [123456];

  $query  = $connect->select($column)
                    ->from('house')
                    ->where('code')
                    ->value($values)
                    ->run();

  $allRow = Rtui::allRow($query); // Equivalent like fetchAll

  foreach ($allRow as $row => $all) {

      $code   = $all['code'];
      $shoes  = $all['shoes'];
      $color  = $all['color'];
  }

  $direct = Rtui::notFound($allRow, '404.shtml'); // Direct url eg. url/404.shtml
  ```

## License

`Moviet/tuisql` is released under the MIT public license.