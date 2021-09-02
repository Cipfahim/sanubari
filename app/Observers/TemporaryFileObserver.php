<?php

namespace App\Observers;

use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class TemporaryFileObserver
{
    /**
     * Handle the TemporaryFile "created" event.
     *
     * @param \App\Models\TemporaryFile $temporaryFile
     * @return void
     */
    public function created(TemporaryFile $temporaryFile)
    {
        //
    }

    /**
     * Handle the TemporaryFile "updated" event.
     *
     * @param \App\Models\TemporaryFile $temporaryFile
     * @return void
     */
    public function updated(TemporaryFile $temporaryFile)
    {
        //
    }

    /**
     * Handle the TemporaryFile "deleted" event.
     *
     * @param \App\Models\TemporaryFile $temporaryFile
     * @return void
     */
    public function deleted(TemporaryFile $temporaryFile)
    {
        Storage::deleteDirectory('temp/' . $temporaryFile->folder);
    }

    /**
     * Handle the TemporaryFile "restored" event.
     *
     * @param \App\Models\TemporaryFile $temporaryFile
     * @return void
     */
    public function restored(TemporaryFile $temporaryFile)
    {
        //
    }

    /**
     * Handle the TemporaryFile "force deleted" event.
     *
     * @param \App\Models\TemporaryFile $temporaryFile
     * @return void
     */
    public function forceDeleted(TemporaryFile $temporaryFile)
    {
        //
    }
}
