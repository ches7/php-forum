<x-app-layout>
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

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

                      <a href="/users/{{$post->user_id}}">
                        {{$post->user->name}}
                      </a>
                    </div>
                </div>

                @endforeach
            
                @else
                <p>No posts found</p>
                @endunless
            
              </div>
            
              <div class="mt-6 p-4">
                {{$posts->links()}}
              </div>


                </div>
            </div>
        </div>
</x-app-layout>
