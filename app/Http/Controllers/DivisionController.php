<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Traits\FormatsFrontendData;
use Illuminate\View\View;

class DivisionController extends Controller
{
    use FormatsFrontendData;

    public function show(Division $division): View
    {
        if (! $division->active) {
            abort(404);
        }

        $data = [
            'division' => [
                'id' => $division->id,
                'name' => $division->name,
                'description' => $division->description,
                'job_description' => is_array($division->job_description) ? $division->job_description : [],
                'is_dpp' => $division->is_dpp,
                'logo_url' => $this->formatImageUrl($division->logo),
                'image_url' => $this->formatImageUrl($division->image),
            ],
        ];

        return view('pages.division.show', $data);
    }
}
