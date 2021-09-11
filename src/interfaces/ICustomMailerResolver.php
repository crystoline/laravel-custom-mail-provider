<?php


namespace Crystoline\CustomMailProvider\Interfaces;


use Illuminate\Mail\Transport\Transport;

interface ICustomMailerResolver
{

    function resolve() : Transport;

}