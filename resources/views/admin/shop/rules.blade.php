@extends('layouts.admin')

@section('content')

    <div class="m-portlet m-portlet--mobile" ng-controller="shopsList">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Правила работы
                    </h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">

            <div class="col-xs-12" style="white-space: pre-line;">

                Здравствуйте коллеги!

                Мы тратит большое количество средств м времени для привлечение 1 клиента. Которые окупаются только при 2-3 покупке пользователя. Поэтому мы работаем над нашим сервисом, для того чтобы наши покупатели становились постоянными.
                В связи с этим созданы правила, которые настроены на то, чтобы мы совместными усилиями радовали клиента хорошим сервисом и получали повторные покупки ;)

                1. Оперативная смена статуса заказа. В момент смены статуса заказа клиенту приходит оповещение, поэтому делать это вовремя очень важное правило.
                1.1. Как только вам приходит заказ в течении 10 мин вы должны принять его (если нет никаких проблем и все есть в наличии).
                1.2. Как только курьер отзвонится о доставке, статут необходимо сменить на "выполнен". И прикрепить фото доставки, если клиент запрашивал.

                2. Время доставки.
                2.1. В своём профиле или в товарах вы должны указывать корректное время доставки, которого будет достаточно для исполнения заказа в срок.
                2.2. В заказах, которые приходят "на ближайшее время" подгружается именно то время, которое вы сами указали в профиле.
                2.3. Если в заказе стоит время "согласовать с получателем", значит вам нужно уточнить желаемое время доставки у получателя.
                2.4. Если в заказе указано время, значит клиент желает, чтобы доставка была именно в это время. И получатель будет по указанному адресу.
                2.6. Если по каким-то причинам вы не успеваете доставить букет в указанное время, вы должны согласовать время с заказчиком. Либо связаться с мнеджером, для разьяснения дальнейших действий.

                3. Контактные данные.
                3.1. Запрещено размещение контактные данных (номера телефонов, ссылки, названия аккаунтов в социальных сетях) за исключением предусмотренных для этого полей в разделе "Профиль" -&gt; "О Магазине".

                4. Наличие цветов. Вы сами выставляете свои товары на сайт и сами должны следить и вовремя редактировать наличие ассортимента.
                4.1. Если в составе вашего букета есть сезонный цветок, его нужно скрывать, как только этот цветок выходит из сезона.
                4.2. Если у вас раскупили какой либо цветок, нужно скрыть его из наличия на сайте, а также букеты, в состав которых входит данный цветок.
                4.3. Если у вас отпуск, или по каким то причинам вы не работаете какие то дни, на это время товары необходимо скрыть. Кнопка "выкл товары" в разделе "товары". Также, этой же кнопкой, вы открываете товары.

                5. Стоимость товаров. Стоимость своих товаров, в том числе цветов поштучно вы определяете сами.
                5.1. Если вам пришёл заказ, а цена не актуальная (по причине, что вы не поменяли цены в связи более дорогой поставкой, или вы допустили опечатку в цене) заказ все равно необходимо выполнить, так как ошибку вы допустили сами.

                6. Стоимость доставки. Также вы указываете сами в разделе "стоимость доставки".
                6.1. Стоимость, которую вы указываете, автоматически включается в каждый ваш заказ. Соответственно, требовать доплатить за доставку с клиента вы не можете.
                6.2. В большинстве крупных городов проставлены автоматические зоны доставки (черты города). Соответственно, вам нужно указать тариф за 1 км доставки за пределы города (не более 50₽/км), и доплата за доставку за город будет считаться автоматически.
                6.3. Если клиент изначально не указал адрес, а он оказался за пределами города, в этом случае вы можете согласовать с ним доплату за доставку и после этого выставить счёт через лк. После того, как клиент Ее оплатит, сумма поступит на ваш счёт, эту транзакцию вы сможете увидеть в истории финансов.
                6.4. Если при доставке в указанное клиентом время и по указанному адресу, получателя не будет на месте, вы должны оповестить об этом клиента. В данном случае, можно с его разрешение либо передать букет через кого-то, либо вы можете согласовать повторную доставку. В данном случае можно также согласовать с клиентом доплату за повторную доставку.

                7. Претензии клиентов. Мы являемся гарантом для клиентов, что их заказ будет выполнен в срок и ему доставят именно то, что он заказал. По этой причине деньги за заказ поступают сначала нам и находятся, с момента выполнения заказа, 3 дня в замороженном состоянии (возможный срок подачи претензии). Когда вы ставите статус "выполнен", клиенту отправляется ссылка на отзыв. Если оценка ниже 3, клиент может оформить официальную претензию.
                7.1. Если клиенту доставили другой букет (без согласования и предварительного фото), не тот, который он заказал, вы должны решить этот вопрос с клиентом, доставив букет, который был заказан. В противном случае мы обязаны вернуть клиенту деньги.
                7.2. Если вы отказываетесь исправлять свои ошибки и решать вопрос с клиентом, мы вернем клиенту деньги за этот заказ.

                8. Авторство фото.
                На сайте фото добавлять нужно без водяных знаков и контактных данных. Ваши фото защищены от копирования.
                Если вы увидели, что ваши фото использует кто-то еще на нашем сайте, мы можем предоставить вам контактные данные данного магазина, для того, чтобы вы решили с ним этот вопрос и попросили их удалить чужие фото.
            </div>


            <!--
            <div class="col-xs-12" style="white-space: pre-line;">
            Правила Flowwow

