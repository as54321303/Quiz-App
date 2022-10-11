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
                            <th>Student Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td>1</td>
                            <td>Mike</td>
                           
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Amanda</td>
                           
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Miller</td>
                           
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Joseph</td>
                           
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Archer</td>
                           
                        </tr>
                       
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
