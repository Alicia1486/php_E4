<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author travail
 */
class Request {

    public $url; //url appelé par le constructeur
    var $controller;
    var $action;
    var $params;

    function __construct() {
        // print_r($_SERVER);
        if (is_null(SESSION::get('login'))) {
           // echo 'is_null dans request';
            $this->url = BASE_URL . '/' . 'user' . '/' . 'login';
        } else {
          //  echo 'is_not_null dans request';
            $this->url = $_SERVER['REQUEST_URI'];
        }
       
    }

}
