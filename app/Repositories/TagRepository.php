<?php

namespace App\Repositories;

use App\Tag;
use Illuminate\Support\Facades\Auth;

class TagRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * Get record by the name.
     * 
     * @param  string $name
     * @return collection
     */
    public function getByName($name)
    {
        return $this->model->where('tag', $name)->first();
    }

    public function getTagsByAuth() {
        $user = Auth::user();

        if (!$user->is_admin) {
            $this->model = $this->model->where("user_id", $user->id);
        }

        return $this->page();
    }
}
