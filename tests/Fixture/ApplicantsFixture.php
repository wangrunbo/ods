<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicantsFixture
 *
 */
class ApplicantsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '姓名', 'precision' => null, 'fixed' => null],
        'tel' => ['type' => 'string', 'length' => 11, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '联系电话', 'precision' => null, 'fixed' => null],
        'id_num' => ['type' => 'string', 'length' => 18, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '身份证号', 'precision' => null, 'fixed' => null],
        'achievement' => ['type' => 'float', 'length' => 3, 'precision' => 1, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '高考成绩'],
        'en_achievement' => ['type' => 'float', 'length' => 3, 'precision' => 1, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '高考英语成绩'],
        'note' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '备注', 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '生成时间', 'precision' => null],
        'updated' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '修改时间', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'tel' => ['type' => 'unique', 'columns' => ['tel'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'tel' => 'Lorem ips',
                'id_num' => 'Lorem ipsum dolo',
                'achievement' => 1,
                'en_achievement' => 1,
                'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => 1530080959,
                'updated' => 1530080959
            ],
        ];
        parent::init();
    }
}
