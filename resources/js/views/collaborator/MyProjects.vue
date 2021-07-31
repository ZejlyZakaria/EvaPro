<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">My projects</h5>
        </div>
        <div class="card-body">
            <h5 v-if="isEmpty(projects)" class="card-title">
                You don't have any project yet!
            </h5>
            <div
                class="card"
                v-for="project in projects"
                :key="project.id"
            >
                <h5 class="card-header">{{ project.name }}</h5>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">
                        With supporting text below as a natural lead-in to
                        additional content.
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
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
            projects: {}
        };
    },
    methods: {
        getProjects() {
            axios
                .post("api/getProjects/" + this.provider.provider_id)
                .then(response => {
                    this.projects = response.data.data.reverse();
                });
        },
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        }
    },
    created() {
        this.getProjects();
    }
};
</script>
