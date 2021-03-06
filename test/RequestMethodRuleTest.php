<?php

/*
 * This file is part of Slim HTTP Basic Authentication middleware
 *
 * Copyright (c) 2013-2015 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   https://github.com/tuupola/slim-basic-auth
 *
 */

namespace Test;

use \Slim\Middleware\HttpBasicAuthentication\RequestMethodRule;

class RequestMethodPassthroughTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldNotAuthenticateOptions()
    {
        \Slim\Environment::mock(array(
            "REQUEST_METHOD" => "OPTIONS"
        ));

        $rule = new RequestMethodRule();

        $this->assertFalse($rule(new \Slim\Slim));
    }

    public function testShouldAuthenticatePost()
    {
        \Slim\Environment::mock(array(
            "REQUEST_METHOD" => "POST"
        ));

        $rule = new RequestMethodRule();

        $this->assertTrue($rule(new \Slim\Slim));
    }

    public function testShouldAuthenticateGet()
    {
        \Slim\Environment::mock(array(
            "REQUEST_METHOD" => "GET"
        ));

        $rule = new RequestMethodRule();

        $this->assertTrue($rule(new \Slim\Slim));
    }

    public function testShouldConfigurePassThrough()
    {
        \Slim\Environment::mock(array(
            "REQUEST_METHOD" => "GET"
        ));

        $rule = new RequestMethodRule(array(
            "passthrough" => array("GET")
        ));

        $this->assertFalse($rule(new \Slim\Slim));
    }
}
