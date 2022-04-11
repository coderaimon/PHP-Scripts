<?php

class Action{
    public $conn,$session,$custom,$view,$helper;
    function __construct()
    {
        $this->conn = new Database;
        $this->session = new Session;
        $this->custom = new Custom;
        $this->view = new View;
        $this->helper = new Helper;
    }
}
