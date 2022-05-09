<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\BaseModel;
use App\Domain\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    use DatabaseToDomainMapper;

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var string
     */
    private string $domainModel;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model, string $domainModel)
    {
        $this->model = $model;
        $this->domainModel = $domainModel;
    }

    /**
     * @param $id
     * @param $eagerLoad
     */
    private function _findModel($id, bool $eagerLoad = false, array $columns = ['*']): ?Model
    {
        if ($eagerLoad)
            return $this->model->withAll()->find($id, $columns);
        else
            return $this->model->find($id, $columns);
    }

    private function _mapDatabaseToDomainModel($model): ?BaseModel
    {
        if ($model == null) {
            return null;
        }
        return $this->getAutoMapperInstance()->map($model, $this->domainModel);
    }

    /**
     * @param $entity
     */
    public function delete(int $id): bool
    {
        $entity = $id ? $this->_findModel($id) : null;

        if (!$entity) {
            return false;
        }

        $entity->delete();
        return true;
    }

    /**
     * @param $attributes
     */
    public function createOrUpdate(array $attributes, string $primaryKey = 'id'): BaseModel
    {
        $model = !array_key_exists($primaryKey, $attributes) ? null : $this->_findModel($attributes[$primaryKey] ?? -1);

        if (!$model)
            $model = $this->model->create($attributes);
        else {
            $model->update($attributes);
        }

        return $this->_mapDatabaseToDomainModel($model);
    }

    /**
     * @param $id
     * @param $eagerLoad
     */
    public function find($id, bool $eagerLoad = false, array $columns = ['*']): ?BaseModel
    {
        $model = null;
        if ($eagerLoad) {
            $model = $this->model->withAll()->find($id, $columns);
        } else {
            $model = $this->model->find($id, $columns);
        }

        return $this->_mapDatabaseToDomainModel($model);
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $all = [];
        foreach ($this->model->all(['*']) as $model) {
            $all[] =  $this->_mapDatabaseToDomainModel($model);
        }

        return $all;
    }

    /**
     * @param $id
     */
    public function exists($id): bool
    {
        return $this->model->find($id) != null;
    }
}
