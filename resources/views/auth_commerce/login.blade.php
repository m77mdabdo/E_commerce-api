<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Health Coach</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url("{{ asset('healthcoach-master/images/image_6.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            margin-top: 80px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .icon-box {
            background-color: #3498db;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin: 0 auto 20px;
        }

        .links {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-6 login-container">
            <div class="icon-box">
                <i class="fa fa-sign-in-alt"></i>
            </div>
            <h3 class="text-center mb-4">Login to Your Account</h3>

            <form method="POST" action="{{ route('storeLogin') }}">
                @csrf

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

               

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
