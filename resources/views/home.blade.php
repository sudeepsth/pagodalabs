<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Styles -->
    </head>
    <body>
    {{-- <div class="d-flex justify-content-center"> --}}
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link active" href="{{route('home')}}">Home</a>
                <a class="nav-item nav-link " href="{{route('edit.employee')}}">Edit Employee</a>
                </div>
            </div>
            </nav>
            {{-- </div> --}}
        <div class="row">
            <div class="col-md-4 pt-4">
                @if(isset($file))
                <div class="alert alert-danger">
                    <h5>File already exists. It will replace the file. Path(/public/employee.csv)</h5>
                </div>
                @endif
            </div>
            <div class="col-md-6 pt-4">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <button type="button" class="btn btn-primary add-row">Add Record</button>
            <form method="POST" action="{{route('export')}}" class="row pt-4">
                {{ csrf_field() }}
                <table class="table" id="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Join Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><input type="hidden" name="id[]" value="1">1</th>
                            <td><input type="text" name="name[]" placeholder="Enter Name"></td>
                            <td><input type="text" name="designation[]" placeholder="Enter Designation"> </td>
                            <td><input type="text" name="joinDate[]" placeholder="Enter Join Date"></td>
                            <td><button class="btn btn-danger row-delete">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
               <button type="submit" class="btn btn-success align-center">Submit</button>
            </form>
            </div>
            <div class="col-md-2"></div>

        </div>
        <div class="d-flex justify-content-center pt-4"> If CSV file is already exits then it will overwrite the file</div>

    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

   <script>
       $(document).ready(function(){
           var num=1;
        $(".add-row").click(function(){
            num = num+1;
            var row = "<tr><th><input type='hidden' name='id[]' value='"+num+"'>"+ num +"</th><td><input type='text' name='name[]' placeholder='Enter Name'></td><td><input type='text' name='designation[]' placeholder='Enter Designation'></td> <td><input type='text' name='joinDate[]' placeholder='Enter Join Date'></td> <td><button class='btn btn-danger row-delete'>Delete</button></td>";
            $("table tbody").append(row);
        });
        $("#table").on('click','.row-delete',function () {
            $(this).closest('tr').remove();
        });
//*
       });
    </script>
</html>
