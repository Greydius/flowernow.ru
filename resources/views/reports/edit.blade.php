@extends('layouts.admin')

@section('content')
<div class="tab-pane" id="report_editor" role="tabpanel">

  <div class="m-portlet__body">

      <div class="form-group m-form__group">
          <table style=" width: 100%">
              <tr>
                  <td>Дата</td>
                  <td>Кол-во заказов</td>
                  <td>Общая цена</td>
                  <td>С учетом комиссии</td>
                  <td>Скачать</td>
              </tr>
              @foreach($confirmedReports as $confirmedReport)
                  <tr>
                      <td>{{ $confirmedReport['date'] }}</td>
                      <td>{{ $confirmedReport['orders_count'] }}</td>
                      <td>{{ $confirmedReport['total_price'] }}</td>
                      <td>{{ $confirmedReport['shop_price'] }}</td>
                      <td>
                        @if($confirmedReport['file'] == false)
                          <a href="{{ route('admin.shop.getConfirmedReport', ['id' => $confirmedReport['id']]) }}">PDF</a>
                        @else
                          <a href="{{ route('admin.uploadedReport', ['id' => $confirmedReport['id']]) }}">PDF</a>
                        @endif
                        /
                        @if($confirmedReport['file'] == false)
                          <a href="{{ route('admin.shop.getConfirmedReportDoc', ['id' => $confirmedReport['id']]) }}">DOC</a>
                        @else
                          <a href="/storage/{{ $confirmedReport['id'] }}.docx">DOC</a>
                        @endif
                      </td>
                  </tr>
              @endforeach
          </table>
      </div>
  </div>

<div class="some-info">
<span>Если Вам нужен оригинал отчета, просим распечатать отчёт в двух экземплярах, подписать и направить в ООО "ФЛН" по адресу: 198206, г. Санкт-Петербург, ул. Адмирала Трибуца, д. 7, кв. 66</span>
</div>
</div>
@endsection

@section('head')
<style>
.m-body .m-content {
  height: 100%;
  padding-bottom: 15px;
}
.tab-pane {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.m-portlet__body {
  flex: auto;
}

.some-info {
  padding: 15px 20px;
  background-color: #fff;
  font-size: 12px;
}
</style>
@stop

@section('footer')

@stop