<?php

namespace App\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\Model;
use Cake\Utility\Inflector;
use ArrayObject;

class SluggableBehavior extends Behavior
{
    protected $_defaultConfig = [
        'field' => 'title',
        'slug' => 'slug',
        'replacement' => '-',
    ];
    public function initialize(array $config)
    {
        $this->_defaultConfig = $config;
    }
    public function beforeSave(Event $event, EntityInterface $entity,ArrayObject $arrayObj)
    {
        $config = $this->config();
        $field = $config['field'];
        $slugfield = $config['slug'];
        $value = $entity->get($field);
        $id = $entity->get('id');
        $slug_validate = false;
        $i = 0;
        while(!$slug_validate)
        {   
            
            $slug = Inflector::slug(strtolower($value), $config['replacement']);
            $conditions[$slugfield.' like '] = $slug;
            if(!isset($id))
            {
                $conditions['id != '] = $id;
            }
            $count = $event->subject->find()->where($conditions)->count();
            if($count > 0)
            {
                $i++;
                $value = $value.' '.$i;
            }
            else
            {
                $slug_validate = true;
                $entity->set($config['slug'],$slug);
            }
        }
    }

}

?>