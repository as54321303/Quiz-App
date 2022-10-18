@extends('parent.layout.layout')

@section('title','Parent-Dashboard')
    
@section('content')

<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->

    @if(session()->has('err_msg'))
    <div class="mb-3 alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('err_msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
     @php 
        session()->forget('err_msg')
     @endphp

    <div class="breadcrumbs-area">
        <h3>Parent Dashboard</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Parents</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Dashboard summery Start Here -->
    <div class="row">
        <div class="col-6-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-magenta">
                            <i class="flaticon-shopping-list text-magenta"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Notifications</div>
                            <div class="item-number"><span class="counter" data-num="12">12</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-yellow">
                            <i class="flaticon-mortarboard text-orange"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Result</div>
                            <div class="item-number"><span class="counter" data-num="16">16</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Dashboard summery End Here -->
    <!-- Dashboard Content Start Here -->
    <div class="row">
        <div class="col-5-xxxl col-12">
            <div class="card dashboard-card-twelve">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>My Kids</h3>
                        </div>
                        <a href="{{ route('parent.addKid', ['parentId' => session()->get('parentId')]) }}">
                            <button class="btn-primary btn btn-lg btn-outline" id="addkid">Add Kid</button>
                        </a>
                    </div>
                    <div class="kids-details-wrap">
                        <div class="row">
                            <div class="col-12-xxxl col-xl-6 col-12">
                                <div class="kids-details-box mb-5">
                                    <div class="item-img">
                                        <img src="{{url('assets/parent/img/figure/student.png')}}" alt="kids">
                                    </div>
                                    <div class="item-content table-responsive">
                                        <table class="table text-nowrap">
                                            <tbody>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td>
                                                        <a href="student-details.html">
                                                            Jessia Rose
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td>Female</td>
                                                </tr>
                                                <tr>
                                                    <td>Class:</td>
                                                    <td>2</td>
                                                </tr>
                                                <tr>
                                                    <td>Roll:</td>
                                                    <td>#2225</td>
                                                </tr>
                                                <tr>
                                                    <td>Section:</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Id:</td>
                                                    <td>#0021</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Date:</td>
                                                    <td>07.08.2017</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12-xxxl col-xl-6 col-12">
                                <div class="kids-details-box">
                                    <div class="item-img">
                                        <img src="{{url('assets/parent/img/figure/student1.png')}}" alt="kids">
                                    </div>
                                    <div class="item-content table-responsive">
                                        <table class="table text-nowrap">
                                            <tbody>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td>
                                                        <a href="student-details.html">
                                                            Jessia Rose
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td>Male</td>
                                                </tr>
                                                <tr>
                                                    <td>Class:</td>
                                                    <td>3</td>
                                                </tr>
                                                <tr>
                                                    <td>Roll:</td>
                                                    <td>#2205</td>
                                                </tr>
                                                <tr>
                                                    <td>Section:</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Id:</td>
                                                    <td>#0045</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Date:</td>
                                                    <td>07.08.2017</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('parent/assign-points')}}"><button class="btn btn-primary" style="font-size:20px;">Assign Points</button></a> <br> <br>
                    <h3 style="float-right">Total Points:50</h3>
                </div>
               
            </div>
        </div>
        <div class="col-xl-12 col-7-xxxl col-12">
            <div class="card dashboard-card-six">
                <div class="card-body">
                    <div class="heading-layout1 mg-b-17">
                        <div class="item-title">
                            <h3>Notifications</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="notice-box-wrap m-height-660">
                        <div class="notice-list">
                            <div class="post-date bg-skyblue">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag mene esom tus eleifend
                                    lectus
                                    sed maximus mi faucibusnting.</a></h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-yellow">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag printing.</a></h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-pink">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag Nulla rhoncus eleifensed
                                    mim
                                    us mi faucibus id. Mauris vestibulum non purus lobortismenearea</a></h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-blue">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag mene esom text of the
                                    printing.</a></h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-yellow">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag printing.</a></h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-blue">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag meneesom.</a></h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-pink">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag meneesom.</a></h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
       
     
    </div>
        <footer class="footer-wrap-layout1">
            <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a
                    href="#">PsdBosS</a></div>
        </footer>

    <!-- Dashboard Content End Here -->
</div>
    
@endsection