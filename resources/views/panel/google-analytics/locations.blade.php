@extends('layouts.panel')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-transparent d-flex align-items-center">
        {{ __('menu.panel.google-analytics.locations') }}

        @can('manage_system')
        <a href="{{ route('panel.google-analytics.sync.locations') }}" class="btn flex-shrink-0 ml-auto p-0">
            <i class="fas fa-sync text-primary"></i>
        </a>
        @endcan
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <select name="continent" class="form-control datatable-filters">
                    <option value="">{{ __('content.panel.google-analytics.table.filters.options.continent') }}</option>
                        @foreach ($locationContinents as $locationContinent)
                            <option value="{{ $locationContinent->continent }}">{{ $locationContinent->continent }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @include('panel.google-analytics.filters.datepickers')
        </div>
        <table id="locations-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('content.panel.google-analytics.table.headers.continent') }}</th>
                    <th>{{ __('content.panel.google-analytics.table.headers.country') }}</th>
                    <th>{{ __('content.panel.google-analytics.table.headers.city') }}</th>
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
        var locationsTable = $('#locations-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{!! route('panel.google-analytics.locations') !!}',
                data: function (data) {
                    dataTableFilters.each(function(index, element) {
                        data[element.name] = element.value;
                    });
                }
            },
            columns: [
                { data: 'continent', name: 'continent' },
                { data: 'country', name: 'country' },
                { data: 'city', name: 'city' },
                { data: 'visitors', name: 'visitors' },
                { data: 'pageviews', name: 'pageviews' }
            ]
        });

        dataTableFilters.on('change', function() {
            locationsTable.draw();
        });
    });
</script>
@endsection
