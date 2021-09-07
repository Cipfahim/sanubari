<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GetCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download all countries form api with flag images';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $countries = Http::get('https://restcountries.eu/rest/v2/all?fields=name;callingCodes;flag');

        // Prepare flags directory
        Storage::disk('public')->deleteDirectory('flags');
        Storage::disk('public')->makeDirectory('flags');

        foreach ($countries->json() as $country) {
            $this->info('Downloading country:' . $country['name']);

            $countryName = $country['name'];
            if (!Country::where('slug', Str::slug($countryName))->exists()) {
                $flagName = substr($country['flag'], strrpos($country['flag'], '/') + 1);
                ob_start();
                echo Http::get($country['flag']);
                $flagContent = ob_get_clean();

                file_put_contents(storage_path('app/public/flags/') . $flagName, $flagContent);

                Country::create([
                    'name' => $country['name'],
                    'slug' => Str::slug($country['name']),
                    'flag_path' => "flags/" . $flagName,
                    'country_code' => $country['callingCodes'][0]
                ]);
            }
        }
        $this->info('All Done');
        return 1;
    }
}
