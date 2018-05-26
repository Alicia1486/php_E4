<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * permet de parser une url
 * @param $url à parser
 * @return tableau contenant les paramètres
 */
class Router {

    static function parse( $request) {
        $request->url = trim($request->url, '/');
        $params = explode('/', $request->url);
        
        $request->controller = isset($params[1])?$params[1]:'user';
        $request->action = isset($params[2]) ? $params[2] : 'login';

        $request->params = array_slice($params, 3);
        return true;
    }

}
