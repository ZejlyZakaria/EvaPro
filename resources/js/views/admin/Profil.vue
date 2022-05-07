<template>
    <div class="container-fluid">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="d-flex flex-column align-items-center text-center"
                            id="partLeft"
                        >
                            <img
                                :src="admin.image"
                                alt="admin"
                                class="rounded-circle"
                                width="150"
                            />
                            <div class="mt-3">
                                <h4>{{ admin.full_name }}</h4>
                                <p class="text-secondary mb-1">
                                    {{ admin.type }}
                                </p>
                                <p class="text-muted font-size-sm">
                                    {{ admin.email }}
                                </p>
                                <div class="file btn btn-lg btn-primary">
                                    Changer la photo
                                    <input
                                        type="file"
                                        name="file"
                                        id="fileInput"
                                        class="profile-edit-btn"
                                        @change="onChange"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Mot de passe</h5>
                            <div class="form-group">
                                <label for="exampleInputPassword1"
                                    >Mot de passe actuel</label
                                >
                                <input
                                    type="password"
                                    :class="[
                                        'form-control',
                                        errorsPass.currentPass
                                            ? 'is-invalid'
                                            : ''
                                    ]"
                                    id="exampleInputPassword1"
                                    v-model="password.currentPass"
                                    placeholder="Saisissez votre mot de passe acteul"
                                />
                                <span
                                    v-if="errorsPass.currentPass"
                                    class="text-danger" style="font-size: 0.8rem"
                                    >{{ errorsPass.currentPass[0] }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"
                                    >Nouveau mot de passe</label
                                >
                                <input
                                    type="password"
                                    :class="[
                                        'form-control',
                                        errorsPass.newPass ? 'is-invalid' : ''
                                    ]"
                                    id="exampleInputPassword1"
                                    v-model="password.newPass"
                                    placeholder="Saisissez votre nouveau mot de passe"
                                />
                                <span
                                    v-if="errorsPass.newPass"
                                    class="text-danger" style="font-size: 0.8rem"
                                    >{{ errorsPass.newPass[0] }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1"
                                    >Confirmez le mot de passe</label
                                >
                                <input
                                    type="password"
                                    :class="[
                                        'form-control',
                                        errorsPass.newPassC ? 'is-invalid' : ''
                                    ]"
                                    id="exampleInputConfirmPassword1"
                                    v-model="password.newPassC"
                                    placeholder="Ressaisissez votre nouveau mot de passe"
                                />
                                <span
                                    v-if="errorsPass.newPassC"
                                    class="text-danger" style="font-size: 0.8rem"
                                    >{{ errorsPass.newPassC[0] }}
                                </span>
                            </div>
                            <button
                                type="button"
                                class="btn btn-primary me-2"
                                @click="changePassword"
                            >
                                Modifier
                            </button>
                        </div>
                    </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3 p-2" id="formChange1">
                    <div class="card-body">
                        <h5 class="card-title">Informations</h5>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Prénom</h6>
                            </div>
                            <div class="col-sm-9">
                                {{ admin.first_name }}
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nom</h6>
                            </div>
                            <div class="col-sm-9">
                                {{ admin.last_name }}
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Adresse e-mail</h6>
                            </div>
                            <div class="col-sm-9">
                                {{ admin.email }}
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tél</h6>
                            </div>
                            <div class="col-sm-9">
                                {{ admin.phone }}
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Sexe</h6>
                            </div>
                            <div class="col-sm-9">
                                {{ admin.gender }}
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Date de naissance</h6>
                            </div>
                            <div class="col-sm-9 ">
                                {{ admin.dateOfBirth }}
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-12">
                                <a
                                    class="btn btn-primary px-4"
                                    href="#"
                                    @click="edit"
                                >
                                    Modifier
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Changes -->
                <div class="card mb-3" id="formChange2">
                    <div class="card-body">
                        <h5 class="card-title">Modifier les informations</h5>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Prénom</h6>
                            </div>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    name="first_name"
                                    :class="[
                                        'form-control',
                                        errors.first_name ? 'is-invalid' : ''
                                    ]"
                                    v-model="admin.first_name"
                                    @change="fillFullName"
                                />
                                <div class="col-sm">
                                    <span
                                        v-if="errors.first_name"
                                        class="text-danger"
                                        >{{ errors.first_name[0] }}</span
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nom</h6>
                            </div>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    name="last_name"
                                    :class="[
                                        'form-control',
                                        errors.last_name ? 'is-invalid' : ''
                                    ]"
                                    v-model="admin.last_name"
                                    @change="fillFullName"
                                />
                                <div class="col-sm">
                                    <span
                                        v-if="errors.last_name"
                                        class="text-danger"
                                        >{{ errors.last_name[0] }}</span
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Adresse e-mail</h6>
                            </div>
                            <div class="col-sm-9 ">
                                <input
                                    type="email"
                                    name="email"
                                    :class="[
                                        'form-control',
                                        errors.email ? 'is-invalid' : ''
                                    ]"
                                    v-model="admin.email"
                                />
                                <div class="col-sm">
                                    <span
                                        v-if="errors.email"
                                        class="text-danger"
                                        >{{ errors.email[0] }}</span
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tél</h6>
                            </div>
                            <div class="col-sm-9 ">
                                <input
                                    type="tel"
                                    name="phone"
                                    :class="[
                                        'form-control',
                                        errors.phone ? 'is-invalid' : ''
                                    ]"
                                    v-model="admin.phone"
                                />
                                <div class="col-sm">
                                    <span
                                        v-if="errors.phone"
                                        class="text-danger"
                                        >{{ errors.phone[0] }}</span
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Sexe</h6>
                            </div>
                            <div class="col-sm-9 ">
                                <select
                                    name="job_title"
                                    :class="[
                                        'form-control',
                                        errors.gender ? 'is-invalid' : ''
                                    ]"
                                    v-model="admin.gender"
                                >
                                    <option :value="admin.gender">{{
                                        admin.gender
                                    }}</option>
                                    <option v-if="admin.gender == 'Masculin'"
                                        >Féminin</option
                                    >
                                    <option v-if="admin.gender == 'Féminin'"
                                        >Masculin</option
                                    >
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Date de naissance</h6>
                            </div>
                            <div class="col-sm-9">
                                <input
                                    type="date"
                                    name="phone"
                                    :class="[
                                        'form-control',
                                        errors.dateOfBirth ? 'is-invalid' : ''
                                    ]"
                                    v-model="admin.dateOfBirth"
                                />
                                <div class="col-sm">
                                    <span
                                        v-if="errors.dateOfBirth"
                                        class="text-danger"
                                        >{{ errors.dateOfBirth[0] }}</span
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <a
                                    class="btn btn-primary px-4"
                                    href="#"
                                    @click="updateAdmin"
                                >
                                    Sauvegarder
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from "jquery";
export default {
    mounted() {
        this.getAdmin();
    },
    data() {
        return {
            admin: {
                id: document
                    .querySelector("meta[name='user-id']")
                    .getAttribute("content"),
                first_name: "",
                last_name: "",
                full_name: "",
                email: "",
                phone: "",
                gender: "",
                dateOfBirth: "",
                image:
                    "assets/images/" +
                    document
                        .querySelector("meta[name='user-image']")
                        .getAttribute("content")
            },
            file: "",
            errors: [],
            errorsPass: [],
            password: {
                currentPass: "",
                newPass: "",
                newPassC: ""
            }
        };
    },
    methods: {
        updateAdmin() {
            var formData = new FormData();
            formData.append("file", this.file);
            Object.entries(this.admin).forEach(([key, value]) => {
                formData.append(key, value);
            });
            var url = "api/updateAdmin/" + this.admin.id;
            axios.post(url, formData).then(response => {
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Vos changements ont été enregistrés",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.errors = [];
                    this.edit();
                    if (this.file != "") {
                        this.admin.image = "assets/images/" + this.admin.image;
                    }
                }
            });
        },
        getAdmin() {
            var url = "api/getAdmin/" + this.admin.id;
            axios.post(url).then(response => {
                this.admin = response.data.data;
                this.admin.image = "assets/images/" + this.admin.image;
            });
        },
        updateImage() {
            var formData = new FormData();
            formData.append("file", this.file);
            var url = "api/updateImageAdmin/" + this.admin.id;
            axios.post(url, formData).then(response => {
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Votre image a été enregistrée",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.getAdmin();
                }
            });
        },
        changePassword() {
            if (this.password.newPass != this.password.newPassC) {
                this.errorsPass = {
                    newPassC: [
                        "Le mot de passe de confirmation n'est pas le même."
                    ]
                };
            } else {
                this.errorsPass = [];
                var url =
                    "api/changePasswordConfirmationAdmin/" + this.admin.id;
                axios.post(url, this.password).then(response => {
                    if (response.data.status == "error") {
                        this.errorsPass = {
                            currentPass: [
                                "Le mot de passe actuel est incorrect."
                            ]
                        };
                    } else if (response.data.status == "success") {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Votre mot de passe a été modifié",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.errorsPass = [];
                        this.password.currentPass = "";
                        this.password.newPass = "";
                        this.password.newPassC = "";
                    }
                });
            }
        },
        edit() {
            $("#formChange1").toggle();
            $("#formChange2").toggle();
        },
        onChange(e) {
            this.fileValidation(e);
        },
        fillFullName() {
            this.admin.first_name = this.admin.first_name.toUpperCase();
            this.admin.last_name = this.admin.last_name.toUpperCase();
            this.admin.full_name =
                this.admin.first_name + " " + this.admin.last_name;
        },
        fileValidation(e) {
            const fi = document.getElementById("fileInput");
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {
                    const fsize = fi.files.item(i).size;
                    const file = Math.round(fsize / 1024);
                    // The size of the file.
                    if (file > 2048) {
                        alert(
                            "Fichier trop gros, veuillez sélectionner un fichier de moins de 2 Mo"
                        );
                    } else {
                        this.file = e.target.files[0];
                        this.updateImage();
                    }
                }
            }
        }
    }
};
</script>

<style scoped>
#formChange2 {
    display: none;
}
#partLeft .file {
    position: relative;
    overflow: hidden;
    width: 250px;
    border: none;
    font-size: 15px;
    margin-top: 5px;
    color: #495057;
    background-color: rgb(233, 233, 233);
}
#partLeft .file:hover {
    cursor: pointer;
}
#partLeft .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
}
</style>
