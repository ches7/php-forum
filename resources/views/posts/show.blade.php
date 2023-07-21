<x-app-layout>
<div class="flex">
    <div>
      <h3 class="text-2xl">
        <a href="/posts/{{$post->id}}">{{$post->title}}</a>
      </h3>
      <div class="text-xl font-bold mb-4">{{$post->tags}}</div>
      
      <div class="text-lg mt-4">
         {{$post->body}}
      </div>
    </div>
</div>

<a href="/posts/{{$post->id}}/edit">
  <i class="fa-solid fa-pencil"></i> Edit
</a>

<form method="POST" action="/posts/{{$post->id}}">
  @csrf
  @method('DELETE')
  <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
</form>
</x-app-layout>