@extends('backend.backend')
@section('title') Conbinaison @endsection
@section('content')
    <h3 class="account__head mb__30">
        Configuration des grilles de matchs
    </h3>

    <div class="row">
        <div class="col-md-8 mt-5">
            <div class="card card_dark">
                <div class="card-body">
                   <table class="table text-white" id="table_conbinaison">
                       <thead>
                       <tr>
                           <th>Date</th>
                           <th>Team Home</th>
                           <th>Team Away</th>
                           <th>Actions</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($fixtures as $fixture)
                           @php
                           $team_home=\App\Helpers\Helpers::getTeamByID($fixture->team_home_id);
                           $team_away=\App\Helpers\Helpers::getTeamByID($fixture->team_away_id);
                           @endphp
                           <tr>
                               <td><span hidden>{{$fixture->fixture_id}}</span>{{\Illuminate\Support\Carbon::parse($fixture->date)}}{{--{{date("Y-m-d h:i T EST",$fixture->timestamp)}}--}}</td>
                               <td><img height="20"
                                        src=" {{$team_home['logo']}}"> {{$team_home['name']}}</td>
                               <td><img height="20"
                                        src=" {{$team_away['logo']}}"> {{$team_away['name']}}</td>
                               <td>
                                   <input type="checkbox" value="{{$fixture->fixture_id}}">
                               </td>
                           </tr>
                       @endforeach
                       </tbody>
                   </table>

                </div>
            </div>
        </div>
        <div class="col-md-4 mt-5">
            <div class="">
                <label class="text-white">Title</label>
                <input class="form-control" id="title">
            </div>
            <div class="">
                <label class="text-white">Jour de fin</label>
                <input type="date" class="form-control" id="end_date">
            </div>
            <div class="">
                <label class="text-white">Heure de fin</label>
                <input type="time" class="form-control" id="end_time">
            </div>
            <div class="d-grid gap-2 mt-3">
                <a class="btn btn-outline-success btn-lg btn-block" id="save_conbinaison"> Valider</a>
            </div>
        </div>
    </div>
@endsection
@push("script")
<script>

    $("#save_conbinaison").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        jsonObj = [];
        $("#table_conbinaison>tbody input[type=checkbox]:checked").each(function () {
            var row = $(this).closest('tr')[0];
            var id = row.cells[0].children[0].innerText;
            item = {};
            item['id'] = id;
           jsonObj.push(item)
        });
        console.log(JSON.stringify({data: jsonObj}))
        $.ajax({
            url: "{{ route('postConbinaison') }}",
            type: "POST",
            dataType: "JSON",
            data: JSON.stringify({
                ob: jsonObj, title: $('#title').val(),
                end_time: $('#end_time').val(), end_date: $('#end_date').val()}),
                success: function (data) {
                    toastr.success('Operation executed successfully', 'Success')
                },
                error: function (err) {
                    toastr.error('An error has occurred' + JSON.stringify((err)),'Error')

                }
            });

    })
</script>
@endpush
