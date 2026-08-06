<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Support\PublicCache\PublicCacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class DivisionController extends Controller
{
    public function show(Division $division): View
    {
        $data = Cache::remember(PublicCacheKey::divisionShow($division->id), now()->addHour(), function () use ($division): array {
            abort_unless($division->active, 404);

            return [
                'division' => [
                    'id' => $division->id,
                    'name' => $division->name,
                    'description' => $division->description,
                    'job_description' => is_array($division->job_description) ? $division->job_description : [],
                    'is_dpp' => (bool) $division->is_dpp,
                    'logo_url' => public_image_url($division->logo),
                    'image_url' => public_image_url($division->image),
                ],
            ];
        });

        return view('pages.division.show', $data);
    }
}
