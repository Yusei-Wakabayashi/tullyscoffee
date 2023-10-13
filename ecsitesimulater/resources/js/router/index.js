import { createRouter, createWebHistory } from "vue-router";
import AllView from "../views/AllView.vue"
import OverWorldView from "../views/OverWorldView.vue"
import NetherView from '../views/NetherView.vue'
import EndView from '../views/EndView.vue'
const routes = [
    {
        path: "/",
        component: AllView,
        name: "all"
    },
    {
        path: "/overWorld",
        component: OverWorldView,
        name: "overWorld"
    },
    {
        path: "/nether",
        component: NetherView,
        name: "nether"
    },
    {
        path: "/end",
        component: EndView,
        name: "end"
    },
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: routes
})

export default router

