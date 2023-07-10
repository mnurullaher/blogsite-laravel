@props(['post'])

<x-card class="!mb-4">
  <div class="flex">
      <div>
          <h3 class="text-2xl">
              <a href="/posts/{{$post->id}}">{{$post->title}}</a>
          </h3>
          <div class="text-xs mb-4">{{"By " . $post->user->name}}</div>
      </div>
  </div>
</x-card>