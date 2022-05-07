<template>
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Mes projets</h4>
            <div
                class="d-sm-flex justify-content-between align-items-start"
                style="margin-bottom: 2ch"
            >
                <div>

                </div>
                <div class="col-sm-3">
                <input type="text" class="form-control" v-model="searchQuery" placeholder="Rechercher...">

                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>Réf #</th>
                                    <th>Nom</th>
                                    <th>Client</th>
                                    <th>Tarif journalier moyen</th>
                                    <th>Date de début</th>
                                    <th>Date de fin </th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr
                                        v-for="project in tempProjects"
                                        :id="'trow' + project.id"
                                        v-bind:data-target="
                                            '#project' + project.id
                                        "
                                        v-bind:aria-controls="
                                            'project' + project.id
                                        "
                                        class="trBgHover collapsed"
                                        style="cursor: pointer; font-weight: 600 "
                                        :key="project.id"
                                    >
                                        <td>{{ project.id }}</td>
                                        <td>
                                            {{ project.name }}
                                        </td>
                                        <td>{{ project.client }}</td>
                                        <td>
                                            {{ project.average_daily_rate }}
                                        </td>
                                        <td>
                                            {{ project.start_date }}
                                        </td>
                                        <td>
                                            {{ project.end_date }}
                                        </td>
                                        <td>
                                            {{ project.outstanding }}
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            provider: {
                provider_id: document
                    .querySelector("meta[name='provider-id']")
                    .getAttribute("content")
            },
            projects: {},
            tempProjects: {},
            searchQuery: "",
        };
    },
    methods: {
        getProjects() {
            axios
                .post("api/getProjects/" + this.provider.provider_id)
                .then(response => {
                    this.projects = response.data.data.reverse();
                    this.tempProjects = response.data.data.reverse();
                });
        },
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        }
    },
    mounted() {
        this.getProjects();

    },
    watch: {
        searchQuery() {
            if (this.searchQuery.length >= 0) {
                var projects = this.projects;
                this.tempProjects = projects.filter(item => {
                    return (
                        item.name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.client
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.average_daily_rate
                            .toString()
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.start_date
                            .toString()
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.end_date
                            .toString()
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1

                    );
                });
            }
        }
    }
};
</script>

<style scoped>
.table tbody th,
.table tbody td {
    border: none;
    font-size: 14px;
}
.table tbody td.acc {
    background: #f3f3f3;
    border: none;
}
.table tbody td .fa {
    font-size: 12px;
    color: #28a745;
}

[data-toggle="collapse"] .fa:before {
    content: "\f062";
    font-family: "FontAwesome";
    font-style: normal;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
}
@media (prefers-reduced-motion: reduce) {
    [data-toggle="collapse"] .fa:before {
        -webkit-transition: none;
        -o-transition: none;
        transition: none;
    }
}

[data-toggle="collapse"].collapsed .fa:before {
    content: "\f063";
    font-family: "FontAwesome";
    font-style: normal;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
}
@media (prefers-reduced-motion: reduce) {
    [data-toggle="collapse"].collapsed .fa:before {
        -webkit-transition: none;
        -o-transition: none;
        transition: none;
    }
}

[data-toggle="collapse"] {
    background: #ececec !important;
}

[data-toggle="collapse"].collapsed {
    background: #fff !important;
}
[data-toggle="collapse"].collapsed:hover {
    background: #ececec !important;
    border-bottom: 2px solid #ececec;
}
.table-wrap {
    overflow: auto;
    overflow-wrap: break-word;
}
</style>
