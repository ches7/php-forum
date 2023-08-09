<x-app-layout>

    <div class="flex justify-center">
        <div class="flex flex-col w-1/2">

            <div class="border rounded-md mt-4">
                <ul role="list" class="divide-y divide-gray-100">
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4 ml-2">
                            <div class="min-w-0 flex-auto">
                                <a href="/posts/{{ $post->id }}">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">{{ $post->title }}</p>
                                </a>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:items-end mr-2">
                            <a href="/users/{{ $post->user_id }}">
                                <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $post->user->name }}</p>
                            </a>
                        </div>
                    </li>
                    <div class="text-xl font-bold mb-4">{{ $post->tags }}</div>

                    <div class="text-lg mt-4">
                        {{ $post->body }}
                    </div>
                </ul>
            </div>


            <a href="/posts/{{ $post->id }}/edit">
                <i class="fa-solid fa-pencil"></i> Edit
            </a>

            <form method="POST" action="/posts/{{ $post->id }}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>

            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

                @unless (count($replies) == 0)

                    @foreach ($replies as $reply)
                        <div class="flex">
                            <div>
                                <div class="text-lg mt-4">
                                    {{ $reply->reply_body }}
                                </div>
                                <a href="/users/{{ $reply->user_id }}">
                                    {{ $reply->user->name }}
                                </a>
                                <a href="/posts/{{ $post->id }}/{{ $reply->id }}/edit">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </a>
                                <form method="POST" action="/posts/{{ $post->id }}/{{ $reply->id }}">
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

            <div>
                <form method="POST" action="/posts/{{ $post->id }}/replies" enctype="multipart/form-data">
                    @csrf
                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Reply</label>
                        <div class="mt-2">
                            <textarea id="reply_body" name="reply_body" rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        @error('reply_body')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Reply</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
</x-app-layout>
