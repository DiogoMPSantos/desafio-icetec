import AllCandidates from './components/AllCandidates.vue';
import AddCandidate from './components/AddCandidate.vue';
import EditCandidate from './components/EditCandidate.vue';
import Login from './components/Login.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/home',
        component: AllCandidates,
        meta: {
            auth: true
        }
    },
    {
        name: 'add',
        path: '/add',
        component: AddCandidate,
        meta: {
            auth: true
        }
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditCandidate,
        meta: {
            auth: true
        }
    },
    {
        name: 'login',
        path: '/',
        component: Login,
        meta: {
            auth: false
        }
    },
    { path: '*', redirect: '/' }
];