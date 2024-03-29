<x-app-layout meta-title="Zcreative Blog - About us" meta-description="About Us">

  <div class="container max-w-7xl mx-auto py-6">

    <!-- Post Section -->
    <section class="w-full md:w-full flex flex-col items-center px-3">

      <article class="w-full flex flex-col shadow my-4">
        @if ($widget && $widget->image)
          <img src="/storage/{{ $widget->image }}">
        @endif

        <div class="bg-white flex flex-col justify-start p-6">
          <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">
            {{ $widget ? $widget->title : '' }}
          </h1>
          <div>
            {!! $widget ? $widget->content : '' !!}
          </div>
        </div>
      </article>
    </section>

  </div>
</x-app-layout>
