import Dash from './views/admin/Dash.vue';
import ShowCollaborators from './views/admin/ShowCollaborators.vue';
import AddCollaborator from './views/admin/AddCollaborator.vue';
import CreateProject from './views/admin/CreateProject.vue';
import Profil from './views/admin/Profil.vue';
import AddAdmin from './views/admin/AddAdmin.vue';
import NotificationsBar from './views/admin/NotificationsBar.vue';
import MyProjects from './views/collaborator/MyProjects.vue';

const routes = [
    { path: '/home', component: Dash },
    { path: '/collaborators', component: ShowCollaborators },
    { path: '/addcollaborator', component: AddCollaborator },
    { path: '/createproject', component: CreateProject },
    { path: '/profil', component: Profil },
    { path: '/addadmin', component: AddAdmin },
    { path: '/notifications', component: NotificationsBar },
    { path: '/myprojects', component: MyProjects },
  ]

export default routes;
