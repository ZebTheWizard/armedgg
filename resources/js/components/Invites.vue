<template>
  <div class="">
    <div class="panel" v-for="team in ff()">
      <div class="panel-heading">{{ team.name }}</div>
      <div class="panel-block" v-for="invite in team.invites">
        <div class="level" style="width: 100%">
          <div class="level-left">
            <div class="level-item">
              {{ invite.id }}
              <input class="clipboard copy" type="text" :id="invite.id" :value="url('/i/' + invite.id)">
            </div>
          </div>
          <div class="level-right">
            <a class="level-item" href="#copy" @click="copy(invite.id)">
              <i class="fas fa-copy"></i>
            </a>
          </div>
        </div>
        <!-- <div class="level">
          <div class="level-left">
            <div class="level-item">aaa</div>
          </div>
          <div class="level-right">
            <div class="level-item">bb</div>
          </div>
        </div> -->

      </div>
    </div>
    <!-- <div class="box" v-for="invite in ff()">
      <article class="media">
        <div class="media-left">
          <p class="is-size-4">
            {{ invite.team.name }}
          </p>
        </div>
        <div class="media-content">
          <div class="content">
            <div class="is-size-4">{{ location.origin + '/dashboard/invite/join/' + invite.name }}</div>
          </div>
        </div>
        <div class="media-right">
          <div class="level-left">
            <div class="level-item">
              <a class="circle is-size-6 has-background-danger has-text-white" href="#delete" @click.prevent="dd(invite.id)" style="width: 30px;">
                <div class="content" style="padding: 0.2rem;">
                  <i class="fas fa-times" style="z-index: 1"></i>
                </div>
              </a>
            </div>
          </div>
        </div>
      </article>
    </div> -->
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
        url (a) {
          return location.origin + a
        },
        copy(id) {
          var text = document.getElementById(id)
          text.select()
          document.execCommand("copy")
        },
        ff () {
          return this.teams.filter(team => {
            return team.name.toLowerCase().includes(this.search.toLowerCase())
          })
        },
        dd (id) {
          axios.post('/dashboard/invite/delete', { id })
          .then(res => {
            this.invites.remove(t => t.id === id)
          })
        }
      },
      mounted() {
        this.$root.$on('searching', data => {
          console.log(data);
          this.search = data
        })
        axios.get('/dashboard/invite/fetch').then(res => {
          res.data.forEach(invite => {
            this.teams[invite.team.id] = this.teams[invite.team.id] || {}
            this.teams[invite.team.id] = {
              name: invite.team.name,
              invites: this.teams[invite.team.id].invites || []
            }
            this.teams[invite.team.id].invites.push(invite)
          })
          var res = [];
          Object.keys(this.teams).forEach(key => {
            var team = this.teams[key]
            res.push(team)
          })
          this.teams = res
          window.loaded()
        })
      }
    }
</script>
