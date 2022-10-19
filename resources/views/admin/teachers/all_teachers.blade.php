@extends('admin.layout.layout')

@section('title','Admin-All Teachers')
    
@section('content')

<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Teacher</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>All Teachers</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Teachers Data</h3>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th> 
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input checkAll">
                                    <label class="form-check-label">ID</label>
                                </div>
                            </th>
                            {{-- <th>Photo</th> --}}
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Date of Birth</th>
                            {{-- <th>Section</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>E-mail</th>
                            <th>Action/th>
                            <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $key=>$item)
                            
                       

                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                    <label class="form-check-label">{{$key+1}}</label>
                                </div>
                            </td>
                            {{-- <td class="text-center"><img src="{{url('assets/admin/img/figure/student2.png')}}" alt="student"></td> --}}
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->contact}}</td>
                            <td>{{$item->dob}}</td>
                            {{-- <td>Male</td>
                            <td>2</td>
                            <td>English</td>
                            <td>A</td>
                            <td>TA-107 Newyork</td>
                            <td>+ 123 9988568</td>
                            <td>kazifahim93@gmail.com</td>
                            <td><a href="teacher-details.html"><button class="btn btn-primary btn-lg">Show</button></a></td>
                             <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
    <footer class="footer-wrap-layout1">
        <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
    </footer>
</div>
    
@endsection