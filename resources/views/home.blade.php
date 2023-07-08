<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

  @auth
  <p>You are logged in</p>
  <form action="/logout" method="POST">
    @csrf
    <button type="submit">Log out</button>
  </form>
  @else
  <div style="border: 3px solid black;">
    <h2>Register</h2>
    <form action="/register" method="POST">
      @csrf
      <div>
        <label for="name">Name</label>
        <input type="text" name="name" />
        @error('name')
            <p>{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="email">Email</label>
        <input type="email" name="email" />
        @error('email')
            <p>{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password">Password</label>
        <input type="password" name="password" />
        @error('password')
            <p>{{ $message }}</p>
        @enderror
      </div>

      <button type="submit">Sign Up</button>
    </form>
  </div>

  <div style="border: 3px solid black;">
    <h2>Login</h2>
    <form action="/login" method="POST">
      @csrf
      <div>
        <label for="email">Email</label>
        <input type="email" name="loginemail" />
        @error('email')
            <p>{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password">Password</label>
        <input type="password" name="loginpassword" />
        @error('password')
            <p>{{ $message }}</p>
        @enderror
      </div>

      <button type="submit">Log in</button>
    </form>
  </div>
  @endauth

  
</body>

</html>
