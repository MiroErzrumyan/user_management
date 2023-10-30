<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BlogContract
{

    /**
     * @param $data
     * @return Model
     */
    public function store($data): Model;

    /**
     * @param $image
     * @return mixed
     */
    public function uploadImage($image): mixed;

    /**
     * @param $relations
     * @param $search
     * @return LengthAwarePaginator
     */
    public function index($relations, $search): LengthAwarePaginator ;

    /**
     * @param $blogId
     * @param $userId
     * @return Collection
     */
    public function likeBlog($blogId, $userId): Collection;
}
