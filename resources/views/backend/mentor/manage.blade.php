@extends('backend.layout')
@section('title')
Add Mentor
@endsection
@section('css')
@endsection
@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mentor</li>
        </ol>
    </nav>
    <div class=
    <div class="row">
        
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="card-title">Mentor</h6>
                        </div>
                    </div>
                    <form class="forms-sample"  method="post" id="post-form">
                        @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="exampleInputname2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputname2" name="name"  required placeholder="Name" value="{{$mentor->name ?? old('name')}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="exampleInputname2" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="exampleInputname2" name="email"  required placeholder="Email" value="{{$mentor->email ?? old('email')}}">
                            </div>
                        </div>
                        @if (empty($mentor->id))
                        <div class="row mb-3">
                            <label for="exampleInputname2" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputname2" name="password"  required placeholder="Password" value="{{$mentor->password ?? old('password')}}">
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3">
                            <label for="exampleInputname2" class="col-sm-3 col-form-label">Student</label>
                            <div class="col-sm-9">
                                <select  class="form-control" id="exampleInputname2" name="student"  required>
                                    <option value="">-Select Students-</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                      <a href="{{route('mentor.index')}}" class="btn btn-secondary" >Cancel</a>
                      <a href="#" class="btn btn-primary btn-icon-text action" id="public">
                        <i class="btn-icon-prepend" data-feather="check-square"></i>
                        @if (!empty($mentor->id))
                            Update
                        @else
                            Add
                        @endif 
                    </a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
       $('a.action').click(function(e){
           e.preventDefault();           
            let url = "{{ $url ?? route('mentor.store')}}";
            let form = document.getElementById('post-form');
            let data = new FormData(form);
           //resuest Start
           $.ajax({
               type:'post',
               url:url,
               data:data,
               contentType: false,
               processData: false,
               dataType: "json",
               success:function(res){
                   console.log(res);
                    form.reset();
                    successToast(res.msg)
               },
               error:function(res){
                   let errors = Object.values(res.responseJSON.errors);
                   errors.map((er)=>{
                    errorToast(er)
                   })
               }
           });
           //resuest End
       }); 
    });
</script>
@endsection