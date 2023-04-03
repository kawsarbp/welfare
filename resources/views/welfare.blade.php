@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-primrayColor table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-title">{{ __('lang.lis_of_text') }} @if(!isset($category)) {{ __('lang.all_category_text') }}@else {{ $category }}{{ __('lang.s_text') }} @endif</p>
                        </div>
                        <div class="col-md-6 text-end d-flex justify-content-end align-items-center gap-2">
                            <a href="{{ route('service.create', $category_id ?? '') }}" title="Add Khairat"
                               class="text-decoration-none text-dark bg-theme border-0 py-1 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                <i class="fa-solid fa-plus me-2"></i>
                                @if(!isset($category))
                                    <img class="d-block w-[30px] max-w-[30px] h-[30px] leading-[30px]"
                                         src="{{ asset('./images/grid-view-icon.svg') }}">
                                @elseif($category == 'orphan')
                                    <img class="d-block w-[30px] max-w-[30px] h-[30px] leading-[30px]"
                                         src="{{ asset('./images/orphan.svg') }}">
                                @elseif($category == 'asnaf')
                                    <img class="d-block w-[30px] max-w-[30px] h-[30px] leading-[30px]"
                                         src="{{ asset('./images/asnaf.svg') }}">
                                @elseif($category == 'welfare')
                                    <img class="d-block w-[30px] max-w-[30px] h-[30px] leading-[30px]"
                                         src="{{ asset('./images/welfare.svg') }}">
                                @elseif($category == 'education')
                                    <img class="d-block w-[30px] max-w-[30px] h-[30px] leading-[30px]"
                                         src="{{ asset('./images/education.svg') }}">
                                @elseif($category == 'others')
                                    <img class="d-block w-[30px] max-w-[30px] h-[30px] leading-[30px]"
                                         src="{{ asset('./images/others.svg') }}">
                                @endif
                            </a>
                            <a href="" onclick="printDiv('printContent')" title="Print Table"
                               class="text-decoration-none text-dark bg-theme border-0 py-1 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                <img class="d-block w-[30px] max-w-[30px] leading-[30px]"
                                     src="{{ asset('./images/print.svg') }}">
                            </a>
                        </div>
                    </div>
                    @include('layouts.errors')
                    <div id="printContent">
                        <table id="example" class="table table-theme">
                            <thead>
                            <tr>
                                <th class="">{{ __('lang.name_text') }}</th>
                                <th class="">{{ __('lang.ic_no_text') }}</th>
                                <th class="">{{ __('lang.address_text') }}</th>
                                <th class="">{{ __('lang.member_status_text') }}</th>
                                <th class="action"><span class="sr-only">{{ __('lang.action_text') }}</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                @php $all_member = $member->member @endphp
                                <tr>
                                    <td>{{ $all_member['name'] }}</td>
                                    <td>{{ $all_member['ic_no'] }}</td>
                                    <td>{{ $all_member['home_address1'] }}</td>
                                    <td>{{ memberStatus($all_member['member_status_ids']) }}</td>
                                    <td class="action">
                                        <div class="flex flex-row gap-2">
                                            <a href="{{ route('welfare.payment', $member['id']) }}" title="Update Payment for welfare"
                                               class="text-decoration-none text-dark bg-theme border-0 py-1 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                                <img class="d-block w-[30px] max-w-[30px] leading-[30px]"
                                                     src="{{ asset('./images/payment-icon.svg') }}">
                                            </a>
                                            <a href="{{ route('welfare.show', $member['id']) }}" title="Welfare Details"
                                               class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                                <i class="fa-solid fa-eye w-[30px]  text-center leading-[30px]"></i>
                                            </a>
                                            <a href="{{ route('welfare.edit', $member['id']) }}" title="Edit Welfare"
                                               class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                                <i class="fa-solid fa-pencil w-[30px] text-center leading-[30px]"></i>
                                            </a>
                                            <form class="d-none" method="post"
                                                  action="{{ route('death.destroy', $member['id']) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="confirmDelete(event)" title="Delete Welfare"
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
