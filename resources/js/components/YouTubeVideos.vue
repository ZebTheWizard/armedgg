<template lang="html">
  <div class="">
    <div v-for="entry in entries" class="has-background-light" style="height: 117px; width: 208px; display: inline-block; margin: 0.2rem 0.2rem 0 0">
      <iframe :class="{'is-hidden': loading}" @load="count_check" width="208" height="117" :src="'https://www.youtube.com/embed/' + entry.id" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
</template>

<script>
export default {
  props: ['player_id'],
  data () {
    return {
      loading: true,
      count: 0,
      entries: []
    }
  },
  methods: {
    count_check() {
      this.count++
      if (this.count == this.entries.length) this.done_loading()
    },
    done_loading() {
      this.loading = false
    }
  },
  mounted () {
    axios.get('/p/youtube/' + this.player_id)
    .then(res => {
      this.entries = res.data.entry
    })
    .catch(err => {
      console.error(err);
    })
  }
}
</script>

<style lang="css">
</style>
