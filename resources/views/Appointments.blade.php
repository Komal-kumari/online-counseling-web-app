@extends('layouts.app')

@section('content')

  <style media="screen">
    /* .card{
      background-color: white;
      color: darkslategray;
      box-shadow: 7px 5px 20px grey;
    }
    .col-md-3{
      margin-left: 0px;

    }

  .r{

    padding: 0.5rem 0rem;
    display: flex;
    justify-content: space-between;
  }


    h3{
      font-weight: bold;
      font-size: 25px;
    }
    h5{
      color: darkslategray;
      font-weight: bold;
        font-size: 18px;

    }
    .Ap  p{
      font-size: 18px;
      font-weight: bold;
    }
    .Ap{
      height: 280px;
    } */
  </style>

{{-- <div class="container">
  @foreach ($u as $us)




  <div class="row">
      <div class="col-md-8 col-sm-8">
  <div class="p-4 mt-3 mb-3 card Ap">

            <h3 >Appointment:</h3>
            <hr color="silver"  height:5px;>
            <section class ="r">
              <div class="item">
                <p>Therapist: </p>
                <p>Issue: </p>
                <p>Type of Appointment: </p>
              </div>

              <div class="item">
                <p>{{$us->therapists->name}}</p>
                  <p>{{$us->issue}}</p>
                <p>{{$us->medium}}</p>
              </div>
            </section>

          </div>
          <div class="col-md-1 col-sm-1">

          </div></div>

          <div class="col-md-3 col-sm-3">

            <div class="p-4 mt-3 mb-3 card Ap">

              <h3>Data and Time</h3>
              <hr color="silver"  height:5px;>
              <h5>{{$us->day}}</h5>

              <h3 style="margin-top: 20px;">Venue</h3>
              <hr color="silver"  height:5px;>
              <h5>{{$us->medium}}</h5>
          </div>

      </div>


  </div>
  <div class="text-center my-4" >
    <a href="" id = "btn" class = "btn btn-success">Cancel Appointment</a>
    <a href="{{ route('patient_Chat') }}" id = "btn" class = "btn btn-success">Chat with Therapist</a>

  </div>
  @endforeach

</div> --}}











<div class="container py-4">





<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Your Appointment with Therapist</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <div class="row">
        <div class="col-lg-8">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

        @foreach ($u as $us)
        <tbody>
          <tr>
     <th>Therapist Name:</th>
     <td>{{$us->therapists->name}}</td>

   </tr>
   <tr>
     <th>Your Issue:</th>
     <td>{{$us->issue}}</td>
   </tr>
   <tr>
     <th>Appointment Type:</th>
     <td>{{$us->medium}}</td>
   </tr>

        </tbody>

      </table>

    </div>


    <div class="col-lg-4">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">


    <tbody>
      <tr>
 <th>Day:</th>
 <td>{{$us->day}}</td>
</tr>
<tr>
 <th>Time Slot:</th>
 <td>{{$us->time}}</td>
</tr>
<tr>
 <th>Venue:</th>
 <td>Online</td>
</tr>

    </tbody>

  </table>

</div>


@endforeach


  </div>

  <div class="text-center" >
    {{-- <a href="#" id = "btn" class = "btn btn-danger mx-1">Cancel Appointment</a> --}}

    {!! Form::open(['action' => ['AppointmentsController@cancel_Appointment', $us->id], 'method' => 'POST', 'class' => 'float-left']) !!}
    {{Form::hidden('_method', 'DELETE')}}
    <button type="submit" class="btn btn-danger mx-1" > Cancel Appointment </button>
    {!! Form::close() !!}




  <a href="{{ route('patient_Chat') }}" id = "btn" class = "btn btn-success mx-1 float-right">Chat with Therapist</a>

  </div>

</div></div>  </div>

</div>
@endsection
