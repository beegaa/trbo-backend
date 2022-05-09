<?php

namespace App\Domain;

interface BaseRepositoryInterface
{
    /**
     * @param array $attributes
     * @return BaseModel
     */
    public function createOrUpdate(array $attributes, string $primaryKey): BaseModel;

    /**
     * @param $entity
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param $id
     * @return BaseModel
     */
    public function find($id, bool $eagerLoad = false, array $columns = ['*']): ?BaseModel;

     /**
     * @return array
     */
    public function all(): array;

    /**
     * @param $id
     * @return bool
     */
    public function exists($id): bool;
}