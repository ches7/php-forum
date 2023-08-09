<x-app-layout>
    <div>
        {{$user->name}}
        joined: {{$user->created_at}}
        total posts: {{count($posts)}}
        total replies: {{count($replies)}}
    </div>

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($posts) == 0)
    
        @foreach($posts as $post)

        <div class="flex">
            <div>
              <h3 class="text-2xl">
                <a href="/posts/{{$post->id}}">{{$post->title}}</a>
              </h3>
              <div class="text-xl font-bold mb-4">{{$post->tags}}</div>
              
              <div class="text-lg mt-4">
                 {{$post->body}}
              </div>

              <div class="text-lg mt-4">
                {{$post->user->name}}
             </div>
            </div>
        </div>

        @endforeach
    
        @else
        <p>No posts found</p>
        @endunless
    
    </div>

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($replies) == 0)
      
        @foreach($replies as $reply)
      
        <div class="flex">
            <div>
              {{-- <h3 class="text-2xl">
                <a href="/posts/{{$post->id}}">{{$post->title}}</a>
              </h3> --}}
              {{-- <div class="text-xl font-bold mb-4">{{$post->tags}}</div> --}}
              
              <div class="text-lg mt-4">
                 {{$reply->reply_body}}
              </div>
              <div class="text-lg mt-4">
                {{$reply->user->name}}
             </div>
              <a href="/posts/{{$post->id}}/{{$reply->id}}/edit">
                <i class="fa-solid fa-pencil"></i> Edit
              </a>
              <form method="POST" action="/posts/{{$post->id}}/{{$reply->id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
      
        @endforeach
      
        @else
        <p>No replies found</p>
        @endunless
      
      </div>
</x-app-layout>