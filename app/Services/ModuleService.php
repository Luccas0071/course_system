<?php

namespace App\Services;

use App\Repositories\ModuleRepository;

class ModuleService
{
    protected $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function getModuleById($id)
    {
        return $this->moduleRepository->find($id);
    }

    public function createModule(array $data)
    {
        return $this->moduleRepository->create($data);
    }

    public function updateModule(array $data)
    {
        return $this->moduleRepository->update($data);
    }

    public function deleteModule($id)
    {
        return $this->moduleRepository->delete($id);
    }
}