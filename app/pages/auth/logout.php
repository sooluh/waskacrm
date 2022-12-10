<?php

if (LOGGED) {
    setcookie('logged', '', time() - (3600 * 720), '/');
    go('/');
}

go('auth/login');
