<?php
namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $connection = 'user';
    protected $table      = 'user_list';
    public $primaryKey = 'MemberId';
    public $timestamps = false;
}
