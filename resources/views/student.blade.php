@extends('layouts.header')
@section('content')

<!DOCTYPE html>
<html>
<head>
   
    @include('layouts.datatable')

    <style type="text/css">
      .container {

    margin-top: 60px;

     }

    </style>
</head>
<body>
  <div class="container-scroller">
      <div class="container-fluid page-body-wrapper"> 
      @include('layouts.sidebar')  
<div class="container">
  
    <a class="btn btn-success" href="javascript:void(0)" id="createNewStudent"> Create student List</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Standard</th>
                <th>Section</th>  
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="studentForm" name="studentForm" class="form-horizontal">
                   <input type="hidden" name="student_id" id="student_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Standard</label>
                        <div class="col-sm-12">
                            <input type="text" id="standard" name="standard" required="" placeholder="Enter standard" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Section</label>
                        <div class="col-sm-12">
                            <input type="text" id="section" name="section" required="" placeholder="Enter Section" class="form-control">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="savebutton" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  </div>  
</div>
</body>
    
<script type="text/javascript">
  $(function () {
     
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('student.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'standard', name: 'standard'},
            {data: 'section', name: 'section'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#createNewStudent').click(function () {
        $('#savebutton').val("create-student");
        $('#student_id').val('');
        $('#studentForm').trigger("reset");
        $('#modelHeading').html("Create New Student");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editStudent', function () {
      var student_id = $(this).data('id');
      $.get("{{ route('student.index') }}" +'/' + student_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Student");
          $('#savebutton').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#student_id').val(data.id);
          $('#name').val(data.name);
          $('#standard').val(data.standard);
          $('#section').val(data.section);
      })
   });
    
    $('#savebutton').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({

          data: $('#studentForm').serialize(),
          url: "{{ route('student.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#studentForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#savebutton').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteStudent', function () {
     
        var student_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('student.destroy') }}"+'/'+student_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
</html>

@endsection