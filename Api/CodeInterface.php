<?php

namespace Elightwalk\Razorpay\Api;

interface CodeInterface
{
    /**
     * GET for razorpay api
     * @return object
     */
    public function getRzpConfig();

    /**
     * GET for razorpay API
     * @return string
     */
    public function setRzpData();

}
