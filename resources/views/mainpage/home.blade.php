
@include('pages.header')
@include('navigation.usernav')
@include('navigation.sidebar')
@if(session()->has('success'))
<div class="alert alert-success">{{session()->get('success')}}</div>
@endif

    <div class="container col-9 rounded-0 d-flex justify-content-between">
        <div class="col-8">
            @if (count($posts)<1)
             {!!'<h3 class="mt-5 p-2 boder rounded shadow text-center"><i class="bi bi-hand-thumbs-down-fill"></i> Currently no posts to see! Please follow or add someone </h3>'!!}
            @endif
         @foreach ($posts as $post)
    
      
         <div class="card mt-4">
            <div class="card-title d-flex justify-content-between  align-items-center">

                <div class="d-flex align-items-center p-2">
                    @php
                    if (empty($post->profile_pic)) {
                        echo '<a href="/mainprofile/'.$post->username.'" class="text-decoration-none text-dark"><img src="/img/default_pic.jpg" alt="" height="30" class="rounded-circle border">&nbsp;&nbsp;'.$post->first_name.' '.$post->last_name.'</a>';
                    }
                    else
                    echo "<a href='/mainprofile/$post->username' class='text-decoration-none text-dark'><img src='./storage/$post->profile_pic'  height='30' class='rounded-circle border'>&nbsp;&nbsp;".$post->first_name.' '.$post->last_name.'</a>';                    
                @endphp
                    
                </div>
                {{-- <div class="p-2">
                    <i class="bi bi-three-dots-vertical"></i>   
                </div> --}}
            </div>  
            <img src="./storage/{{$post->post_img}}" class="" alt="..."  height="600">
            <h4 style="font-size: x-larger" class="p-2 border-bottom">
                <span>
                @php
                $likes=getlikecount($post->postid);
                $comm=getallcomments($post->postid);
                if (checklikestatus($post->postid)){
                        $like_btn_display='none';
                        $unlike_btn_display='';
                }
                else {
                    $like_btn_display='';
                    $unlike_btn_display='none';
                }
                @endphp
                    <i class="bi bi-heart-fill unlike_btn" style="display: {{$unlike_btn_display}}" data-post-id={{$post->postid}}></i>
                    <i class="bi bi-heart like_btn"  style="display: {{$like_btn_display}}" data-post-id={{$post->postid}} data-user-id="{{$post->user_id}}"></i>
                </span>
              
                &nbsp;&nbsp;<i
                    class="bi bi-chat-left"></i>
            </h4>
            <div>
                <span class="mx-2" data-bs-toggle="modal" data-bs-target="#likes{{$post->postid}}">   {!! count($likes) !!} likes</span> 
                <span class="mx-2" data-bs-toggle="modal"  data-bs-target="#postview{{$post->postid}}">   {!! count($comm) !!} comments</span> 
            </div>
            <div class="card-body">
                {{$post->post_text}}
             
            </div>

            <div class="input-group p-2 border-top">
                <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.."
                aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section{{$post->postid}}" data-post-id="{{$post->postid}}" type="button"
                id="button-addon2" >Post</button>
            </div>

        </div>

        {{-- commentsofpeople --}}
        <div class="modal fade" id="postview{{$post->postid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
    
                    <div class="modal-body d-flex p-0">
                        <div class="col-8">
                            <img src="/storage/{{$post->post_img}}" class="w-100 rounded-start">
                        </div>
    
    
    
                        <div class="col-4 d-flex flex-column">
                            <div class="d-flex align-items-center p-2 border-bottom">
                                <div><img src="/storage/{{$post->profile_pic}}" alt="" height="50" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-center">
                                    <h6 style="margin: 0px;">{{$post->first_name}} {{$post->last_name}}</h6>
                                    <p style="margin:0px;" class="text-muted">{{'@'.$post->username}}</p>
                                </div>
                            </div>
                            <div class="flex-fill align-self-stretch overflow-auto" id="comment-section{{$post->postid}}" style="height: 100px;">        
                                
                                @php
                                    $comments=getallcomments($post->postid);
                                    if (count($comments)<1) {
                                        echo "<p class='text-center my-3 nce'>there is no comments!!</p>";
                                    }
                                @endphp
                                    @foreach ($comments as $comment)
                                       @php
                                           $cuser=getallUser($comment['user_id']);
                                       @endphp 
                                   
                                    <div class="d-flex align-items-center p-2">
                                    <div>
                                        @if (empty($cuser['profile_pic']))

                                        <img src="/img/default_pic.jpg" alt="" height="40" class="rounded-circle border">
                                            @else
                                        <img src="/storage/{{$cuser['profile_pic']}}" alt="" height="40" class="rounded-circle border">
                                        @endif
                                    </div>
                                    <div>&nbsp;&nbsp;&nbsp;</div>
                                    <div class="d-flex flex-column justify-content-start align-items-start">
                                        <h6 style="margin: 0px;"><a href="/mainprofile/{{$cuser['username']}}" class="text-decoration-none text-dark">{{'@'.$cuser['username']}}</a></h6>
                                        <p style="margin:0px;" class="text-muted">{{$comment['comment']}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="input-group p-2 border-top">
                                <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.."
                                    aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page="wall" data-cs="comment-section{{$post->postid}}" data-post-id="{{$post->postid}}" type="button"
                                    id="button-addon2" >Post</button>
                            </div>
                        </div>
    
    
    
                    </div>
    
                </div>
            </div>
        </div>

   
        {{-- likescountofpeople --}}
        <div class="modal fade" id="likes{{$post->postid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Likes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- @if (empty($post->id))
                        {{'No Followings!'}}
                    @endif  --}}
                        @if (count($likes)<1)
                            {{'No likes'}}
                        @endif
                
                     @foreach ($likes as  $u)
                    @php
                        $allusers=getallUser($u['user_id']);
                    @endphp
                  
                         {{-- @php
                             dd($u->profile_pic);
                         @endphp --}}
                     <div class="d-flex justify-content-between">
                         <div class="d-flex align-items-center p-2">
                             @if (!empty($allusers['profile_pic']))
                             <div><img src="/storage/{{$allusers['profile_pic']}}" alt="" height="40" class="rounded-circle border">   
                             @else
                                 <div><img src="/img/default_pic.jpg" alt="" height="40" class="rounded-circle border">
                             @endif
                             </div>
                             <div>&nbsp;&nbsp;</div>
                             <div class="d-flex flex-column justify-content-center">
                               <a href="/mainprofile/{{$allusers['username']}}" class="text-decoration-none text-dark">  <h6 style="margin: 0px;font-size: small;">{{$allusers['first_name']}} {{$allusers['last_name']}}</h6> </a> 
                                 <p style="margin:0px;font-size:small" class="text-muted">{{'@'.$allusers['username']}}</p>
                             </div>
                         </div>
                         <div class="d-flex align-items-center">
                            
                            @if ( checkfollowstatus(Auth()->id(),$u['user_id']))
                            <button class="btn btn-sm btn-danger unfollowbtn" data-user-id={{$allusers['id']}}>UnFollow</button>
                            @elseif ($u['user_id']==Auth()->id())
                            {{-- <button class="btn btn-sm btn-primary followbtn" data-user-id={{$f->user_id}}>Follow</button> --}}
                            @else
                            <button class="btn btn-sm btn-primary followbtn" data-user-id={{$allusers['id']}}>Follow</button>
                            @endif
                            
                            {{-- <button class="btn btn-sm btn-primary followbtn" data-user-id={{$following->id}}>Follow</button> --}}
                            
        
                         </div>
                     </div>
          
                @endforeach
                   
                   </div>
                </div>
            </div>
          </div>
         @endforeach
          
        

        </div>

        <div class="col-4 mt-4 p-3">
            <div class="d-flex align-items-center p-2">
                <div>
                    {{-- <img src="/storage/{{Auth::user()->profile_pic}}" alt="" height="60" class="rounded-circle border"> --}}
                    @php
                    if (empty(Auth()->user()->profile_pic)) {
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
                   <a href="/mainprofile/{{Auth::user()->username}}" class="text-decoration-none text-dark"> <h6 style="margin: 0px;">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h6> </a> 
                    <p style="margin:0px;" class="text-muted"><span>@</span>{{Auth::user()->username}}</p>
                </div>
            </div>
            <div>
                <h6 class="text-muted p-2">You Can Follow Them</h6>
                @foreach ($users as $user)   
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        @if (empty($user->profile_pic))
                          <div><img src="/img/default_pic.jpg" alt="" height="40" class="rounded-circle border">
                         @else
                            <div><img src="/storage/{{$user->profile_pic}}" alt="" height="40" class="rounded-circle border">   
                        @endif
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                          <a href="/mainprofile/{{$user->username}}" class="text-decoration-none text-dark">  <h6 style="margin: 0px;font-size: small;">{{$user->first_name}} {{$user->last_name}}</h6> </a> 
                            <p style="margin:0px;font-size:small" class="text-muted">{{'@'.$user->username}}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-primary followbtn" data-user-id="{{$user->id}}">Follow</button>

                    </div>
                </div>
                @endforeach
                @if (count($users)<1)
                    {!!'<p class="p-2 boder rounded shadow text-center">No suggestions for you! </p>'!!}
                @endif
         


            </div>
        </div>
    </div>
    @include('pages.footer')