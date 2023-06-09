@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-primrayColor table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-title">{{ __('lang.death_cases_text') }}</p>
                        </div>
                        <div class="col-md-6 text-end d-flex justify-content-end align-items-center gap-2">
                            <a href="{{ route('death.create') }}" title="Add Death"
                               class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                <i class="fa-solid fa-plus"></i>
                                <img src="{{ asset('./images/death.svg') }}">
                            </a>
                            <a href="" title="Print Content"
                               class="text-decoration-none text-dark bg-theme border-0 py-1 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                <img src="{{ asset('./images/print.svg') }}">
                            </a>
                        </div>
                    </div>
                    @include('layouts.errors')
                    <table id="example" class="table table-theme">
                        <thead>
                        <tr>
                            <th class="">{{ __('lang.name_text') }}</th>
                            <th class="">{{ __('lang.identification_no_text') }}</th>
                            <th class="">{{ __('lang.address_text') }}</th>
                            <th class="">{{ __('lang.date_of_death_text') }}</th>
                            <th class="">{{ __('lang.burial_place_text') }}</th>
                            <th class="">{{ __('lang.member_status_text') }}</th>
                            <th class=""><span class="sr-only">{{ __('lang.action_text') }}</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            @php $all_member = $member->member @endphp
                            <tr>
                                <td>{{ $all_member['name'] }}</td>
                                <td>{{ $all_member['ic_no'] }}</td>
                                <td>{{ $all_member['home_address1'] }}</td>
                                <td>{{ $member['date_of_death'] }}</td>
                                <td>{{ $member['burial_place'] }}W</td>
                                <td>{{ memberStatus($all_member['member_status_ids']) }}</td>
                                <td>
                                    <div class="flex flex-row gap-2">
                                        <a href="{{ route('death.show', $member['id']) }}" title="{{ __('lang.see_death_details_title') }}"
                                           class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                            <i class="fa-solid fa-eye w-[30px]  text-center leading-[30px]"></i>
                                        </a>
                                        <a href="{{ route('death.edit', $member['id']) }}" title="{{ __('lang.edit_death_record_title') }}"
                                           class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                            <i class="fa-solid fa-pencil w-[30px] text-center leading-[30px]"></i>
                                        </a>
                                        <form class="d-inline-block" method="post"
                                              action="{{ route('death.destroy', $member['id']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="confirmDelete(event)" title="{{ __('lang.delete_death_record_title') }}"
                                                    class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                                <i class="fa-solid fa-trash-can w-[30px] text-center leading-[30px]"></i>
                                            </button>
                                        </form>
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
