<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'test_table';


    /**
     * No create/update dates
     * @var string
     */
    public $timestamps = false;


    /**
     * No create/update dates
     * @var array
     */
    protected $fillable = ['name', 'body'];

}
