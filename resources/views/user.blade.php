<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <div class="col-md-12 mt-4">
        @if(session()->has('success'))
            <div  class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        <form action="{{url(app()->getLocale().'/submit-user')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" value="{{old('name')}}" class="form-control" placeholder="Name">
                @error('name')
                <label class="error">{{$message}}</label>
                @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="text" value="{{old('email')}}" class="form-control" placeholder="Email">
                @error('email')
                <label class="error">{{$message}}</label>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" value="{{old('password')}}" class="form-control" placeholder="Password">
                @error('password')
                <label class="error">{{$message}}</label>
                @enderror
            </div>
            <div class="form-group">
                <label>Profile Image</label>
                <input name="profile_image" type="file" class="form-control" >
                @error('profile_image')
                <label class="error">{{$message}}</label>
                @enderror
            </div>
            <div class="form-group">
                <label>Profile Image</label>
                <input name="images[]" type="file" multiple class="form-control" >
                @error('images')
                <label class="error">{{$message}}</label>
                @enderror
            </div>
            <div class="form-group">
               <button class="btn btn-primary mt-2" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div class="col-md-12 table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            @if(count($users))
                @foreach($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->profile_image}}</td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>

<!-- Bootstrap Bundel -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
