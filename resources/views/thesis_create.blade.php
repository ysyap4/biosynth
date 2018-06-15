
<?php
use Illuminate\Support\Facades\Input;
?>
@extends('layouts.app')

@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif


<div class="container" style="align-items: center;">
<h1>Uploading new thesis paper</h1>
<br>
  <div class="col-md-12" style="background-color:#A0CFEC;">
   <!-- FORM STARTS HERE -->
        <form method="POST" action="{{URL::route('thesis_create_process')}}" novalidate role="form"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> <!--setiap user ade token die sendiri outsider tk boleh dpt token-->
<br>
            <div class="form-group @if($errors->has('t_title'))has-error @endif">
                <label for="t_title">Title</label>
                <input type="text" id="t_title" class="form-control" name="t_title" placeholder="Enter the Thesis paper's title" value="{{ Input::old('t_title') }}"><!--id x compulsary-->
                @if ($errors->has('t_title')) <p class="help-block">{{ $errors->first('t_title') }}</p> @endif

            </div>

             <div class="form-group @if($errors->has('t_studname'))has-error @endif">
                <label for="t_studname">Student's Name</label>
                <input type="text" id="t_studname" class="form-control" name="t_studname" value="{{ Auth::user()->s_name }} ">
                @if ($errors->has('t_studname')) <p class="help-block">{{ $errors->first('t_studname') }}</p> @endif
            </div>


            <div class="form-group @if($errors->has('t_sv'))has-error @endif">
                <label for="t_sv">Supervisor</label>
                <input type="text" id="t_sv" class="form-control" name="t_sv" value="{{ Auth::user()->s_sv }}">
                @if ($errors->has('t_sv')) <p class="help-block">{{ $errors->first('t_sv') }}</p> @endif
            </div>

            <div class="form-group @if ($errors ->has ('t_type')) has-error @endif">
                <label for="t_type">Thesis Type</label><br>
                    <select name="t_type">
                        <option value="-"> - </option>
                        <option value="Degree"> Degree </option>
                        <option value="Master"> Master </option>
                        <option value="Phd"> Phd </option>
                    </select>
                 @if ($errors->has('t_type'))<p class="help-block">{{$errors ->first('t_type')}}</p>@endif
            </div>

            <div class="form-group @if($errors->has('t_thesis'))has-error @endif">
                <label for="t_thesis">Thesis Paper</label>
                <input type="file" id="t_thesis" class="form-control" name="t_thesis" placeholder=" " value=" " accept="application/pdf">
                @if ($errors->has('t_thesis')) <p class="help-block">{{ $errors->first('t_thesis') }}</p> @endif
            </div>

             <div class="form-group @if($errors->has('abstract'))has-error @endif">
                <label for="abstract">Abstract</label>
                <textarea id="abstract" rows="10" cols="70" class="form-control" name="abstract" value="Enter your abstract here"></textarea>
                @if ($errors->has('abstract')) <p class="help-block">{{ $errors->first('abstract') }}</p> @endif
            </div>

            <div>
            <br>
             <button type="submit" class="btn btn-success">Add</button>
              <button type="reset" role="button" class="btn btn-info">Reset</button>
            
             <div class="pull-right">
                <a class="btn btn-danger" href="{{url()->previous()}}"> Cancel</a>
            </div>
            
        </form>
        

</div><br></div>
</div>
<br><br>

@endsection

@section('pdfscript')
<script>
    function alertNotPDF()
    {
        if (localStorage.getItem("hasFileTypeError") == 'true') {
            localStorage.removeItem("hasFileTypeError")
            swal("Invalid File Type!", "Please upload in pdf format!", "warning")
        }  
    }

    $(document).ready(function(){
      alertNotPDF();
    });
</script>
@endsection