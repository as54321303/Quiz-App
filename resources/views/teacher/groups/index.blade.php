@extends('teacher.layout.layout')

@section('title','Teacher-Groups')

@section('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
@endsection

@section('content')


<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Groups</h3>
        <ul>
            <li>
                <a href="{{url('teacher/dashboard')}}">Home</a>
            </li>
            <li>Groups</li>
        </ul>
    </div>
   
    <!-- Breadcubs Area End Here -->
    <!-- Student Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <h3>All Groups</h3>
                <div class="item-title">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createGroup">
                        Create Group
                      </button>                  
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                {{-- <div class="form-check"> --}}
                                    {{-- <input type="checkbox" class="form-check-input checkAll"> --}}
                                    <label class="form-check-label">Sr.No.</label>
                                {{-- </div> --}}
                            </th>
                            {{-- <th>Photo</th> --}}
                            <th>Group Name</th>
                            {{-- <th>Gender</th> --}}
                            <th>Class</th>
                           {{--  <th>Parents</th>
                            <th>Address</th>
                            <th>Date Of Birth</th>
                            <th>Phone</th> --}}
                            {{-- <th>E-mail</th> --}}
                            <th>Action</th>
                            {{-- <th>Status</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{-- <div class="form-check">
                                    <input type="checkbox" class="form-check-input"> --}}
                                    <label class="form-check-label">1</label>
                                {{-- </div> --}}
                            </td>
                            {{-- <td class="text-center"><img src="{{url('assets/admin/img/figure/student2.png')}}" alt="student"></td> --}}
                            <td>Toppers Group</td>
                            <td>10</td>
                            {{-- <td>2</td>
                            <td>A</td>
                            <td>Jack Sparrow </td>
                            <td>TA-107 Newyork</td>
                            <td>02/05/2001</td>
                            <td>+ 123 9988568</td>
                            <td>kazifahim93@gmail.com</td> --}}
                            <td><a href="student-details.html"><button class="btn btn-primary btn-lg">Show</button></a></td>
                            {{-- <td>
                                <div class="form-check form-switch form-check">
                                    <input class="form-check-input form-control" type="checkbox" id="">
                                    <label class="form-check-label" for="">Active</label>
                                </div>
                            </td> --}}
                            {{-- <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </td> --}}
                            
                        </tr>
                        <tr>
                            <td>
                                {{-- <div class="form-check">
                                    <input type="checkbox" class="form-check-input"> --}}
                                    <label class="form-check-label">2</label>
                                {{-- </div> --}}
                            </td>
                            {{-- <td class="text-center"><img src="{{url('assets/admin/img/figure/student2.png')}}" alt="student"></td> --}}
                            <td>Backbenchers Group</td>
                            <td>10</td>
                            {{-- <td>2</td> --}}
                            {{-- <td>A</td>
                            <td>Jack Sparrow </td>
                            <td>TA-107 Newyork</td>
                            <td>02/05/2001</td>
                            <td>+ 123 9988568</td>
                            <td>kazifahim93@gmail.com</td> --}}
                            <td><a href="student-details.html"><button class="btn btn-primary btn-lg">Show</button></a></td>
                            {{-- <td>
                                <div class="form-check form-switch form-check">
                                    <input class="form-check-input form-control" type="checkbox" id="">
                                    <label class="form-check-label" for="">Active</label>
                                </div>
                            </td> --}}
                            {{-- <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </td> --}}
                            
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
    


  
  <!-- Modal -->
  <div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Group</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control form-control-sm mb-3" id="group_name" placeholder="Enter group name...">
                </div>
            <div class="form-group">
               <label for="select_class">Select Class</label>
            <select class="form-control mb-3" id="select_class">
                <option>1st</option>
                <option>2nd</option>
                <option>3rd</option>
                <option>4th</option>
                <option>5th</option>
                <option>6th</option>
                <option>7th</option>
                <option>8th</option>
                <option>9th</option>
                <option>10th</option>
                <option>11th</option>
                <option>12th</option>
              </select>
            </div>



              <label for="select_students">Select Students</label>
            <select class="form-control form-control-sm select" id="select_students" multiple="multiple" style="width: 100%">
                <option>Ayush</option>
                <option>Asutosh</option>
                <option>Amanda</option>
                <option>Harry</option>
                <option>George</option>
                <option>Brack</option>
                <option>Donny</option>
                <option>Mike</option>
                <option>Hemsowrth</option>
                <option>Robert</option>
                <option>Scarlet</option>
                <option>Jennifer</option>
              </select>

      
            <div class="form-group">
              <button type="button" class="btn btn-primary mt-3">Create</button>
            </div>
            </form>
        </div>

      </div>
    </div>
  </div>
    
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    
      $(document).ready(function(){

        $(".select").select2({

        });

      });
</script>
    
@endsection