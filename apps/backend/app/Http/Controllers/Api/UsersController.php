<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UsersService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Venoudev\Results\ApiJsonResources\PaginatedResource;
use Venoudev\Results\Contracts\Result;
use function PHPUnit\Framework\assertInstanceOf;

class UsersController extends Controller
{
    private UsersService $users_service;
    private Result $result;

    public function __construct(Result $result, UsersService $users_service){
        $this->users_service = $users_service;
        $this->result = $result;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users_service->listUsers();

        $this->result->success();

        if($users->isEmpty()){
            $this->result->addMessage('EMPTY_LIST','Empty model list solicited.');
            $this->result->setDescription('Empty list of users in kibernum technical test.');
            return $this->result->getJsonResponse();
        }

        $this->result->addMessage('SIMPLE_LIST','Simple data list.');
        $this->result->setDescription('List of users in kibernum technical test.');
        $this->result->addDatum('users', $users->all());
        return $this->result->getJsonResponse();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserRequest $request)
    {
        //
    }
}
