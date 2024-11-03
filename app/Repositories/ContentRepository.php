<?php

namespace App\Repositories;

use App\Models\Content;

class ContentRepository
{
    public function all()
    {
        return Content::with('module.course')->get();
        // return Content::all();
    }

    public function find($id)
    {
        return Content::findOrFail($id);
    }

    public function create(array $data)
    {
        return Content::create($data);
    }

    public function update(array $data)
    {
        $content = Content::findOrFail($data['id']);
        $content->update($data);
        return $content;
    }

    public function delete($id)
    {
        $content = Content::findOrFail($id);
        return $content->delete();
    }

    public function allUsersViewed($id)
    {
        $content = Content::find($id);
        if ($content) {
            return $content->users;
        }
    }
}

