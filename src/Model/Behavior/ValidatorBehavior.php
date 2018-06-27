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

    public function id_num($value)
    {
        $regex = '/^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}$/';

        return (bool)preg_match($regex, $value);
    }

    public function achievement($value)
    {
        $regex = '/^\d{1,3}(\.\d)?$/';

        return (bool)preg_match($regex, $value);
    }
}