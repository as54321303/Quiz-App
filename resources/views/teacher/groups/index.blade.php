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
                <a href="{{ url('teacher/dashboard') }}">Home</a>
            </li>
            <li>Groups</li>
        </ul>
    </div>
   
    <!-- Breadcubs Area End Here -->
    <!-- Student Table Area Start Here -->
    <div class="card height-auto">

        @if(session('err_msg'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('err_msg')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {{ session()->forget('err_msg') }}
        @endif

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
                            <th>S.No</th>
                            <th>Group Name</th>
                            <th>Class</th>
                            <th>Total Members</th>
                            <th>Points</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i=1; ?>
                        @foreach($data as $rows)
                        <tr>
                            <td>
                                {{ $i }}
                            </td>
                            <td>
                                {{ $rows->groupName }}
                            </td>
                            <td>
                                {{ $rows->class }}
                            </td>
                            <td>
                                {{ $rows->totalMember }}
                            </td>
                            <td>
                                <a href="{{route('teacher.show.point',$rows->id)}}"><button class="btn btn-primary">Show Points</button></a>
                            </td>
                            <td>
                              <a href="{{route('teacher.group.show',$rows->id)}}"><button class="btn btn-primary">Show</button></a>
                              <a href="{{route('teacher.assign.points',$rows->id)}}"><button class="btn btn-primary">Assign</button></a>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>Group Name</th>
                            <th>Class</th>
                            <th>Total Members</th>
                            <th>Total Points</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                   
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

            <form action="{{ route('teacher.createGroup') }}" method="post">
              @csrf
                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control form-control-sm mb-3" id="group_name" name="group_name" placeholder="Enter group name..." required>
                </div>
                <div class="form-group">
                  <label for="select_class">Select Class</label>

                  <select name="class" class="form-control mb-3" id="select_class" onchange="return fetchStudentsList()" required>
                        <option value="">Select Class</option>
                        @foreach($class as $classes)
                            <option value="{{ $classes->class }}">{{ $classes->class }}</option>
                        @endforeach
                  </select>
                </div>



              <label for="select_students">Select Students</label>
                <select name="students[]" class="form-control form-control-sm select" id="select_students" multiple="multiple" style="width: 100%" required>
                  
                </select>

      
            <div class="form-group">
              <button type="submit" class="btn btn-primary mt-3">Create</button>
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