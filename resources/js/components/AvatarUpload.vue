<template>
  <div class="box avatar-upload" :style="{width, height}">
    <input type="hidden" name="avatar" :value="userAvatar">
    <figure>
      <p class="image has-background-grey-lighter" style="height: 150px; width: 150px">
        <img v-if="userAvatar" :src="userAvatar || src">
      </p>
    </figure>

    <image-uploader
      @success="onSuccess"
      trigger="avatar-upload"
      :data="data"
      :url="url">
    </image-uploader>
    <button type="button" class="button is-medium is-dark" id="avatar-upload">{{ label }}</button>
  </div>
</template>

<script>
  import ImageUploader from "./ImageUploader"

  export default {
    components: { ImageUploader },
    props: {
      src: {
        type: [String]
      },
      width: {
        type: [Number],
        default: 200
      },
      height: {
        type: [Number],
        default: 270
      },
      url: {
        type: [String],
        required: true
      },
      label: {
        type: [String],
        default: 'Upload Avatar'
      },
      data: {
        type: [Object],
        default: {}
      },
    },
    data() {
      return {
          userAvatar: this.src,
      }
    },
    methods: {
      onSuccess(url) {
        this.userAvatar = url;
      }
    }
  }
</script>

<style>
  .avatar-upload {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-around;
  }
</style>
