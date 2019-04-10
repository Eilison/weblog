<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Repositories\TagRepository;
use Illuminate\Support\Facades\Auth;

class TagController extends ApiController
{
    protected $tag;

    public function __construct(TagRepository $tag)
    {
        parent::__construct();

        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response->collection($this->tag->getTagsByAuth());
    }

    /**
     * Show all of the tags.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        return $this->response->collection($this->tag->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagRequest $request)
    {
        $data = array_merge($request->all(), [
            'user_id'      => Auth::id()
        ]);

        $this->tag->store($data);

        return $this->response->withNoContent();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return $this->response->item($this->tag->getById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->tag->update($id, $request->except('tag'));

        return $this->response->withNoContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->tag->destroy($id);

        return $this->response->withNoContent();
    }
}
