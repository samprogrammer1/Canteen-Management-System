@extends('layouts.dashboard')

@section('content')

    <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-12">
          <div class="box">
              
            <div class="box-header">
                <h4 class="box-title">Invoice Form</h4>  
            </div>
            <div class="box-body">

                <form action="{{Route('invoice-get')}}" method="get">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Start Date</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" name="start_date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">End Date</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" name="end_date">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mt-2">
                        <button type="submit" class="btn btn-success">Get Invoice</button>
                    </div>	
                </form>		
                	
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
@endsection