<template>
    <div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Activity Report</h4>
                <p class="card-description">
                    You indicate the working days for the selected month
                </p>
                <form class="forms-sample">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="exampleInputUsername1"
                            placeholder="Username"
                        />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input
                            type="email"
                            class="form-control"
                            id="exampleInputEmail1"
                            placeholder="Email"
                        />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="exampleInputPassword1"
                            placeholder="Password"
                        />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputConfirmPassword1"
                            >Confirm Password</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            id="exampleInputConfirmPassword1"
                            placeholder="Password"
                        />
                    </div>
                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" />
                            Remember me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">
                        Submit
                    </button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>


    </div>
        <div class="row">
            <div class="col-md-3">
              <div class="fc-external-events">
                <div class='fc-event'>
                  <p>Deciphering Marketing Lingo For Small Business Owners</p>
                  <p class="small-text"></p>
                  <p class="text-muted mb-0">Georgia</p>
                </div>
                <div class='fc-event'>
                  <p>Influencing The Influencer</p>
                  <p class="small-text"></p>
                  <p class="text-muted mb-0">Netherlands</p>
                </div>
                <div class='fc-event'>
                  <p>Profiles Of The Powerful Advertising Exec Steve Grasse</p>
                  <p class="small-text"></p>
                  <p class="text-muted mb-0">Canada</p>
                </div>
              </div>
              <div class="mt-4">
                <p>Filter board</p>
                <div class="form-check form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Project Board
                  </label>
                </div>
                <div class="form-check form-check-danger">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Kamban Board
                  </label>
                </div>
                <div class="form-check form-check-info">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Summary Board
                  </label>
                </div>
                <div class="form-check form-check-success">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Planner Board
                  </label>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Fullcalendar</h4>
                    <FullCalendar :options="calendarOptions" />
                </div>
              </div>
            </div>
        </div>
    </div>

</template>

<script>
import Datepicker from "vuejs-datepicker";
import { en, fr } from "vuejs-datepicker/dist/locale";
import $ from "jquery";
import NotificationsBar from "./NotificationsBar.vue";

