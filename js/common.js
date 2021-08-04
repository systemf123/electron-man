window.addEventListener('load', function () {
  let urlAjax = '/php/ajax.php',
      $form = getElementToID('posts-form')

  $form.addEventListener('submit', function(e) {
    e.preventDefault()

    this.classList.add('ajax')
    let formDataRequest = new FormData(this)
    formDataRequest.append('type', 'add')

    fetch(urlAjax, {
      method: 'POST',
      body: formDataRequest
      })
        .then((response) => {
          return response.json();
        })
        .then((response) => {
          if (response.error.isError) {
            showErroreReponse(this, response)
          } else {
            if (response.result) {
              $postTitle.innerText = 'Записи на вашей стене'
              templateResponcePost(response)
              this.classList.remove('ajax')
              this.reset()
            }
          }
        });
    })

  /*******************************************************************/

  Object.prototype.event = event

  let $userBox = getElementToID('user-box'),
    $userStatus = getElementToID('user-status'),
    $inputStatus = getElementToID('input-status'),
    $statusText = getElementToID('status-text'),
    $postList = getElementToID('post-list'),
    $postTitle = getElementToID('post-title'),
    tmpStrStatusText = '',
    localStorageKey = 'status'

  if (localStorage.getItem(localStorageKey)) {
    $statusText.innerText = localStorage.getItem(localStorageKey)
  } else {
    $statusText.innerText = 'изменить статус'
  }

  $userBox.event('click', function (e) {
    this.classList.toggle('open')
  })

  $postList.event('click', function (e) {
    if (e.target.classList.contains('post-item__close')) {
      let $parent = e.target.closest('.post-item')
      let id = e.target.dataset.id

      setTimeout(function () {
        fetch(urlAjax, {
          method: 'post',
          headers: {'Content-Type':'application/x-www-form-urlencoded'},
          body: 'type=delete&id='+ id
        }).then(response => {
          return response.json()
        }).then(response => {
          if (response.error.isError) {
            showErroreReponse(null, response)
          } else {
            $parent.classList.add('close')
            $parent.remove()
            getAllPosts(false)
          }
        })
      },500)
    }
  })

  $userStatus.event('click', function (e) {
    $inputStatus.value = ''
    $inputStatus.focus()

    if (e.target.classList.contains('user-info__status')) {
      this.classList.add('open')
    }
    if (e.target.classList.contains('user-statua-form__btn')) {
      this.classList.remove('open')
      if (tmpStrStatusText) {
        $statusText.innerText = tmpStrStatusText
        saveStatus(localStorageKey, tmpStrStatusText)
      }
    }

  })

  $inputStatus.addEventListener('keypress', function (e) {
    tmpStrStatusText = this.value
    if (e.which === 13) {
      $statusText.innerText = tmpStrStatusText
      $userStatus.classList.remove('open')
      saveStatus(localStorageKey, tmpStrStatusText)
    }
  })

  function getAllPosts(replacePost = true) {
    fetch(urlAjax, {
      method: 'post',
      headers: {'Content-Type':'application/x-www-form-urlencoded'},
      body: 'type=get'
    }).then(response => {
      return response.json()
    }).then(response => {
      if (response.error.isError) {
        showErroreReponse(response)
      } else {
        if (response.result) {
          if (replacePost) {
            console.log("start", response);
            templateResponcePost(response)
          }else {
            console.log("delete", response);
          }
        } else {
          $postTitle.innerText = 'Записей пока нет'
        }
      }
    });
  }

  function getElementToID(id) {
    return document.getElementById(id)
  }

  function event(type, callback) {
    addEventListener.call(this, type, callback)
  }


  function saveStatus(key, val) {
    localStorage.setItem(key, val)
  }

  function templateResponcePost(response) {
    let html = ''
    let randomAvatar = ''

    response.result.forEach( function(comment) {
      randomAvatar = Math.round(Math.random() * 10) > 5 ? '/assets/img/deadpool.png' : '/assets/img/logan.png'
      html += '<article class="post-item shadow-box">\n' +
        '        <i data-id="'+ comment.id + '" class="post-item__close"></i>\n' +
        '       <header class="post-item__header">\n' +
        '          <div class="post-item__header-pictory">\n' +
        '            <img src="'+ randomAvatar + '" alt="">\n' +
        '          </div>\n' +
        '          <div class="post-item__header-inf">\n' +
        '             <h2 class="post-item__header-name">' + comment.user_name + '</h2>\n' +
        '             <time class="post-item__header-time">\n' +
        '                ' + comment.passed + ' в <span>' + comment.time + '</span>\n' +
        '             </time>\n' +
        '          </div>\n' +
        '       </header>\n' +
        '        <div class="post-item__message">\n' + comment.message + '</div>\n' +
        '     </article>'
    })
    $postList.innerHTML = html
  }

  function showErroreReponse($form, response) {
    let strMessage = ''
    if (response.error.message.length) {
      response.error.message.forEach( function(item) {
        strMessage += item + '\n'
      })
      if ($form) {
        $form.classList.remove('ajax')
      }
      alert(strMessage)
    }
  }
  // первый запрос при загрузке тсраницы
  getAllPosts();

  /*******************************************************************/
  // Сам слайдер
  (function() {
    function Slider(idSlider, classSliderContainer, classSlaiderItem) {
      this.$slider = document.getElementById(idSlider)
      this.$sliderContainer = this.$slider.querySelector(classSliderContainer)
      this.$items = this.$slider.querySelectorAll(classSlaiderItem)
      this.itemWidth = this.$items[0].clientWidth
      this.marginLeft = parseInt(window.getComputedStyle(this.$items[1], null).getPropertyValue("margin-left"))
      this.itemWidthStepToScroll = this.$items[0].offsetWidth + this.marginLeft
      this.width50Precent = this.itemWidth / 2
      this.posStartTouch = 0
      this.startPostTranslateX = 0
      this.diff = 0
      this.maxScroll = this.$items.length * this.itemWidthStepToScroll - this.itemWidthStepToScroll
      this.timer = null
      this.istouchMove = false
    }

    Slider.prototype.init = function () {
      this.$slider.addEventListener('touchstart', (e) => {
        if (!this.istouchMove && !this.timer) {
          if (!this.timer) {
            let touch = this.getTouch(e)
            this.startPostTranslateX = this.getTranslateX(this.$sliderContainer)
            this.posStartTouch = touch.pageX;

            this.timer = setTimeout(function() {
              this.timer = null
            }, 400)
          }
        }
      });

      this.$slider.addEventListener('touchmove', (e) => {
        this.istouchMove = true
        let touch = this.getTouch(e)
        let x = touch.pageX;
        let y = touch.pageY;
        this.diff = Math.round(this.posStartTouch - x)
        this.diff *= -1
        this.$sliderContainer.style.transform = "translateX(" + (this.startPostTranslateX + this.diff) + "px)"
      })

      this.$slider.addEventListener('touchend', (e) => {
        if (this.istouchMove) {
          this.istouchMove = false
          let stepScroll = this.itemWidthStepToScroll
          let direction = 1

          if (this.diff < 0) {
            direction = -1
          }
          if (direction > 0 && this.startPostTranslateX === 0) {
            this.$sliderContainer.style.transform = "translateX(" + this.startPostTranslateX + "px)"
            return false
          } else if (direction < 0 && this.maxScroll === Math.abs(this.startPostTranslateX)) {
            this.$sliderContainer.style.transform = "translateX(" + this.startPostTranslateX + "px)"
            return false
          }


          if (Math.abs(this.diff) > this.width50Precent) {
            stepScroll *= direction
            this.startPostTranslateX += stepScroll
            this.$sliderContainer.style.transform = "translateX(" + (this.startPostTranslateX) + "px)"
          } else {
            this.$sliderContainer.style.transform = "translateX(" + this.startPostTranslateX + "px)"
          }
        }
      })
    }

    Slider.prototype.getTranslateX = function(elem) {
      let style = window.getComputedStyle(elem);
      let matrix = new WebKitCSSMatrix(style.transform);
      return parseInt(matrix.m41)
    }

    Slider.prototype.getTouch = function(event) {
      let evt = (typeof event.originalEvent === 'undefined') ? event : event.originalEvent;
      return evt.touches[0] || evt.changedTouches[0];
    }

    if (getWidth() <= 490) {
      let thouchSlider = new Slider('slider', '.photos-slider', '.photos-slider__item')
      thouchSlider.init()
    }

    function getWidth()
    {
      let xWidth = null;
      if(window.screen != null)
        xWidth = window.screen.availWidth;

      if(window.innerWidth != null)
        xWidth = window.innerWidth;

      if(document.body != null)
        xWidth = document.body.clientWidth;

      return xWidth;
    }
  })()
})