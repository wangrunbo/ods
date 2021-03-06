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
 * @mixin \App\Model\Behavior\SearchBehavior
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
        $this->addBehavior('Search');
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

        // 身份证号
        if (array_key_exists('id_num', $data)) {
            // 全角数字转半角
            $data['id_num'] = mb_convert_kana($data['id_num'], "n");
            // 短横杠、空格删除
            $data['id_num'] = preg_replace('/[-\s]/', '', $data['tel']);
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
            ->add('tel', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'last' => true,
                'message' => __d($this->getLocale(), 'Tel format invalid!')
            ])
        ;

        $validator
            ->scalar('id_num')
            ->requirePresence('id_num', 'create', __d($this->getLocale(), 'Please enter your id number!'))
            ->notEmpty('id_num', __d($this->getLocale(), 'Please enter your id number!'))
            ->add('id_num', 'format', [
                'rule' => 'id_num',
                'provider' => 'table',
                'last' => true,
                'message' => __d($this->getLocale(), 'Please enter the correct id number!')
            ])
        ;

        $validator
            ->requirePresence('achievement', 'create', __d($this->getLocale(), 'Please enter your achievement!'))
            ->notEmpty('achievement', __d($this->getLocale(), 'Please enter your achievement!'))
            ->add('achievement', 'format', [
                'rule' => 'achievement',
                'provider' => 'table',
                'last' => true,
                'message' => __d($this->getLocale(), 'Please enter the correct achievement!')
            ])
        ;

        $validator
            ->requirePresence('en_achievement', 'create', __d($this->getLocale(), 'Please enter your English achievement!'))
            ->notEmpty('en_achievement', __d($this->getLocale(), 'Please enter your English achievement!'))
            ->add('en_achievement', 'format', [
                'rule' => 'achievement',
                'provider' => 'table',
                'last' => true,
                'message' => __d($this->getLocale(), 'Please enter the correct English achievement!')
            ])
        ;

        $validator
            ->scalar('note')
            ->allowEmpty('note')
        ;

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['tel']));

        return $rules;
    }

    /**
     * @param array $search
     * @return Query
     */
    public function findAllBySearch($search)
    {
        $query = $this->find();

        if ($this->hasSearch('name', $search)) {
            $query->andWhere($this->andLike('name', $search['name']));
        }

        if ($this->hasSearch('tel', $search)) {
            $query->andWhere($this->andLike('tel', $search['tel']));
        }

        if ($this->hasSearch('note', $search)) {
            $query->andWhere($this->andLike('note', $search['note']));
        }

        $query->orderDesc('created');

        return $query;
    }
}
