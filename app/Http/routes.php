<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use App\Store;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });

    /**
     * Show Products List
     */
    Route::get('/productslist', function () {
        return view('products', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });

    /**
     * Show Stores List
     */
    Route::get('/stores', function () {
        return view('stores', [
            'stores' => Store::orderBy('created_at', 'asc')->get()
        ]);
    });

    /**
     * Add New Store
     */
    Route::post('/store', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'url' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $store = new Store;
        $store->name = $request->name;
        $store->url = $request->url;
        $store->save();

        return redirect('/stores');
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    });

    /**
     * Delete Store
     */
    Route::delete('/store/{id}', function ($id) {
        Store::findOrFail($id)->delete();

        return redirect('/stores');
    });
});
