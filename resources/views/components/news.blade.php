<div class="flex-wrap my-4">
  <div class="col-12">
    <div class="h5 mb-0">{{ $article->title }}</div>
    <p class="mt-0">{{ $article->created_at->diffForHumans() }}</p>
  </div>
  <div class="col-phone-4">
    <img style="width: 100%; height: auto" src="{{ $article->image }}" alt="news-article">
  </div>
  <div class="col-phone-8 pl-3">
    <p class="mt-0" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical; ">
      {{ $article->text }}
    </p>
    <a href="/news/{{ $article->slug }}" class="btn btn-black">Read More</a>
  </div>
</div>
<hr>