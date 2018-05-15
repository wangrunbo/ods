<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class DataComponent extends Component
{

    /**
     * 数据验证
     *
     * @param array $data
     * @param \Cake\Datasource\EntityInterface $entity
     * @param callable|null $callback
     * @param array $options
     * @return array
     */
    public function validate($data, $entity, callable $callback = null, $options = [])
    {
        $options += [
            'validate' => true,
            'correct' => false,
        ];

        TableRegistry::getTableLocator()->get((string)$entity->getSource())->patchEntity($entity, $data, ['validate' => $options['validate']]);

        if (!is_null($callback)) {
            $callback();
        }

        return [
            'errors' => $entity->getErrors(),
            'default' => $options['correct'] ? array_merge($data, $entity->toArray()) : $data
        ];
    }
}