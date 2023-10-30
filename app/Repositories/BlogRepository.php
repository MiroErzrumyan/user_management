<?php

namespace App\Repositories;

use App\Contracts\BlogContract;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class BlogRepository implements BlogContract
{


    /**
     * @var Blog
     */
    protected Blog $team;

    /**
     * @param Blog $blog
     */
    public function __construct(Blog $blog){
        $this->blog = $blog;
    }

    /**
     * @param $data
     * @return Model
     */
    public function store($data):Model
    {
        return $this->blog::create($data);
    }

    /**
     * @param $image
     * @return mixed
     */
    public function uploadImage($image): mixed
    {
        $filename = Str::random(16).".".$image->getClientOriginalExtension();
        $image->storeAs('images', $filename,'public');
        return $filename;
    }


    /**
     * @param $relations
     * @param $search
     * @return LengthAwarePaginator
     */
    public function index($relations, $search): LengthAwarePaginator
    {

        if ($search) {
            return $this->blog::where('name', 'LIKE', '%' . $search . '%')->paginate(10);

        }
        return $this->blog->paginate(10);
    }

    /**
     * @param $blogId
     * @param $userId
     * @return Collection
     */
    public function likeBlog($blogId, $userId): Collection
    {
        $blog = $this->blog->where('id',$blogId)->first();
        if ($blog->likes->contains($userId)){
            $blog->likes()->detach($userId);
        }else{
            $blog->likes()->attach($userId);
        }

        $blog->load('likes');
        return $blog->likes;
    }

}
