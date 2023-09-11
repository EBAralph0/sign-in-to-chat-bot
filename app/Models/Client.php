<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use Sortable;
    //use HasFactory;
    protected $fillable =["id","status","firstName","lastName","typeAuth","sex","telephone","whatsapp","accountNumber"];

    public $sortable = ['status',
    'firstName',
    'lastName',
    'typeAuth',
    'sex',
    'telephone',
    'whatsapp',
    'accountNumber'
];

}
