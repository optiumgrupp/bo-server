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
        'city',
        'updated',
        'gSPHod',
        'gSPHos',
        'gCYLod',
        'gCYLos',
        'gAXISod',
        'gAXISos',
        'gADDod',
        'gADDos',
        'gPD',
        'gUpdated',
        'cBC',
        'notes',
        'cUpdated',
        'MFD',
    ];
}
