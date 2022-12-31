<?php

namespace App\Http\Repositories\Api;

use App\User;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->disableDeletedStatus = config('enums.disableDeletedStatus');
        $this->enableDeletedStatus = config('enums.enableDeletedStatus');
        $this->enablePublishStatus = config('enums.enablePublishStatus');
        $this->nextId = 0;
        $this->perPage = config('enums.perPage');
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function getPaginated($page = null)
    {
        return $this->model->orderBy('id', 'DESC')->paginate($page ?? config('enums.itemPerPage'));
    }

    public function getPaginatedWithFilter($filter, $page = null)
    {
        return $this->model->filter($filter)->orderBy('id', 'DESC')->paginate($page ?? config('enums.itemPerPage'));
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update(array $data, $id)
    {
        $getData = $this->getById($id);
        $getData->fill($data);

        return $getData->push();
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function pagination($resource)
    {
        $pagination = [
            'lastPage' => $resource->lastPage(),
            'currentPage' => $resource->currentPage(),
            'perPage' => $resource->perPage(),
            'totalItems' => $resource->total()
        ];

        return $pagination;
    }
}
