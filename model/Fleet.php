<?php

namespace model;

Class Fleet {
    
    protected $vessels = [];
    protected $admiralIndex = 0;

    public function __construct(array $vessel) {

        if(count($vessel)<50){
            throw new \Exception('A fleet need 50 vessels');
        }

        $this->vessels =[];
    }

    public function setAsAdmiral(int $vesselIndex = 0){
        $this->admiralIndex = $vesselIndex;
    }

    public function getVessels(){
        return $this->vessels;
    }
}