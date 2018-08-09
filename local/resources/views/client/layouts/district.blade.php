<option>Quận/huyện</option>
@foreach($list_district as $district)
        {{-- <option value="{{$district->maqh}}">{{$district->name}}</option> --}}
        <option value="{{$district->name}}" id="{{$district->maqh}}">{{$district->name}}</option>
@endforeach

