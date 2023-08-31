<x-app-layout>
    <div class="flex justify-center">
    
        <div class="flex flex-col w-1/2">
    <form method="POST" action="/posts/{{ $post->id }}/{{ $reply->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-12">
            <div>
                <h2 class="text-base font-semibold leading-7 mt-4 ml-2">Edit reply</h2>



                <div class="col-span-full">
                    <div class="mt-2">
                        <textarea id="reply_body" name="reply_body" rows="3"
                            class="mt-4 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    {{ $reply->reply_body }}
                                    </textarea>
                    </div>
                    @error('reply_body')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Reply</button>
                </div>


            </div>
        </div>
    </form>
        </div>
    </div>
</x-app-layout>
