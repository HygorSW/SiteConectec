<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user_one_id', 'user_two_id'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Relação com o primeiro usuário
    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    // Relação com o segundo usuário
    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }
}
