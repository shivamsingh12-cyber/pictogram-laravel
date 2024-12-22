@include('pages.header')
    <div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form method="POST" action="">
                @csrf
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Verify Your Email Id</h1>
                @if(session()->has('sent'))
                <div class="alert alert-success">{{session()->get('sent')}}</div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
               <b>{{Auth::user()->email}}</b>
                <p>Enter 6 Digit Code Sended to You</p>
                <div class="form-floating mt-1">

                    <input type="password" class="form-control rounded-0" name="verify" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">######</label>
                    <span class="text-danger"> <small>@error('verify')
                        {{$message}}
                        @enderror </small></span>
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    {{-- <button class="btn btn-primary" type="submit">Resend Code</button> --}}
                    <button class="btn btn-primary" type="submit" name="submit" value="submit">Verify Email</button>





                </div>
                <br>
                <a href="logout" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i>
                    Logout</a>
            </form>
        </div>
    </div>


    @include('pages.footer')