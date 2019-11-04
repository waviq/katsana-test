<?php

namespace App\Console\Commands;

use App\Position;
use App\Trip;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KatsanaImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'katsana:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from json file';

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
     * @return mixed
     */
    public function handle()
    {
        $filename = 'vehicle-trip-20190223.json';
        $json = Storage::disk('public')->get($filename);

        $trips = json_decode($json, true)['trips'];

        DB::transaction(function () use ($trips) {
            foreach ($trips as $trip) {
                $dataTrip = [
                    'distance'          =>  $trip['distance'],
                    'duration'          =>  $trip['duration'],
                    'max_speed'         =>  $trip['max_speed'],
                    'average_speed'     =>  $trip['average_speed'],
                    'idle_duration'     =>  $trip['idle_duration'],
                    'score'             =>  $trip['score'],
                    'start'             =>  json_encode($trip['start'], true),
                    'end'               =>  json_encode($trip['end'], true)
                ];

                $tripData = Trip::create($dataTrip);


                foreach ($trip['histories'] as $position) {
                    $dataPosition = [
                        'trip_id'           =>  $tripData->id,
                        'latitude'          =>  $position['latitude'],
                        'longitude'         =>  $position['longitude'],
                        'tracked_at'        =>  $position['tracked_at'],
                        'speed'             =>  $position['speed'],
                        'voltage'           =>  $position['voltage'],
                        'distance'          =>  $position['distance'],
                    ];

                    Position::create($dataPosition);
                }


            }
        }, 3);

        $this->info('import success...');
    }
}
