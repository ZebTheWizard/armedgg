<template>
  <div class="level">
    <div class="level-left">
      <div class="title">Manage {{ model }}s</div>
    </div>
    <div class="level-item">
      <div class="field" style="width: 100%; padding: 0 1rem;">
        <p class="control has-icons-left">
          <input class="input" type="text" :placeholder="'Search ' + model + 's'" @input="$root.$emit('searching', $event.target.value)">
          <span class="icon is-small is-left">
            <i class="fas fa-search"></i>
          </span>
        </p>
      </div>
    </div>
    <div class="level-right" v-if="hasbutton">
      <form class="is-marginless" :action="'/dashboard/' + model.toLowerCase() + '/create'" method="post">
        <input type="hidden" name="_token" :value="csrf">
        <button type="submit" class="button is-info">
          Create {{ model }} <i class="fas fa-plus" style="margin-left: 0.5rem;"></i>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
    export default {
      props: {
        'model': { type: String, required: true},
        'hasbutton': { type: Boolean, default: false}
      },
      data () {
        return {
          csrf: document.head.querySelector('meta[name="csrf-token"]').content
        }
      }
    }
</script>
