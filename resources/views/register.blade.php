<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-7/assets/css/login-7.css">
</head>
<body>
<section class="bg-light p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
        <div class="card border border-light-subtle rounded-4">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h4 class="text-center">Welcome to register!</h4>
                </div>
              </div>
            </div>
            <form action="{{route('validar-registro')}}" method="post">
            @csrf
              <div class="row gy-3 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Write a name" value="{{old('name') ?? @$user->name}}" required>
                    <label for="name" class="form-label">Name</label>
                  </div>
                  @error('name')
                    <p class="form-text text-danger">{{$message}}</p>    
                  @enderror
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Write a lastName" value="{{old('lastName') ?? @$user->lastName}}" required>
                      <label for="lastName" class="form-label">Lastname</label>
                    </div>
                    @error('lastName')
                      <p class="form-text text-danger">{{$message}}</p>    
                    @enderror
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="{{old('email') ?? @$user->email}}" required>
                      <label for="email" class="form-label">Email</label>
                    </div>
                  </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                    <label for="password" class="form-label">Password</label>
                  </div>
                  @error('password')
                    <p class="form-text text-danger">{{$message}}</p>    
                  @enderror
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" type="submit">Register</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
