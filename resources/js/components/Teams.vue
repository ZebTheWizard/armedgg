<template>
  <div class="">
    <div class="box" v-for="team in ff()">
      <article class="media">
        <figure class="media-left">
          <p class="image is-64x64">
            <img :src="team.logo">
          </p>
        </figure>
        <div class="media-content">
          <div class="content">
            <div class="is-size-4">{{ team.name }}</div>
            {{ team.overview }}
          </div>
        </div>
        <div class="media-right">
          <div class="level-left">
            <div class="level-item" v-if="team.pivot.isMod">
              <a class="circle is-size-6 has-background-grey-light has-text-white" :href="'/dashboard/team/players/' + team.id" style="width: 30px;">
                <div class="content" style="padding: 0.2rem;">
                  <i class="fas fa-users" style="z-index: 1"></i>
                </div>
              </a>
            </div>
            <div class="level-item" v-if="team.pivot.isMod">
              <a class="circle is-size-6 has-background-grey-light has-text-white" href="#invite" @click.prevent="invite(team.id)" style="width: 30px;">
                <div class="content" style="padding: 0.2rem;">
                  <i class="fas fa-user-plus" style="z-index: 1"></i>
                </div>
              </a>
            </div>
            <div class="level-item" v-if="team.pivot.isMod">
              <a class="circle is-size-6 has-background-grey-light has-text-white" :href="'/dashboard/team/edit/' + team.id" style="width: 30px;">
                <div class="content" style="padding: 0.2rem;">
                  <i class="fas fa-pencil" style="z-index: 1"></i>
                </div>
              </a>
            </div>

            <div class="level-item" v-if="team.can_delete">
              <a class="circle is-size-6 has-background-danger has-text-white" href="#delete" @click.prevent="dd(team.id)" style="width: 30px;">
                <div class="content" style="padding: 0.2rem;">
                  <i class="fas fa-times" style="z-index: 1"></i>
                </div>
              </a>
            </div>
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
      data () {
        return {
          teams: [],
          search: ''
        }
      },
      methods: {
        ff () {
          return this.teams.filter(t => t.name.toLowerCase().indexOf(this.search.toLowerCase()) >= 0)
        },
        dd (id) {
          axios.post('/dashboard/team/delete', { id })
          .then(res => {
            this.teams.remove(t => t.id === id)
          })
        },
        invite (id) {
          axios.post('/dashboard/invite/create', { id })
          .then(res => {
            window.location.href="/dashboard/invite/view"
          })
        }
      },
      mounted() {
        this.$root.$on('searching', data => {
          this.search = data
        })
        axios.get('/dashboard/team/fetch').then(res => {
          this.teams = res.data
          this.teams.forEach(team => {
            if (!team.pivot) {
              team.pivot = {}
              team.pivot.isMod = team.can_delete
            }
          })
          window.loaded()
        })
      }
    }
</script>
