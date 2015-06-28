<?php
require_once 'core.php';
authentication_logout();
http_go_to_url(LOGIN_PAGE_URL);
