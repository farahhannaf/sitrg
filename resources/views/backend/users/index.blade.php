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
          <h1 class="m-0 text-dark">Daftar User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
            Tambah User
          </button>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <!-- Small boxes (Stat box) -->
        <div class="row">
                    <table id="datatables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Kode Wilayah</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $key => $d)
                            <tr>
                                <td>{{ $d->user_id}}</td>
                                <td>{{ $d->name}}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->password }}</td>
                                <td>{{ $d->kode_wil }}</td>
                                <td>
                                    <a href="/user/edit/{{$d->user_id}}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/user/delete/{{$d->user_id}}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
        </div>
      </div>
  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
        <form action="/user/create/" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="name" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Enter name" required>
          </div>
          <div class="form-group">
            <label for="email">email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label for="password">password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="kode_wil">kode wilayah</label>
            <input type="number" class="form-control" name="kode_wil" id="kode_wil" placeholder="kode_wil" required>
            <input type="hidden" class="form-control" name="role_id" id="role_id" placeholder="kode_wil" value="2">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" value="submit">Submit</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('DataTables/css/dataTables.bootstrap4.min.css')}}">

<script src="{{ asset('DataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('DataTables/js/dataTables.bootstrap4.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
      $('#datatables').DataTable();
  } );
</script>
