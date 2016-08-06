<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\InclusionIn;


class Customers extends Model
{
    public function validation()
    {
        $this->validate(
            new InclusionIn(
                array(
                    "field"  => "type",
                    "domain" => array(
                        "guest",
                        "free",
                        "paying"
                    )
                )
            )
        );

        $this->validate(
            new Uniqueness(
                array(
                    "field"   => "name",
                    "message" => "The name must be unique"
                )
            )
        );

        if ($this->year < 0) {
            $this->appendMessage(new Message("The year cannot be less than zero"));
        }


        if ($this->validationHasFailed() == true) {
            return false;
        }
        else {
            return true;
        }
    }
}
