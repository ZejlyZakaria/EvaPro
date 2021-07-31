<template>
    <div class="container">
        <div class="main-body">
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
                                    alt="Admin"
                                    class="rounded-circle"
                                    width="150"
                                />
                                <div class="mt-3">
                                    <h4>{{ admin.full_name }}</h4>
                                    <p class="text-secondary mb-1">
                                        {{ admin.job_title }}
                                    </p>
                                    <p class="text-muted font-size-sm">
                                        Bay Area, San Francisco, CA
                                    </p>
                                    <div class="file btn btn-lg btn-primary">
                                        Change picture
                                        <input
                                            type="file"
                                            name="file"
                                            class="profile-edit-btn"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                            >
                                <h6 class="mb-0">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-globe mr-2 icon-inline"
                                    >
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line
                                            x1="2"
                                            y1="12"
                                            x2="22"
                                            y2="12"
                                        ></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"
                                        ></path></svg
                                    >Website
                                </h6>
                                <span class="text-secondary"
                                    >https://bootdey.com</span
                                >
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                            >
                                <h6 class="mb-0">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-github mr-2 icon-inline"
                                    >
                                        <path
                                            d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"
                                        ></path></svg
                                    >Github
                                </h6>
                                <span class="text-secondary">bootdey</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                            >
                                <h6 class="mb-0">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-twitter mr-2 icon-inline text-info"
                                    >
                                        <path
                                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"
                                        ></path></svg
                                    >Twitter
                                </h6>
                                <span class="text-secondary">@bootdey</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                            >
                                <h6 class="mb-0">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-instagram mr-2 icon-inline text-danger"
                                    >
                                        <rect
                                            x="2"
                                            y="2"
                                            width="20"
                                            height="20"
                                            rx="5"
                                            ry="5"
                                        ></rect>
                                        <path
                                            d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"
                                        ></path>
                                        <line
                                            x1="17.5"
                                            y1="6.5"
                                            x2="17.51"
                                            y2="6.5"
                                        ></line></svg
                                    >Instagram
                                </h6>
                                <span class="text-secondary">bootdey</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                            >
                                <h6 class="mb-0">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-facebook mr-2 icon-inline text-primary"
                                    >
                                        <path
                                            d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"
                                        ></path></svg
                                    >Facebook
                                </h6>
                                <span class="text-secondary">bootdey</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3" id="formChange1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">First Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ admin.first_name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Last name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ admin.last_name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ admin.email }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ admin.phone }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Occupation</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ admin.job_title }}
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
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Changes -->
                    <div class="card mb-3" id="formChange2">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">First name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="text"
                                        name="first_name"
                                        :class="[
                                            'form-control',
                                            errors.first_name
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        v-model="admin.first_name"
                                        @change="fillFullName"
                                    />
                                </div>
                            </div>
                            <span
                                v-if="errors.first_name"
                                class="text-danger"
                                >{{ errors.first_name[0] }}</span
                            >
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Last name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
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
                                </div>
                            </div>
                            <span v-if="errors.last_name" class="text-danger">{{
                                errors.last_name[0]
                            }}</span>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="email"
                                        name="email"
                                        :class="[
                                            'form-control',
                                            errors.email ? 'is-invalid' : ''
                                        ]"
                                        v-model="admin.email"
                                    />
                                </div>
                            </div>
                            <span v-if="errors.email" class="text-danger">{{
                                errors.email[0]
                            }}</span>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input
                                        type="tel"
                                        name="phone"
                                        class="form-control"
                                        v-model="admin.phone"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Occupation</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select
                                        name="job_title"
                                        :class="[
                                            'form-control',
                                            errors.job_title ? 'is-invalid' : ''
                                        ]"
                                        v-model="admin.job_title"
                                    >
                                        <option :value="admin.job_title">{{admin.job_title}}</option>
                                        <option>Developper</option>
                                        <option>Manager</option>
                                        <option>CEO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <a
                                        class="btn btn-primary px-4"
                                        href="#"
                                        @click="updateAdmin"
                                    >
                                        Save changes
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gutters-sm">
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3">
                                        <i class="material-icons text-info mr-2"
                                            >assignment</i
                                        >Project Status
                                    </h6>
                                    <small>Web Design</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 80%"
                                            aria-valuenow="80"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <small>Website Markup</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 72%"
                                            aria-valuenow="72"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <small>One Page</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 89%"
                                            aria-valuenow="89"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <small>Mobile Template</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 55%"
                                            aria-valuenow="55"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <small>Backend API</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 66%"
                                            aria-valuenow="66"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3">
                                        <i class="material-icons text-info mr-2"
                                            >assignment</i
                                        >Project Status
                                    </h6>
                                    <small>Web Design</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 80%"
                                            aria-valuenow="80"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <small>Website Markup</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 72%"
                                            aria-valuenow="72"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <small>One Page</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 89%"
                                            aria-valuenow="89"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <small>Mobile Template</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 55%"
                                            aria-valuenow="55"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                    <small>Backend API</small>
                                    <div
                                        class="progress mb-3"
                                        style="height: 5px"
                                    >
                                        <div
                                            class="progress-bar bg-primary"
                                            role="progressbar"
                                            style="width: 66%"
                                            aria-valuenow="66"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                        ></div>
                                    </div>
                                </div>
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
    data() {
        return {
            admin: {
                admin_id: document
                    .querySelector("meta[name='user-id']")
                    .getAttribute("content"),
                first_name: document
                    .querySelector("meta[name='user-first_name']")
                    .getAttribute("content"),
                last_name: document
                    .querySelector("meta[name='user-last_name']")
                    .getAttribute("content"),
                full_name: document
                    .querySelector("meta[name='user-full_name']")
                    .getAttribute("content"),
                job_title: document
                    .querySelector("meta[name='user-job_title']")
                    .getAttribute("content"),
                email: document
                    .querySelector("meta[name='user-email']")
                    .getAttribute("content"),
                phone: document
                    .querySelector("meta[name='user-phone']")
                    .getAttribute("content"),
                image: "assets/images/" + document
                    .querySelector("meta[name='user-image']")
                    .getAttribute("content")
            },
            errors: []
        };
    },
    methods: {
        updateAdmin() {
            var url = "api/updateAdmin/" + this.admin.admin_id;
            axios.post(url, this.admin).then(response => {
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Toast.fire({
                        icon: "success",
                        title: "Updated successfully"
                    });
                    this.errors = [];
                }
                });
        },
        edit() {
            $("#formChange1").toggle();
            $("#formChange2").toggle();
        },
        fillFullName() {
            this.admin.first_name = this.admin.first_name.toUpperCase();
            this.admin.last_name = this.admin.last_name.toUpperCase();
            this.admin.full_name = this.admin.first_name + " " + this.admin.last_name;
        }
    }
};
</script>

<style scoped>
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm > .col,
.gutters-sm > [class*="col-"] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3,
.my-3 {
    margin-bottom: 1rem !important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100% !important;
}
.shadow-none {
    box-shadow: none !important;
}
#formChange2 {
    display: none;
}
#partLeft .file {
    position: relative;
    overflow: hidden;
    width: 200px;
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
