<notifications :user-id="{{ request()->user()->id }}">
    <span slot="you-have" v-cloak>{{ __("You have") }}</span>
    <span slot="one" v-cloak>{{ __("notification") }}</span>
    <span slot="many" v-cloak>{{ __("notifications") }}</span>
    <span slot="no-notifications" v-cloak>{{ __("You don't have any notifications") }}</span>
</notifications>