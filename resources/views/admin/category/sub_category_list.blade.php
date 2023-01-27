    @foreach($childs as $parent)
<option value='{{$parent->title}}'>-- {{$parent->title}}</option>        

            {{-- `isNotEmpty` collection method was added in Laravel 5.3 --}}
            @if($parent->children->isNotEmpty())
                @include('admin.category.sub_category_list', [
                    'childs' => $parent->children
                ])

            @endif

    @endforeach