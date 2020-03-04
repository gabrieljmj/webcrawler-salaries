<?php

namespace Crawler\Operation;

interface OperationInterface
{
    /**
     * @param string $body
     * 
     * @return mixed
     */
    public function getData(string $body);
}