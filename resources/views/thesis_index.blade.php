@extends('layouts.app')

@section('content')

<div class="container">

<h1>Thesis paper management</h1>
<br>

<a style="color:white;" class="btn btn-warning" href="{{URL::route('thesis_create')}}">Add</a>
<button type="submit" id="thesis_show" style="color:yellow;" class="btn btn-small btn-success" onClick="thesis_show()";> Show</button> 
<button type="submit" id="thesis_edit" class="btn btn-small btn-info" onClick="thesis_edit()";> Edit</button> 
<button type="submit" id="thesis_delete" style="color:#FFF0AA;" class="btn btn-small btn-danger" onClick="thesis_delete()";> Delete</button>
<br><br>
<form method="GET" name="get_checkbox">
<table id="mytable" class="table table-striped table-bordered">
    <thead>
        <tr style="background:#B4D8E7; text-align: center;">
            <td></td>
            <td>No</td>
            <td>Title</td>
            <td>Student Name</td>
            <td>Supervisor</td>
            <td>Type</td>
            <td>Thesis</td>
        </tr>
    </thead>
<tbody>
    <?php $no = 1; ?>
    @foreach($thesis as $value)
    <tr>
        <td><input type="checkbox" name="selected_thesis[]" value="{{ $value->id }}" id="selected_thesis"></td>
        <td><?php echo $no ?></td>
        <td>{{ $value->t_title }}</td>
        <td>{{ $value->t_studname }}</td>
        <td>{{ $value->t_sv }}</td>
        <td>{{ $value->t_type }}</td>
        <td><a href="/thesis/public/uploads/files/{{$value->t_thesis}}" class="btn btn-warning"> {{ $value->t_thesis }}</a></td>
    </tr>
    <?php $no++; ?>
    @endforeach
</tbody>
</table>
</form>

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
            x.push($(this).val());
          });
        }

        if(document.getElementById('selected_thesis').checked) 
        {
            document.get_checkbox.action = "{{URL::route('thesis_show')}}";
            document.get_checkbox.submit();
        } 
        else 
        {
           swal('You have not check any checkbox!');
        }       
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

        if(document.getElementById('selected_thesis').checked) 
        {
            document.get_checkbox.action = "{{URL::route('thesis_edit')}}";
            document.get_checkbox.submit();
        } 
        else 
        {
           swal('You have not check any checkbox!');
        }
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
       text: "You will not be able to recover this thesis paper!",
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
                       title: "Thesis paper removed!",
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
