    @foreach($childs->children as $parent)
    
        <option value='{{$parent->id}}' {{$parent->id==s->id?'selected':''}}>-- {{$parent->title}}</option>        

            @if($parent->children->isNotEmpty())
                @include('admin.category.sub_category_list', [
                    'childs' => $parent->children
                ])

            @endif

    @endforeach