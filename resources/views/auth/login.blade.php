

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
/>

  <style>
    body {
      background: linear-gradient(45deg, #c3ff00, #002aff);
      height: 100vh;
      font-family: "Montserrat", sans-serif;
      margin: 0;
      overflow: hidden;
    }

    .container {
      position: absolute;
      transform: translate(-50%, -50%);
      top: 50%;
      left: 50%;
    }

    form {
      background: rgba(255, 255, 255, 0.3);
      padding: 3em;
      height: 320px;
      border-radius: 20px;
      border-left: 1px solid rgba(255, 255, 255, 0.3);
      border-top: 1px solid rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(10px);
      box-shadow: 20px 20px 40px -6px rgba(0, 0, 0, 0.2);
      text-align: center;
      transition: all 0.2s ease-in-out;
    }

    form p {
      font-weight: 500;
      color: #fff;
      opacity: 0.7;
      font-size: 1.4rem;
      margin-top: 0;
      margin-bottom: 60px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    form a {
      text-decoration: none;
      color: #ddd;
      font-size: 12px;
    }

    form a:hover {
      text-shadow: 2px 2px 6px #00000040;
    }

    form input {
      background: transparent;
      width: 200px;
      padding: 1em;
      margin-bottom: 2em;
      border: none;
      border-left: 1px solid rgba(255, 255, 255, 0.3);
      border-top: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 5000px;
      backdrop-filter: blur(5px);
      box-shadow: 4px 4px 60px rgba(0, 0, 0, 0.2);
      color: #fff;
      font-family: Montserrat, sans-serif;
      font-weight: 500;
      transition: all 0.2s ease-in-out;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
      outline: none;
    }

    form input:hover {
      background: rgba(255, 255, 255, 0.1);
      box-shadow: 4px 4px 60px 8px rgba(0, 0, 0, 0.2);
    }

    form input:focus {
      background: rgba(255, 255, 255, 0.1);
    }

    form input[type="button"] {
      margin-top: 10px;
      width: 150px;
      font-size: 1rem;
      cursor: pointer;
    }

    form:hover {
      margin: 4px;
    }

    ::placeholder {
      font-family: Montserrat, sans-serif;
      font-weight: 400;
      color: #fff;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
    }

    .drop {
      background: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(10px);
      border-radius: 10px;
      border-left: 1px solid rgba(255, 255, 255, 0.3);
      border-top: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 10px 10px 60px -8px rgba(0, 0, 0, 0.2);
      position: absolute;
    }

    .drop-1 {
      height: 80px;
      width: 80px;
      top: -20px;
      left: -40px;
      z-index: -1;
    }

    .drop-2 {
      height: 80px;
      width: 80px;
      bottom: -30px;
      right: -10px;
    }

    .drop-3 {
      height: 100px;
      width: 100px;
      bottom: 120px;
      right: -50px;
      z-index: -1;
    }

.drop-4 {
  height: 120px;
  width: 120px;
  top: -60px;
  right: -60px;
  position: absolute;
  border-radius: 12px;
  backdrop-filter: blur(6px);
}

.drop-4::before {
  content: "";
  position: absolute;
  inset: 15px;   /* 👈 REAL padding */
  background: url("{{ asset('LOGO.webp') }}") no-repeat center;
  background-size: contain;
  border-radius: 8px;
}


    .drop-5 {
      height: 60px;
      width: 60px;
      bottom: 170px;
      left: 90px;
      z-index: -1;
    }

    .MDJAminDiv {
      position: fixed;
      bottom: 5%;
      left: 2%;
    }

    .MDJAmin {
      text-decoration: none;
      border-bottom: 1px dashed rgb(44, 44, 44);
      border-top: 1px dashed rgb(44, 44, 44);
      padding: 4px 0;
      color: rgba(44, 44, 44, 0.525);
      font-family: monospace;
      font-style: italic;
      font-size: 1.3em;
      transition: all 0.5s;
    }

    .MDJAmin:hover {
      color: #000;
    }
    button {
      width: 160px;
      padding: 12px;
      margin-top: 10px;
      border: none;
      border-radius: 50px;
      font-size: 1rem;
      font-weight: 500;
      color: #fff;
      cursor: pointer;
      background: linear-gradient(135deg, #00ffcc, #0066ff);
      box-shadow: 0 8px 20px rgba(0,0,0,0.25);
      transition: all 0.3s ease;
    }

    .password-wrapper {
  position: relative;
  width: 100%;
}



.password-wrapper i {
  position: absolute;
  right: 18px;
  top: 30%;
  transform: translateY(-50%);
  cursor: pointer;
  color: rgba(255,255,255,0.8);
  font-size: 16px;
}

.password-wrapper i:hover {
  color: #fff;
}

</style>
</head>

<body>
  <div class="container">
    <form method="POST" action="{{ route('login') }}">
      <p>Welcome</p>

      @csrf
      <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
        @if($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
      <br />

        <div class="password-wrapper">
        <input
            id="password"
            name="password"
            type="password"
            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
            required
            placeholder="{{ trans('global.login_password') }}"
        />

        <i class="fa-solid fa-eye" id="togglePassword"></i>
        </div>

        @if($errors->has('password'))
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
        @endif



        @if($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
      <br />

      <button type="submit">Sign In</button>
      <br />

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Forgot Password?</a><br>
         @endif

      <a href="{{ route('register') }}">Create Account</a>
    </form>

    <div class="drops">
      <div class="drop drop-1"></div>
      <div class="drop drop-2"></div>
      <div class="drop drop-3"></div>
      <div class="drop drop-4"></div>
      <div class="drop drop-5"></div>
    </div>
  </div>

  <div class="MDJAminDiv">
<div class="MDJAminDiv">
  <a class="MDJAmin" href="https://eemotrack.com/" target="_blank">
    Copyright © <span id="year"></span> EEMOTRACK INDIA – Developed by Ajay Mehta
  </a>
</div>

<script>
  document.getElementById("year").textContent = new Date().getFullYear();
</script>
<script>
  const togglePassword = document.getElementById("togglePassword");
  const password = document.getElementById("password");

  togglePassword.addEventListener("click", function () {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash");
  });
</script>

  </div>
</body>
</html>
