<?php

namespace App\Model\Behavior;

use Cake\I18n\Time;
use Cake\ORM\Behavior;

class SearchBehavior extends Behavior
{

    public function initialize(array $config)
    {
        parent::initialize($config);
    }

    /**
     * @param string $name
     * @param array $search
     * @return bool
     */
    public function hasSearch($name, array $search)
    {
        if (!array_key_exists($name, $search)) {
            return false;
        }

        $value = $search[$name];

        if (is_integer($value) || is_float($value)) {
            $value = (string)$value;
        }

        return !empty($value) || $value === '0';
    }

    /**
     * @param mixed $value
     * @param string $type
     * @return mixed
     */
    public function format($value, $type = 'string')
    {
        switch ($type) {
            case 'string':
                $value = preg_replace('/\\\\/', '\\\\\\\\', $value);

                break;
            case 'datetime':
                if (is_string($value)) {
                    $datetime = date_parse($value);

                    $value = Time::create($datetime['year'], $datetime['month'], $datetime['day'], $datetime['hour'], $datetime['minute'], $datetime['second']);
                }
        }

        return $value;
    }

    /**
     * @param string $column
     * @param string|array $value
     */
    public function andLike($column, $value)
    {

    }

    public function orLike($column, $value)
    {

    }

    /**
     * @param string $sting
     */
    protected function _searchStringToArray($sting)
    {
        
    }
}