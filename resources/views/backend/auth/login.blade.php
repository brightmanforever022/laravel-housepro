@extends('layouts.inspinia')

@section('content')

    <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>

                    <h1 class="logo-name">A+</h1>

                </div>
                <h3>Welcome to APARTOLINO</h3>
                <!--p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                    <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
                <!--/p-->
                <p>Login in. To see it in action.</p>
                <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Username" required="" name="email" value="{{ old('email') }}">

                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" required=""  name="password">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                    <!--a href="#"><small>Forgot password?</small></a>
                    <p class="text-muted text-center"><small>Do not have an account?</small></p>
                    <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a-->
                </form>
                <p class="m-t"> <small>APARTOLINO ADMIN &copy; 2016</small> </p>
            </div>
    </div>

@endsection
