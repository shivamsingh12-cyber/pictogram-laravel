@includeIf("pages.header")
{{-- <pre>
    @php
        print_r($errors);
    @endphp
</pre> --}}
<div class="login">
    <div class="col-4 bg-white border rounded p-4 shadow-sm">
        <form action="" method="POST">
            @csrf
            <div class="d-flex justify-content-center">

                <img class="mb-4" src="img/pictogram.png" alt="" height="45">
            </div>
            <h1 class="h5 mb-3 fw-normal">Create new account</h1>
            <div class="d-flex">
                <div class="form-floating mt-1 col-6 ">
                    <input type="text" class="form-control rounded-0 @error('first_name') is-invalid  @enderror" placeholder="First Name" name="first_name" value="{{ old('first_name') }}">
                    <label for="floatingInput">first name</label>
                    <span class="text-danger"> <small>@error('first_name')
                        {{$message}}
                    @enderror </small></span>
                </div>
                <div class="form-floating mt-1 col-6">
                    <input type="text" class="form-control rounded-0 @error('last_name') is-invalid  @enderror" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                    <label for="floatingInput">last name</label>
                    <span class="text-danger"> <small>@error('last_name')
                        {{$message}}
                    @enderror </small></span>
                </div>
            </div>
            <div class="d-flex gap-3 my-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="exampleRadios1"
                        value="1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="exampleRadios3"
                        value="0">
                    <label class="form-check-label" for="exampleRadios3">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="exampleRadios2"
                        value="2">
                    <label class="form-check-label" for="exampleRadios2">
                        Other
                    </label>
                </div>
            </div>
            <div class="form-floating mt-1">
                <input type="email" class="form-control rounded-0 @error('email') is-invalid  @enderror" placeholder="username/email" name="email" value="{{ old('email') }}">
                <label for="floatingInput">email</label>
                <span class="text-danger"> <small>@error('email')
                    {{$message}}
                @enderror </small></span>
            </div>
            <div class="form-floating mt-1">
                <input type="text" class="form-control rounded-0 @error('username') is-invalid  @enderror" placeholder="username/email" name="username" value="{{ old('username') }}">
                <label for="floatingInput">username</label>
                <span class="text-danger"> <small>@error('username')
                    {{$message}}
                @enderror </small></span>
            </div>
            <div class="form-floating mt-1">
                <input type="password" class="form-control rounded-0 @error('userpass') is-invalid  @enderror" id="floatingPassword" placeholder="Password" name="userpass" value="{{ old('userpass') }}">
                <label for="floatingPassword">password</label>
                <span class="text-danger"> <small>@error('userpass')
                    {{$message}}
                @enderror </small></span>
            </div>

            <div class="mt-3 d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" type="submit" name="submit" value="submit">Sign Up</button>
                <a href="{{url('/login')}}" class="text-decoration-none">Already have an account ?</a>
            </div>

        </form>
    </div>
</div>
@includeIf("pages.footer")