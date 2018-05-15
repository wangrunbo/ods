<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;

class ValidatorBehavior extends Behavior
{

    protected $_locale = 'validation';

    public function initialize(array $config)
    {
        parent::initialize($config);
    }

    public function getLocale()
    {
        return $this->_locale;
    }

    public function tel($value)
    {
        $regex = '/^(13[0-9]|14[579]|15[0-3,5-9]|16[6]|17[0135678]|18[0-9]|19[89])\d{8}$/';

        return (bool)preg_match($regex, $value);
    }
}