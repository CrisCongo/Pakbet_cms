<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        body {
            background-color: #FCF8EC;
            font-family: Arial, sans-serif;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-outline {
            margin-bottom: 1rem;
        }
        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #E5E2E2;
            border-radius: 4px;
        }
        .form-label {
            display: block;
            margin-bottom: 0.25rem;
            color: #333;
        }
        .btn-primary {
            background-color: #E5E2E2;
            color: #333;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #E6E3E3;
        }
    </style>
</head>
<body>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="form1Example1">Email address</label>
          <input type="email" id="form1Example1" name="email" class="form-control" required />
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="form1Example2">Password</label>
          <input type="password" id="form1Example2" name="password" class="form-control" required />
        </div>

        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
              <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>


</body>
</html>
