<?php

namespace App\Http\Controllers;

use App\Contracts\BlogContract;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Resources\MessageResource;
use App\Models\Blog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @var BlogContract
     */
    protected BlogContract $blogContract;

    /**
     * @param BlogContract $blogContract
     */
    public function __construct(BlogContract $blogContract)
    {
        $this->blogContract = $blogContract;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $request['search'];
        $blogs = $this->blogContract->index(null,$request['search']);

        return view('blogs.index',compact('blogs'));
    }


    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('blogs.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request)
    {
        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
        ];
        $data['image'] = $this->blogContract->uploadImage($request->file('image'));
        $this->blogContract->store($data);
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }

    /**
     * @param Request $request
     * @param $blogId
     * @return MessageResource
     */
    public function like(Request $request, $blogId): MessageResource
    {
        $userId = auth()->user()->id;
        $blogLikes = $this->blogContract->likeBlog($blogId,$userId);
        return new MessageResource(['success' => 1,'blogLikes' => $blogLikes]);
    }
}
