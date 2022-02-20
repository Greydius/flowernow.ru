@extends('layouts.admin')

@section('content')

    <div class="m-portlet m-portlet--mobile" ng-controller="shopsList">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Отчеты
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">

            <!--begin: Datatable -->
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data">


                <div class="table-responsive" ng-cloak>

                    <table style=" width: 100%">
                        <tbody class="" style="">
                            @foreach($reports as $report)
                                <tr>
                                    <td>{{ $report->shop_id }} - {{ $report->shop->name }}</td>
                                    <td>{{ \App\Helpers\AppHelper::ruMonth($report->report_date->format('m'), 2) }} {{ $report->report_date->format('Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.shop.getReportFile', ['id' => $report->id]) }}" target="_blank"><i class="fa fa-file-<?=($report->ext == 'pdf' ? 'pdf' : 'word')?>-o"></i></a>
                                        @if(!empty($report->warning))
                                        <i class="fa fa-info text-error"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $reports->appends(request()->query())->links() }}







            </div>
            <!--end: Datatable -->
        </div>
    </div>



@endsection

@section('head')
@stop

@section('footer')
@stop