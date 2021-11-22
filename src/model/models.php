<?php

class User
{
    // table fields
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    // message string
    public $id_msg;
    public $first_name_msg;
    public $last_name_msg;
    public $email_msg;
    // constructor set default value
    function __construct()
    {
        $id = 0;
        $first_name = $last_name = $email = "";
        $id_msg = $first_name_msg = $last_name_msg = $email_msg = "";
    }
}
