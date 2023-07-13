<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

   @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session()->get('message') }}
        </div>
      @endif
      
  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">One</span>-Health</a>

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctors.html">Doctors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.html">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>

            @if(Route::has('login'))
            @auth()

            <li class="nav-item">
              <a class="nav-link" style="background-color: #00DAA4; color:black" href="{{ url('myappointment') }}">My Appointment</a>
            </li>
                <x-app-layout>
                </x-app-layout>
            @else
                <li class="nav-item">
                <a class="btn btn-primary ml-lg-3" href="{{ route('login') }}">Login</a>
                </li>

                <li class="nav-item">
                <a class="btn btn-primary ml-lg-3" href="{{ route('register') }}">Register</a>
                </li>
            @endauth
            @endif
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

<div style="padding:4% 17% 0 17%">

<table class="table">
    <h5>MY APPOINTMENTS</h5>
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Doctor Name</th>
      <th scope="col">Date</th>
      <th scope="col">Message</th>
      <th scope="col">Status</th>
      <th scope="col">Alter Appointment</th>
    </tr>
  </thead>

  @foreach ($appoint as $appoints )
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>{{ $appoints->doctor }}</td>
        <td>{{ $appoints->date }}</td>
        <td>{{ $appoints->message }}</td>
        <td>{{ $appoints->status }}</td>

        <td class="btn btn-success" style="margin: 4px"><a style="text-decoration: none; color:#fff" href="{{ url('editappoint', $appoints->id) }}">Edit</a></td>
        
        <td class="btn btn-danger" style="margin: 4px"><a onclick="return confirm('You are about to delete this!')" style="text-decoration: none; color:#fff" href="{{ url('deleteappoint', $appoints->id) }}">Delete</a></td>


        </tr>  
    </tbody>    
  @endforeach
</table>
</div>

  {{-- Footer --}}
  @include('user.footer')

  @include('admin.script')
  
</body>
</html>