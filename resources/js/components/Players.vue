<template>
  <div class="">
    <div class="box" v-for="user in ff()">
      <article class="media" style="align-items: center">
        <figure class="media-left">
          <p class="image is-64x64">
            <img :src="user.player.avatar">
          </p>
        </figure>
        <div class="media-content">
          <div class="content">
            <div class="is-size-5">{{ user.player.fname + ' "' + user.player.nname + '" ' + user.player.lname }}</div>
          </div>
        </div>
        <div class="media-right">
          <div class="level-left">

            <div class="level-item">
              <a :class="['circle', 'is-size-6', 'has-text-white', {'has-background-grey-light': !user.pivot.isMod, 'has-background-warning': user.pivot.isMod,}]" href="#promote" @click.prevent="makemod(user.id)" style="width: 30px;">
                <div class="content" style="padding: 0.2rem;">
                  <i class="fas fa-star" style="z-index: 1"></i>
                </div>
              </a>
            </div>

            <!-- <div class="level-item">
              <a class="circle is-size-6 has-background-danger has-text-white" href="#delete" @click.prevent="dd(user.id)" style="width: 30px;">
                <div class="content" style="padding: 0.2rem;">
                  <i class="fas fa-times" style="z-index: 1"></i>
                </div>
              </a>
            </div> -->

          </div>
        </div>
      </article>
    </div>
    <div class="has-text-centered is-size-4 has-background-light" v-if="ff().length <= 0">
      Could not find anything.
    </div>
  </div>

</template>

<script>
    export default {
      props: ['team_id', 'is_admin'],
      data () {
        return {
          users: [],
          search: '',
          isAdmin: !!this.is_admin
        }
      },
      methods: {
        ff () {
          return this.users.filter(u => {
            var findby = u.player.fname + '"' + u.player.nname + '"' + u.player.lname
            return findby.toLowerCase().indexOf(this.search.toLowerCase()) >= 0
          })
        },
        dd (user_id) {
          axios.post('/dashboard/player/delete', { team_id: this.team_id, user_id })
          .then(res => {
            this.users.remove(u => u.id === user_id)
          })
        },
        makemod (user_id) {
          var user = this.users.find(u => u.id === user_id);
          // user.pivot.isMod = !user.pivot.isMod
          axios.post('/dashboard/team/makemod', { team_id: this.team_id, user_id })
          .then(res => {
            user.pivot.isMod = !!res.data
          })
        },
      },
      mounted() {
        this.$root.$on('searching', data => {
          this.search = data
        })
        axios.get('/dashboard/team/players/fetch/' + this.team_id).then(res => {
          this.users = res.data.users
          window.loaded()
        })
      }
    }
</script>
