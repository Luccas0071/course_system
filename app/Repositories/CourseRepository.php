<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function all()
    {
        
        // return Course::with('modules.contents')->get();
        
        $userId = auth()->id();

        $courses = Course::with(['modules.contents' => function ($query) use ($userId) {
            $query->with(['users' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }]);
        }])->get();
    
        $courses->each(function ($course) use ($userId) {
            $course->modules->each(function ($module) use ($userId) {
                $module->contents->each(function ($content) use ($userId) {
                    $content->viewed = $content->viewedByUser($userId);
                });
            });
        });
    
        return $courses;
    }

    public function find($id)
    {
        return Course::findOrFail($id);
    }

    public function create(array $data)
    {
        return Course::create($data);
    }

    public function update(array $data)
    {
        $course = Course::findOrFail($data['id']);
        $course->update($data);
        return $course;
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);
        return $course->delete();
    }
}

