<?php

namespace Anspi\AnspiBundle\Provider\Website;

interface PageInterface {

    public function setSource($source);
    public function getSource();
    public function isValid();
    public function url();
    public function name();

}