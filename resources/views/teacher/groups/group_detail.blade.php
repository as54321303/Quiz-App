@extends('teacher.layout.layout')

@section('title','Teacher-Assign Points')
    
@section('content')

<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Group Detail</h3>
        <ul>
            <li>
                <a href="{{url('teacher/dashboard')}}">Home</a>
            </li>
            <li>Group Detail</li>
        </ul>
    </div>
   
    <!-- Breadcubs Area End Here -->
    <!-- Student Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <h3>Group Detail</h3>
                <div class="item-title">                 
                </div>
            </div>

            <div class="table-responsive">
                <table class="table display text-nowrap">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>User Id</th>
                            <th>Student Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $key=>$item)
                            
                      
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->userId}}</td>
                            <td>{{$item->name}}</td>
                           
                        </tr>
                        @endforeach
                       
                    </tbody>
                
                </table>
            </div>

        </div>
    </div>
    <!-- Student Table Area End Here -->
    <footer class="footer-wrap-layout1">
        <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a
                href="#">PsdBosS</a></div>
    </footer>
</div>


@endsection
