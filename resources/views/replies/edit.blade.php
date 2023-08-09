<x-app-layout>
    <form method="POST" action="/posts/{{ $post->id }}/{{ $reply->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Create Post</h2>



                <div class="col-span-full">
                    <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Reply</label>
                    <div class="mt-2">
                        <textarea id="reply_body" name="reply_body" rows="3"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
</x-app-layout>
