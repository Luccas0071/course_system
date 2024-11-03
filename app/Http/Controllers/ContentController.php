<?php

namespace App\Http\Controllers;

use App\Generic\Generic;
use App\Services\ContentService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContentController extends Controller
{
    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index()
    {
        try {
            $data = $this->contentService->getAllContent();
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao listar conteudo: " . $e->getMessage(), "", 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $this->contentService->createContent($request->all());

            return Generic::message(true, "Conteudo criado com sucesso!", "", 200);
        } catch (ValidationException $e) {
            $messages = Generic::extractMessagesFromMessageBag($e->validator->errors());
            return Generic::message(false, $messages, "", 201);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao criar o conteudo: " . $e->getMessage(), "", 500);
        }
    }

    public function read($id)
    {
        try {
            $data = $this->contentService->getContentById($id);
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao obter conteudo: " . $e->getMessage(), "", 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $this->contentService->updateContent($request->all());

            return Generic::message(true, "Conteudo alterada com sucesso!", "", 200);
        } catch (ValidationException $e) {
            $messages = Generic::extractMessagesFromMessageBag($e->validator->errors());
            return Generic::message(false, $messages, "", 201);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao alterar conteudo: " . $e->getMessage(), "", 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->contentService->deleteContent($id);

            return Generic::message(true, "Conteudo excluido com sucesso!", "", 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao excluir conteudo: " . $e->getMessage(), "", 500);
        }
    }

    public function alterSituation($id)
    {
        try{
            $viewed = $this->contentService->alterSituationContent($id);
            if($viewed){
                return Generic::message(true, "Conteudo visualizado com sucesso!", "", 200);
            }else{
                return Generic::message(true, "Visualização cancelada com sucesso!", "", 200);
            }
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao visualizar conteudo: " . $e->getMessage(), "", 500);
        }
    }

    public function usersViewed($id)
    {
        try {
            $data = $this->contentService->getAllUsersViewed($id);
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao listar usuários que visualizaram conteudo: " . $e->getMessage(), "", 500);
        }
    }
}
