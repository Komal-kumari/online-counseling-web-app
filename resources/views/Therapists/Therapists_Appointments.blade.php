@extends('layouts.app')
@section('content')



<div class="container py-4">



  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Your list of Appointments</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Appointment Type</th>
              <th>Issue</th>
              <th>Day</th>
              <th>Time</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Patient</th>
              <th>Appointment Type</th>
              <th>Issue</th>
              <th>Day</th>
              <th>Time</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
@foreach ($th as $t)
              <tr>
                  <td>{{$t->users->name}}</td>
                  <td>{{$t->medium}}</td>
                  <td>{{$t->issue}}</td>
                  <td>{{$t->day}}</td>
                  <td>{{$t->time}}</td>
                  <td>{!! Form::open(['action' => ['TherapistController@cancel_Appointment', $t->id], 'method' => 'POST', 'class' => 'float-left']) !!}
                  {{Form::hidden('_method', 'DELETE')}}
                  <button type="submit" class="fa-input" > <i class = "fa fa-trash"></i> </button>
                  {!! Form::close() !!}</td>



              </tr>
@endforeach



          </tbody>

        </table>
        {{$th->links()}}
        <div class="text-center" >
          <a href="{{ route('therapist_Chat') }}" id = "btn" class = "btn btn-success">Chat Window</a>

        </div>
      </div>
    </div>
  </div>


</div>

@endsection
