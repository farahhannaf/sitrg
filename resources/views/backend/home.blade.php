<!-- Dashboard -->
@extends('layouts.backend.main')

@section('title', 'SITRG')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
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
        <div class="col-lg-12 col-12">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <center><h3>{{$pdf_sum}}</h3></center>

              <center><p>Jumlah PDF</p></center>
            </div>
            <!-- <div class="icon">
              <i class="ion ion-document-text"></i>
            </div> -->
            <center><a href="/pdf" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></center>
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
      </div>
   

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection