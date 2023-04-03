@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-primrayColor table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-title">{{ __('lang.database_text') }}</p>
                        </div>
                        <div class="col-md-6 text-end d-flex justify-content-end align-items-center gap-2">
                            <a href="{{ route('member.create') }}" title="Add Member"
                               class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                <i class="fa-solid fa-plus"></i>
                                <img src="{{ asset('./images/add-user.svg') }}">
                            </a>
                            <button href="javascript:" onclick="printDiv('printContent')" title="Print data"
                               class="text-decoration-none text-dark bg-theme border-0 py-1 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                <img src="{{ asset('./images/print.svg') }}">
                            </button>
                        </div>
                    </div>
                    @include('layouts.errors')
                    <div id="printContent">
                        <table id="example" class="table table-theme">
                            <thead>
                            <tr>
                                <th class="">{{ __('lang.name_text') }} </th>
                                <th class="">{{ __('lang.identification_no_text') }}</th>
                                <th class="">{{ __('lang.address_text') }}</th>
                                <th class="">{{ __('lang.member_status_text') }}</th>
                                <th class="">{{ __('lang.checking_status_text') }}</th>
                                <th class="action"><span class="sr-only">{{ __('lang.action_text') }}</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>{{ $member['name'] }}</td>
                                    <td>{{ $member['ic_no'] }}</td>
                                    <td>{{ $member['home_address1'] }}</td>
                                    <td>{{ memberStatus($member['member_status_ids']) }}</td>
                                    <td>2011-04-25</td>
                                    <td class="action">
                                        <div class="flex flex-row gap-2 hide-print">
                                            <a href="{{ route('member.family', $member['id']) }}" title="Manage Dependents"
                                               class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                                <img class="d-block w-[30px] max-w-[30px] leading-[30px]"
                                                     src="{{ asset('./images/add-user.svg') }}">
                                            </a>
                                            <a href="{{ route('member.show', $member['id']) }}" title="View member details"
                                               class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                                <i class="fa-solid fa-eye w-[30px]  text-center leading-[30px]"></i>
                                            </a>
                                            <a href="{{ route('member.edit', $member['id']) }}" title="Edit member"
                                               class="text-decoration-none text-dark bg-theme border-0 py-2 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                                <i class="fa-solid fa-pencil w-[30px] text-center leading-[30px]"></i>
                                            </a>
                                            <form class="d-inline-block" method="post"
                                                  action="{{ route('member.destroy', $member['id']) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="confirmDelete(event)" title="Delete Member"
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

                    "info": "Showing _START_ to _END_ of _TOTAL_ entries"
                },

                processing: true,
                serverSide: true,
                ajax: {
                    url: '/data-list',
                    type: 'POST'
                },
                columns: [
                    { data: 'name' },
                    { data: 'ic_no' },
                    { data: 'home_address1' },
                    { data: 'member_status_ids' },
                    { data: 'member_status_ids' },
                    { data: 'member_status_ids' },
                ],
                responsive: {
                    details: false
                },
                "columnDefs": [ {
                    "targets": -1,
                    "orderable": false
                } ]

            });
        });
    </script>
@endsection
