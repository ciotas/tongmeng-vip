<?php

namespace App\Admin\Repositories;

use App\Models\Podcast as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Podcast extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
