<?php

namespace App\Controller;
use Cake\Event\Event;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Response;
use Cake\I18n\Time;

/**
 * Class AdminController
 * @package App\Controller
 *
 * @property \App\Model\Table\ApplicantsTable $Applicants
 * @property \App\Controller\Component\DataComponent $Data
 */
class AdminController extends AppController
{

    /**
     * 登录验证码
     * @var string
     */
    protected $_authCode;

    /**
     * 登陆验证用Cookie
     * @var Cookie
     */
    protected $_authCookie;

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Applicants');

        $this->loadComponent('Data');

        $this->_authCode = env('ADMIN_AUTH_CODE', ADMIN_AUTH_CODE);
        $this->_authCookie = new Cookie(
            COOKIE_ADMIN_AUTH,
            $this->request->getCookie(COOKIE_ADMIN_AUTH),
            Time::now()->addHour(ADMIN_AUTH_HOLD_HOUR),
            '/'.env('ADMIN_PAGE_URL', ADMIN_PAGE_URL)
        );
    }

    public function beforeFilter(Event $event)
    {
        $allowed = ['auth'];

        if ($this->_authCookie->getValue() !== $this->_authCode && !in_array($this->request->getParam('action'), $allowed)) {
            $rdct = $this->request->is('get') ? $this->request->getRequestTarget() : $this->request->referer(true);
            return $this->redirect(['action' => 'auth', 'rdct' => urlencode($rdct)]);
        }

        return parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {
        $this->response = $this->response->withCookie($this->_authCookie);

        return parent::beforeRender($event);
    }

    public function beforeRedirect(Event $event, $url, Response $response)
    {
        $this->response = $response->withCookie($this->_authCookie);

        return parent::beforeRedirect($event, $url, $response);
    }

    /**
     * 后台管理首页
     *
     * @throws \Exception
     */
    public function index()
    {
        $Applicants = $this->Applicants->findAllBySearch($this->request->getQuery());

        $applicants = $this->_paginate($Applicants)->toArray();

        $this->set(compact('applicants'));
    }

    /**
     * @param int $id
     * @return Response
     * @throws \Aura\Intl\Exception
     */
    public function edit($id = null)
    {
        $this->request->allowMethod('post');

        $keys = ['name', 'tel', 'note'];

        $data = [];
        foreach ($keys as $key) {
            if (array_key_exists($key, $this->request->getData())) {
                $data[$key] = $this->request->getData($key);
            }
        }

        $applicant = $this->Applicants->get($id);

        $validator = $this->Data->validate($data, $applicant);

        if (empty($validator['errors'])) {
            $applicant = $this->Applicants->save($applicant);

            if ($applicant === false) {
                throw new InternalErrorException(__d('exception', 'Fail to save applicant information!'));
            }
        }

        return $this->response->withStringBody(json_encode($validator));
    }

    public function auth()
    {
        if ($this->request->is('post')) {
            $auth_code = $this->request->getData('auth_code');

            $redirect = $this->request->getQuery('rdct');

            if ($auth_code === $this->_authCode) {
                $this->_authCookie = $this->_authCookie->withValue($auth_code);

                $redirect_to = is_null($redirect) ? ['action' => 'index'] : urldecode($redirect);

            } else {
                $this->request->getSession()->write(SESSION_FORM_ADMIN_AUTH, [
                    'default' => ['auth_code' => $auth_code],
                    'error' => true
                ]);

                $redirect_to = is_null($redirect) ? ['action' => 'auth'] : ['action' => 'auth', 'rdct' => $redirect];
            }

            $this->response = $this->response->withCookie($this->_authCookie);

            return $this->redirect($redirect_to);

        } else {
            $auth_code = $this->_authCookie->getValue();

            if ($auth_code === $this->_authCode) {
                return $this->redirect(['action' => 'index']);
            }
        }

        if ($this->request->getSession()->check(SESSION_FORM_ADMIN_AUTH)) {
            $this->set($this->request->getSession()->consume(SESSION_FORM_ADMIN_AUTH));
        }
    }

    /**
     * @return Response|null
     * @deprecated
     */
    public function clear()
    {
        $this->request->allowMethod('post');

        $this->_authCookie = $this->_authCookie->withExpired();

        return $this->redirect(['action' => 'auth']);
    }
}