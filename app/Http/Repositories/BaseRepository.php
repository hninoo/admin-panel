<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->nextId = 0;
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getPaginated($page = null)
    {
        return $this->model->orderBy('id', 'DESC')->paginate($page ?? config('enums.itemPerPage'));
    }

    public function getPaginatedWithFilter($page = null, $filter)
    {
        return $this->model->filter($filter)->orderBy('id', 'DESC')->paginate($page ?? config('enums.itemPerPage'));
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function update(array $data, $id)
    {
        $result = $this->getById($id);
        $result->fill($data);

        return $result->push();
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function getDataByField(string $field, $value = null, $cond = null, string $fun = 'where')
    {
        if ($cond == null) {
            return $this->model->$fun($field, $value);
        } else {
            return $this->model->$fun($field, $cond, $value);
        }
    }

    public function checkImageSizeLimitaion($image)
    {
        $validator = validator(request()->all(), [
            $image => 'max:' . config('filesystems.imageSizeLimit'),
        ], [$image . '.max' => config('message.invalidFileSize')]);
        if ($validator->fails()) {
            $error_text = '';

            foreach ($validator->errors()->all() as $error) {
                $error_text .= $error;
            }
            throw new ValidationException($error_text);
        }

        return null;
    }
}
