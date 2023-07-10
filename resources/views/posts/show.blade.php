<x-layout>

    <a href={{ url()->previous() }} class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="!p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <h3 class="text-2xl mb-2">{{ $post->title }}</h3>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div class="flex justify-center flex-col items-center">
                    <div class="text-left">
                        {{ $post->body }}
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
