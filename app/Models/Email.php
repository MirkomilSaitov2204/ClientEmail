<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{

    protected $fillable = ['name', 'description', 'user_id'];

    protected $table = 'emails';

    public function storeEmail(array $data)
    {
        $data = $this->with('user')->create($data);

        return $data;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
