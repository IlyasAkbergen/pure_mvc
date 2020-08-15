<?php

namespace App\Controllers;

class BaseController
{
    public function actionUndefinedRoute()
    {
        var_dump("must be 404 page");
    }
}