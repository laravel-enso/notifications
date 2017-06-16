<notifications :user-id="{{ request()->user()->id }}" v-cloak>
    <span slot="you-have">{{ __("You have") }}</span>
    <span slot="one">{{ __("unread notification") }}</span>
    <span slot="many">{{ __("unread notifications") }}</span>
    <span slot="no-notifications">{{ __("You don't have any unread notifications") }}</span>
    <span slot="mark-all-as-read">{{ __("Mark All Read") }}</span>
    <span slot="clear-all">{{ __("Clear All") }}</span>
</notifications>