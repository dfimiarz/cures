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

namespace ccny\scidiv\cures\ctrl;

use Silex\Application as Application;
use Symfony\Component\HttpFoundation\Request as Request;

/**
 * Description of HomeController
 *
 * @author Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 */
class WORequestTypeController {
   
    public function getTypes(Request $request, Application $app){
        
        $reqTypes = ["Cleaning","Lights","Leaking radiator",
                    "Leaking pipe","Leak","Faucet","Toilet paper",
                    "Shades","Lock","Windows","Sink"
                    ];
        
        $term = $request->get('term');
        
        $callback =
            function ($probType) use ($term)
            {
                return stripos($probType, $term) !== FALSE;
            };
        
        $result = array_filter($reqTypes, $callback);        
        
        return $app->json($result);
    }
    
}
