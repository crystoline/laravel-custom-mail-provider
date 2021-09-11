<?php


namespace Crystoline\CustomMailProvider\Interfaces;


interface ICustomMailerResolver
{

    function resolve() : ICustomMailer;

}