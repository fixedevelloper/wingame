@extends('over.base_over')
@section('title')  @endsection
@push("scripts")

@endpush
@section('content')

    <div class="row container">
       <div class="col-md-5 text-end">
           <div class="text-center">
               <img width="80"  src="{!! $fixture->team_home_logo !!}"
               >
               <h5 class="mt-1">  {!! $fixture->team_home_name !!}</h5>
           </div>
       </div>
        <div class="col-md-2 text-center">
            <p class="h5 text-danger mb-3">{!! \Carbon\Carbon::parse($fixture->date)->format("D , d,M,Y") !!}</p>
          <p class="h4">
              <span class="badge badge-circle bg-danger"><span class="h5 text-white">{!! $fixture->score_ft_home !!}</span></span> - <span class="badge badge-circle bg-danger"><span class="h5 text-white">{!! $fixture->score_ft_away !!}</span></span>
          </p>
        </div>
        <div class="col-md-5">
            <div class="text-center">
            <img width="80" src="{!! $fixture->team_away_logo !!}"
            >
           <h5 class="mt-1"> {!! $fixture->team_away_name !!}</h5>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 mt-5">
            <table class="table">
                <thead>
                <tr>
                    <th>Team home</th>
                    <th>score</th>
                    <th>Team away</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fixtures as $fixture)
                <tr>
                    <td>{{ $fixture->team_home_name }}</td>
                    <td class="text-center">
                       <span class="badge bg-success"> {!! \Carbon\Carbon::parse($fixture->date)->format("D , d,M,Y") !!}</span><br>
                      <span class="center">{!! $fixture->score_ft_home !!}-{!! $fixture->score_ft_away !!}</span>  </td>
                    <td>{{ $fixture->team_away_name }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

