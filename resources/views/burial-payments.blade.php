@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-primrayColor table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-title">{{ __('lang.payment_of_memorial_service_text') }}</p>
                        </div>
                        <div class="col-md-6 text-end d-flex justify-content-end align-items-center gap-2">
                            <a href=""
                               class="text-decoration-none text-dark bg-theme border-0 py-1 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                <img class="d-block w-[30px] max-w-[30px] leading-[30px]"
                                     src="{{ asset('./images/print.svg') }}">
                            </a>
                        </div>
                    </div>
                    @include('layouts.errors')
                    <table id="example" class="table table-theme">
                        <thead>
                        <tr>
                            <th class="">{{ __('lang.dead_person_name_text') }}</th>
                            <th class="">{{ __('lang.ic_no_text') }}</th>
                            <th class="">{{ __('lang.address_text') }}</th>
                            <th class="">{{ __('lang.date_of_death_text') }}</th>
                            <th class="">{{ __('lang.amount_paid_text') }}</th>
                            <th class="">{{ __('lang.burial_contact_person_text') }}</th>
                            <th class=""><span class="sr-only">{{ __('lang.action_text') }}</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deaths as $death)
                            @php $member = $death->member @endphp
                            <tr>
                                <td>{{ $member['name'] }}</td>
                                <td>{{ $member['ic_no'] }}</td>
                                <td>{{ $member['home_address1'] }}</td>
                                <td>{{ memberStatus($member['member_status_ids']) }}</td>
                                <td>{{ $death['service_cost'] }}</td>
                                <td>{{ $death['burial_contact_person'] }}</td>
                                <td>
                                    <div class="flex flex-row gap-2">
                                        <a href="{{ route('burial.payment.create', $death->id) }}" title="Update Payment for death Member"
                                           class="text-decoration-none text-dark bg-theme border-0 py-1 px-2 rounded text-xl flex flex-row gap-1 align-items-center d-block">
                                            <img class="d-block w-[30px] max-w-[30px] leading-[30px]"
                                                 src="{{ asset('./images/payment-icon1.svg') }}">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "language": {
                    "search": "{{ __('lang.search_text') }}:",
                    "lengthMenu": "{{ __('lang.show_text') }} _MENU_ {{ __('lang.entries_text') }}",

                    "info": "Showing _START_ to _END_ of _TOTAL_ entries (filtered from _MAX_ total entries)",
                    "paginate": {
                        "next": "{{ __('lang.next_text') }}",
                        "previous": "{{ __('lang.previous_text') }}"
                    },
                },
                responsive: {
                    details: false
                }
            });
        });
    </script>
@endsection
