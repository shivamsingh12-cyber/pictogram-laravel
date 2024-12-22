@include('pages.header')
    <div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form action="" method="POST">
                @csrf
                <div class="d-flex justify-content-center">
                    @if(session()->has('success'))
                    <div class="alert alert-success">{{session()->get('success')}}</div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger">{{session()->get('error')}}</div>
                    @endif

                </div>
                <h1 class="h5 mb-3 fw-normal">Forgot Your Password ?</h1>
             
                <p>Enter 6 Digit Code Sended to You</p>
                <div class="form-floating mt-1">
                    <input type="text" class="form-control rounded-0" name="otpcheck" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Enter OTP</label>
                    <span class="text-danger"> <small>@error('otpcheck')
                        {{$message}}
                        @enderror </small></span>
                </div>
                <div class="form-floating mt-1">
                    <input type="password" class="form-control rounded-0"  name="new_pass" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Create new password</label>
                    <span class="text-danger"> <small>@error('new_pass')
                        {{$message}}
                        @enderror </small></span>
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit" value="submit" name="submit">Change Password</button>

                </div>
                <br>
                <a href="/logout" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i> Go Back
                    To
                    Login</a>
            </form>
        </div>
    </div>

    @include('pages.footer')