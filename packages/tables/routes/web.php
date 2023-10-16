<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('_filament/tables/popover', function (Request $request) {
    $model = $request->get('modelType')::find($request->get('modelId'));

    return view($request->get('view'), [
        'model' => $model,
    ]);
})->name('filament.tables.popover');
