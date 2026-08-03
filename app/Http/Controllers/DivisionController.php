<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\View\View;

class DivisionController extends Controller
{
    public function show(Division $division): View
    {
        abort_unless($division->active, 404);

        return view('pages.division.show', [
            'division' => [
                'id' => $division->id,
                'name' => $division->name,
                'description' => $division->description,
                'job_description' => is_array($division->job_description) ? $division->job_description : [],
                'is_dpp' => (bool) $division->is_dpp,
                'logo_url' => public_image_url($division->logo),
                'image_url' => public_image_url($division->image),
            ],
        ]);
    }
}
