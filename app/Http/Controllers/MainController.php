<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainController extends Controller
{
    function main(Request $request)
    {
        $savedCity = $request->cookie('city');
        $cities = City::all()->sortBy('name');
        $slug = $request->slug;
        if (!isset($slug) && isset($savedCity)) {
            return response(redirect('/'.$request->cookie('city')));
        }
        if (isset($slug)) {
            $slugCity = City::where('slug', '=', $slug)->first();
            if (isset($slugCity)) {
                return response(view('Pages.Main', ['cities' => $cities, 'selected' => $slugCity]))->cookie('city',
                    $request->slug);
            } else {
                return abort(404);
            }
        }

        return view('Pages.Main', ['cities' => $cities]);
    }

    function about(Request $request)
    {
        return redirect($request->cookie('city').'/'.$request->segment(1));
    }

    function news(Request $request)
    {
        return redirect($request->cookie('city').'/'.$request->segment(1));
    }

    function section(Request $request)
    {
        $city = City::where('slug', '=', $request->city)->first();
        return view('Pages/'.$request->section, ['selected' => $city]);
    }

    function removeCity(Request $request)
    {
        try {
            $city = City::where('name', '=', $request->input('city'))->first();
            if (isset($city)) {
                $city->delete();
                return response('city is removed', 200);
            } else {
                throw new \Exception('city is not found');
            }
        } catch (\Exception $error) {
            return response($error->getMessage(), 500);
        }
    }

    function addCity(Request $request)
    {
        $city = new City();
        $city->name = $request->input('city');
        $city->slug = Str::slug(Str::ascii($request->input('city')));
        $city->save();
        return response('city is added', 200);
    }
}
