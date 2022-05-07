<template>
    <div
        class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
        aria-labelledby="notificationDropdown"
    >
        <a class="dropdown-item py-3 border-bottom">
            <p class="mb-0 font-weight-medium float-left">
                Vous avez {{ notifications.length }} nouvelles notifications
            </p>
            <span class="badge badge-pill badge-primary float-right" @click="deleteNotifications"
                >Tout supprimer</span
            >
        </a>
        <a
            class="dropdown-item preview-item py-3"
            v-for="notification in notifications"
            :key="notification.id"
        >
            <div class="preview-thumbnail">
                <i
                    :class="['m-auto text-primary', notification.type == 'reportwork' ?
                    'mdi mdi-flask-outline' : notification.type == 'starting' ? 'mdi mdi-human-greeting' : ''  ]"
                    style="font-size: 2rem"
                ></i>
            </div>
            <div class="preview-item-content">
                <h6 class="preview-subject fw-normal text-dark mb-1">
                    {{ notification.content }}
                </h6>
                <p class="fw-light small-text mb-0">
                    {{ notification.created_at }}
                </p>
            </div>
        </a>
    </div>

</template>

<script>export default {
    mounted() {
        this.getNotifications();
        this.interval = setInterval(
            function() {
                this.getNotifications();
            }.bind(this),
            10000
        );
    },
    data() {
        return {
            admin: {
                admin_id: document
                    .querySelector("meta[name='user-id']")
                    .getAttribute("content")
            },
            notifications: {}
        };
    },
    methods: {
        getNotifications() {
            axios
                .post("api/getNotifications/" + this.admin.admin_id + '/admin')
                .then(response => {
                    this.notifications = response.data.data.reverse();
                });
        },
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        },
        deleteNotifications() {
            axios
                .post("api/deleteNotifications/" + this.admin.admin_id + '/admin')
                .then(response => {
                    this.notifications = {};
                });
        }
    },
    created() {
        this.getNotifications();
    }
};
</script>

<style scoped>
.scrollNotify::-webkit-scrollbar {
    display: none;
}
</style>
