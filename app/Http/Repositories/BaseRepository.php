<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function entity($entity)
    {
        $this->model = $entity;
    }

    public function all()
    {
        try {
            return $this->model->all();
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function find($value, $param = null)
    {
        try {
            $query = $this->model->newQuery();
            if (isset($param)) {
                if (isset($param['with'])) {
                    $query->with($param['with']);
                }
            }
            return $query->findOrFail($value);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function findByUuid($uuid)
    {
        try {
            return $this->findBy(["uuid" => $uuid])->firstOrFail();
        } catch (\Exception $exception) {
            report($exception);
            throw new \Exception($exception->getMessage());
        }
    }

    public function findBy($criteria = null, $param = null)
    {

        $result = $this->model->newQuery();

        if ($criteria) {
            $result->where($criteria);
        }

        // Verificar With.
        if (isset($param['with'])) {
            $result->with($param['with']);
        }

        // Verificar Order By.
        if (isset($param['orderBy'])) {
            $type = (isset($param['type'])) ? $param['type'] : 'ASC';
            $result->orderBy($param['orderBy'], $type);
        }

        // Verifica LIMIT.
        if (isset($param['limit'])) {
            $result->limit($param['limit']);
        }

        // Verifica WhereIn.
        if (isset($param['whereIn'])) {
            if (is_array($param['whereIn'][0])) {
                foreach ($param['whereIn'] as $whereIn) {
                    $result->WhereIn($whereIn[0], $whereIn[1]);
                }
            } else {
                $result->WhereIn($param['whereIn'][0], $param['whereIn'][1]);
            }
        }

        // Verifica WhereYear.
        if (isset($param['whereYear'])) {
            $result->whereYear($param['whereYear'][0], '=', $param['whereYear'][1]);
        }

        return $result->get();
    }

    /**
     * @throws \Exception
     */
    public function create(array $data)
    {
        try {
            $this->model->fill($data);
            $this->model->save();
            return $this->model;
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function update($entity)
    {
        try {
            $entity->update();
            return $entity;
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function paginate(int $perPage, array $criteria = [])
    {
        try {
            $build = $this->model->newQuery();

            if (isset($criteria['OR'])) {
                collect($criteria['OR'])->map(function ($value, $key) use ($build) {
                    if (!empty($value)) {
                        $build->OrWhere($key, "like", "%$value%");
                    }
                });

                unset($criteria['OR']);
            }

            return $build->paginate($perPage);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }
}
