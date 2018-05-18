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
                'tel' => $this->request->getData('tel')
            ];

            $applicant = $this->Applicants->newEntity();

            $validator = $this->Data->validate($data, $applicant);

            if ($this->request->is('ajax')) {
                return $this->response->withStringBody(json_encode($validator));
            }

            if (empty($validator['errors'])) {
                $applicant = $this->Applicants->save($applicant);

                if ($applicant === false) {
                    throw new InternalErrorException(__d('exception', 'Fail to save applicant information!'));
                }

                return $this->redirect(['action' => 'complete']);

            } else {
                $this->request->getSession()->write(SESSION_FORM_APPLY, $validator);

                return $this->redirect(['action' => 'index']);
            }
        }

        if ($this->request->getSession()->check(SESSION_FORM_APPLY)) {
            $this->set($this->request->getSession()->consume(SESSION_FORM_APPLY));
        }
    }

    public function complete()
    {
//        $this->set(null);
    }
}