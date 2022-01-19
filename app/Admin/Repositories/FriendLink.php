<?php

namespace App\Admin\Repositories;

use App\Models\FriendLink as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class FriendLink extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
