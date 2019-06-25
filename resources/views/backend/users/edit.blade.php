<!-- Dashboard -->
@extends('layouts.backend.main')

@section('title', 'SITRG')

@section('content')
<!-- Content Wrapper. Contains page content -->
 <!-- upload zip -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      @if(session('sukses'))
        <div class="alert alert-success" role="alert" >
          [{session('sukses')}]
        </div>
      @endif
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit User</h1>
        </div><!-- /.col -->
        
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <form action="/user/update/{{$data->user_id}}" method="POST">
          {{csrf_field()}}
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="name" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Enter name" value="{{$data->name}}"  required>
            </div>
            <div class="form-group">
              <label for="email">email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{$data->email}}" required>
            </div>
            <div class="form-group">
              <label for="password">password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{$data->password}}" required>
            </div>
            <div class="for value="{{$data->email}}"m-group">
              <label for="kode_wil">kode wilayah</label>
              <input type="number" class="form-control" name="kode_wil" id="kode_wil" placeholder="kode_wil" value="{{$data->kode_wil}}" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning" value="submit">Update</button>
            </div>
            
          </form>    
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>