Прежде всего чем занимается Flowwow? - Flowwow занимается сайтом, созданием и улучшением удобного интерфейса для пользователей, а также привлечением клиентов, для того, чтобы у вас, коллеги, были заказы )

А вы непосредственно получаете заказы и доставляете Цветы. И контактируете с вашим клиентом, которого мы для вас привлекли.

Flowwow тратит большое количество средств для привлечение 1 клиента. Которые окупаются только при 2-3 покупке пользователя. Поэтому мы работаем над нашим сервисом, для того чтобы наши покупатели становились постоянными.
В связи с этим созданы правила, которые настроены на то, чтобы мы совместными усилиями радовали клиента хорошим сервисом и получали повторные покупки ;)

1. Оперативная смена статуса заказа. В момент смены статуса заказа клиенту приходит оповещение, поэтому делать это вовремя очень важное правило.
1.1. Как только вам приходит заказ в течении 10 мин вы должны принять его (если нет никаких проблем и все есть в наличии).
1.2. Фото готового букета нужно прикрепить к заказу (обязательное условие, иначе дальнейшие статусы неактивны).
1.3. Когда вы отдаете готовый букет курьеру, статус нужно поменять на "курьер вышел".
1.4. Как только курьер отзвонится о доставке, статут необходимо сменить на "выполнен". И прикрепить фото доставки, если клиент запрашивал.

2. Время доставки.
2.1. В своём профиле и в товарах вы должны указывать корректное время доставки, которого будет достаточно для исполнения заказа в срок.
2.2. В заказах, которые приходят "на ближайшее время" подгружается именно то время, которое вы сами указали в профиле.
2.3. Если заказ не принимается в течении 10 мин, он автоматически отправляется на тендер (это ответ на вопрос, почему вам пришло оповещение о новом заказе, а в лк его нет). При этом, если тендер никто не выигрывает, заказ снова возвращается вам.
2.4. Если в заказе стоит время "согласовать с получателем", значит вам нужно уточнить желаемое время доставки у получателя и указать его в заказе, нажав кнопку "указать время". В этот момент клиенту отправится время доставки букета, тем самым уменьшится количество звонков и вопросов как вам так и нам.
2.5. Если в заказе указано время, значит клиент желает, чтобы доставка была именно в это время. И получатель будет по указанному адресу.
2.6. Если по каким-то причинам вы не успеваете доставить букет в указанное время, вы должны согласовать время с заказчиком. Либо нажать на отмену с указанием причины "не успеваем по времени", в данном случае заказ отправляется на тендер.
2.7. Если вы просрочили заказ и нажали на отказ, с вас взымается штраф 10% от стоимости заказа. При этом, если заказ выполнит другой флорист, но клиент оставит негативный отзыв, связанный с просроченной доставкой, этот отзыв переводится на магазин, который просрочил заказ.

3. Контактные данные.
3.1. На Flowwow запрещено размещение контактные данных (номера телефонов, ссылки, названия аккаунтов в социальных сетях) за исключением предусмотренных для этого полей в разделе "Профиль" -&gt; "О Магазине".

