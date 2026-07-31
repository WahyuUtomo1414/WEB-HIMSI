<?php

namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Greeting extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'greeting';

    protected $guarded = ['id'];
}
