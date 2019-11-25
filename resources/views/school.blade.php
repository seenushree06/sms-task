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
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Student Name</th>
                <th>Standard</th>
                <th>Teacher Name</th>
                <th>Section</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
        ajax: "{{ route('school.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'standard', name: 'standard'},
            {data: 'teacher_name', name: 'teacher_name'},
            {data: 'section', name: 'section', orderable: false, searchable: false},
        ]
    });
       
     
  });
</script>
</html>

@endsection