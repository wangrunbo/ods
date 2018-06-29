<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link https://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    public $title = SITE_NAME;

    protected $scriptVars = null;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * 设置页面标题
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title.' | '.SITE_NAME;
    }

    public function setScriptVars($name, $value = null, array $options = [])
    {
        $options += [
            'is_html' => false,
            'is_string' => true
        ];

        if (is_null($value)) {
            $var = "let {$name};";
        } else {
            if ($options['is_html']) {
                $value = preg_replace('/'.PHP_EOL.'|(\r\n)|\n/', '', $value);
            }

            if ($options['is_string'] || is_string($value)) {
                $value = '\''.$value.'\'';
            }

            $var = "let {$name} = {$value};";
        }

        if (!is_null($this->scriptVars)) {
            $this->scriptVars = $var;
        } else {
            $this->scriptVars .= PHP_EOL.$var;
        }

        $this->Html->scriptBlock($this->scriptVars, ['block' => 'vars']);
    }
}
