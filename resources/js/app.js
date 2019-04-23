
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

import "./autocomplete"
import axios from "axios"
import {Checkbox, Radio} from 'vue-checkbox-radio';

window.Vue = require('vue');

// window.loaded = function () {
//   document.querySelectorAll('.sectionloader').forEach(node => {
//     node.classList.remove('is-active')
//   })
// }

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

// Vue.component('dashboard-manager', require('./components/DashboardManager.vue'));
// Vue.component('teams', require('./components/Teams.vue'));
// Vue.component('players', require('./components/Players.vue'));
// Vue.component('invites', require('./components/Invites.vue'));
// Vue.component('avatar-upload', require('./components/AvatarUpload.vue'));
// Vue.component('prepend', require('./components/Prepend.vue'));
// Vue.component('tags', require('./components/Tags.vue'));
// Vue.component('faqs', require('./components/Faqs.vue'));
// Vue.component('sponsors', require('./components/Sponsors.vue'));
// Vue.component('youtube-videos', require('./components/YouTubeVideos.vue'));
Vue.component('radio', Radio);
Vue.component('navigation-layout', require('./components/NavigationLayout.vue'));
Vue.component('category-picker', require('./components/CategoryPicker.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if (document.body.contains(document.getElementById('dashboard'))) {
  const dashboard = new Vue({
      el: '#dashboard',
      data: {
        deleteid: null,
        role: {
          name: null,
          permissions: []
        },
        user: {
          name: null,
          role: null,
          email: null
        },
        player: {
          category: null,
          name: null,
          country_flag: null,
          country_name: null,
          instagram: null,
          twitch: null,
          twitter: null,
          youtube: null,
        },
        category: {
          name: null,
          id: null
        },
        faq: {
          question: null,
          answer: null
        },
        news: {
          title: null,
          text: null
        },
        sponsor: {
          name: null,
          link: null,
          description: null
        }
      },
      methods: {
        setRole(name, perms) {
          console.log(name, perms)
          this.role.name = name
          this.role.permissions = perms
        },
        setUser(obj) {
          this.user = obj
        },
        setCategory(obj={}) {
          this.category = obj
        },
        setFaq(obj={}) {
          this.faq = obj
        },
        setSponsor(obj={}) {
          this.sponsor = obj
        },
        setNews(obj={}) {
          this.news = obj
        },
        setPlayer(obj={}) {
          this.category = obj.category || {}
          this.player = obj
        },
        setDelete(id) {
          this.deleteid = id
        },
        saveNavigation() {
          axios.post('/dashboard/settings/navigation', {
            used: window.used_navigation,
            available: window.available_navigation
          }).then(res => {
            location.reload()
          })
        }
      }
  });
}

// if (document.body.contains(document.getElementById('player_youtube'))) {
//   const player_youtube = new Vue({
//       el: '#player_youtube'
//   });
// }
