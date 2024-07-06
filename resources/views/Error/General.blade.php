@extends('Error.master_error_page')
@section('content')
<div class="container-xxl container-p-y">
  <div class="misc-wrapper">
    <h2 class="mb-2 mx-2">Internal error :(</h2>
    <p class="mb-4 mx-2">{{ $exception->getMessage() }}</p>
    <div class="mt-2">
      <a href="{{route('index')}}" type="submit" class="btn btn-danger me-2">Back to page</a>
    </div>
    <div class="mt-3">
      <img
        src="{{asset('Template/assets/img/illustrations/girl-doing-yoga-light.png')}}"
        alt="page-misc-error-light"
        width="500"
        class="img-fluid"
        data-app-dark-img="illustrations/page-misc-error-dark.png"
        data-app-light-img="illustrations/page-misc-error-light.png"
      />
    </div>
  </div>
</div>
@endsection