<?php

namespace App\Http\Controllers;

use App\Generic\Generic;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function create(Request $request)
    {
        try {
            $this->moduleService->createModule($request->all());

            return Generic::message(true, "Modulo criado com sucesso!", "", 200);
        } catch (ValidationException $e) {
            $messages = Generic::extractMessagesFromMessageBag($e->validator->errors());
            return Generic::message(false, $messages, "", 201);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao criar o modulo: " . $e->getMessage(), "", 500);
        }
    }

    public function read($id)
    {
        try {
            $data = $this->moduleService->getModuleById($id);
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao obter o modulo: " . $e->getMessage(), "", 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $this->moduleService->updateModule($request->all());
            
            return Generic::message(true, "Modulo alterada com sucesso!", "", 200);
        } catch (ValidationException $e) {
            $messages = Generic::extractMessagesFromMessageBag($e->validator->errors());
            return Generic::message(false, $messages, "", 201);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao alterar o modulo: " . $e->getMessage(), "", 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->moduleService->deleteModule($id);

            return Generic::message(true, "Modulo excluir com sucesso!", "", 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao excluir o modulo: " . $e->getMessage(), "", 500);
        }
    }
}
