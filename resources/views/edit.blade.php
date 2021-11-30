<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit Employee</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Styles -->
    </head>
    <body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link " href="{{route('home')}}">Home</a>
                <a class="nav-item nav-link active" href="{{route('edit.employee')}}">Edit Employee</a>
                </div>
            </div>
            </nav>
        <div class="row">
            <div class="col-md-4 pt-4">
                 @if(!$file)
                <div class="alert alert-danger d-flex justify-content-center">
                    <h5>First Add Employee record</h5>
                </div>
                @endif
            </div>
            <div class="col-md-6 pt-4">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <button type="button" class="btn btn-primary add-row" @if(!$file) disabled @endif>Add Employee</button>
            <form method="POST" action="{{route('update.employee')}}" class="row">
                {{ csrf_field() }}
                <table class="table" id="table">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Join Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($file)
                            @foreach($data as $item)
                            <tr>
                            <th scope="row" style="width:10px"><input type="hidden" name="id[]" value="{{$item[0]}}"><input style="width:30px" type="text" value="{{$item[0]}}" disabled></th>
                                <td><input type="text" name="name[]" value="{{$item[1]}}" placeholder="Enter Name"></td>
                                <td><input type="text" name="designation[]" value="{{$item[2]}}" placeholder="Enter Designation"> </td>
                                <td><input type="text" name="joinDate[]" value="{{$item[3]}}" placeholder="Enter Join Date"></td>
                                <td><button class="btn btn-danger row-delete">Delete</button></td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <center><button type="submit" class="col-md-3 btn btn-success" @if(!$file) disabled @endif>Update Record</button></center>
                
            </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

   <script>
       $(document).ready(function(){
           var num={{$id}};
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
