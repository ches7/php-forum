<x-app-layout>

    <div class="flex justify-center">
    
        <div class="flex flex-col w-1/2">

    <form method="POST" action="/posts" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
            <div class="">
                <h2 class="text-base font-semibold leading-7 mt-4 ml-2">Create Post</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="title" class="block text-sm font-medium leading-6 ml-2">Title</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" autocomplete="title"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('title')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="tags" class="block text-sm font-medium leading-6 ml-2">Tags (separate by comma)</label>
                        <div class="mt-2">
                            <input type="text" name="tags" id="tags" autocomplete="tags"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('tags')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
                    </div>

                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 ml-2">Body</label>
                        <div class="mt-2">
                            <textarea id="body" name="body" rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        @error('body')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
                    </div>


                </div>
            </div>


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
    </form>

        </div>
    </div>
</x-app-layout>
