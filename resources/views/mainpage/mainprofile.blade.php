@include('pages.header')
@include('navigation.usernav')

@foreach ($userdata as $user )
    <div class="container col-9 rounded-0">
        <div class="col-12 rounded p-4 mt-4 d-flex gap-5">
            <div class="col-4 d-flex justify-content-end align-items-start">
                @if (empty($user->profile_pic))
                <img src="/img/default_pic.jpg" class="img-thumbnail rounded-circle my-3" style="height:170px;" alt="...">
                {{-- <div><img src="/img/default_pic.jpg" alt="" height="40" class="rounded-circle border"> --}}
               @else
               <img src="/storage/{{$user->profile_pic}}" class="img-thumbnail rounded-circle my-3" style="height:170px;" alt="...">
                  {{-- <div><img src="/storage/{{$user->profile_pic}}" alt="" height="40" class="rounded-circle border">    --}}
              @endif
                {{-- <img src="/storage/{{$user->profile_pic}}" class="img-thumbnail rounded-circle my-3" style="height:170px;" alt="..."> --}}
            </div>
            <div class="col-8">
                <div class="d-flex flex-column">
                        
                   
                    <div class="d-flex gap-5 align-items-center">
                        <span style="font-size: xx-large;">{{$user->first_name}} {{$user->last_name}}</span>
                        @if ($user->id!=Auth()->id())   
                        <div class="dropdown">
                            <span class="" style="font-size:xx-large" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-chat-fill"></i> Message</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-x-circle-fill"></i> Block</a></li>
                            </ul>
                        </div>
                        @endif

                    </div>
                    <span style="font-size: larger;" class="text-secondary">{{'@'.$user->username}}</span>
                    <div class="d-flex gap-2 align-items-center my-3">

                        <a class="btn btn-sm btn-primary"><i class="bi bi-file-post-fill"></i> {{count($posts)}} Posts</a>
                        <a class="btn btn-sm btn-primary"><i class="bi bi-people-fill"></i> {{count($followers)}} Followers</a>
                        <a class="btn btn-sm btn-primary"><i class="bi bi-person-fill"></i> {{count($followings)}} Following</a>

                      
                    </div>

                    <div class="d-flex gap-2 align-items-center my-1">

                       @if ($user->id!=Auth()->id())
                            @if(count($followstatus)<1)
                            <button class="btn btn-sm btn-primary followbtn" data-user-id={{$user->id}}>Follow</button>
                            @else
                            <button class="btn btn-sm btn-danger unfollowbtn" data-user-id={{$user->id}}>Unfollow</button>
                            @endif
                       @endif

                      
                    
                       
                     
                     



                    </div>
                </div>
            </div>

            
        </div>
        <h3 class="border-bottom" style="display: flex; justify-content: center;"> All Posts</h3>
        <div class="gallery d-flex flex-wrap position-relative  gap-2 mb-4">
            @if (count($posts)<1)
                {!!"<h1 class='mt-5 p-2 boder rounded shadow text-center position-absolute top-0 start-50 translate-middle-x'>Nothing to see here </h1>" !!}
            @endif
                @foreach ($posts as $post )
                <img src="/storage/{{$post->post_img}}" width="300px" class="rounded" />
                           
                @endforeach
            </div>
            
            
            
            
        </div>
        
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body d-flex p-0">
                    <div class="col-8">
                        <img src="img/post2.jpg" class="w-100 rounded-start">
                    </div>



                    <div class="col-4 d-flex flex-column">
                        <div class="d-flex align-items-center p-2 border-bottom">
                            <div><img src="./img/profile.jpg" alt="" height="50" class="rounded-circle border">
                            </div>
                            <div>&nbsp;&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-start align-items-center">
                                <h6 style="margin: 0px;">Monu Giri</h6>
                                <p style="margin:0px;" class="text-muted">@oyeitsmg</p>
                            </div>
                        </div>
                        <div class="flex-fill align-self-stretch overflow-auto" style="height: 100px;">

                            <div class="d-flex align-items-center p-2">
                                <div><img src="./img/profile2.jpg" alt="" height="40" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <h6 style="margin: 0px;">@osilva</h6>
                                    <p style="margin:0px;" class="text-muted">its nice pic very good</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center p-2">
                                <div><img src="./img/profile2.jpg" alt="" height="40" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <h6 style="margin: 0px;">@osilva</h6>
                                    <p style="margin:0px;" class="text-muted">its nice pic very good</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center p-2">
                                <div><img src="./img/profile2.jpg" alt="" height="40" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <h6 style="margin: 0px;">@osilva</h6>
                                    <p style="margin:0px;" class="text-muted">its nice pic very good</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center p-2">
                                <div><img src="./img/profile2.jpg" alt="" height="40" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <h6 style="margin: 0px;">@osilva</h6>
                                    <p style="margin:0px;" class="text-muted">its nice pic very good</p>
                                </div>
                            </div>

                        </div>
                        <div class="input-group p-2 border-top">
                            <input type="text" class="form-control rounded-0 border-0" placeholder="say something.."
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary rounded-0 border-0 " type="button"
                                id="button-addon2" >Post</button>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>
@endforeach
@include('pages.footer')