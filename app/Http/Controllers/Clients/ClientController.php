<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client\ClientModel;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getAll(Request $request)
    {
        return ClientModel::all();
    }
}
