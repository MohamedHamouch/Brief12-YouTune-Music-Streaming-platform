<?php

require_once 'RegisterTrait.php';
require_once 'User.php';
class Artist extends User
{
    use RegisterTrait;
    public function __construct($username, $email, $password, $is_suspended)
    {
        parent::__construct($username, $email, 'artist', $password, $is_suspended);
    }

}

?>