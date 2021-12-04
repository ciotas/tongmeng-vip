<?php

namespace App\Admin\Repositories;

use App\Models\Reminder as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Reminder extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
