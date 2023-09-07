<x-app-layout>
    <div class="flex justify-center">
        <div class="flex flex-col w-1/2">

            <form action="/">
                <div class="relative border-2 border-gray-100 m-4 rounded-lg">
                  <div class="absolute top-4 left-3">
                    <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
                  </div>
                  <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                    placeholder="Search Forum Posts..." />
                  <div class="absolute top-2 right-2">
                    <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">
                      Search
                    </button>
                  </div>
                </div>
              </form>

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

            <a href="/posts/create" class="flex mt-4 justify-center">
                <p class="bg-blue-500 p-2 rounded">Create post</p>
                </a>

        </div>

    </div>
</x-app-layout>
