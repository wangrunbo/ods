<?php

namespace App\Model\Behavior;

use Cake\Database\Expression\QueryExpression;
use Cake\I18n\Time;
use Cake\ORM\Behavior;
use Cake\ORM\Query;

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
     * @return \Closure
     */
    public function andLike($column, $value)
    {
        $value = $this->_searchStringToArray($value);

        return function (QueryExpression $exp) use ($column, $value) {
            foreach ($value as $like) {
                $exp->like($column, "%{$like}%");
            }

            return $exp;
        };
    }

    public function orLike($column, $value)
    {
        $value = $this->_searchStringToArray($value);

        return function (QueryExpression $exp, Query $q) use ($column, $value) {
            $or = [];

            foreach ($value as $like) {
                $or[] = $q->newExpr()->like($column, "%{$like}%");
            }

            return $exp->or_($or);
        };
    }

    /**
     * @param string $string
     * @return array|string
     */
    protected function _searchStringToArray($string)
    {
        if (!is_string($string)) {
            return $string;
        }

        $string = preg_replace('/^[ 　]+|[ 　]$/', '', $string);
        $string = preg_replace('/[ 　]+/', ' ', $string);

        return explode(' ', $string);
    }
}