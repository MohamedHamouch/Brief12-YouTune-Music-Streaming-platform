<?php

require_once './models/User.php';
require_once './models/RegisterTrait.php';

class Member extends User
{
    use RegisterTrait;

    public function __construct($username, $email, $password, $is_suspended)
    {
        parent::__construct($username, $email, 'member', $password, $is_suspended);
    }
}

?>