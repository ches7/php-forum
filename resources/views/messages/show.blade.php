<x-app-layout>
<div class="flex justify-center">
  <div class="flex">
  <div id="user_container" class="">
  
    <main class="">
      <header>
        <div>
          <h2 class="text-lg mt-4 mb-4 ml-2">Users</h2>
        </div>
      </header>
      <ul id="users" class="ml-2">
        @foreach($users as $user)
        <li>
  <a href="/messages/{{$user->id}}"> <p>{{$user->name}}</p> </a>
        </li>
        @endforeach
      </ul>
    </main>
  
  </div>

<div id="container">
    <main class="">
      <header>
        <div>
          <h2 class="text-lg mt-4 mb-4">Chat with {{ $user_name }}</h2>
        </div>
      </header>
      <ul id="chat">

        @unless(count($messages) == 0)

        @foreach($messages as $message)

        @if($message->sender_id == $user_id)

        <li class="you">
          <div class="entete">
            <span class="status green"></span>
            <h2>{{$user_name}}</h2>

            <h3> 
            {{date('dS M Y h:i', strtotime($message->created_at))}}
            </h3>
          </div>
          <div class="flex justify-start ml-4">

        @else

        <li class="me">
            <div class="entete">
              <h3>{{date('dS M Y h:i', strtotime($message->created_at))}}</h3>
              <h2 class="ml-1">{{ Auth::user()->name }}</h2>
              <span class="status blue ml-1"></span>
            </div>
            <div class="flex justify-end mr-4">

        @endif
            
        <div class="triangle"></div>
            </div>
          <div class="message">
            {{$message->body}}
          </div>
        </li>

        @endforeach
        @endunless

      </ul>
      <footer>
        <div>
            <form method="POST" action="/messages/{{ $user_id }}" enctype="multipart/form-data">
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
      </footer>
    </main>
  </div>
  </div>
</div>
  
  
</x-app-layout>