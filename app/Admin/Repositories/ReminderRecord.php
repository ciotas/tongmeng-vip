<?php

namespace App\Admin\Repositories;

use App\Models\ReminderRecord as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ReminderRecord extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
