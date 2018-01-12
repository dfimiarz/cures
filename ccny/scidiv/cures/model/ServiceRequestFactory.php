<?php

/*
 * The MIT License
 *
 * Copyright 2017 Daniel Fimiarz <dfimiarz@ccny.cuny.edu>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace ccny\scidiv\cures\model;

use Symfony\Component\HttpFoundation\Request;
use ccny\scidiv\cures\model\ServiceRequest;

/**
 * Description of ServiceRequestFactory
 *
 * @author Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 */
class ServiceRequestFactory {

    /**
     * 
     * @param Request $http_req
     * @return ServiceRequest
     */
    public static function createFromRequest(Request $http_req) {
        $servRequest = new ServiceRequest();
        
        $servRequest->type = $http_req->get("type",null);
        $servRequest->location = $http_req->get("location",null);
        $servRequest->urgent = $http_req->get("urgent",null);
        $servRequest->details = $http_req->get("details",null);
        $servRequest->image = $http_req->files->get("image");
        
        $servRequest->name = $http_req->get("name",null);
        $servRequest->department = $http_req->get("dept",null);
        $servRequest->phone = $http_req->get("phone",null);
        $servRequest->email = $http_req->get("email",null);
        
        return $servRequest;
    }

}
