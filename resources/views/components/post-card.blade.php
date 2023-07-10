@props(['post'])

<x-card class="!mb-4">
  <div class="flex">
      <div>
          <h3 class="text-2xl">
              <a href="/posts/{{$post->id}}">{{$post->title}}</a>
          </h3>
          <div class="text-xs mt-4"><a href="/?user={{ strtolower($post->user->id) }}">{{"By " . $post->user->name}}</a></div>
      </div>
  </div>
</x-card>