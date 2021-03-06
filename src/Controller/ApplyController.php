<?php

namespace App\Controller;
use Cake\Http\Exception\InternalErrorException;


/**
 * Class ApplyController
 * @package App\Controller
 *
 * @property \App\Model\Table\ApplicantsTable $Applicants
 * @property \App\Controller\Component\DataComponent $Data
 */
class ApplyController extends AppController
{

    /**
     * @throws \Exception
     */
    public function initialize()
    {
        $this->loadModel('Applicants');

        $this->loadComponent('Data');
    }

    /**
     * 申请页面
     * @return \Cake\Http\Response|null
     * @throws \Aura\Intl\Exception
     */
    public function index()
    {
        if ($this->request->is('post')) {
            $data = [
                'name' => $this->request->getData('name'),
                'tel' => $this->request->getData('tel'),
                'id_num' => $this->request->getData('id_num'),
                'achievement' => $this->request->getData('achievement'),
                'en_achievement' => $this->request->getData('en_achievement')
            ];

            $applicant = $this->Applicants->newEntity();

            $validator = $this->Data->validate($data, $applicant);

            if (empty($validator['errors'])) {
                $applicant = $this->Applicants->save($applicant);

                if ($applicant === false) {
                    throw new InternalErrorException(__d('exception', 'Fail to save applicant information!'));
                }
            }

            if (isset($validator['errors']['tel']) && array_keys($validator['errors']['tel']) === ['unique']) {
                unset($validator['errors']['tel']);
            }

            // TODO ajax cross domain
            $this->response = $this->response->withHeader('Access-Control-Allow-Origin', '*');

            return $this->response->withStringBody(json_encode($validator));
        }
    }
}