@extends('student.layout.layout')

@section('title','Student::Assignments')

@section('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
@endsection
    
@section('content')

<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Assignments</h3>
        <ul>
            <li>
                <a href="{{url('teacher/dashboard')}}">Home</a>
            </li>
            <li>Assignments</li>
        </ul>
    </div>


@if (\Session::has('status'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {!! \Session::get('status') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      @endif
    <!-- Breadcubs Area End Here -->
    <!-- Student Table Area Start Here -->
    <div class="card text-center">
        <div class="card-header bg-primary text-white">
          ASSIGNMENTS
        </div>
        <div class="card-body">
           
            <div class="row mt-5">
                @foreach ($assignments as $assignment)
                    
                
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-header">
                        <h5 class="card-title float-left">Subject: {{$assignment->subject}}</h5>
                        <h5 class="card-title float-right">Submit To: ({{$assignment->name}})</h5>
                    </div>
                    <div class="card-body">
                     
                      <p class="card-text">{{$assignment->assignment}}</p>
                      {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                  </div>
                </div>

                @endforeach

              </div>

        </div>

    </div>
    {{-- </div> --}}
    <!-- Student Table Area End Here -->
    <footer class="footer-wrap-layout1">
        <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a
                href="#">PsdBosS</a></div>
    </footer>
</div>




@endsection