4. Наличие цветов. Вы сами выставляете свои товары на сайт и сами должны следить и вовремя редактировать наличие ассортимента.
4.1. Если в составе вашего букета есть сезонный цветок, его нужно скрывать, как только этот цветок выходит из сезона.
4.2. Если у вас раскупили какой либо цветок, нужно скрыть его из наличия на сайте, а также букеты, в состав которых входит данный цветок. Это делается одним кликом. В идеале необходимо заходить в раздел товары минимум 2 раза в день и проверять наличие представленных вами букетов. Это также даёт статут "проверенный" на сайте.
4.3. Если у вас отпуск, или по каким то причинам вы не работаете какие то дни, на это время товары необходимо скрыть. Кнопка "выкл товары" в разделе "товары". Также, этой же кнопкой, вы открываете товары.

5. Стоимость товаров. Стоимость своих товаров, в том числе цветов поштучно вы определяете сами. Перед установкой цен, обязательно ознакомьтесь с правилами формирования комиссии. (<a data-toggle="modal" href="#comm_rules_modal">Правила формирования комиссии на Flowwow</a>)
5.1. Если вам пришёл заказ, а цена не актуальная (по причине, что вы не поменяли цены в связи более дорогой поставкой, или вы не ознакомились с правилами формирования комиссии, или вы допустили опечатку в цене) заказ все равно необходимо выполнить, так как ошибку вы допустили сами. Либо Flowwow может перезаказать такой букет у другого флориста, списав с вас сумму разницы стоимости букета.

6. Стоимость доставки. Также вы указываете сами в разделе "стоимость доставки".
6.1. Стоимость, которую вы указываете, автоматически включается в каждый ваш заказ (не забывайте указывать стоимость доставки в дополнительные городах). Соответственно, требовать доплатить за доставку с клиента вы не можете.
6.2. В большинстве крупных городов проставлены автоматические зоны доставки (черты города). Соответственно, вам нужно указать тариф за 1 км доставки за пределы города (не более 50₽/км), и доплата за доставку за город будет считаться автоматически.
Если в разделе "стоимость доставки" вы не видите выделенной синей зоны доставки, значит в вашем городе они ещё не указаны. Вы можете запросить у Flowwow ссылку на проставление зоны доставки в вашем городе, и тогда доплата за доставку также будет считаться автоматически.
6.3. Если клиент изначально не указал адрес, а он оказался за пределами города, в этом случае вы можете согласовать с ним доплату за доставку и после этого выставить счёт через лк. После того, как клиент Ее оплатит, сумма поступит на ваш счёт, эту транзакцию вы сможете увидеть в истории финансов.
Если счёт на доплату выставлен без согласования с клиентом, ваш магазин штрафуется на сумму выставленного счета.
6.4. Если при доставке в указанное клиентом время и по указанному адресу, получателя не будет на месте, вы должны оповестить об этом клиента. В данном случае, можно с его разрешение либо передать букет через кого-то, либо вы можете согласовать повторную доставку. В данном случае можно также согласовать с клиентом доплату за повторную доставку.

7. Претензии клиентов. Flowwow является гарантом для клиентов, что их заказ будет выполнен в срок и ему доставят именно то, что он заказал. По этой причине деньги за заказ поступают сначала нам и находятся, с момента выполнения заказа, 3 дня в замороженном состоянии (возможный срок подачи претензии). Когда вы ставите статус "выполнен", клиенту отправляется ссылка на отзыв. Если оценка ниже 3, клиент может оформить официальную претензию.
7.1. Если клиенту доставили другой букет (без согласования и предварительного фото), не тот, который он заказал, вы должны решить этот вопрос с клиентом, доставив букет, который был заказан. В противном случае Flowwow обязан вернуть клиенту деньги.
7.2. Если вы отказываетесь исправлять свои ошибки и решать вопрос с клиентом, Flowwow вернет клиенту деньги за этот заказ.

8. Авторство фото.
На сайте Flowwow фото добавлять нужно без водяных знаков и контактных данных. Ваши фото защищены от копирования.
Если вы увидели, что ваши фото использует кто-то еще на нашем сайте, Flowwow может предоставить вам контактные данные данного магазина, для того, чтобы вы решили с ним этот вопрос и попросили их удалить чужие фото.. Flowwow сделать за вас этого не может, т.к. доказательства, что фото именно ваши есть только у вас.        </div>
            -->

        </div>

    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop