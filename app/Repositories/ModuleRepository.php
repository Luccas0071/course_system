<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    public function find($id)
    {
        return Module::findOrFail($id);
    }

    public function create(array $data)
    {
        return Module::create($data);
    }

    public function update(array $data)
    {
        $module = Module::findOrFail($data['id']);
        $module->update($data);
        return $module;
    }

    public function delete($id)
    {
        $module = Module::findOrFail($id);
        return $module->delete();
    }
}

