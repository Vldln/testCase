require("./bootstrap");
import { createStore } from "vuex";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";

const store = createStore({
    state: {
        groups: [],
        options: [],
    },
    mutations: {
        SET_GROUPS_OWNER(state, items) {
            state.groups_owner = items;
        },
        SET_GROUPS_MEMBER(state, items) {
            state.groups_member = items;
        },
        SET_OPTIONS(state, items) {
            state.options = items;
        },
    },
    actions: {
        getGroups(context) {
            axios.get("/api/users/groups/owner").then((resp) => {
                context.commit("SET_GROUPS_OWNER", resp.data.items.data);
            });
            axios.get("/api/users/groups/member").then((resp) => {
                context.commit("SET_GROUPS_MEMBER", resp.data.items.data);
            });
        },
        getOptions(context) {
            axios.get("/api/options").then((resp) => {
                context.commit("SET_OPTIONS", resp.data.items.data);
            });
        },
        postGroup(context, params) {
            axios.post("/api/groups", { name: params.name });
        },
        updateGroup(context, params) {
            axios.post("/api/groups/update", {
                id: params.id,
                name: params.name,
            });
        },
        deleteGroup(context, params) {
            axios.post("/api/groups/delete", { id: params.id });
        },
        postInvite(context, params) {
            axios.post("/api/requests", {
                email: params.email,
                groups_id: params.groups_id,
            });
        },
        postExpenses(context, params) {
            axios.post("/api/expenses", {
                split_option_id: params.type,
                amount: params.amount,
                description: params.descr,
                group_id: params.group_id,
                members: params.members,
                recipient_id: params.recipient_id,
            });
        },
    },
});
const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(store)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
