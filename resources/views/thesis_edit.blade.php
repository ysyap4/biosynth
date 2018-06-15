@extends('layouts.app')

@section('content')

<div class="container">

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif


<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <form method="POST" name="thesis_edit_process" id="thesis_edit_process" action="{{ URL::route ('thesis_edit_process')}}" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @for ($i=0; $i < sizeof($edit_selected_thesis); $i++)

        <div class="page-header">
            <h1><span class="glyphicon glyphicon-user"></span> Editing thesis paper of {{$edit_selected_thesis[$i]->t_title}}</h1>
        </div>
            <input type="hidden" name="edit_selected_thesis[]" value="{{ $edit_selected_thesis[$i]->id }}">
        
        <!-- FORM STARTS HERE -->

        <div class="form-group @if($errors->has('t_title'))has-error @endif">
            <label for="t_title">Title</label>
            <input type="text" id="t_title" class="form-control" name="t_title[{{$i}}]" value="{{$edit_selected_thesis[$i]->t_title}}">
            @if ($errors->has('t_title')) <p class="help-block">{{ $errors->first('t_title') }}</p> @endif
        </div>

        <div class="form-group @if($errors->has('t_studname'))has-error @endif">
            <label for="t_studname">Student Name</label>
            <input type="text" id="t_studname" class="form-control" name="t_studname[{{$i}}]" value="{{$edit_selected_thesis[$i]->t_studname}}">
            @if ($errors->has('t_studname')) <p class="help-block">{{ $errors->first('t_studname') }}</p> @endif
        </div>

        <div class="form-group @if($errors->has('t_sv'))has-error @endif">
            <label for="t_sv">Supervisor</label>
            <input type="text" id="t_sv" class="form-control" name="t_sv[{{$i}}]" value="{{$edit_selected_thesis[$i]->t_sv}}">
            @if ($errors->has('t_sv')) <p class="help-block">{{ $errors->first('t_sv') }}</p> @endif
        </div>

        <div class="form-group @if ($errors ->has ('t_type')) has-error @endif">
                <label for="t_type">Thesis Type</label><br>
                    <select name="t_type[{{$i}}]">
                    @if ($edit_selected_thesis[$i]->t_type == "Degree")
                        <option value="Degree"> Degree </option>
                        <option value="Master"> Master </option>
                        <option value="Phd"> Phd </option>
                        <option value="-"> - </option>
                    @elseif ($edit_selected_thesis[$i]->t_type == "Master")
                        <option value="Master"> Master </option>
                        <option value="Degree"> Degree </option>
                        <option value="Phd"> Phd </option>
                        <option value="-"> - </option>
                    @elseif ($edit_selected_thesis[$i]->t_type == "Phd")
                        <option value="Phd"> Phd </option>
                        <option value="Degree"> Degree </option>
                        <option value="Master"> Master </option>
                        <option value="-"> - </option>
                    @elseif ($edit_selected_thesis[$i]->t_type == "-")
                        <option value="-"> - </option>
                        <option value="Degree"> Degree </option>
                        <option value="Master"> Master </option>
                        <option value="Phd"> Phd </option>
                    @endif
                    </select>
                 @if ($errors->has('t_type'))<p class="help-block">{{$errors ->first('t_type')}}</p>@endif
            </div>

        <div class="form-group @if($errors->has('t_thesis'))has-error @endif">
            <label for="t_thesis">Current Thesis Paper</label><br>
            <a href="/thesis/public/uploads/files/{{$edit_selected_thesis[$i]->t_thesis}}" class="btn btn-warning">
             {{ $edit_selected_thesis[$i]->t_thesis }}</a>
             <input type="hidden" id="t_oldname" class="form-control" name="t_oldname[{{$i}}]" value="{{$edit_selected_thesis[$i]->t_thesis}}"><br><br>
            <label for="t_thesis">Upload new Thesis Paper</label>
            <input type="file" id="t_thesis" class="form-control" name="t_thesis{{$i}}" value="/thesis/public/uploads/files/{{$edit_selected_thesis[$i]->t_thesis}}" accept="application/pdf">
            @if ($errors->has('t_thesis')) <p class="help-block">{{ $errors->first('t_thesis') }}</p> @endif
        </div>

        <div class="form-group @if($errors->has('abstract'))has-error @endif">
                <label for="abstract">Abstract</label>
                <textarea id="abstract" rows="10" cols="70" class="form-control" name="abstract[{{$i}}]">{{$edit_selected_thesis[$i]->abstract}}</textarea>
                @if ($errors->has('abstract')) <p class="help-block">{{ $errors->first('abstract') }}</p> @endif
        </div>

        @endfor
        </form>
      
        <br>

        <button type="submit" class="btn btn-small btn-info" form="thesis_edit_process"> Update </button>
        <a style="color:white" class="btn btn-small btn-info" href="{{url()->previous()}}">Back</a>

    </div>
</div>



@endsection





@section('script2')

    
    <script type="text/javascript">

    function thesis_show()
    {
        var x =[];

        if (this.checked)
        {
          $('#selected_thesis').removeAttr('disabled');
          $('#mytable :checked').each(function()
          {
            x.push($(this).vathesis_editl());
          });
        }

        x = document.getElementById("selected_thesis").value;
        document.get_checkbox.action = "{{URL::route('thesis_show')}}";
        document.get_checkbox.submit();
    }
    </script>

    <script type="text/javascript">
    function thesis_edit()
    {
        var x =[];

        if (this.checked)
        {
          $('#selected_thesis').removeAttr('disabled');
          $('#mytable :checked').each(function()
          {
            x.push($(this).val());
          });
        }

        x = document.getElementById("selected_thesis").value;
        document.get_checkbox.action = "{{URL::route('thesis_edit')}}";
        document.get_checkbox.submit();
    }
    </script>

     
      <script>

      $('#mytable').dataTable( {
        "lengthMenu" : [[5,10,15,-1],[5,10,15,"All"]]
        } );
   
    </script>

    <script type="text/javascript">
    function thesis_delete()
    {
        var x =[];

          $('button#thesis_delete').on('click',
    function(){
      swal({
       title: "Are you sure?",
       text: "You will not be able to recover this user!",
       type: "warning",
       html:true,
       showCancelButton: true,
       confirmButtonColor: '#3ebf8f',
       confirmButtonText: 'Yes,delete it!',
       closeOnConfirm: true,
       showLoaderOnConfirm:false
      },
      function(){
        $.ajax({
             success: function (userRows) {
                 swal({
                       title: "Data Removed!",
                       type: "success",
                       html:true,
                       showCancelButton: false,
                       confirmButtonColor: '#3ebf8f',
                       confirmButtonText: 'OK',
                       closeOnConfirm: true
                       },
                       function(){

                         if (this.checked)
        {
          $('#selected_thesis').removeAttr('disabled');
          $('#mytable :checked').each(function()
          {
            x.push($(this).val());
          });
        }

        x = document.getElementById("selected_thesis").value;
        document.get_checkbox.action = "{{URL::route('thesis_delete')}}";
        document.get_checkbox.submit();
                         
                       });
          }
        });
      });
    })
       
    }
    </script>

@endsection
