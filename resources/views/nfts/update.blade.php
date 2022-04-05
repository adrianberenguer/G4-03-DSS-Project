<form action="{{ route('nft.update') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    @method('PUT')
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">ID</span>
        </div>
        <input type="number" class="form-control" name="id" value="{{ old('id') }}" placeholder="Identifier of the NFT" aria-label="id" aria-describedby="basic-addon1" id="id">
    </div>
    @if ($errors->has('id'))
        @foreach ($errors->get('id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Name</span>
        </div>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="New NFT name (optional)" aria-label="Name" aria-describedby="basic-addon1" id="name">
    </div>
    <div class="input-group mb-3 bootstrap-textarea">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Base price</span>
        </div>
        <input type="number" class="form-control" name="base_price" value="{{ old('base_price') }}" placeholder="New base_price of the collection (optional)" aria-label="base_price" aria-describedby="basic-addon2" id="base_price">
    </div>
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Limit date</span>
        </div>
        <input type="date" class="form-control" name="limit_date" placeholder="New limit date (optional)" value="{{ old('limit_date') }}" aria-label="Username" aria-describedby="basic-addon3" id="limit_date">
    </div>
    @if ($errors->has('limit_date'))
        @foreach ($errors->get('limit_date') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Collection</span>
        </div>
        <input type="text" class="form-control" name="collection_id" placeholder="New belonging collection (optional)" value="{{ old('collection_id') }}" aria-label="Username" aria-describedby="basic-addon3" id="collection_id">
    </div>
    @if ($errors->has('collection_id'))
        @foreach ($errors->get('collection_id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">User</span>
        </div>
        <input type="text" class="form-control" name="user_id" placeholder="New user owner (optional)" value="{{ old('user_id') }}" aria-label="Username" aria-describedby="basic-addon3" id="user_id">
    </div>
    @if ($errors->has('user_id'))
        @foreach ($errors->get('user_id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Type</span>
        </div>
        <input type="text" class="form-control" name="type_id" placeholder="New type (optional)" value="{{ old('type_id') }}" aria-label="Username" aria-describedby="basic-addon3" id="type_id">
    </div>
    @if ($errors->has('type_id'))
        @foreach ($errors->get('type_id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <button type="submit" class="btn btn-primary">Update</button>
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Image</span>
        </div>
        <input type="text" class="form-control" name="img_url" placeholder="New associated image (optional)" value="{{ old('img_url') }}" aria-label="Username" aria-describedby="basic-addon3" id="img_url">
    </div>
    @if ($errors->has('img_url'))
        @foreach ($errors->get('img_url') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<style lang="scss">
.create-collection-container{
    margin-top: 1rem;
}

.bootstrap-textarea{
    width: 600px;
}

.bootstrap-input{
    width: 400px;
}

button{
    margin-bottom: 1rem;
}

.invalid-tooltip{
    position: relative;
    display: block;
    width: 400px;
    margin-top: -15px;
}
</style>