import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import { mapGetters } from "vuex";
export default {
    mounted() {
        this.getProjects();
        this.getCalendars();
        this.changeBG();
    },
    data() {
        return {
            expense: {
                subject: "",
                amount: ""
            },
            provider: {
                id: document
                    .querySelector("meta[name='provider-id']")
                    .getAttribute("content")
            },
            project: {
                id: ""
            },
            projects: {},
            expenses: {},
            errors: [],
            event: {
                start: "",
                end: "",
                nbrOfDays: 0
            },
            file: "",
            newFile: "",
            isDisponible: true,
            currentExpense: "",
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                header: {
                    left: "prev,next,today",
                    center: "title",
                    right: "month,agendaWeek,agendaDay"
                },
                // dateClick: this.handleDateClick,
                weekends: true,
                selectable: true,
                selectMirror: true,
                unselectAuto: true,
                dragScroll: true,
                eventLimit: true,
                editable: true,
                events: [],
                views: {
                    dayGrid: {
                        eventLimit: 2 // adjust to 6 only for timeGridWeek/timeGridDay
                    }
                },
                dayMaxEvents: 2,
                select: this.handleSelect,
                eventClick: function(arg) {
                    console.log(arg.id);
                }
            }
        };
    },
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    methods: {
        toggleWeekends: function() {
            this.calendarOptions.weekends = !this.calendarOptions.weekends; // toggle the boolean!
        },
        handleSelect(arg) {
            let id_project = $("#selectProject").val();
            var url =
                "api/isAvailableCalendar/" +
                arg.startStr +
                "/" +
                arg.endStr +
                "/" +
                id_project;
            axios.post(url).then(response => {
                if (response.data.data == "true") {
                    this.event.start = arg.startStr;
                    this.event.end = arg.endStr;
                    let lastDay = this.event.end.slice(
                        this.event.end.length - 2
                    );
                    let firstDay = this.event.start.slice(
                        this.event.start.length - 2
                    );
                    let res = parseInt(lastDay) - parseInt(firstDay);
                    this.event.nbrOfDays = res;
                    this.addToCalendar();
                }
            });
        },
        addToCalendar() {
            let project_id = $("#selectProject").val();
            var url = "api/addToCalendar/" + project_id;
            $("#cover-spin").show(0);
            axios.post(url, this.event).then(response => {
                if (response.data.status == "success") {
                    this.getCalendars();
                } else {
                    $("#cover-spin").hide(0);
                }
            });
        },
        getCalendars() {
            $("#cover-spin").show(0);
            var url = "api/getCalendars/" + this.provider.id;
            axios.post(url).then(response => {
                this.calendarOptions.events = response.data.data;
                $("#cover-spin").hide(0);
            });
        },
        getNbrOfDays(elem) {
            elem = JSON.stringify(elem);
            let project_id = $("#selectProject").val();
            var url = "api/getNbrOfDays/" + project_id;
            axios.post(url, elem).then(response => {
                $("#cover-spin").hide(0);
                alert(response.data.data);
            });
        },
        getCalendarsId() {
            $("#cover-spin").show(0);

            let project_id = $("#selectProject").val();
            var url = "api/getCalendarsId/" + project_id;
            axios.post(url).then(response => {
                var output = [];
                for (var i = 0; i < response.data.data.length; ++i)
                    output.push(response.data.data[i]['id']);
                this.getNbrOfDays(output);
            });
        },
        changeBG() {
            const feries = [
                "2026-01-01",
                "2026-04-06",
                "2026-05-01",
                "2026-05-08",
                "2026-05-14",
                "2026-05-25",
                "2026-07-14",
                "2026-08-15",
                "2026-11-01",
                "2026-11-11",
                "2026-12-25",
                "2025-01-01",
                "2025-04-21",
                "2025-05-01",
                "2025-05-08",
                "2025-05-29",
                "2025-06-09",
                "2025-07-14",
                "2025-08-15",
                "2025-11-01",
                "2025-11-11",
                "2025-12-25",
                "2024-01-01",
                "2024-04-01",
                "2024-05-01",
                "2024-05-08",
                "2024-05-09",
                "2024-05-20",
                "2024-07-14",
                "2024-08-15",
                "2024-11-01",
                "2024-11-11",
                "2024-12-25",
                "2023-01-01",
                "2023-04-10",
                "2023-05-01",
                "2023-05-08",
                "2023-05-18",
                "2023-05-29",
                "2023-07-14",
                "2023-08-15",
                "2023-11-01",
                "2023-11-11",
                "2023-12-25",
                "2022-01-01",
                "2022-04-18",
                "2022-05-01",
                "2022-05-08",
                "2022-05-26",
                "2022-06-06",
                "2022-07-14",
                "2022-08-15",
                "2022-11-01",
                "2022-11-11",
                "2022-12-25",
                "2021-01-01",
                "2021-04-05",
                "2021-05-01",
                "2021-05-08",
                "2021-05-13",
                "2021-05-24",
                "2021-07-14",
                "2021-08-15",
                "2021-11-01",
                "2021-11-11",
                "2021-12-25",
                "2020-01-01",
                "2020-04-13",
                "2020-05-01",
                "2020-05-08",
                "2020-05-21",
                "2020-06-01",
                "2020-07-14",
                "2020-08-15",
                "2020-11-01",
                "2020-11-11",
                "2020-12-25"
            ];
            for (let index = 0; index < feries.length; index++) {
                var d = "td[data-date=" + "'" + feries[index] + "'" + "]";
                $(d).css("background-color", "#bfbfbf");
            }
            $(".fc-button").click(function() {
                for (let index = 0; index < feries.length; index++) {
                    var d = "td[data-date=" + "'" + feries[index] + "'" + "]";
                    $(d).css("background-color", "#bfbfbf");
                }
            });
        },
        nextStep(elem1, elem2, percent) {
            var elem1 = "#" + elem1;
            var elem2 = "#" + elem2;
            $(elem1).toggle();
            $(elem2).toggle();
            $(".progress-bar").animate({ width: percent }, 1200); // animate progress-bar
        },
        nextStepP(elem1, elem2, elem3) {
            var elem1 = "#" + elem1;
            var elem2 = "#" + elem2;

            if (elem3 == "back") {
                $(elem1).removeClass("done", 1200);
                $(elem2).removeClass("active", 1200);
                $(elem2).addClass("disable", 1200);
            } else {
                $(elem1).addClass("done", 1200);
                $(elem2).removeClass("disable", 1200);
                $(elem2).addClass("active", 1200);
            }
        },
        setProjectId() {
            this.project.id = $("#selectProject").val();
            this.getExpenses();
        },
        getProjects() {
            var url = "api/getProjects/" + this.provider.id;
            axios.post(url).then(response => {
                this.projects = response.data.data;
            });
        },
        addExpense() {
            if (this.file != "") {
                var formData = new FormData();
                formData.append("file", this.file);
                Object.entries(this.expense).forEach(([key, value]) => {
                    formData.append(key, value);
                });
                var url =
                    "api/addExpense/" +
                    this.provider.id +
                    "/" +
                    this.project.id;
                axios.post(url, formData).then(response => {
                    if (response.data.status == "error") {
                        this.errors = response.data.errors;
                    } else if (response.data.status == "success") {
                        this.errors = [];
                        this.reset();
                        this.getExpenses();
                    }
                });
            }
        },
        getExpenses() {
            var url =
                "api/getExpenses/" + this.provider.id + "/" + this.project.id;
            axios.post(url).then(response => {
                this.expenses = response.data.data.reverse();
            });
        },
        deleteExpense(elem) {
            var url = "api/deleteExpense/" + elem + "/" + this.provider.id;
            axios.post(url).then(response => {
                this.getExpenses();
            });
        },
        changeFile() {
            if (this.newFile != "") {
                var formData = new FormData();
                formData.append("file", this.newFile);
                var url =
                    "api/changeFile/" +
                    this.currentExpense +
                    "/" +
                    this.provider.id;
                axios.post(url, formData).then(response => {
                    if (response.data.status == "error") {
                        this.errors = response.data.errors;
                    } else if (response.data.status == "success") {
                        this.getExpenses();
                    }
                });
            }
            $("#showFileModal").modal("hide");
        },
        showFile(elem, elem2) {
            this.currentExpense = elem2;
            $("#iframeFile").attr(
                "src",
                "assets/files/" + this.provider.id + "/" + elem
            );
            $("#showFileModal").modal("toggle");
        },
        onChange(e) {
            if (e.target.files[0].size / 1024 / 1024 > 2) {
                $("#customFile").val("");
                Swal.fire("The file size is too big.");
            } else {
                this.file = e.target.files[0];
            }
        },
        onChangeFile(e) {
            if (e.target.files[0].size / 1024 / 1024 > 2) {
                $("#inputFile2").val("");
                Swal.fire("The file size is too big.");
            } else {
                this.newFile = e.target.files[0];
                let src = URL.createObjectURL(e.target.files[0]);
                $("#iframeFile").attr("src", src);
            }
        },
        reset() {
            this.expense.subject = this.expense.amount = "";
            this.expense.files = [];
            $("#customFile").val("");
        },
        filevalidation() {
            const fi = document.getElementById("customFile");
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {
                    const fsize = fi.files.item(i).size;
                    const file = Math.round(fsize / 1024);
                    // The size of the file.
                    if (file >= 1) {
                        alert(
                            "File too Big, please select a file less than 4mb"
                        );
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        },
        displayMessage(message) {
            toastr.success(message, "Event");
        }
    }
};
</script>

<style scoped>
.progress-bar {
    background-color: #8b008b;
}
.bg-buttons {
    background-color: #6617cb;
    background-image: linear-gradient(315deg, #6617cb 0%, #cb218e 74%);
}

.progressbar {
    width: 100%;
    margin: 0;
    padding: 0;
    position: relative;
    z-index: 100;
}
.progressbar li {
    list-style-type: none;
    width: 30%;
    float: left;
    font-size: 1rem;
    position: relative;
    text-align: center;
    color: #c87137;
}

.progressbar li:after {
    width: 100%;
    height: 4px;
    content: "";
    position: absolute;
    background-color: #c4c4c4;
    top: 25px;
    left: -50%;
    z-index: -1;
}
.progressbar li:first-child:after {
    content: none;
}

.progressbar li.active:before {
    border-color: #c4c4c4;
    animation: yourCustomAnimation 0.5s;
    animation-fill-mode: both;
}
.progressbar li.active + li:after {
    background-color: #c4c4c4;
    animation: animation1 0.5s;
    animation-fill-mode: both;
}

.progressbar li.done:before {
    border-color: #4b0082;
}
.progressbar li.done + li:after {
    background-color: #4b0082;
    animation: animation1 0.5s;
    animation-fill-mode: both;
}

.progressbar li:before {
    width: 50px;
    height: 50px;
    border: 5px solid #c87137;
    display: block;
    text-align: center;
    margin: auto;
    border-radius: 50%;
    background-color: #4b0082;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}
.progressbar li.disable:before {
    width: 50px;
    height: 50px;
    border: 5px solid #e4e4e4;
    display: block;
    text-align: center;
    margin: auto;
    border-radius: 50%;
    background-color: #e4e4e4;
    color: #4b0082;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: animation1 0.5s;
    animation-fill-mode: both;
}

li:before {
    content: "";
}

/* Step Count */
ul.rb-step {
    counter-reset: step;
}

ul.rb-step li:before {
    content: counter(step);
    counter-increment: step;
}

/* For Square */
ul.rb-square li::before {
    border-radius: 0;
}
/* For Rounded Square */
ul.rb-rounded-square li::before {
    border-radius: 20%;
}

/* For addition of Custom Icons */
li.mobile:before {
    font-family: FontAwesome;
    content: "\f274";
}
li.email:before {
    font-family: FontAwesome;
    content: "\f153";
}
li.user:before {
    font-family: FontAwesome;
    content: "\f073";
}
li.success:before {
    font-family: FontAwesome;
    content: "\f058";
}
@keyframes animation1 {
    from {
        transform: scale(0.7);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.myLabel {
    display: block;
    width: 20vw;
    max-width: 150px;
    margin-right: auto;
    background-color: rgb(231, 231, 231);
    color: #707070;
    border-radius: 2px;
    font-size: 1em;
    line-height: 2.5em;
    text-align: center;
}

.myLabel:hover {
    background-color: rgb(214, 214, 214);
}

.myLabel:active {
    background-color: mediumaquamarine;
}

.myInput {
    border: 0;
    clip: rect(1px, 1px, 1px, 1px);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}

#cover-spin {
    position: fixed;
    width: 100%;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.7);
    z-index: 9999;
    display: none;
}

@-webkit-keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

#cover-spin::after {
    content: "";
    display: block;
    position: absolute;
    left: 48%;
    top: 40%;
    width: 40px;
    height: 40px;
    border-style: solid;
    border-color: #4b0082;
    border-top-color: transparent;
    border-width: 4px;
    border-radius: 50%;
    -webkit-animation: spin 0.8s linear infinite;
    animation: spin 0.8s linear infinite;
}

/* Bootstrap css */
@import "https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css";

/* Google Material Icons */
@import "http://fonts.googleapis.com/icon?family=Material+Icons";

/* Propeller CSS */
@import "dist/css/propeller.min.css";

/* Calendar CSS */
@import "calendar/css/fullcalendar.min.css";

/* Calendar CSS for Print Media */
@import "calendar/css/fullcalendar.print.min.css";

/* Propeller Calendar CSS */
@import "calendar/css/pmd-fullcalendar.css";
</style>
