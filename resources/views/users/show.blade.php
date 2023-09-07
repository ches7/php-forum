<x-app-layout>
  <div class="flex justify-center">
    
    <div class="flex flex-col w-1/2">

      <div class="flex mt-4 justify-center">
        <div class="border rounded p-4">
        <p>
        {{$user->name}}
        </p>
        <p>
        Joined: {{$user->created_at->format('d m Y')}}
        </p> 
        <p>
        Posts: {{count($posts)}}
        </p>
        <p>
        Replies: {{count($replies)}}
        </p>
      </div>
      </div>

      <a href="/messages/{{ $user->id }}" class="flex mt-4 justify-center">
      <p class="bg-blue-500 p-2 rounded" href="/">Message user</p>
      </a>

      @unless (count($posts) == 0)

          <ul role="list" class="divide-y divide-gray-100">

              @foreach ($posts as $post)
                  <li class="flex justify-between gap-x-6 py-5">
                      <div class="flex min-w-0 gap-x-4">
                          <div class="min-w-0 flex-auto">
                              <a href="/posts/{{ $post->id }}">
                                  <p class="text-sm font-semibold leading-6 text-gray-900">{{ $post->title }}</p>
                              </a>
                              <a href="/users/{{ $post->user_id }}">
                                  <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $post->user->name }}</p>
                              </a>
                          </div>
                      </div>
                      <div class="hidden shrink-0 sm:flex sm:items-end">
                        <x-heroicon-o-chat-bubble-left class="w-6 h-6"/>
                          <p class="text-sm leading-6 text-gray-900 pl-2">{{ count($post->replies) }}</p>
                      </div>
                  </li>
              @endforeach

          </ul>
      @else
          <p>No posts found</p>
      @endunless

      <div class="mt-6 p-4">
          {{ $posts->links() }}
      </div>

  </div>
  </div>
</x-app-layout>