<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;

    protected $table = 'contact_information';

    protected $fillable = [
        'images',
        'describe',
        'phone_number',
        'email',
        'link_facebook',
        'link_map',
        'link_zalo',
        'slogan',
    ];
}