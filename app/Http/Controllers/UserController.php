<?php

namespace App\Http\Controllers;

use App\Generic\Generic;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $data = $this->userService->getAllUser();
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao listar usuários: " . $e->getMessage(), "", 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $this->userService->createUser($request->all());

            return Generic::message(true, "Usuário criado com sucesso!", "", 201);
        } catch (ValidationException $e) {
            $messages = Generic::extractMessagesFromMessageBag($e->validator->errors());
            return Generic::message(false, $messages, "", 201);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao criar o usuário: " . $e->getMessage(), "", 500);
        }
    }

    public function read($id)
    {
        try {
            $data = $this->userService->getUserById($id);

            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao obter usuário: " . $e->getMessage(), "", 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $this->userService->updateUser($request->all());

            return Generic::message(true, "Usuário alterada com sucesso!", "", 200);
        } catch (ValidationException $e) {
            $messages = Generic::extractMessagesFromMessageBag($e->validator->errors());
            return Generic::message(false, $messages, "", 201);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao alterar usuário: ". $e->getMessage(), "", 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->userService->deleteUser($id);

            return Generic::message(true, "Usuário excluido com sucesso!", "", 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao excluido usuário: " . $e->getMessage(), "", 500);
        }
    }
}
