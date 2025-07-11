<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    /**
     * @param Picture $picture
     * @return RedirectResponse
     */
    public function destroy(Picture $picture): RedirectResponse
    {
        Storage::disk('public')->delete($picture->filename);
        $picture->delete();
        return redirect()->back()->with('success', 'La photo a été supprimée');
    }
}
