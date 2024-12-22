@include('pages.header')
    <div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form action="" method="POST">
                @csrf
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Forgot Your Password ?</h1>
                
            @if(session()->has('error'))
            <div class="alert alert-danger">{{session()->get('error')}}</div>
            @endif

                <div class="form-floating">
                    <input type="text" class="form-control rounded-0" name="email" placeholder="username/email">
                    <label for="floatingInput">username/email</label>
                    <span class="text-danger"> <small>@error('checkemail')
                        {{$message}}
                    @enderror </small></span>
                </div>

               
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit" value="submit" name="submit">Send Verification Code</button>
                </div>
                <br>
                <a href="/logout" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i> Go Back
                    To
                    Login</a>
            </form>
        </div>
    </div>

@include('pages.footer')