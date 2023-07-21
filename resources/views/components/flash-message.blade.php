@if(session()->has('message'))
<div
  class="fixed center px-48 py-3">
  <p>
    {{session()->get('message')}}
  </p>
</div>
@endif