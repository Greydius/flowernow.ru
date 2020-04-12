@extends('layouts.admin')

@section('content')
<div class="tab-pane" id="report_editor" role="tabpanel">

  <div class="m-portlet__body">

      <div class="form-group m-form__group">
          <table style=" width: 100%">
              <tr>
                  <td>Магазин</td>
                  <td>Комиссия</td>
                  <td>Общая цена</td>
                  <td>С учетом комиссии</td>
                  <td>Скачать</td>
                  <td>Изменить</td>
                  <td>Подтвердить</td>
              </tr>
              @foreach($groupedReports as $k => $groupedReport)
                  <tr style="padding: 15px 0;">
                    <td style="font-weight: 600; font-size: 18px;">{{ $k }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-weight: 600; font-size: 18px;">Кол-во: {{ count($groupedReport) }}</td>
                  </tr>
                  @foreach($groupedReport as $confirmedReport)
                  <tr>
                      <td>{{ $confirmedReport['shop_name'] }}</td>
                      <td>{{ $confirmedReport['total_price'] - abs($confirmedReport['shop_price']) }}</td>
                      <td>{{ $confirmedReport['total_price'] }}</td>
                      <td>{{ $confirmedReport['shop_price'] }}</td>
                      <td>
                        <a href="{{ route('admin.shop.getConfirmedReport', ['id' => $confirmedReport['id']]) }}">PDF</a>
                        /
                        <a href="{{ route('admin.shop.getConfirmedReportDoc', ['id' => $confirmedReport['id']]) }}">DOC</a>
                      </td>
                      <td>
                        @if($confirmedReport['confirmed'] != 1)
                          <a href="{{ route('admin.shop.editConfirmedReport', ['id' => $confirmedReport['id']]) }}">Изменить</a>
                        @else
                          Не доступно
                        @endif
                      </td>
                      <td>
                        @if($confirmedReport['confirmed'] != 1)
                        <form action="{{ route('admin.shop.confirmedReport', ['id' => $confirmedReport['id']]) }}" method="GET">
                          <button>Подтвердить</button>
                        </form>
                        @else
                          Подтвержден
                        @endif
                      </td>
                  </tr>
                  @endforeach
              @endforeach
          </table>
      </div>
  </div>

</div>
@endsection

@section('head')
<style>
</style>
@stop

@section('footer')

@stop