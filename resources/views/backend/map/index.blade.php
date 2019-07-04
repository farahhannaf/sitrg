<!-- Dashboard -->
@extends('layouts.backend.main')

@section('title', 'SITRG')

@section('content')
<!-- Content Wrapper. Contains page content -->
 <!-- upload zip -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Peta</h1>
        </div><!-- /.col -->
      
  </div>
  <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="jumbotron">
          <div class="row">
            <iframe src="http://localhost/mapbender/application/sitrg" style="height:500px;width:100%;"></iframe>
          </div>          
        </div>
        <h3>List data peta</h3>
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama data</th>
                <th>Tanggal</th>
                <th>Action</th>
              </tr>
            </thead>

          </table>
        </div>
      </div>
    </section>
  <!-- /.content -->
</div>

  <!-- /.content-wrapper -->
@endsection


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('css/tabel.css')}}">
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap.no-icons.min.css" rel="stylesheet">
<script src="{{ asset('js/tabel.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>