@extends('layout.main_layout')
@section('custom-script')

    <script>
        $(document).ready(function () {
            $('.like-button').click(function () {
                const authId = @json(auth()->user() ? auth()->user()->id : 0);
                let id = $(this).attr('id')
                let likedItem = $(this)
                let likesCountElem = $(`.likes-count-${id}`)
                $.ajax({
                    type: 'post',
                    url: `blogs/like/${id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        likedId: id
                    },
                    success: function (data) {
                        let hasAuthId = data.data?.blogLikes?.some(item => item.id == authId);
                        if(hasAuthId) {
                            likedItem.addClass('liked')
                        }else {
                            likedItem.removeClass('liked')
                        }
                        likesCountElem.text(`likes : ${data.data.blogLikes.length}`)
                    },
                });
            });

            $('.like-button').hover(
                function() {
                    $(this).css('cursor','pointer');
                }, function() {
                }
            );
        })
    </script>
@stop
@section('custom-style')
    <style>
        .liked{
            color: red;
        }
    </style>
@stop
@section('body')
    <div style="
        text-align: center;
        display: flex;
        justify-content: center;">
        <div class="d-flex" style="width: 30%; margin-top: 30px">
            <form action="{{route('blogs.index')}}" method="get" class="d-flex" style="width: 100%">

                @csrf
                <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                <input type="submit" value="Search" style="width: 30%;
                                                border-radius: 10%;
                                                border: unset;" >
            </form>
        </div>
    </div>

    <div class="d-flex " style="flex-wrap: wrap;">
        @foreach($blogs as $blog )
{{--            @dd($blog->likes->contains(auth()->id()))--}}

        <div class="card" style="width: 30%;margin: 10%;">
            <img class="card-img-top" src="{{asset("storage/images/{$blog->image}")}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-between">{{$blog->name}}
                    <div>
                        <span class="likes-count-{{$blog->id}}">
                            likes: {{$blog->likes->count()}}
                        </span>
                        @if(auth()->check())
                            <i class="fa fa-heart card-text like-button {{$blog->likes->contains(auth()->id()) ? 'liked' : ''}}" id="{{$blog->id}}" aria-hidden="true"></i>
                        @endif
                    </div>
                </h5>
                <p class="card-text">{{$blog->description}}</p>
            </div>
        </div>
    @endforeach
            <div class="float-sm-right" style="margin-left: 10%">
                {!! $blogs->links() !!}
            </div>

    </div>

@stop
