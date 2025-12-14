<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SoftDeleteObserver
{
    /**
     * Handle the Model "deleting" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function deleting(Model $model)
    {
        // Only set deleted_by if the model uses soft deletes and has the column
        if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
            $model->deleted_by = Auth::id();
        }
    }
}
