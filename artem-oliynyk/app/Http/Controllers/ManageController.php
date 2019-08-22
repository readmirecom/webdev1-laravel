<?php

namespace App\Http\Controllers;

use App\TestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ManageController extends Controller {
    // add record
    public function add(Request $request) {
        // default fields
        $name = '';
        $body = '';

        if ($request->isMethod("post")) {
            $name = $request->get('name');
            $body = $request->get('body');

            $model = new TestModel();
            $model->fill($request->all());

            $saved = $model->save();

            if ($saved) {
                return redirect("/");
            }
        }

        return view("add", array(
                'name' => $name,
                'body' => $body,
            )
        );
    }

    // edit record
    public function edit(Request $request, $id) {

        $model = TestModel::find($id);

        if ($model instanceof TestModel) {

            if ($request->isMethod("post")) {

                $model->fill($request->all());

                $saved = $model->save();

                if ($saved) {
                    return redirect("/");
                }
            }

            return view("edit", array(
                    'model' => $model
                )
            );
        }

        return redirect("/");
    }
    // edit record
    public function delete(Request $request, $id) {

        $model = TestModel::find($id);

        if ($model instanceof TestModel) {

            try {
                $saved = $model->delete();

                if ($saved) {
                    return redirect("/");
                }
            } catch (\Exception $e) {
            }
        }

        return redirect("/");
    }
}
