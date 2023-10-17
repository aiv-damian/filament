<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('_filament/tables/popover', function (Request $request) {
    $model = $request->get('modelType')::find($request->get('modelId'));

    return view($request->get('view'), [
        ... $request->get('viewData'),
        'model' => $model,
    ]);
})->name('filament.tables.popover');
