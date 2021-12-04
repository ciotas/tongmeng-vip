<?php

namespace App\Admin\Repositories;

use App\Models\Market as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Market extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
