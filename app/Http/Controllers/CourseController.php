<?php

namespace App\Http\Controllers;

use App\Generic\Generic;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    protected $course;
    protected $courseService;

    public function __construct(Course $course, CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->course = $course;
    }

    public function index()
    {
        try {
            $data = $this->courseService->getAllCourse();
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao listar cursos: " . $e->getMessage(), "", 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $this->courseService->createCourse($request->all());

            return Generic::message(true, "Curso criado com sucesso!", "", 200);
        } catch (ValidationException $e) {
            $messages = Generic::extractMessagesFromMessageBag($e->validator->errors());
            return Generic::message(false, $messages, "", 201);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao criar o curso: " . $e->getMessage(), "", 500);
        }
    }

    public function read($id)
    {
        try {
            $data = $this->courseService->getCourseById($id);
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao obter o curso: " . $e->getMessage(), "", 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $this->courseService->updateCourse($request->all());
            return Generic::message(true, "Curso alterado com sucesso!", "", 200);
        } catch (ValidationException $e) {
            $messages = Generic::extractMessagesFromMessageBag($e->validator->errors());
            return Generic::message(false, $messages, "", 201);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao alterar o curso: " . $e->getMessage(), "", 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->courseService->deleteCourse($id);

            return Generic::message(true, "Curso excluir com sucesso!", "", 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao excluir o curso: " . $e->getMessage(), "", 500);
        }
    }
}
