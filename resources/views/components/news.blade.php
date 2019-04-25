<div class="flex-wrap mt-1 mb-4">
  <div class="col-12">
    <div class="h6 mb-0 text-blue">{{ $article->title }}</div>
    <p class="my-0" style="font-size: 0.8rem"><strong>By {{$article->author->name}}</strong> {{ $article->created_at->diffForHumans() }}</p>
  </div>
  <div class="col-phone-4">
    <img style="width: 100%; height: auto" src="{{ $article->image }}" alt="news-article">
  </div>
  <div class="col-phone-8 pl-3">
    <p class="my-0" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;     font-size: 0.9rem;line-height: 1.8rem;">
      {{ $article->text }}
    </p>
    <a href="/news/{{ $article->slug }}" style="font-size: 0.6rem; line-height: 1.9rem;" class="btn btn-black px-3 py-2">Read More</a>
  </div>
</div>
<hr>