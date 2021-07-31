<template>
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img
                            class="rounded-circle"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                            alt=""
                        />
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
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{ info.name }}
                        </h5>
                        <h6>
                            {{ info.job }}
                        </h6>
                        <p class="proile-rating">
                            RANKINGS : <span>8/10</span>
                        </p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    id="home-tab"
                                    data-toggle="tab"
                                    href="#home"
                                    role="tab"
                                    aria-controls="home"
                                    aria-selected="true"
                                    >About</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    id="profile-tab"
                                    data-toggle="tab"
                                    href="#profile"
                                    role="tab"
                                    aria-controls="profile"
                                    aria-selected="false"
                                    >Timeline</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <input
                        type="submit"
                        class="profile-edit-btn"
                        name="btnAddMore"
                        value="Edit Profile"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>WORK LINK</p>
                        <a href="">Website Link</a><br />
                        <a href="">Bootsnipp Profile</a><br />
                        <a href="">Bootply Profile</a>
                        <p>SKILLS</p>
                        <a href="">Web Designer</a><br />
                        <a href="">Web Developer</a><br />
                        <a href="">WordPress</a><br />
                        <a href="">WooCommerce</a><br />
                        <a href="">PHP, .Net</a><br />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div
                            class="tab-pane fade show active"
                            id="home"
                            role="tabpanel"
                            aria-labelledby="home-tab"
                        >
                            <div class="row">
                                <div class="col-md-6">
                                    <label>User Id</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ info.user_id }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ info.name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ info.email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>123 456 7890</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Profession</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ info.job }}</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="profile"
                            role="tabpanel"
                            aria-labelledby="profile-tab"
                        >
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Experience</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Expert</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Hourly Rate</label>
                                </div>
                                <div class="col-md-6">
                                    <p>10$/hr</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Total Projects</label>
                                </div>
                                <div class="col-md-6">
                                    <p>230</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>English Level</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Expert</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Availability</label>
                                </div>
                                <div class="col-md-6">
                                    <p>6 months</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Your Bio</label><br />
                                    <p>Your detail description</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            info: {
                user_id: document
                    .querySelector("meta[name='user-id']")
                    .getAttribute("content"),
                name: document
                    .querySelector("meta[name='user-name']")
                    .getAttribute("content"),
                job: document
                    .querySelector("meta[name='user-job']")
                    .getAttribute("content"),
                email: document
                    .querySelector("meta[name='user-email']")
                    .getAttribute("content")
            }
        };
    }
};
</script>

<style scoped>
.emp-profile {
    margin: 0;
}
.profile-img {
    text-align: center;
    display: block;
}
.profile-img img {
    width: 180px;
    height: 200px;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    width: 50%;
    border: none;
    border-radius: 25px;
    font-size: 15px;
    margin-top: 5px;
    color: #495057;
    background-color: rgb(233, 233, 233);
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
}
.profile-head h5 {
    color: #333;
}
.profile-head h6 {
    color: #0062cc;
}
.profile-edit-btn {
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating {
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span {
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs {
    margin-bottom: 5%;
}
.profile-head .nav-tabs .nav-link {
    font-weight: 600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active {
    border: none;
    border-bottom: 2px solid #0062cc;
}
.profile-work {
    padding: 14%;
    margin-top: -15%;
}
.profile-work p {
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a {
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul {
    list-style: none;
}
.profile-tab label {
    font-weight: 600;
}
.profile-tab p {
    font-weight: 600;
    color: #0062cc;
}
.roundDiv {
    border-radius: 50%;
}
</style>
