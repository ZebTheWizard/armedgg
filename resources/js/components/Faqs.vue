<template>
  <div class="">
    <div class="box" v-for="faq in ff()">
      <article class="media" style="align-items: center">
        <div class="media-content">
          <div class="content">
            <div class="is-size-5">{{ faq.question }}</div>
          </div>
        </div>
        <div class="media-right">
          <div class="level-left">

            <div class="level-item">
              <a class="circle is-size-6 has-background-grey-light has-text-white" :href="'/dashboard/faq/edit/' + faq.id" style="width: 30px;">
                <div class="content" style="padding: 0.2rem;">
                  <i class="fas fa-pencil" style="z-index: 1"></i>
                </div>
              </a>
            </div>
            <!-- <div class="level-item">
              <a class="circle is-size-6 has-background-danger has-text-white" href="#delete" @click.prevent="dd(faq.id)" style="width: 30px;">
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
          faqs: [],
          search: '',
        }
      },
      methods: {
        ff () {
          return this.faqs.filter(f => {
            var findby = f.question
            return findby.toLowerCase().indexOf(this.search.toLowerCase()) >= 0
          })
        },
        dd (faq_id) {
          axios.post('/dashboard/faq/delete', { faq_id })
          .then(res => {
            this.faqs.remove(f => f.id === faq_id)
          })
        },
      },
      mounted() {
        this.$root.$on('searching', data => {
          this.search = data
        })
        axios.get('/dashboard/faq/fetch/').then(res => {
          this.faqs = res.data
          console.log(this.faqs);
          window.loaded()
        })
      }
    }
</script>
