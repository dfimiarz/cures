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
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Session as Session;
use ccny\scidiv\cures\model\ServiceRequest;
use ccny\scidiv\cures\model\ServiceRequestFactory;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Description of HomeController
 *
 * @author Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 */
class WorkOrderController {

    public function newWorkOrder(Request $request, Application $app) {

//        $form_params = array("form_errors" =>
//            array(
//                "phone" =>
//                array("Name too short", "Name is empty"),
//                "email" =>
//                array("Name too short", "Name is empty"),
//                "name" =>
//                array("Name too short", "Name is empty")
//        ));
        $errorMsgs = $app['session']->getFlashBag()->get('formErrors');

        if( count($errorMsgs) > 0 ){
            var_dump($errorMsgs);
            exit();
        }
        
        $formParams = ["form_errors" => $errorMsgs];
        
        return $app['twig']->render("newworkorder.html.twig", $formParams);
    }

    public function submitWorkOrder(Request $request, Application $app) {

        /* @var $session Session */
        $session = $app['session'];

        $servicerequest = ServiceRequestFactory::createServiceRequest($request);

        /* @var $validationErrors ConstraintViolationList */
        $validationErrors = $app['validator']->validate($servicerequest);

        $errorMsgs = [];
        
        if (count($validationErrors) > 0) {

            /* @var $validationError ConstraintViolationInterface */
            foreach ($validationErrors as $validationError) {
                
                $fieldname = $validationError->getPropertyPath();
                
                if (!array_key_exists($fieldname, $errorMsgs)){
                    $errorMsgs[$fieldname] = [];
                }
                
                $errorMsgs[$fieldname][] = $validationError->getMessage();
            }
            
            $session->getFlashBag()->add('formErrors', $errorMsgs);

            return $app->redirect($app['url_generator']->generate("newWorkOrder"));
        }

        exit();

        //When submission is ok, redirect to done
        return $app->redirect("/confirm");
    }

    public function confirmWorkOrder(Request $request, Application $app) {

        $bag = $app['session']->getFlashBag()->get('user');

        $result = "";

        foreach ($bag as $key => $value) {
            $result .= $key . " " . $value;
        }

        return $result;
    }

}
