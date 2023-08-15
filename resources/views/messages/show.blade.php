<x-app-layout>
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @unless(count($messages) == 0)

    @foreach($messages as $message)

    <div class="flex">
        <div>
          {{-- <h3 class="text-2xl"> --}}
            {{-- <a href="/posts/{{$post->id}}">{{$post->title}}</a> --}}
          {{-- </h3> --}}
          <div class="text-xl font-bold mb-4">{{$message->sender_id}}</div>
          <div class="text-xl font-bold mb-4">{{$message->body}}</div>
        </div>
    </div>

    @endforeach

    @else
    <p>No messages found</p>
    @endunless


    <div>
        <form method="POST" action="/messages/{{ $user }}" enctype="multipart/form-data">
            @csrf
            <div class="col-span-full">
                <div class="mt-2">
                    <textarea id="body" name="body" rows="3"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                @error('body')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send</button>
            </div>
        </form>
    </div>

</div>
</x-app-layout>