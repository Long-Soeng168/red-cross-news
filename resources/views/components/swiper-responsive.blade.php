<div {{ $attributes }}>
    <style>
        .swiper-responsive {
            width: 100%;
            /* height: 100%; */
            /* aspect-ratio: 21/9 */
        }

        .swiper-responsive-item {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-responsive-img {
            display: block;
            width: 100%;
            /* height: 100%; */
            aspect-ratio: 9/16;
            object-fit: cover;
        }

    </style>

    <swiper-container  class="swiper-responsive" autoplay="true"
        autoplay-delay=1000
        speed=500
        effect="slide"
        pagination="true"
        pagination-clickable="true"
        navigation="true"
        space-between="30"
        loop="true"
        init="false"
    >
        <swiper-slide class="swiper-responsive-item">
            <img class="swiper-responsive-img" src="https://source.unsplash.com/random/?mountain&1" alt="">
        </swiper-slide>
        <swiper-slide class="swiper-responsive-item">
            <img class="swiper-responsive-img" src="https://source.unsplash.com/random/?mountain&2" alt="">
        </swiper-slide>
        <swiper-slide class="swiper-responsive-item">
            <img class="swiper-responsive-img" src="https://source.unsplash.com/random/?mountain&3" alt="">
        </swiper-slide>
        <swiper-slide class="swiper-responsive-item">
            <img class="swiper-responsive-img" src="https://source.unsplash.com/random/?mountain&4" alt="">
        </swiper-slide>
        <swiper-slide class="swiper-responsive-item">
            <img class="swiper-responsive-img" src="https://source.unsplash.com/random/?mountain&5" alt="">
        </swiper-slide>
    </swiper-container>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <script>
        const swiperEl = document.querySelector('.swiper-responsive')
        Object.assign(swiperEl, {
          slidesPerView: 1,
          spaceBetween: 10,
          pagination: {
            clickable: true,
          },
          breakpoints: {
            640: {
              slidesPerView: 1,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 40,
            },
            1024: {
              slidesPerView: 3,
              spaceBetween: 50,
            },
          },
        });
        swiperEl.initialize();
      </script>
</div>
