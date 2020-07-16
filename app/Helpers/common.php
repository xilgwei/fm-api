<?php

/**
 * fm密码加密方式
 * @param $password
 * @return string
 */
function encryption_password($password) {
    $authCode = env('RgvuqpG8FRVwCCykk4');
    return "###" . md5(md5($authCode . $password));
}
