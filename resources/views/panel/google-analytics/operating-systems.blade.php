@extends('layouts.panel')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-transparent d-flex align-items-center">
        {{ __('menu.panel.google-analytics.operating-systems') }}

        @can('manage_system')
        <a href="{{ route('panel.google-analytics.sync.operating-systems') }}" class="btn flex-shrink-0 ml-auto p-0">
            <i class="fas fa-sync text-primary"></i>
        </a>
        @endcan
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <select name="name" class="form-control datatable-filters">
                    <option value="">{{ __('content.panel.google-analytics.table.filters.options.operating-system') }}</option>
                        @foreach ($operatingSystems as $operatingSystem)
                            <option value="{{ $operatingSystem->name }}">{{ $operatingSystem->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @include('panel.google-analytics.filters.datepickers')
        </div>
        <table id="operating-systems-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('content.panel.google-analytics.table.headers.operating-system') }}</th>
                    <th>{{ __('content.panel.google-analytics.table.headers.version') }}</th>
                    <th>{{ __('content.panel.google-analytics.table.headers.visitors') }}</th>
                    <th>{{ __('content.panel.google-analytics.table.headers.pageviews') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
@include('panel.google-analytics.scripts.datepickers')
@include('scripts.datatables')
<script>
    $(function() {
        var dataTableFilters = $('.datatable-filters');
        var operatingSystemsTable = $('#operating-systems-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{!! route('panel.google-analytics.operating-systems') !!}',
                data: function (data) {
                    dataTableFilters.each(function(index, element) {
                        data[element.name] = element.value;
                    });
                }
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'version', name: 'version' },
                { data: 'visitors', name: 'visitors' },
                { data: 'pageviews', name: 'pageviews' }
            ]
        });

        dataTableFilters.on('change', function() {
            operatingSystemsTable.draw();
        });
    });
</script>
@endsection
