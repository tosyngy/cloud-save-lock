<?php

class Error extends Controller{

    function __construct() {
        parent::__construct();
       }

            function index(){ 
                echo mdecrypt_generic(null,"tosin");
        }
       
}
