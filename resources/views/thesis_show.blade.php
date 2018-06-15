@extends('layouts.app')

@section('content')

<div class="container">

<br>

<a style="color:white; float:right;" class="btn btn-warning" href="{{url()->previous()}}">Back</a>

<br><br><br>
@for ($i=0; $i < sizeof($show_selected_thesis); $i++)
    <div class="jumbotron col-md-12">
    <h2>Displaying information of {{$show_selected_thesis[$i] -> t_title}}</h2>
        <p>
            <strong>Title : </strong>{{$show_selected_thesis[$i]->t_title}}<br>
            <strong>Student Name : </strong>{{$show_selected_thesis[$i]->t_studname}}<br>
            <strong>Supervisor : </strong>{{$show_selected_thesis[$i]->t_sv}}<br>
            <strong>Type : </strong>{{$show_selected_thesis[$i]->t_type}}<br>
            <strong>Open as PDF : </strong><a href="/thesis/public/uploads/files/{{$show_selected_thesis[$i]->t_thesis}}" class="btn btn-info"> {{ $show_selected_thesis[$i]->t_thesis }}</a><br>
            <strong>Abstract : </strong><br>{{$show_selected_thesis[$i]->abstract}}<br>
        </p>
        </div>
    @endfor

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
