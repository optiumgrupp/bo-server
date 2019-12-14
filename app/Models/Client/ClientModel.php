<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    protected $table = 'clients';
    protected $guarded = [
        'id',
    ];
    protected $fillable = [
        'firstName',
        'lastName',
        'birthDay',
        'birthMonth',
        'birthDate',
        'registrationDate',
        'email',
        'phone',
        'address',
        'updated',
        'MFD',

        'gSPHos',
        'gSPHod',
        'gCYLod',
        'gCYLos',
        'gAXISod',
        'gAXISos',
        'gADDod',
        'gADDos',
        'gPD',
        'cBC',
        'notes',
    ];
}
