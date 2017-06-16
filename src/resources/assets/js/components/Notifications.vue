<template>
	<li id="notifications" class="dropdown notifications-menu">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" @click="getList()">
			<i class="fa fa-bell-o"></i>
			<span class="label label-danger" v-if="unreadCount" v-text="unreadCount"></span>
		</a>
		<ul class="dropdown-menu" v-cloak>
			<li class="header" v-if="unreadCount"><slot name="you-have"></slot> {{ unreadCount }} <span v-if="unreadCount == 1"><slot name="one"></slot></span><span v-else><slot name="many"></slot></span></li>
			<li class="header" v-else><slot name="no-notifications"></slot></li>
				<li>
					<ul class="menu">
						<li><!-- start message -->
						  <a href="#">
						    <div class="pull-left">
						      <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
						    </div>
						    <h4>
						      Support Team
						      <small><i class="fa fa-clock-o"></i> 5 mins</small>
						    </h4>
						    <p>Why not buy a new awesome theme?</p>
						  </a>
						</li>
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
		data: function() {
			return {
				unreadCount: 0,
				totalNotificationsCount: 0,
				notificationsList: []
			}
		},
		computed: {
			needsUpdate: function() {
				return this.unreadCount || (this.totalNotificationsCount !== this.notificationsList.length) ? true : false;
			}
		},
		methods: {
			getNotificationsCount: function() {
				axios.get('/core/notifications/getCount').then((response) => {
					this.unreadCount = parseInt(response.data.unread);
					this.totalNotificationsCount = parseInt(response.data.total);
				});
			},
			getList: function() {
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
			markAsRead: function() {
				axios.patch('/core/notifications/markAsRead').then((response) => {
					this.unreadCount = 0;
					this.totalNotificationsCount = this.notificationsList.length;
				});
			},
			clearNotifications: function() {
				axios.patch('/core/notifications/clearAll').then((response) => {
						this.notificationsList = [];
						this.unreadCount = 0;
						this.totalNotificationsCount = 0;
				});
			},
			listen: function() {
				let self = this;
				Echo.private('App.User.' + this.userId).notification(function(notification) {
					self.unreadCount++;
					if ($('#notifications').hasClass('open')) {
						self.getList();
					}
				});
			}
		},
		mounted: function() {
			this.getNotificationsCount();
			this.listen();
		}
	}

</script>