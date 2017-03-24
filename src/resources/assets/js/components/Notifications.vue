<template>
  <li id="notifications" class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" @click="getNotificationsList">
        <i class="fa fa-bell-o"></i>
        <span class="label label-danger" v-if="unreadNotificationsCount" v-text="unreadNotificationsCount"></span>
    </a>
    <ul class="dropdown-menu" v-cloak>
      <li class="header" v-if="unreadNotificationsCount"><slot name="you-have"></slot> {{ unreadNotificationsCount }} <span v-if="unreadNotificationsCount == 1"><slot name="one"></slot></span><span v-else><slot name="many"></slot></span></li>
      <li class="header" v-else><slot name="no-notifications"></slot></li>
        <li>
          <ul class="menu">
              <li>
                  <a :href="notification.data.link" v-for="notification in notificationsList">
                    <i class="fa fa-envelope-o text-yellow"></i><span :class="{ 'bold' : !notification.read_at }">{{ notification.data.body }}</span>
                  </a>
              </li>
          </ul>
        </li>
        <li class="footer"><a href="#" @click="clearNotifications">Clear All</a></li>
    </ul>
  </li>
</template>

<script>

  export default {
    props: {
      userId: {
        type: Number,
        required: true
      }
    },
    data: function()
    {
      return {
        unreadNotificationsCount: 0,
        totalNotificationsCount: 0,
        notificationsList: []
      }
    },
    computed:
    {
      needsUpdate: function()
      {
        return this.unreadNotificationsCount || (this.totalNotificationsCount !== this.notificationsList.length) ? true : false;
      }
    },
    methods:
    {
      getNotificationsCount: function()
      {
        axios.get('/core/notifications/getCount').then((response) => {

          this.unreadNotificationsCount = parseInt(response.data.unread);
          this.totalNotificationsCount = parseInt(response.data.total);
        });
      },
      getNotificationsList: function()
      {
        if (this.needsUpdate) {

          axios.get('/core/notifications/getList').then((response) => {

            this.notificationsList = response.data;
          }).then(() => {

            if(this.needsUpdate) {

              this.markAsRead();
            }
          });
        }
      },
      markAsRead: function()
      {
        axios.patch('/core/notifications/markAsRead').then((response) => {

          this.notificationsList.forEach(function(notification) {

            if (!notification.read_at) {

              notification.read_at = response.data;
            }
          });
        }).then(() => {

          this.unreadNotificationsCount = 0;
          this.totalNotificationsCount = this.notificationsList.length;
        });
      },
      clearNotifications: function()
      {
        axios.patch('/core/notifications/clearAll').then((response) => {

            this.notificationsList = [];
            this.unreadNotificationsCount = 0;
            this.totalNotificationsCount = 0;
        });
      },
      listen: function()
      {
        var self = this;
        Echo.private('App.User.' + this.userId).notification(function(notification) {

          self.unreadNotificationsCount++;
          if ($('#notifications').hasClass('open')) {

            self.getNotificationsList();
          }
        });
      }
    },
    mounted: function()
    {
      this.getNotificationsCount();
      this.listen();
    }
  }

</script>