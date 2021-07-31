<template>
    <div
        class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown"
    >
        <h6 class="dropdown-header">
            Alerts Center
        </h6>
        <div v-if="isEmpty(notifications)" class="text-center mt-3" >You don't have any notification</div>
        <a class="dropdown-item d-flex align-items-center" href="#">
            <div v-for="notification in notifications" :key="notification.id">

                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-briefcase text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">
                        {{ notification.created_at}}
                    </div>
                    <span class="font-weight-bold"
                        >{{ notification.content }}
                    </span>
                </div>
            </div>
        </a>
        <!-- <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
                <div class="icon-circle bg-success">
                    <i class="fas fa-donate text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">December 7, 2019</div>
                $290.29 has been deposited into your account!
            </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
                <div class="icon-circle bg-warning">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">December 2, 2019</div>
                Spending Alert: We've noticed unusually high spending for your
                account.
            </div>
        </a> -->
        <a class="dropdown-item text-center small text-gray-500" href="#"
            >Show All Alerts</a
        >
    </div>
</template>

<script>
export default {
     data() {
        return {
            provider: {
                provider_id: document.querySelector("meta[name='provider-id']").getAttribute("content"),
            },
            notifications: {}
        };
    },
    methods: {
        getNotifications() {
            // axios.post("api/getNotifications/" + this.provider.provider_id).then(response => {
            //     this.notifications = response.data.data;
            // });
        },
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        }
    },
    created() {
        this.getNotifications();
    },
};
</script>
