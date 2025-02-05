import { createApp, h } from 'vue'
import { createInertiaApp, router } from '@inertiajs/vue3'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'
import "bootstrap-icons/font/bootstrap-icons.css"
import '@popperjs/core'; 

createInertiaApp({
    resolve: name => {
      const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
      return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
      createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(router)
        .mount(el)
    },
  })