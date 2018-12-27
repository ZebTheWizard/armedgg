import Preload from 'image-preload'

window.search = function (input, wrapper, noresults) {
  var wrapper = document.getElementById(wrapper)
  var count = 0;
  Array.prototype.forEach.call(wrapper.children, child => {
    var find = child.dataset.find
    var value = input.value.toLowerCase()
    if (find) {
      find = find.toLowerCase()
      if (find.includes(value) || !value) {
        child.style.display = "block"
        count ++
      } else {
        child.style.display = "none"
      }
    }
  })
  if (!count) {
    document.getElementById(noresults).style.display = 'block'
  } else {
    document.getElementById(noresults).style.display = 'none'
  }
}


function b(url) {
  return window.location.origin + url
}

Preload([
  b('/png/background.png'),
  b('/png/banner.png'),
  b('/png/watermark.png'),
  b('/svg/grid.svg'),
  b('/svg/three-dots.svg')
])
