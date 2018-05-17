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

    public function like($string)
    {
        dump(gettype($string));exit;
    }
}