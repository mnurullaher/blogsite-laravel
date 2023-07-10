<x-layout>
  <x-card class="!p-10 !max-w-lg !mx-auto !mt-24">
      <header class="text-center">
          <h2 class="text-2xl font-bold uppercase mb-1">
              Create a Post
          </h2>
      </header>

      <form method="POST" action="/posts" enctype="multipart/form-data">
          @csrf

          <div class="mb-6">
              <label for="title" class="inline-block text-lg mb-2">Post Title</label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                value="{{ old('title') }}" />

              @error('title')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="body" class="inline-block text-lg mb-2">
                  Post Body
              </label>
              <textarea class="border border-gray-200 rounded p-2 w-full" name="body" rows="10">
                  {{ old('body') }}
              </textarea>

              @error('body')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                  Create Post
              </button>

              <a href="/" class="text-black ml-4"> Back </a>
          </div>
      </form>
  </x-card>
</x-layout>
