<div {{ $attributes }}>
    <style>
        .mySwiper {
            width: 100%;
            /* height: 100%; */
            aspect-ratio: 21/9
        }

        .swiper-slide-item {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide-img {
            display: block;
            width: 100%;
            /* aspect-ratio: 21/9 */
                height: 100%;
                object-fit: cover;
        }

    </style>

    <swiper-container autoplay="true" autoplay-delay=2000 speed=1000 effect='slide' class="mySwiper" pagination="true" pagination-clickable="true" navigation="true" space-between="30" loop="true">
        <swiper-slide class="swiper-slide-item">
            <img class="swiper-slide-img" src="https://source.unsplash.com/random/?mountain&1" alt="">
        </swiper-slide>
        <swiper-slide class="swiper-slide-item">
            <img class="swiper-slide-img" src="https://source.unsplash.com/random/?mountain&2" alt="">
        </swiper-slide>
        <swiper-slide class="swiper-slide-item">
            <img class="swiper-slide-img" src="https://source.unsplash.com/random/?mountain&3" alt="">
        </swiper-slide>
        <swiper-slide class="swiper-slide-item">
            <img class="swiper-slide-img" src="https://source.unsplash.com/random/?mountain&4" alt="">
        </swiper-slide>
        <swiper-slide class="swiper-slide-item">
            <img class="swiper-slide-img" src="https://source.unsplash.com/random/?mountain&5" alt="">
        </swiper-slide>
    </swiper-container>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</div>

