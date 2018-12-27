
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.loaded = function () {
  document.querySelectorAll('.sectionloader').forEach(node => {
    node.classList.remove('is-active')
  })
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

Vue.component('dashboard-manager', require('./components/DashboardManager.vue'));
Vue.component('teams', require('./components/Teams.vue'));
Vue.component('players', require('./components/Players.vue'));
Vue.component('invites', require('./components/Invites.vue'));
Vue.component('avatar-upload', require('./components/AvatarUpload.vue'));
Vue.component('prepend', require('./components/Prepend.vue'));
Vue.component('tags', require('./components/Tags.vue'));
Vue.component('faqs', require('./components/Faqs.vue'));
Vue.component('sponsors', require('./components/Sponsors.vue'));
Vue.component('youtube-videos', require('./components/YouTubeVideos.vue'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if (document.body.contains(document.getElementById('dashboard'))) {
  const dashboard = new Vue({
      el: '#dashboard',
      mounted () {
        document.querySelectorAll('.sectionloader').forEach(node => {
          node.parentElement.style.position = 'relative'
        })
      }
  });
}

if (document.body.contains(document.getElementById('player_youtube'))) {
  const player_youtube = new Vue({
      el: '#player_youtube'
  });
}
