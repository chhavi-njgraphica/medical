@extends('backend.layout')
@section('title')
Mentors
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
@endsection
@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mentors</li>
        </ol>
    </nav>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-10">
                          <h6 class="card-title">Mentors</h6>
                      </div>
                      
                      <div class="col-md-2 text-end">
                        <a href="{{route('mentor.create')}}" class="btn btn-primary btn-sm" >
                            Add Mentor
                        </a>
                      </div>
                  </div>
                  <br>
                  
                    <div class="table-responsive">
                      <table id="dataTableExample" class="table">
                        <thead>
                          <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($mentors as $mentor) 
                                <tr> 
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$mentor->user->name}}</td>
                                    <td>{{$mentor->user->email}}</td>
                                    <td>
                                      <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="checkChecked" {{($mentor->status=='active') ? 'checked':''}} onchange="statusChange({{$mentor->id}},this)" >
                                    
                                      </div>
                                    </td>
                                    <td>
                                    <a href="{{route('mentor.edit',$mentor->id)}}" class="btn btn btn-inverse-primary btn-sm"><i class="fas fa-edit"></i></a> 
                                    <a href="{{route('mentor.destroy',$mentor->id)}}"class="btn btn btn-inverse-danger btn-sm"><i class="fas fa-trash"></i>
                                    </a>
                                    </td>
                                </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
              </div>
          </div>
      </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{asset('assets/backend/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/backend/js/data-table.js')}}"></script>
<script>
  function statusChange(id,elem){
      let sts;
      if(elem.checked){
         sts = 'active';
      }else{
         sts = "inactive";
      }
       
        let url = "{{route('mentor.status')}}"; 
        $.ajax({
          type: "get",
          url,
          data: {
            id,sts
          },
          beforeSend: function() {   
          },
          success:function(response){            
            successToast(response.message);                         
          },
          error:function(response){
            errorToast(response.responseJSON.message)
          }                                                
        });
      }
</script>
@if (session('message-success'))
    <script>
        successToast('Data Removed Successfully');
    </script>
    @endif
    @if (session('message-error'))
    <script>
        errorToast('We have an Error');
    </script>
    @endif
@endsection