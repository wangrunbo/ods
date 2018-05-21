<?php
const SITE_NAME = '上海交大法国留学桥';
const ADMIN_PAGE_URL = 'admin';
const ADMIN_AUTH_CODE = '';  // 后台管理身份验证码（10位以内）

/** Setting */
define('DATA_PER_PAGE', [10, 50, 100]);
define('DATE_FORMAT', ['DATE' => 'Y-m-d', 'DATETIME' => 'Y-m-d H:i:s']);
define('ADMIN_AUTH_HOLD_HOUR', 1);

/** Session Name */
define('SESSION_FORM_ADMIN_AUTH', 'form.admin.auth');

/** Cookie Name */
define('COOKIE_ADMIN_AUTH', 'adminAuth');