(function () {
    var nav = document.querySelector('nav.fixed')
    if (nav){
      var dropnavs = document.querySelectorAll('.dropnav')
      var height = nav.getBoundingClientRect().height
      var progress = document.getElementById('read-progress')
      var logo = document.getElementById('logo')

      var fn = () => {
        var height2 = nav.getBoundingClientRect().height
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var winHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / winHeight) * 100;

        if (progress) {
           progress.style.width = scrolled + "%";
        }
        // console.log(height2, height)
        // if (height2 != height) {
           document.body.style['margin-top'] = height2 + 'px'
        // }
        if (window.pageYOffset > height2) {
            nav.classList.add('bg-white', 'text-dark')
            nav.classList.remove('bg-dark', 'text-white')
            logo.width = 50
            logo.src = "/logo-black.png"
            Array.from(dropnavs).forEach(dropnav => {
              dropnav.classList.remove('bg-white', 'text-dark')
              dropnav.classList.add('bg-dark', 'text-white')
            })
        } else {
            nav.classList.remove('bg-white', 'text-dark')
            nav.classList.add('bg-dark', 'text-white')
            Array.from(dropnavs).forEach(dropnav => {
              dropnav.classList.add('bg-white', 'text-dark')
              dropnav.classList.remove('bg-dark', 'text-white')
              logo.width = 50
              logo.src = "/logo-white.png"
            })
        }
        height = height2
      }

      // fn()
      // window.addEventListener('scroll', fn)
      // window.addEventListener('resize', fn)
    }



})();

(function () {
   if (!window.Waves) return;
   new Waves({
      canvas: 'waves',
      waveCount: 5,
      backgroundColor: '#3EB5F7',
      backgroundBlendMode: 'source-over',
      waveBlendMode: 'screen',
      scale: 0.5,
   }, {
      color: 'yellow',
      amplitude: 30,
   }, {
      color: 'cyan',
      amplitude: 20,
   }, {
      color: '#3EB5F7',
      amplitude: 30,
   })

   $('#waves').parent().css('margin-bottom', '6rem')

})();

document.addEventListener('keydown', function (e) {
   e.stopPropagation()
   if (e.ctrlKey && e.which == 68) {
      e.preventDefault()
      window.location.href = "/dashboard"
   }
})

window.loadMoreApps = function(el, page) {
   console.log(window.location.origin)
   getJSON(window.location.origin + "/apps?json=true&page=" + page, function (err, json) {
      if (err) {
         el.innerHTML = "No apps. Try again?"
         el.className = "btn btn-red"
      } else {
         getJSON(el.dataset.template, function (err, template) {
            if (err) {
               el.innerHTML = "Template Error. Try again?"
               el.className = "btn btn-red"
            }
            var apps = document.getElementById('apps')
            apps.innerHTML += json.apps.data.map(app => render(template, app)).join("")
         }, 'text')

      }
   })
}

