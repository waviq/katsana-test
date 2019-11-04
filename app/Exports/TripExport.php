<?php

namespace App\Exports;

use App\Position;
use App\Trip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TripExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public $dataAll;

    public function collection()
    {
        $trip = Trip::find(request()->get('xid'));

        foreach ($trip->position as $position)  {
            $data = [
                'ID' => $position->id,
                'Datetime' => date('Y-m-d h:i:s', strtotime($position->tracked_at)),
                'Latitude' => $position->latitude,
                'Longitude' => $position->longitude,
                'Speed (kmh)' => $position->speed * 1.852,
                'Distance (m)' => $position->distance,
                'Voltage' => $position->voltage,
            ];

            $this->dataAll[] = $data;
        }

        return collect($this->dataAll);

    }

    public function headings(): array
    {
        return [
            'ID',
            'Datetime',
            'Latitude',
            'Longitude',
            'Speed (kmh)',
            'Distance (m)',
            'Voltage'
        ];
    }

}
