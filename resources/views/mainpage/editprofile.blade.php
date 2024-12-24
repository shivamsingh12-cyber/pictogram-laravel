@include('pages.header')
@include('navigation.usernav')
    <div class="container col-9 rounded-0 d-flex justify-content-between">
        <div class="col-12 bg-white border rounded p-4 mt-4 shadow-sm">
            <form action="{{route('edit_profile')}}" method="POST" >
                @csrf
                <div class="d-flex justify-content-center">
                    @if(session()->has('success'))
                    <div class="alert alert-success">{{session()->get('success')}}</div>
                    @endif
                </div>
                <h1 class="h5 mb-3 fw-normal">Edit Profile</h1>
             
                <div class="form-floating mt-1 col-6">
                    <img src="img/{{Auth::user()->profile_pic}}" class="img-thumbnail my-3" style="height:150px;" alt="...">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Change Profile Picture</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-floating mt-1 col-6 ">
                        <input type="text" class="form-control rounded-0" placeholder="username/email" name="first_name" value="{{Auth::user()->first_name}}">
                        <label for="floatingInput">first name</label>
                    </div>
                    <div class="form-floating mt-1 col-6">
                        <input type="text" class="form-control rounded-0" name="last_name" value="{{Auth::user()->last_name}}" placeholder="username/email">
                        <label for="floatingInput">last name</label>
                    </div>
                </div>
                <div class="d-flex gap-3 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1"
                            value="1" @php
                              echo  Auth::user()->gender==1?'checked':''
                            @endphp>
                        <label class="form-check-label" for="exampleRadios1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios3"
                            value="0" @php
                            echo  Auth::user()->gender==0?'checked':''
                          @endphp>
                        <label class="form-check-label" for="exampleRadios3">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios2"
                            value="2" @php
                            echo  Auth::user()->gender==2?'checked':''
                          @endphp>
                        <label class="form-check-label" for="exampleRadios2">
                            Other
                        </label>
                    </div>
                </div>
                <div class="form-floating mt-1">
                    <input type="email" class="form-control rounded-0" placeholder="username/email" value="{{Auth::user()->email}}" readonly>
                    <label for="floatingInput">email</label>
                </div>
                <div class="form-floating mt-1">
                    <input type="text" class="form-control rounded-0" placeholder="username/email" name="username" value="{{Auth::user()->username}}">
                    <label for="floatingInput">username</label>
                </div>
                <div class="form-floating mt-1">
                    <input type="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">password</label>
                </div>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit" name="submit" value="submit">Update Profile</button>



                </div>

            </form>
        </div>

    </div>
 @include('pages.footer')