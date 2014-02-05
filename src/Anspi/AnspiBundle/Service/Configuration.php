<?php

namespace Anspi\AnspiBundle\Service;

class Configuration
{
    protected $config = array();

    public function __construct()
    {
        $this->config = array(
            'username' => null,
            'password' => null
        );
    }

    public function setPassword($password)
    {
        $this->config['password'] = $password;
    }

    public function getPassword()
    {
        return $this->config['password'];
    }

    public function setUsername($username)
    {
        $this->config['username'] = $username;
    }

    public function getUsername()
    {
        return $this->config['username'];
    }

    public function isValid()
    {
        if(!$this->getPassword() || !$this->getUsername()) return false;
        return true;
    }

    public function save($file)
    {
        //$json = json_encode($this->config);
        //file_put_contents($file, $json);
    }

    public function load($file)
    {
        //$json = file_get_contents($file);
        //$this->config = json_decode($json);
    }
}