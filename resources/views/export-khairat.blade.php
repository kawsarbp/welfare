@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="card-title mb-3">{{ __('lang.khairat_kematian_report_excel_text') }}</h4>
                            </div>
                        </div>
                        @include('layouts.errors')
                        <form class="forms-sample" action="{{ route('export.khairat') }}" enctype="multipart/form-data"
                              method="post">
                            @csrf
                            <div class="form-group is-invalid">
                                <div class="form-group align-items-center required">
                                    <label class="col-form-label"><span>{{ __('lang.select_field_text') }}</span></label>
                                    <div class="row fields">
                                        @for($i=0; $i < 8; $i++)
                                            <div class="col-sm-3 col-md-2">
                                                <select name="fields[]" class="form-control custom-select mb-3">
                                                    <option value="">{{ __('lang.select_column_text') }} </option>
                                                    @foreach($columns as $value)
                                                        <option value="{{ $value['id'] }}"
                                                                @if(old('fields[]') == $value['id']) selected @endif>{{ $value['label'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endfor
                                    </div>
                                    @error('importXl')
                                    <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">{{ __('lang.submit_text') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let fields = ['Full Name', 'IC No', 'Member Type']
    </script>
@endsection
