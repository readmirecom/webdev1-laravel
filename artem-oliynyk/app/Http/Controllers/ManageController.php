<?php

namespace App\Http\Controllers;

use App\TestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;

class ManageController extends Controller {
    // add record
    public function add(Request $request) {
        // default fields
        $name = '';
        $body = '';

        $notifications = '';


        if ($request->isMethod("post")) {
            $name = $request->get('name');
            $body = $request->get('body');

            $model = new TestModel();
            $model->fill($request->all());


            try {
                $this->validate($request, [
                    'name' => 'required|filled',
                    'body' => 'required|filled',
                ]);

                $saved = $model->save();

                if ($saved) {
                    return redirect("/");
                }
            } // if validation failed
            catch (ValidationException $e) {
                $messages = $e->validator->getMessageBag()->toArray();

                foreach ($messages as $field => $mgs) {
                    $notificationsArr[] = "Field '{$field}' error: " . implode($mgs, ", ");
                }

                $notifications = implode("\n", $notificationsArr);
            }
        }

        return view("add", array(
                'name' => $name,
                'body' => $body,
                'notifications' => $notifications
            )
        );
    }

    // edit record
    public function edit(Request $request, $id) {

        $notifications = '';

        $model = TestModel::find($id);

        if ($model instanceof TestModel) {

            if ($request->isMethod("post")) {

                try {
                    $this->validate($request, [
                        'name' => 'required|filled',
                        'body' => 'required|filled',
                    ]);

                    $model->fill($request->all());

                    $saved = $model->save();

                    if ($saved) {
                        return redirect("/");
                    }
                } // if validation failed
                catch (ValidationException $e) {
                    $messages = $e->validator->getMessageBag()->toArray();

                    foreach ($messages as $field => $mgs) {
                        $notificationsArr[] = "Field '{$field}' error: " . implode($mgs, ", ");
                    }

                    $notifications = implode("\n", $notificationsArr);
                }
            }

            return view("edit", array(
                    'model'         => $model,
                    'notifications' => $notifications
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
