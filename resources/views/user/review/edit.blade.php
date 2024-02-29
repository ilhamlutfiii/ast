@extends('user.layouts.master')

@section('title','Review Edit')

@section('main-content')
<div class="card">
  <h5 class="card-header">Review Edit</h5>
  <div class="card-body">
    <form action="{{route('user.asetreview.update',$review->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">Review By:</label>
        <input type="text" disabled class="form-control" value="{{$review->user_info['user_nama']}}">
      </div>

      <div class="form-group">
        <label for="rate">Rate:</label><br>
        <div class="rating_box">
          <div class="star-rating">
            <div class="star-rating__wrap">
              <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5" {{(($review->rate == 5) ? 'checked' : '')}}>
              <label class="star-rating__ico fa fa-star" for="star-rating-5" title="5 out of 5 stars"></label>
              <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4" {{(($review->rate == 4) ? 'checked' : '')}}>
              <label class="star-rating__ico fa fa-star" for="star-rating-4" title="4 out of 4 stars"></label>
              <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3" {{(($review->rate == 3) ? 'checked' : '')}}>
              <label class="star-rating__ico fa fa-star" for="star-rating-3" title="3 out of 3 stars"></label>
              <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2" {{(($review->rate == 2) ? 'checked' : '')}}>
              <label class="star-rating__ico fa fa-star" for="star-rating-2" title="2 out of 2 stars"></label>
              <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1" {{(($review->rate == 1) ? 'checked' : '')}}>
              <label class="star-rating__ico fa fa-star" for="star-rating-1" title="1 out of 1 stars"></label>
            </div>
          </div>
        </div>
      </div>



      <div class="form-group">
        <label for="review">Review</label>
        <textarea name="review" id="" cols="20" rows="10" class="form-control">{{$review->review}}</textarea>
      </div>
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Select Status--</option>
          <option value="active" {{(($review->status=='active')? 'selected' : '')}}>Active</option>
          <option value="inactive" {{(($review->status=='inactive')? 'selected' : '')}}>Inactive</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
  .order-info,
  .shipping-info {
    background: #ECECEC;
    padding: 20px;
  }

  .order-info h4,
  .shipping-info h4 {
    text-decoration: underline;
  }

  /* Rating */
  .rating_box {
    display: inline-flex;
  }

  .star-rating {
    font-size: 0;
    padding-left: 10px;
    padding-right: 10px;
  }

  .star-rating__wrap {
    display: inline-block;
    font-size: 1rem;
  }

  .star-rating__wrap:after {
    content: "";
    display: table;
    clear: both;
  }

  .star-rating__ico {
    float: right;
    padding-left: 2px;
    cursor: pointer;
    color: #aaa;
    font-size: 16px;
    margin-top: 5px;
  }

  .star-rating__ico:last-child {
    padding-left: 0;
  }

  .star-rating__input {
    display: none;
  }

  .star-rating__ico:hover:before,
  .star-rating__ico:hover~.star-rating__ico:before,
  .star-rating__input:checked~.star-rating__ico:before,
  .star-rating__input:checked~.star-rating__ico:hover:before {
    content: "\F005";
    color: #F7941D;
    /* Warna kuning */
  }
</style>
@endpush