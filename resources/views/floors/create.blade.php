@extends('admin_template')

@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<br><br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 ">

        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h2 class="text-center">Create New Floor</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form role="form" class="form-horizontal" method="post" action="/floors">
                {{csrf_field()}}

                <div class="box-body">
                    <div class="input-group">
                        <label >Floor Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter floor name">
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Create"/>
                </div>
        </div>
    </div>
    <div class='col-lg-3'></div>
</div>

</form>
@endsection
