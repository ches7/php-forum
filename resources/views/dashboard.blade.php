<x-app-layout>

  <div class="flex justify-center">
    
    <div class="flex flex-col w-1/2">


      @unless (count($posts) == 0)

      <div class="flex mt-4 justify-center">
      Your posts
      </div>

      <ul role="list" class="divide-y divide-gray-100">

          @foreach ($posts as $post)
              <li class="flex justify-between gap-x-6 py-5">
                  <div class="flex min-w-0 gap-x-4">
                      <div class="min-w-0 flex-auto">
                          <a href="/posts/{{ $post->id }}">
                              <p class="text-sm font-semibold leading-6 text-gray-900">{{ $post->title }}</p>
                          </a>
                          {{-- <a href="/users/{{ $post->user_id }}">
                              <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $post->user->name }}</p>
                          </a> --}}
                      </div>
                  </div>
                  <div class="hidden shrink-0 sm:flex sm:items-end mr-2">

                    <x-heroicon-o-chat-bubble-left class="w-6 h-6 mb-0.5"/>
                    
                <p class="text-sm leading-6 text-gray-900 pl-1 mr-2 mb-1">{{ count($post->replies) }}</p>

                    <a href="/posts/{{ $post->id }}/edit">
                        <x-heroicon-o-pencil-square class="w-6 h-6 mb-1.5 mr-1"/>
                    </a>
        

                    <form method="POST" action="/posts/{{ $post->id }}">
                        @csrf
                        @method('DELETE')
                        <button><x-heroicon-o-trash class="w-6 h-6 mr-1 text-red-500"/></button>
                    </form>

                </div>
              </li>
          @endforeach

      </ul>
  @endunless


  @unless (count($users) == 0)

  <div class="flex mt-4 justify-center">
  Your messages
  </div>

  <ul role="list" class="divide-y divide-gray-100">

      @foreach ($users as $user)
          <li class="flex justify-between gap-x-6 py-5">
              <div class="flex min-w-0 gap-x-4">
                      <a href="/users/{{ $user->id }}">
                          <p class="text-sm font-semibold leading-6 mt-2">{{ $user->name }}</p>
                      </a>
                  </div>
              <div class="mr-2">

                <a href="/messages/{{ $user->id }}" class="">
                  <x-heroicon-o-chat-bubble-left-right class="w-6 h-6 mb-1.5 mr-1"/>
                </a>

            </div>
          </li>
      @endforeach

  </ul>

@endunless

<a href="/posts/create" class="flex mt-4 justify-center">
    <p class="bg-blue-500 p-2 rounded">Create post</p>
    </a>

    </div>
  </div>
</x-app-layout>
