
<div class="user-side-bar">
    <ul class="list-group">
        <li class="list-group-item {{Route::currentRouteName() == 'site.user.dashboard' ? 'active' : ''}}"><a href="{{route('site.user.dashboard')}}">{{__('messages.user.dashboard')}}</a></li>
        <li class="list-group-item {{Route::currentRouteName() == 'site.user.serviceOrders'  ? 'active' : ''}}"><a href="{{route('site.user.serviceOrders')}}">{{__('messages.service-orders')}}</a></li>
        <li class="list-group-item {{Route::currentRouteName() == 'site.user.productsOrders' || Route::currentRouteName() == 'site.user.orders.show' ? 'active' : ''}}"><a href="{{route('site.user.productsOrders')}}">{{__('messages.product-orders')}}</a></li>
        <li class="list-group-item {{Route::currentRouteName() == 'site.user.ship.pill.details' || Route::currentRouteName() == 'site.user.ship.pill.details.edit' ? 'active' : ''}}"><a href="{{route('site.user.ship.pill.details')}}">{{__('messages.ship.pill.details')}}</a></li>
        <li class="list-group-item {{Route::currentRouteName() == 'site.user.personal.info.edit' ? 'active' : ''}}"><a href="{{route('site.user.personal.info.edit')}}">{{__('messages.personal')}}</a></li>
        <li class="list-group-item"><a href="{{route('backpack.auth.logout')}}">{{__('messages.logout')}}</a></li>
    </ul>
</div>
