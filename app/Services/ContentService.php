<?php

namespace App\Services;

use App\Repositories\ContentRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class ContentService
{
    protected $contentRepository;
    protected $userRepository;

    public function __construct(ContentRepository $contentRepository, UserRepository $userRepository)
    {
        $this->contentRepository = $contentRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllContent()
    {
        return $this->contentRepository->all();
    }

    public function getContentById($id)
    {
        return $this->contentRepository->find($id);
    }

    public function createContent(array $data)
    {
        return $this->contentRepository->create($data);
    }

    public function updateContent(array $data)
    {
        return $this->contentRepository->update($data);
    }

    public function deleteContent($id)
    {
        return $this->contentRepository->delete($id);
    }

    public function alterSituationContent($id){

        $content = $this->contentRepository->find($id);
        return $this->userRepository->hasUserCheckedContent($id);
    }

    public function getAllUsersViewed($id){

        return $this->contentRepository->allUsersViewed($id);
    }
}