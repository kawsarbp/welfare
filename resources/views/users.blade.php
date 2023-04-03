@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-primrayColor table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-title">{{ __('lang.users_text') }}</p>
                        </div>
                        <div class="col-md-6 text-end d-flex justify-content-end align-items-center gap-2">
                            <button href="" id="print" onclick="printDiv('printContent')"
                               class="text-decoration-none text-dark bg-theme border-0 py-1 px-2 rounded text-xl flex flex-row gap-1 align-items-center">
                                <img class="d-block w-[30px] max-w-[30px] leading-[30px]"
                                     src="{{ asset('./images/print.svg') }}">
                            </button>
                        </div>
                    </div>
                    @include('layouts.errors')
                    <div id="printContent">
                        <table id="example" class="table table-theme">
                            <thead>
                            <tr>
                                <th class="">{{ __('lang.user_id_text') }}</th>
                                <th class="">{{ __('lang.user_name_text') }}</th>
                                <th class="">{{ __('lang.authority_text') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['username'] }}</td>
                                    <td>
                                        @foreach($user->authority as $authority)
                                        {{ $authority->title }}
                                        @endforeach
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
                responsive: {
                    details: false
                }
            });
        });
    </script>
@endsection
