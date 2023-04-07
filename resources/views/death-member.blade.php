@extends('layouts.app')

@section('content')
    @php $member = $death->member @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="card-title mb-3">{{ __('lang.database_list_text') }}</h4>
                            </div>
                        </div>
                        <h4>{{ $member['name'] }}</h4>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label">{{ __('lang.full_name_form') }}</label>
                                    <div class="col-sm-9">
                                        {{ $member['name'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label">{{ __('lang.other_name_form') }}</label>
                                    <div class="col-sm-9">
                                        {{ $member['name2'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label">{{ __('lang.telephone_text') }}</label>
                                    <div class="col-sm-9">
                                        {{ $member['telephone_one'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label">{{ __('lang.other_telephone_text') }}</label>
                                    <div class="col-sm-9">
                                        {{ $member['telephone2'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label">{{ __('lang.address_text') }}</label>
                                    <div class="col-sm-9">
                                        {{ $member['home_address1'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach(array(
                                    array('label'=>__('lang.city_form'), 'value'=> $member->home_city),
                                    array('label'=>__('lang.postcode_form'), 'value'=> $member->home_postcode),
                                    array('label'=>__('lang.district_form'), 'value' => $member->home_district),
                                    array('label'=>__('lang.state_form'),'value' => $member->home_state->name),
                                    array('label'=>__('lang.beneficiary_text'),'value' => getName($member->home_state)),
                                    array('label'=>__('lang.birth_date_text'),'value' => $member->bitth_date),
                                    array('label'=>__('lang.ic_no_text'),'value' => $member->ic_no),
                                    array('label'=>__('lang.job_text'),'value' => $member->current_job),
                                    array('label'=>__('lang.guardian_text'),'value' => guardian($member->relation_ships)),
                                    array('label'=>__('lang.asnaf_status_text'),'value' => $member->jobjob),
                                    array('label'=>__('lang.marital_status_form'),'value' => getName($member->marital_status)),
                                    array('label'=>__('lang.date_of_death_form'),'value' => $member->date_of_death),
                                    array('label'=>__('lang.wakil_pengurus_jenazah_text'),'value' => $death->buiral_contact_person),
                                    array('label'=>__('lang.no_tel_wakil_pengurus_jenazah_text'),'value' => $member->buiral_contact_person_tel),
                                    array('label'=>__('lang.sebab_kematian_text'),'value' => $member->cause_of_death),
                                    ) as $data)
                                <div class="col-md-6 col-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">
                                            <span>{{$data['label']}}</span>
                                        </label>
                                        <div class="col-sm-9">
                                            {{$data['value']}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            @foreach(
                                array(
                                    array('src' => $death->attached_file1),
                                    array('src' => $death->attached_file2),
                                    array('src' => $death->attached_file3),
                                    array('src' => $death->attached_file4)
                                )
                                 as $src)
                                <div class="form-group mb-3 col-md-3 col-sm-4 col-6">
                                    <label for="exampleInputCity1">{{ __('lang.image_file_form') }}</label>
                                    <img style="width: 100%;height: calc(100px + 5vw)"
                                         src="{{ asset("uploads/".$src['src'] ) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                        @include('layouts.errors')
                        <div class="row">
                            @include('layouts.member-dependents')
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
