yii-listview
==============
Enhanced the ListView widget of yii2 framework using bootstrap classes

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sangroya/yii2-listview "*"
```

or add

```
"sangroya/yii2-listview": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php

 <?= \sangroya\ListView::widget([
               'dataProvider' => $dataProvider,
                'options' => [
                   'tag' => 'table',
                   'class' => 'importview-table table-bordered',
                   'id' => 'list-wrapper',
               ],
               'layout' => "{summary}\n{items}\n{pager}",
               'itemOptions' => ['class' => 'item', 'style' => 'margin-bottom: 5px;', 'tag'=>'tr'],
               'itemView' => function ($model, $key, $index, $widget) use($errors, $table_columns,$status){
                  
                   return $this->render('_list_item',['model' => $model]);
               },
           
               ]) 
?>


```
