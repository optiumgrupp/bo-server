<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client\ClientModel;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getAll(Request $request)
    {
        $query = ClientModel::query();

        $firstName = null;
        $lastName = null;
        $birthYear = null;
        $birthMonth = null;
        $birthDay = null;

        // First name
        if ($request->has('firstName') && !is_null($request->get('firstName'))) {
            $firstName = trim($request->get('firstName'));
        }

        // Last name
        if ($request->has('lastName') && !is_null($request->get('lastName'))) {
            $lastName = trim($request->get('lastName'));
        }

        // year
        if ($request->has('birthYear') && $request->get('birthYear')) {
            $birthYear = $request->get('birthYear');
            if (!is_numeric($birthYear)) {
                throw new \Exception('birthYear is not a number');
            }
        }

        // month
        if ($request->has('birthMonth') && $request->get('birthMonth')) {
            $birthMonth = $request->get('birthMonth');
            if (!is_numeric($birthMonth)) {
                throw new \Exception('birthMonth is not a number');
            }

            if ($birthMonth < 1 || $birthMonth > 12) {
                throw new \Exception('birthMonth must be between 1 and 12');
            }
        }

        // day
        if ($request->has('birthDay') && $request->get('birthDay')) {
            $birthDay = $request->get('birthDay');
            if (!is_numeric($birthDay)) {
                throw new \Exception('birthDay is not a number');
            }

            if ($birthDay < 1 || $birthDay > 31) {
                throw new \Exception('birthDay must be between 1 and 31');
            }
        }

        // set filters
        if ($firstName) {
            $query->where('firstName', 'like', '%' . trim($firstName) . '%');
        }
        if ($lastName) {
            $query->where('lastName', 'like', '%' . trim($lastName) . '%');
        }
        if ($birthYear) {
            $query->where('birthDate', $birthYear);
        }
        if ($birthMonth) {
            $query->where('birthMonth', $birthMonth);
        }
        if ($birthDay) {
            $query->where('birthDay', $birthDay);
        }

        return $query->get();
    }
}
