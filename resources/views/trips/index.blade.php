@extends('layouts.master')

@section('content')
    <h2>Katsana Trips Records</h2>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Start Datetime</th>
            <th>End Datetime</th>
            <th>Locations</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trips as $trip)

            <tr>
                <td>{{date('dS F, Y H:ia', strtotime(unserialize(serialize(json_decode($trip->start)->tracked_at))))}}</td>
                <td>{{date('dS F, Y H:ia', strtotime(unserialize(serialize(json_decode($trip->end)->tracked_at))))}}</td>
                <td>
                    @foreach($trip->position as $position)
                        <a target="_blank" href="https://www.latlong.net/c/?lat={{$position->latitude}}&long={{$position->longitude}}" class="list-group-item">Get Location</a>
                    @endforeach
                </td>
                <td>
                    <a href="{{url(action('KatsanaTestController@create', '?xid='.$trip->id))}}" class="btn btn-primary">Export CSV</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection