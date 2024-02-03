@extends('backend.backend')
@section('title') Looto resultats @endsection
@section('content')
    <h3 class="account__head mb__30">
        Liste des grilles de matchs
    </h3>

    <div class="row">
        <div class="card card_dark mt-5">
            <div class="card-body">
                <form id="form_grille">
                    <div class="col-md-6">
                        <div class="">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control " id="grille_date">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="card card_dark">
                <div class="card-body">
                    <table class="table text-white" id="table_conbinaison">
                        <thead>
                        <tr>
                            <th>Date End</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lis_fixtures as $fixture)
                          <tr>
                              <td>{{$fixture->end_time}}</td>
                              <td>{{$fixture->title}}</td>
                              <td><a class="btn btn-outline-primary" href="{{route('admin.result',['id'=>$fixture->id])}}">Detail</a></td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

