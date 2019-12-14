<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientCollection;
use App\Models\Client\ClientModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getAll(Request $request)
    {
        $query = ClientModel::query();

        $this->populateFilters($request, $query);

        return new ClientCollection($this->paginate($request, $query));
    }

    private function populateFilters(Request $request, Builder $query): void
    {
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
    }

    private function paginate(Request $request, Builder $query)
    {
        $perPage = 15;
        $page = 1;

        if ($request->has('perPage') && $request->get('perPage')) {
            $perPage = $request->get('perPage');
            if (!is_numeric($perPage)) {
                throw new \Exception('perPage is not a number');

            }
        }

        if ($request->has('page') && $request->get('page')) {
            $page = $request->get('page');
            if (!is_numeric($page)) {
                throw new \Exception('page is not a number');
            }
        }


        return $query->paginate($perPage, '*', 'page', $page);
    }
}
