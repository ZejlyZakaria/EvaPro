<template>
    <a
        class="nav-link dropdown-toggle"
        href=""
        id="alertsDropdown"
        role="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="setSeen"
    >
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span v-if="notificationsCount != ''" class="badge badge-danger badge-counter">{{ notificationsCount }}</span>
    </a>
</template>

<script>
window.setInterval(function() {
  this.getNotificationsCount;
}, 5000);
export default {
    data() {
        return {
            provider: {
                provider_id: document
                    .querySelector("meta[name='provider-id']")
                    .getAttribute("content")
            },
            notificationsCount: "",
        };
    },
    methods: {
        getNotificationsCount() {
            axios.post("api/getNotificationsCount/" + this.provider.provider_id).then(response => {
                this.notificationsCount = response.data.count;
            });
        },
        setSeen() {
            axios.post("api/setSeen/" + this.provider.provider_id).then(response => {
                this.notificationsCount = "";
            });
        }
    },
    created() {
        this.getNotificationsCount();
    }
};
</script>
