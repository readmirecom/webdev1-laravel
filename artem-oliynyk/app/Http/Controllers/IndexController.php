<?php

namespace App\Http\Controllers;

use App\TestModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function homepage() {

        $models = TestModel::all();

        return view("index", array(
            'models' => $models
        ));
    }
}
