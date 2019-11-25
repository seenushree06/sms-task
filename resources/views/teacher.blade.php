@extends('layouts.header')
@section('content')

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
  
    <a class="btn btn-success" href="javascript:void(0)" id="createNewTeacher"> Create Teacher List</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Standard</th>
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
                <form id="teacherForm" name="teacherForm" class="form-horizontal">
                   <input type="hidden" name="teacher_id" id="teacher_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Designation</label>
                        <div class="col-sm-12">
                            <input type="text"  id="designation" name="designation" required="" placeholder="Enter Designiation" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Standard</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="standard" name="standard" placeholder="Enter Standard" value="" maxlength="50" required="">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
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
        ajax: "{{ route('teacher.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'designation', name: 'designation'},
            {data: 'standard', name: 'standard'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#createNewTeacher').click(function () {
        $('#saveBtn').val("create-teacher");
        $('#teacher_id').val('');
        $('#teacherForm').trigger("reset");
        $('#modelHeading').html("Create New Teacher");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editTeacher', function () {
      var teacher_id = $(this).data('id');
      $.get("{{ route('teacher.index') }}" +'/' + teacher_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Teacher");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#teacher_id').val(data.id);
          $('#name').val(data.name);
          $('#designation').val(data.designation);
          $('#standard').val(data.standard);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#teacherForm').serialize(),
          url: "{{ route('teacher.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#teacherForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteTeacher', function () {
     
        var teacher_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('teacher.destroy') }}"+'/'+teacher_id,
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