@includeIf("pages.header")
<div class="login">
<<<<<<< HEAD
=======
    {{-- @if ($success)
        {{'your account has been created'}}
    @endif --}}
    {{}}
>>>>>>> 188252b71dc6903aedd5d7c071aaff32081b31d7
    <div class="col-4 bg-white border rounded p-4 shadow-sm">
        <form method="POST" action="">
            @csrf
            <div class="d-flex justify-content-center">

                <img class="mb-4" src="img/pictogram.png" alt="" height="45">
            </div>
            <h1 class="h5 mb-3 fw-normal">Please sign in</h1>
<<<<<<< HEAD
            @if(session()->has('error'))
            <div class="alert alert-danger">{{session()->get('error')}}</div>
            @endif
            @if(session()->has('success'))
            <div class="alert alert-success">{{session()->get('success')}}</div>
            @endif
            <div class="form-floating">
                <input type="text" class="form-control rounded-0" name="email" placeholder="username/email">
                <label for="floatingInput">username/email</label>
                <span class="text-danger"> <small>@error('email')
                    {{$message}}
                @enderror </small></span>
=======

            <div class="form-floating">
                <input type="email" class="form-control rounded-0" name="username_email" placeholder="username/email">
                <label for="floatingInput">username/email</label>
>>>>>>> 188252b71dc6903aedd5d7c071aaff32081b31d7
            </div>

            <div class="form-floating mt-1">
                <input type="password" class="form-control rounded-0" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">password</label>
<<<<<<< HEAD
                <span class="text-danger"> <small>@error('password')
                    {{$message}}
                @enderror </small></span>
            </div>

            <div class="mt-3 d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" type="submit" name="submit" value="submit">Log in</button>
                <a href="{{url('/signup')}}" class="text-decoration-none">Create New Account</a>


            </div>  
=======
            </div>

            <div class="mt-3 d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" type="submit">Log in</button>
                <a href="{{ url('/signup')}}" class="text-decoration-none">Create New Account</a>


            </div>
>>>>>>> 188252b71dc6903aedd5d7c071aaff32081b31d7
            <a href="#" class="text-decoration-none">Forgot password ?</a>
        </form>
    </div>
</div>
@includeIf("pages.footer")