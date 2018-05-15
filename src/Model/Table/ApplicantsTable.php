<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applicants Model
 *
 * @method \App\Model\Entity\Applicant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Applicant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Applicant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Applicant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Applicant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Applicant findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \App\Model\Behavior\ValidatorBehavior
 */
class ApplicantsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('applicants');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Validator');
        $this->addBehavior('Timestamp');
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        // 姓名
        if (array_key_exists('name', $data)) {
            // 全角字母空格转半角，半角假名转全角
            $data['name'] = mb_convert_kana($data['name'], "rsKV");
            // 开头结尾空格删除
            $data['name'] = preg_replace('/(^ +)|( +$)/', '', $data['name']);
            // 空格合并
            $data['name'] = preg_replace('/ +/', ' ', $data['name']);
        }

        // 电话号码
        if (array_key_exists('tel', $data)) {
            // 全角数字转半角
            $data['tel'] = mb_convert_kana($data['tel'], "n");
            // 短横杠、空格删除
            $data['tel'] = preg_replace('/[-\s]/', '', $data['tel']);
        }
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     * @throws \Aura\Intl\Exception
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
        ;

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create', __d($this->getLocale(), 'Please enter your name!'))
            ->notEmpty('name', __d('validation', 'Please enter your name!'))
            ->maxLength('name', 100, __d('validation', 'Name is far too long!'))
            ->regex('name', '/^[\x{4e00}-\x{9fff}\x{0800}-\x{4e00} \.a-zA-Z]{1,100}$/u', __d('validation', 'Name format invalid!'))
        ;

        $validator
            ->scalar('tel')
            ->requirePresence('tel', 'create', __d($this->getLocale(), 'Please enter your phone number!'))
            ->notEmpty('tel', __d($this->getLocale(), 'Please enter your phone number!'))
            ->add('tel', 'format', [
                'rule' => 'tel',
                'provider' => 'table',
                'last' => true,
                'message' => __d($this->getLocale(), 'Tel format invalid!')
            ])
        ;

        $validator
            ->scalar('note')
            ->allowEmpty('note')
        ;

        return $validator;
    }
}
