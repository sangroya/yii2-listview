<?php
/**
 * @package   yii2-grid
 * @author    Parveen Sangroya <parveen0013@gmail.com>
 * @copyright Copyright &copy; parveen-sangroya, 2020
 * @version   1.0
 */

namespace sangroya;
use Closure;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\widgets\ListView as YiiListView;

class ListView extends YiiListView
{

    public $header=false;
    public $parentOptions=[];
   
    public function renderHeader($attributes){
        $header="";
        $options=$this->itemOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        $headerItemTag="span";
       
        if($tag=="tr")
        $headerItemTag="th";

       
        foreach($attributes as $value)
        $header.=Html::tag($headerItemTag,$value,[]);
      
        return Html::tag($tag,$header,[]);
    }
    public function renderItems()
    {
        $models = $this->dataProvider->getModels();
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        if($this->header){
            if(! isset($this->header["attributes"])){
                throw new InvalidConfigException('The "attributes" property must be either an array or an object of header');
            }
            $row[]=$this->renderHeader($this->header['attributes']);
          
        }
        foreach (array_values($models) as $index => $model) {
            $key = $keys[$index];
            if (($before = $this->renderBeforeItem($model, $key, $index)) !== null) {
                $rows[] = $before;
            }

            $rows[] = $this->renderItem($model, $key, $index);

            if (($after = $this->renderAfterItem($model, $key, $index)) !== null) {
                $rows[] = $after;
            }
        }
      
        return implode($this->separator, $rows);
    }
    /**
     * Runs the widget.
     */
    public function run()
    {
       $mycontent=[];
        if ($this->showOnEmpty || $this->dataProvider->getCount() > 0) {
            $content = preg_replace_callback('/{\\w+}/', function ($matches) use (&$mycontent) {

                $content = $this->renderSection($matches[0]);
                $mycontent[$matches[0]]=$content;
                return $content === false ? $matches[0] : $content;
            }, $this->layout);
            
        } else {
            $content = $this->renderEmpty();
        }

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
       
        foreach($mycontent as $key=>$content){
            if($key=="{items}")
            {
                if($this->parentOptions){
                    $parentOptions = $this->parentOptions;
                    $parentTag = ArrayHelper::remove($parentOptions, 'tag', 'div');
                    echo Html::tag($parentTag, Html::tag($tag, $content, $options),$parentOptions);
                }else
                echo Html::tag($tag, $content, $options);
            }
            else
            echo $content;
           
        }
       
    }
}
