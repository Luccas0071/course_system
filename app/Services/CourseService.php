<?php

namespace App\Services;

use App\Repositories\CourseRepository;


class CourseService
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getAllCourse()
    {
        return $this->courseRepository->all();
    }

    public function getCourseById($id)
    {
        return $this->courseRepository->find($id);
    }

    public function createCourse(array $data)
    {
        return $this->courseRepository->create($data);
    }

    public function updateCourse(array $data)
    {
        return $this->courseRepository->update($data);
    }

    public function deleteCourse($id)
    {
        return $this->courseRepository->delete($id);
    }
}