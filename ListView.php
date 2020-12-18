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
use yii\helpers\Html;
use yii\widgets\ListView as YiiListView;

class ListView extends YiiListView
{

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
            echo Html::tag($tag, $content, $options);
            else
            echo $content;
           
        }
       
    }
}
