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
          {{session('sukses')}}
        </div>
      @endif
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Upload File ZIP</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
      <div class="container">
        
        <div class="col-lg-8 mx-auto my-5"> 

          @if(count($errors) > 0)
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }} <br/>
            @endforeach
          </div>
          @endif

          <form action="{{route('uploadfile')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
              <b>File ZIP</b><br/>
              <input type="file" name="zip">
            </div>
            <div class="form-group">
              <b>File pdf</b><br/>
              <input type="file" name="pdf">
            </div>

            <input type="submit" value="Upload" class="btn btn-primary">
          </form>
        </div>
      </div>
   
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

