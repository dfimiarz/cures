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

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of ServiceRequest
 *
 * @author Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 */
class ServiceRequest {

    /** @var string */
    public $type;
    
    /** @var string */
    public $location;
    
    /** @var int */
    public $urgent;
    
    /** @var string */
    public $details;
    
    /** @var UploadedFile | null */
    public $image;
    
    /** @var string */
    public $name;
    
    /** @var string */
    public $department;
    
    /** @var string */
    public $phone;
    
    /** @var string */
    public $email;

    public function __construct() {
        
    }

    static public function loadValidatorMetadata(ClassMetadata $metadata) {

        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('name', new Assert\Length(array('min' => 2)));

        $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        $metadata->addPropertyConstraint('email', new Assert\Email(array('checkMX' => true)));

        $metadata->addPropertyConstraint('phone', new Assert\NotBlank());
        $metadata->addPropertyConstraint('phone', new Assert\Length(array('min' => 4)));

        $metadata->addPropertyConstraint('type', new Assert\NotBlank());
        $metadata->addPropertyConstraint('type', new Assert\Length(array('min' => 2)));

        $metadata->addPropertyConstraint('location', new Assert\NotBlank());
        $metadata->addPropertyConstraint('location', new Assert\Length(array('min' => 2)));

        $metadata->addPropertyConstraint('image', new Assert\Image(array('mimeTypes' => "image/jpx")));
    }

    public function getRawFormValues() {
        
        $filename = $this->image instanceof UploadedFile ? $this->image->getClientOriginalName() : null; 

        return array(
            "type" => $this->type,
            "location" => $this->location,
            "urgent" => $this->urgent,
            "details" => $this->details,
            "image" => $filename,
            "name" => $this->name,
            "department" => $this->department,
            "phone" => $this->phone,
            "email" => $this->email
        );
    }

}
