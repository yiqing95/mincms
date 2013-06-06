### MINCMS \app\core namespace ,over write some widget and custom classes.
- [MINCMS](http://www.mincms.com)
- all of modules needs \app\core\ classes. such as DB.

```
use app\core\DB;

DB::one($table,$getway=array());
DB::all($table,$getway=array());
DB::insert(nsert($table,$data=array()));
DB::batchInsert($table, $columns, $rows);
DB::update($table, $columns, $condition = '', $params = array());
DB::delete($table, $condition, &$params);

```


```
DB::pagination($table,$params=array(),$route=null);
will return array('pages' 'models')
<div class='pagination'>
<?php  echo \yii\widgets\LinkPager::widget(array(
      'pagination' => $pages,
  ));?>
</div>

```
 