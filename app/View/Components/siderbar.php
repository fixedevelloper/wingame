<?php

namespace App\View\Components;

use App\Models\Country;
use App\Models\League;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Request;
use Illuminate\View\Component;

class siderbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {

        $leagues = League::query()->whereIn('league_id',[2,3,39,140,135,78,61])->get();
        $countries = Country::all();

        return view('components.siderbar',[
            'countries' => $countries,
            'leagues' => $leagues,
            'country_by'=>null
        ]);
    }
}
