<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->

    <link href="/sweetalert2/sweetalert2.min.css" rel="stylesheet" />
    <script src="/sweetalert2/sweetalert2.min.js"></script>




    <style>
        .swal2-container {
            z-index: 99999;

        }

        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }

        .login-card h2 {
            margin-bottom: 30px;
            font-weight: 600;
            color: #333;
        }

        .form-label {
            font-size: 14px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 12px;
        }

        .btn-login {
            background-color: #007bff;
            color: white;
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 16px;
            width: 100%;
            border: none;
        }

        .btn-login:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .forgot-password {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @if (session('toast_message'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });


            Toast.fire({
                icon: "{{ session('toast_icon') }}",
                title: "{{ session('toast_message') }}"
            });
        </script>
    @endif
    <div class="login-container">
        <div class="login-card">
            <h2 class="text-center">Login</h2>
            <form action="{{ url('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-login">Login</button>

            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
