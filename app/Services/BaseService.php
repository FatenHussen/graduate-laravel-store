<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $filters = [])
    {
        $query = $this->model::query();

        // Apply filters
        foreach ($filters as $key => $value) {
            $query->where($key, $value);
        }

        return $query->get();
    }

    public function getOne($id)
    {
        $object = $this->model->find($id);
        if (!$object) {
            throw new NotFoundException("Resource with ID {$id} not found.");
        }
        return $object;
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $object = $this->getOne($id); // Reuse getOne for consistency
        $object->update($data);
        return $object;
    }

    public function delete($id)
    {
        $object = $this->getOne($id); // Reuse getOne for consistency
        return $object->delete();
    }
}
