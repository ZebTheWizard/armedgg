<template>
  <div class="">
    <div class="box" v-for="sponsor in ff()">
      <article class="media" style="align-items: center">
        <div class="media-content">
          <div class="content">
            <div class="is-size-5">{{ sponsor.name }}</div>
          </div>
        </div>
        <div class="media-right">
          <div class="level-left">

            <div class="level-item">
              <a class="circle is-size-6 has-background-grey-light has-text-white" :href="'/dashboard/sponsor/edit/' + sponsor.id" style="width: 30px;">
                <div class="content" style="padding: 0.2rem;">
                  <i class="fas fa-pencil" style="z-index: 1"></i>
                </div>
              </a>
            </div>
            <!-- <div class="level-item">
              <a class="circle is-size-6 has-background-danger has-text-white" href="#delete" @click.prevent="dd(sponsor.id)" style="width: 30px;">
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
      data () {
        return {
          sponsors: [],
          search: '',
        }
      },
      methods: {
        ff () {
          return this.sponsors.filter(f => {
            var findby = f.name
            return findby.toLowerCase().indexOf(this.search.toLowerCase()) >= 0
          })
        },
        dd (sponsor_id) {
          axios.post('/dashboard/sponsor/delete', { sponsor_id })
          .then(res => {
            this.sponsors.remove(f => f.id === sponsor_id)
          })
        },
      },
      mounted() {
        this.$root.$on('searching', data => {
          this.search = data
        })
        axios.get('/dashboard/sponsor/fetch').then(res => {
          this.sponsors = res.data
          window.loaded()
        })
      }
    }
</script>
