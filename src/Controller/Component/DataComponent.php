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
            'correct' => true,
        ];

        TableRegistry::getTableLocator()->get((string)$entity->getSource())->patchEntity($entity, $data, ['validate' => $options['validate']]);

        if (!is_null($callback)) {
            $callback();
        }

        if ($options['correct']) {
            foreach (array_keys($data) as $key) {
                if ($entity->has($key) && empty($entity->getError($key))) {
                    $data[$key] = $entity->get($key);
                }
            }
        }

        return [
            'errors' => $entity->getErrors(),
            'default' => $data
        ];
    }
}