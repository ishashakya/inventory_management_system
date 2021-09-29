<div class="form-group">
    <label for="exampleForName">Product Name</label>
    <div></div>
</div>
<div class="form-group">
    <label for="exampleForName">Sold quantity</label>
    <div></div>
</div>
<div>
    @foreach ($combineData as $key=>$data)
        {{$data}}
        {{$key}}
    @endforeach
</div>
