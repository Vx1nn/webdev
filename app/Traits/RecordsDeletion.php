<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RecordsDeletion
{
    protected static function bootRecordsDeletion()
    {
        static::deleting(function ($model) {
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
                $model->deleted_by = Auth::id();
                $model->saveQuietly();
            }
        });
    }
}
