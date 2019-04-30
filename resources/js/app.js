
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

window.ready = function(fn) {
  if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading"){
    fn();
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

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

if (document.body.contains(document.getElementById('featured'))) {
  window.featured = new Vue({
    el: '#featured',
    data: {
      selected: 'live',
      viewInterval: null,
      views: 0
    },
    methods: {
      select (thing) {
        this.selected = thing
      },
      _getWindowDimensions () {
        this.fs = document.getElementById('featured-video')
        this.fsw = this.fs.getBoundingClientRect().width
        this.fs.style.height = (this.fsw / 16 * 9) + 'px'

      },
      _fv(thing, value, prop="innerHTML") {
        return document.getElementById('video-' + thing)[prop] = value
      },
      _rc(el, selector, classname) {
        var elems = document.querySelectorAll(selector);
        [].forEach.call(elems, function(elem) {
            elem.classList.remove(classname)
        });
        el.classList.add(classname)
      },
      _vi(views) {
        clearInterval(this.viewInterval)
        var fn = () => {
          var max = Math.floor(views * 0.112) + Math.floor(Math.random() * 6)
          var randomViewers = views + Math.floor(Math.random() * max)
          this.views = randomViewers || 1
        }
        this.viewInterval = setInterval(fn, 15000)
        fn()
      },
      twitch(video, streamer) {
        var thumbnail = document.getElementById('twitch-' + streamer.twitch_id)
        document.getElementById('featured-video').innerHTML = null
        this._getWindowDimensions()
        console.log(streamer)
        this._fv('user_name', video.user_name)
        this._fv('user_name', 'https://twitch.tv/' + video.user_name, 'href')
        this._vi(video.viewer_count + 1)
        this._fv('views', this.views)
        document.getElementById('thumbnail-views-' + streamer.twitch_id).innerHTML = this.views
        this._fv('title', video.title)
        this._fv('title', 'https://twitch.tv/' + video.user_name, 'href')
        this._fv('avatar', streamer.twitch_logo, 'src')
        // this._rc()
        document.getElementById('video-info').style.display = "flex"
        this._rc(thumbnail, '.thumbnail', 'active')
        this.select('live')
        new Twitch.Embed("featured-video", {
          width: "100%",
          height: this.fsw / 16 * 9,
          channel: video.user_name,
          layout: "video",
          theme: "dark"
        });
      },
      youtube(video, player){
        this._getWindowDimensions()
        this._fv('user_name', player.name)
        this._fv('user_name', 'https://youtube.com/channel/' + player.youtube, 'href')
        this._fv('views', video.views)
        this._fv('title', video.title)
        this._fv('title', 'https://youtube.com/watch?v=' + video.id, 'href')
        this._fv('avatar', player.avatar, 'src')
        document.getElementById('video-info').style.display = "flex"
        console.log('youtube-' + video.id, document.getElementById('youtube-' + video.id))
        this._rc(document.getElementById('youtube-' + video.id), '.thumbnail', 'active')
        this.select('videos')
        document.getElementById('featured-video').innerHTML = `
        <iframe style="width:100%" height="${this.fsw/16*9}" src="https://www.youtube.com/embed/${video.id}?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        `
      }
    }
  })
}

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
