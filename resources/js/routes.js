import Dashboard from './views/admin/Dashboard.vue';
import AddProvider from './views/admin/AddProvider.vue';
import CreateProject from './views/admin/CreateProject.vue';
import Profil from './views/admin/Profil.vue';
import AddAdmin from './views/admin/AddAdmin.vue';
import ShowAdmins from './views/admin/ShowAdmins.vue';
import NotificationsBar from './views/admin/NotificationsBar.vue';
import Billings from './views/admin/Billings.vue';
import newprofil from './views/admin/newprofil.vue';
import Providers from './views/admin/Providers.vue';
import Projects from './views/admin/projects.vue';
import Encours from './views/admin/Encours.vue';
import Paiements from './views/admin/Paiements.vue';
import Commissions from './views/admin/Commissions.vue';


// ROUTES FOR PROVIDER
import DashboardProvider from './views/collaborator/Dashboard.vue';
import MyProjects from './views/collaborator/MyProjects.vue';
import ProviderProfil from './views/collaborator/Profil.vue';
import ReportWork from './views/collaborator/ReportWork.vue';
import MyBillings from './views/collaborator/MyBillings.vue';
import test from './views/collaborator/test.vue';
import MyExpenses from './views/collaborator/MyExpenses.vue';
// END ROUTED FOR PROVIDER

const routes = [
    { path: '/admin', component: Dashboard },
    { path: '/providers', component: Providers },
    { path: '/addprovider', component: AddProvider },
    { path: '/createproject', component: CreateProject },
    { path: '/profil', component: Profil },
    { path: '/addadmin', component: AddAdmin },
    { path: '/notifications', component: NotificationsBar },
    { path: '/myprojects', component: MyProjects },
    { path: '/myprofil', component: ProviderProfil },
    { path: '/reportwork', component: ReportWork },
    { path: '/mybillings', component: MyBillings },
    { path: '/test', component: test },
    { path: '/billings', component: Billings },
    { path: '/newprofil', component: newprofil },
    { path: '/projects', component: Projects },
    { path: '/myexpenses', component: MyExpenses },
    { path: '/encours', component: Encours },
    { path: '/paiements', component: Paiements },
    { path: '/home', component: DashboardProvider },
    { path: '/commissions', component: Commissions },
    { path: '/admins', component: ShowAdmins },
  ]

export default routes;
