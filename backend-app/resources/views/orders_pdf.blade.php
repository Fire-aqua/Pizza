<!DOCTYPE html>
<html>
  <head>
      <title>Orders</title>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        * {
          /*font-family: Helvetica, sans-serif;*/
          font-family: "DejaVu Sans", sans-serif;
        }
        </style>
  </head>
  <body>
      <div style="width: 100%; max-width: 960px; margin: auto">
          <table width="100%">       
              <tr>
                  <td colspan="2">
                      <table width="100%" cellpadding="0" cellspacing="0" border="1">
                        @foreach ($orders as $order)
                        <thead>
                          <tr style="background-color: rgb(233, 233, 233)">
                            <th style="text-align: left; padding: 5px 10px;">Номер заказа</th>
                            <th style="text-align: center; padding: 5px 10px;" colspan="2">Контактные данные</strong></th>
                            <th style="text-align: center; padding: 5px 10px;">Цена</th>
                          </tr>
                        </thead>
                        <tbody>                            
                          <tr>
                            <td style="text-align: left; padding: 5px 5px;">{{ $order['id'] }}</td>
                            <td style="text-align: center; padding: 5px 5px;" colspan="2">                                  
                              Имя: {{ $order->customer['fio'] }}, телефон: {{ $order->customer['phone'] }}<br>
                              @if ($order->customer['street'])                                            
                                Доставить по адресу (улица, дом, квартира):<br>
                                {{ $order->customer['street'] }}, {{ $order->customer['house'] }}, {{ $order->customer['flat'] }}
                              @endif
                            </td>
                            <td style="text-align: center; padding: 5px 10px;">{{ $order['total_sum'] }}$</td>
                          </tr>
                          <tr>
                            <th style="text-align: left; padding: 5px 10px;">Размер</th>
                            <th style="text-align: left; padding: 5px 10px;">Товар</th>
                            <th style="text-align: left; padding: 5px 10px;">Топпинги</th>
                            <th style="text-align: left; padding: 5px 10px;">Количество</th>
                          </tr>
                          @foreach ($order->orderElements as $orderElement)
                            <tr>
                              <td style="text-align: left; padding: 5px 10px;">{{ $orderElement['size'] }}</td>
                              <td style="text-align: left; padding: 5px 10px;">{{ $orderElement->good['display_name_ru'] }}</td>
                              <td style="text-align: left; padding: 5px 10px;">
                                @foreach ($orderElement->ingredients as $ingredient)
                                {{ $ingredient['display_name_ru'] }}<br>
                                @endforeach
                              </td>
                              <td style="text-align: left; padding: 5px 10px;">{{ $orderElement['count'] }}</td>                                      
                            </tr>
                          @endforeach                                
                        @endforeach
                        </tbody>
                      </table>
                  </td>
              </tr>
          </table>
      </div>
  </body>
</html>