<template>
    <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="icon-bell"></i>
        <span class="count"></span>
    </a>
</template>

<script>
export default {
    mounted() {
        this.interval = setInterval(function() {
            this.getNotificationsCount();

        }.bind(this), 10000)
    },
    data() {
        return {
            provider: {
                provider_id: document
                    .querySelector("meta[name='provider-id']")
                    .getAttribute("content")
            },
            notificationsCount: "",
            counter: 0,
            firstNotification: "",
        };
    },
    methods: {
        getNotificationsCount() {
            axios.post("api/getNotificationsCount/" + this.provider.provider_id).then(response => {
                this.notificationsCount = response.data.count;
                if(this.counter == 0) {
                    this.firstNotification = this.notificationsCount;
                    this.counter++;
                }
                if (this.notificationsCount != this.firstNotification) {
                    this.playSound();
                    this.notify();
                    this.firstNotification = this.notificationsCount;

                }
            });
        },
        setSeen() {
            axios.post("api/setSeen/" + this.provider.provider_id).then(response => {
                this.notificationsCount = "";
                this.firstNotification = "";
            });
        },
        playSound() {
            var audio = new Audio("https://media1.vocaroo.com/mp3/15qmUOrvxTYa");
            audio.play();
        },
        notify() {
            Toast.fire({
                iconHtml: "<i class='fas fa-bell fa-fw'></i>",
                position: "bottom-end",
                iconColor: "#007bff",
                title: "You have a new notification!"
            });
        }
    },
    created() {
        this.getNotificationsCount();

    }
};
</script>
