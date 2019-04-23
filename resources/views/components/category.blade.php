<ul class="text my-0 pl-4" style="font-size: 1.4rem">
  @foreach($categories as $category)
  <li style="list-style: none">
    <radio name="{{ isset($name) ? $name : 'parent_id' }}" value="{{ $category->id }}" :checked="{{$category->id}} == category.{{ isset($checkprop) ? $checkprop : 'parent_id' }}">{{ $category->name }}</radio>
  </li>
  @include('components.category', [
    "categories" => $category->children
  ])
  @endforeach
</ul>