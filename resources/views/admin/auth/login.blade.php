<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            width: 100vw;
            height: 100vh;
        }
        .box{
            width: 30vw

        }
    </style>
    <title>Login</title>
</head>

<body class="d-flex justify-content-center align-items-center ">
    <div class="box">
        <h1>Welcome back</h1>
        <p class="text-secondary">Welcome back ! Please enter your details.</p>
        <ul class="pl-3">
            <li class="font-weighted-bold">Loging in as Admin</li>



        </ul>
        <div class="row">

  
            <div class="col-12">
                <!-- form here -->
                <form action="{{url('admin/login-post')}}" method="POST">
                    @csrf
                    
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your Email" >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="*******">
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <small class="text-right">
                            <a href="#" class="text-primary">Forgot Password?</a>
                        </small>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary ml-0 my-2">Log in</button>
                    <button type="submit" class="btn btn-block bg-white border border-black ml-0 my-2"> <img src="{{url('assets/auth_assets/googIcon.png')}}" width="30px" height="30px" alt="..."> Log in with Google</button>
                </form>
            </div>
        </div>

    </div>



    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>


</body>

</html>