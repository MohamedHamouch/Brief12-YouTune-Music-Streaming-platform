<?php

class Admin extends User
{
    public function __construct($username, $email, $password, $is_suspended)
    {
        parent::__construct($username, $email, 'admin', $password, $is_suspended);
    }
}

?>