<x-app-layout>

    <div class="flex justify-center">
        <div class="flex flex-col w-1/2">

            <div class="border rounded-md mt-4">

                    <div class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4 ml-3">
                            <a href="/users/{{ $post->user_id }}">
                                <p class="font-semibold">{{ $post->user->name }}</p>
                            </a>         
                               
                        </div>

                        @if ($post->user_id === auth()->id())

                        <div class="hidden shrink-0 sm:flex sm:items-end mr-2">
                            
                            <a href="/posts/{{ $post->id }}/edit">
                                <x-heroicon-o-pencil-square class="w-6 h-6 mb-1.5 mr-1"/>
                            </a>
                

                            <form method="POST" action="/posts/{{ $post->id }}">
                                @csrf
                                @method('DELETE')
                                <button><x-heroicon-o-trash class="w-6 h-6 mr-1 text-red-500"/></button>
                            </form>

                        </div>

                        @endif

                    </div>

                    <div class="bg-gray-200 ml-3 mr-3 rounded">
                            <p class="text-lg font-semibold leading-6 ml-1 mr-1">{{ $post->title }}</p>    
                    </div>

                    <div class="mt-2 ml-3 mr-3">
                        {{ $post->body }}
                    </div>

                    <div class="flex mb-4 mt-2 ml-3 mr-3">
                        @php
                         $tags = explode(',', $post->tags);   
                        @endphp

                        @foreach($tags as $tag)
                    <p class="text-xs font-bold pl-1 pr-1 bg-blue-300 rounded mr-1">
                     <a href="/?tag={{$tag}}">  {{ $tag }} </a>
                    </p>
                    @endforeach
                    </div>
            </div>


                @unless (count($replies) == 0)

                    @foreach ($replies as $reply)
            <div class="border rounded-md mt-4">

                <div class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4 ml-3">
                        <a href="/users/{{ $reply->user_id }}">
                            <p class="font-semibold">{{ $reply->user->name }}</p>
                        </a>         
                           
                    </div>

                    @if ($reply->user_id === auth()->id())

                    <div class="hidden shrink-0 sm:flex sm:items-end mr-2">
                            
                        <a href="/posts/{{ $post->id }}/{{ $reply->id }}/edit">
                            <x-heroicon-o-pencil-square class="w-6 h-6 mb-1.5 mr-1"/>
                        </a>
            

                        <form method="POST" action="/posts/{{ $post->id }}/{{ $reply->id }}">
                            @csrf
                            @method('DELETE')
                            <button><x-heroicon-o-trash class="w-6 h-6 mr-1 text-red-500"/></button>
                        </form>

                    </div>

                    @endif

                </div>

                <div class="ml-3 mr-3 mb-4">
                    {{ $reply->reply_body }}
                </div>
        </div>
        @endforeach
                @else
                    <p>No replies found</p>
                @endunless
                    


            <div>
                <form method="POST" action="/posts/{{ $post->id }}/replies" enctype="multipart/form-data">
                    @csrf
                    <div class="col-span-full">
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
