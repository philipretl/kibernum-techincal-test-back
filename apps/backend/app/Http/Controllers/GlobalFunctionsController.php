<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalFunctionsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function docs(){
        return redirect('api/docs');
    }
}
