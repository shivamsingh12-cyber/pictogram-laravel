@include('pages.header')
@include('navigation.usernav')
@if(session()->has('success'))
<div class="alert alert-success">{{session()->get('success')}}</div>
@endif

    <div class="container col-9 rounded-0 d-flex justify-content-between">
        <div class="col-8">
         @foreach ($posts as $post)
         <div class="card mt-4">
            <div class="card-title d-flex justify-content-between  align-items-center">

                <div class="d-flex align-items-center p-2">
                    <img src="./storage/{{$post->profile_pic}}" alt="" height="30" class="rounded-circle border">&nbsp;&nbsp;{{$post->first_name}} {{$post->last_name}}
                </div>
                <div class="p-2">
                    <i class="bi bi-three-dots-vertical"></i>
                </div>
            </div>
            <img src="./storage/{{$post->post_img}}" class="" alt="..."  height="600">
            <h4 style="font-size: x-larger" class="p-2 border-bottom"><i class="bi bi-heart"></i>&nbsp;&nbsp;<i
                    class="bi bi-chat-left"></i>
            </h4>
            <div class="card-body">
                {{$post->post_text}}

            </div>

            <div class="input-group p-2 border-top">
                <input type="text" class="form-control rounded-0 border-0" placeholder="say something.."
                    aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-primary rounded-0 border-0" type="button"
                    id="button-addon2">Post</button>
            </div>

        </div>
         @endforeach
          
        

        </div>

        <div class="col-4 mt-4 p-3">
            <div class="d-flex align-items-center p-2">
                <div>
                    {{-- <img src="/storage/{{Auth::user()->profile_pic}}" alt="" height="60" class="rounded-circle border"> --}}
                    @php
                    if (!isset(Auth()->user()->profile_pic)) {
                        echo '<img src="/img/default_pic.jpg" alt="" height="60" class="rounded-circle border">';
                    }
                    else{

                    //    echo "<img src='/storage/".{{Auth::user()->profile_pic}}'  height='30' class='rounded-circle border'>";
                       echo '<img src="/storage/'.Auth()->user()->profile_pic.'" alt="" height="60" class="rounded-circle border">';
                    }
                @endphp
                </div>
                <div>&nbsp;&nbsp;&nbsp;</div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h6 style="margin: 0px;">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h6>
                    <p style="margin:0px;" class="text-muted"><span>@</span>{{Auth::user()->username}}</p>
                </div>
            </div>
            <div>
                <h6 class="text-muted p-2">You Can Follow Them</h6>
                @foreach ($users as $user)   
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="/storage/{{$user->profile_pic}}" alt="" height="40" class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 style="margin: 0px;font-size: small;">{{$user->first_name}} {{$user->last_name}}</h6>
                            <p style="margin:0px;font-size:small" class="text-muted">{{'@'.$user->username}}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-primary">Follow</button>

                    </div>
                </div>
                @endforeach
         


            </div>
        </div>
    </div>
    @include('pages.footer')