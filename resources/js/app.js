require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import axios from "axios";
import VueAxios from "vue-axios";
import VueScrollTo from "vue-scrollto";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(VueScrollTo, {
                container: ".drawer-content",
                duration: 500,
                easing: "ease",
                offset: -30,
                force: true,
                cancelable: true,
                onStart: false,
                onDone: false,
                onCancel: false,
                x: false,
                y: true,
            })
            .use(VueAxios, axios)
            .mixin({
                methods: {
                    route,
                    hasAnyPermission: function (permissions) {
                        var allPermissions = this.$page.props.auth.can;
                        var hasPermission = false;
                        permissions.forEach(function (item) {
                            if (allPermissions[item]) hasPermission = true;
                        });
                        return hasPermission;
                    },
                },
            })
            .mount(el);
    },
});

InertiaProgress.init({ color: "red", showSpinner: true });
