<x-app-layout>
    <div class="flex justify-center">
        <div class="flex flex-col w-1/2">

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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                </svg>
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
