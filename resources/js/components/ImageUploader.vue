<template lang="html">
  <div>
    <div :class="['modal', {'is-active': modalopen}]">
      <div class="modal-background" @click="destroy"></div>
      <div class="modal-content">
        <nav class="navbar has-background-white">
          <div class="navbar-start">
            <div class="navbar-item square hh" @click.prevent="Cropper.rotate(-15)">
              <a href="#" class="content has-text-info">
                <i class="fas fa-undo"></i>
              </a>
            </div>
            <div class="navbar-item square hh" @click.prevent="Cropper.rotate(15)">
              <a href="#" class="content has-text-info">
                <i class="fas fa-undo fa-flip-horizontal"></i>
              </a>
            </div>
            <div class="navbar-item square hh" @click.prevent="Cropper.reset()">
              <a href="#" class="content has-text-info">
                <i class="fas fa-trash-alt"></i>
              </a>
            </div>
          </div>

          <div class="navbar-end">
            <div class="navbar-item square hh" @click.prevent="destroy">
              <a href="#" class="content has-text-info">
                <i class="fas fa-times"></i>
              </a>
            </div>
          </div>


        </nav>
        <div style="max-height: 30vh"><img id="cropper-image" :src="dataUrl" @load.stop="create"></div>
        <nav class="navbar has-background-white">
          <div class="navbar-item nav-button hh" @click.prevent="destroy">
            Cancel
          </div>
          <div class="navbar-item nav-button hh" @click.prevent="upload">
            <span v-if="!uploading">Submit</span>
            <span v-else><i class="fas fa-spinner fa-spin"></i></span>
          </div>
        </nav>
      </div>
    </div>

    <input ref="input" type="file" class="copy" :accept="mimes">
    <input type="hidden" :value="image_url">
  </div>
</template>

<script>
import 'cropperjs/dist/cropper.css'
import Cropper from 'cropperjs'

export default {
  props: {
    trigger: {
      type: [String],
      required: true
    },
    url: {
      type: [String],
      required: true
    },
    ratio: {
      type: [Number],
      default: 1/1
    },
    mimes: {
      type: [String],
      default: 'image/png, image/gif, image/jpeg, image/bmp, image/x-icon'
    },
    data: {
      type: [Object],
      default: {}
    },
  },
  data () {
    return {
      Cropper: undefined,
      modalopen: false,
      dataUrl: undefined,
      image_url: '',
      uploading: false
    }
  },
  methods: {
    destroy () {
      this.Cropper.destroy()
      this.$refs.input.value = '';
      this.modalopen = false,
      this.dataUrl = undefined
    },
    create() {
      this.Cropper = new Cropper(document.getElementById('cropper-image'), {
        aspectRatio: this.ratio,
        autoCropArea: 1,
        cropBoxMovable: false,
        cropBoxResizable: false,
        dragMode: 'move',
        maxHeight: window.innerHeight / 100 * 50,
        toggleDragModeOnDblclick: false,
        wheelZoomRatio: 0.05
      })
    },
    pickImage() {
      this.$refs.input.click()
    },
    uploadProgress(){
      //
    },
    upload() {
      if (this.uploading) return
      this.uploading = true
      this.Cropper.getCroppedCanvas({
        width: 150,
        height: 150
      }).toBlob(blob => {
        var form = new FormData();
        var config = {
          onUploadProgress: this.uploadProgress
        }
        Object.keys(this.data).forEach(key => {
          form.append(key, this.data[key])
        })
        form.append('photo', blob);
        axios.post(this.url, form, config).then(res => {
          this.image_url = res.data
          this.$emit('success', res.data)
          this.destroy()
          this.uploading = false
        }).catch(err => console.error)
      })
    }
  },
  mounted () {
    let trigger = document.getElementById(this.trigger)
    if (!trigger) {
      throw 'Trigger not found for ImageUploader';
    } else {
      trigger.addEventListener('click', this.pickImage)
    }
    let fileInput = this.$refs.input
    fileInput.addEventListener('change', () => {
      if (fileInput.files != null && fileInput.files[0] != null) {
        let reader = new FileReader()
        reader.onload = (e) => {
          this.dataUrl = e.target.result
        }
        reader.readAsDataURL(fileInput.files[0])
        // this.filename = fileInput.files[0].name || 'unknown'
        // this.$emit('changed', fileInput.files[0], reader)
        this.modalopen = true
      }
    })
    window.loaded()
  }
}
</script>

<style lang="css">
.img {
  max-width: 100%;
}

.nav-button {
  flex-grow: 1;
  justify-content: center;
}
.hh:hover, .hh:hover * {
  cursor: pointer;
  background: #209cee;
  color: white !important;
}

.cropper-container { width: 100% !important }
</style>
