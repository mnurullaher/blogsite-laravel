<x-layout>

    <a href={{ '/' }} class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="!p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <h3 class="text-2xl mb-2">{{ $post->title }}</h3>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div class="flex justify-center flex-col items-center w-full">
                    <div class="text-left">
                        {{ $post->body }}
                    </div>

                    <div class="flex">
                        @if ($post->liked())
                            <form action="/posts/unlike/{{ $post->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"><i class="fa-solid fa-thumbs-down font-thin"></i> </button>
                            </form>
                        @else
                            <form action="/posts/like/{{ $post->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"><i class="fa-solid fa-thumbs-up font-thin"></i> </button>
                            </form>
                        @endif
                        <p class="text-xs ml-1 mt-1 text-gray-600">{{ $post->likeCount }}</p>
                    </div>
                    
                    <form action="/posts/{{ $post->id }}/comment" method="POST" class="mt-4 w-10/12">
                        @csrf
                        <div class="mb-6 text-left">
                            <label for="comment" class="text-sm">Leave a comment</label>
                            <textarea class="border border-gray-200 rounded p-2 w-full" name="comment">
                            </textarea>
                            @error('comment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <button type="submit"
                                class="float-right bg-laravel text-white rounded py-1 px-2 hover:bg-black text-xs mb-2">
                                <i class="fa-solid fa-comment font-thin ml-3 mt-1"></i> Post Comment
                            </button>
                        </div>
                    </form>

                    <div class="w-10/12">
                        @unless ($post->commentCount() == 0)
                            @foreach ($post->comments as $comment)
                                <x-card class="w-full bg-white text-left">
                                    <div>
                                        {{$comment->body}}
                                    </div>
                                </x-card>
                                <div class="mb-2 text-right">
                                    <a href="/?user={{ $comment->creator_id }}" class="text-xs">
                                        {{'By ' . $comment->creator->name}}
                                    </a>
                                </div>
                                
                            @endforeach
                        @endunless
                    </div>

                    <a href="mailto:{{ $post->user->email }}"
                        class="w-48 bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80 text-center"><i
                            class="fa-solid fa-envelope"></i>
                        Contact Author</a>
                </div>
            </div>
        </x-card>
    </div>
</x-layout>
