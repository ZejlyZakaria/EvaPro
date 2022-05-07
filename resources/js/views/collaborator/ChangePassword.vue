<template>
    <div
        class="modal"
        id="firstModal"
        tabindex="-1"
        role="dialog"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                   Changez votre mot de passe
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nouveau mot de passe</label>
                        <input type="password" placeholder="Saisissez un nouveau mot de passe" class="form-control" aria-describedby="emailHelp" v-model="provider.password">
                    </div>
                    <div class="form-group">
                        <label>Confirmation du nouveau mot de passe</label>
                        <input type="password" placeholder="Ressaisissez votre nouveau mot de passe" class="form-control" v-model="provider.passwordConfirmation">
                    </div>
                    <span v-if="error != ''" class="text-danger">{{
                        error
                    }}</span>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="changePassword">
                        <span v-show="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Sauvegarder
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import $ from 'jquery';

export default {
    mounted() {
        $("#firstModal").modal('show');
    },
    data() {
        return {
            provider: {
                provider_id: document
                    .querySelector("meta[name='provider-id']")
                    .getAttribute("content"),
                password: "",
                passwordConfirmation: ""
            },
            error: "",
            isLoading: false
        };
    },
    methods: {
        changePassword() {
            this.isLoading = true;
            if (this.provider.password != this.provider.passwordConfirmation) {
                this.isLoading = false;
                this.error = "Le mot de passe de confirmation n'est pas le même!"
            }
            else{
                axios
                .post("api/changePassword/" + this.provider.provider_id, this.provider)
                .then(response => {
                    this.isLoading = false;
                    if (response.data.status == "success") {
                        this.error = "";
                        $('#firstModal').modal('hide');
                        Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Votre mot de passe a été modifié avec succès.",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    }

                });
            }

        },
    },
};
</script>

<style scoped>
.modal-confirm {
	color: #636363;
	width: 325px;
	font-size: 14px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	border-bottom: none;
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -15px;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px;
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -5px;
}
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
}
.modal-confirm .icon-box {
	color: #fff;
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -70px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #82ce34;
	padding: 15px;
	text-align: center;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-confirm .icon-box i {
	font-size: 58px;
	position: relative;
	top: 3px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn {
	color: #fff;
	border-radius: 4px;
	background: #82ce34;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #6fb32b;
	outline: none;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>
