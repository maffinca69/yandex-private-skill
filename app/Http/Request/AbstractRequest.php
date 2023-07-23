<?php

namespace App\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

abstract class AbstractRequest extends Controller implements RequestInterface
{
    protected Request $request;

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->validate($request, $this->rules());
    }
}
