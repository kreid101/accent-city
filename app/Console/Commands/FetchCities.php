<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FetchCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch cities from hh API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiUrl = 'https://api.hh.ru/areas';
        $response = Http::withOptions(['verify' => false])->get($apiUrl);
        if ($response->successful()) {
            $countries = $response->json();
            $russ = [];
            $cities = [];
            foreach ($countries as $country) {
                if ($country['name'] == 'Россия') {
                    $russ = $country['areas'];
                }
            }
            for ($area = 0; $area < count($russ); $area++) {
                if (!empty($russ[$area]['areas'])) {
                    for ($subarea = 0; $subarea < count($russ[$area]['areas']); $subarea++) {
                        $cities[] = $russ[$area]['areas'][$subarea]['name'];
                    }
                } else {
                    $cities[] = $russ[$area]['name'];
                }
            }
            foreach (array_chunk($cities, 1000) as $chunk) {
                foreach ($chunk as $array) {
                    $city = new City();
                    $city->name = $array;
                    $city->slug = Str::slug(Str::ascii($array));
                    $city->save();
                }
            }
            $this->info('cities are added successfully');
        } else {
            $this->error('failed to fetch');
        }
    }

}
