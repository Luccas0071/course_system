<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function all()
    {
        // $query  = " SELECT ";
        // $query .= "     use.*, ";
        // $query .= " ( ";
        // $query .= "     SELECT  ";
        // $query .= "         count(id) as qtd_course  ";
        // $query .= "     FROM courses as cou  ";
        // $query .= "     WHERE use.id = cou.user_id ";
        // $query .= " ) ";
        // $query .= " FROM users as use ";
                    
        // return DB::select($query);

        return User::withCount('courses')->get();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data)
    {
        $user = User::findOrFail($data['id']);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    public function hasUserCheckedContent($id)
    {
        $user = Auth::user();
        $exists = $user->contents()->where('content_id', $id)->exists();

        if ($exists) {
            $user->contents()->detach($id);
            return false;
        } else {
            $user->contents()->attach($id);
            return true;
        }
    }
}

