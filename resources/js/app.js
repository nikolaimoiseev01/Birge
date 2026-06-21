import './bootstrap';
import {livewire_hot_reload} from 'virtual:livewire-hot-reload'
// import Swiper JS
import Swiper from 'swiper';
// import Swiper styles
import 'swiper/css';
import { Navigation, Pagination } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';

import { gsap } from "gsap";

import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollSmoother } from "gsap/ScrollSmoother";

import Lenis from 'lenis'

// Initialize Lenis
const lenis = new Lenis();

// Use requestAnimationFrame to continuously update the scroll
function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

gsap.registerPlugin(ScrollTrigger,ScrollSmoother);

Swiper.use([Navigation, Pagination]);
window.Swiper = Swiper;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

livewire_hot_reload();

window.revealOnScroll = function revealOnScroll(delay = 0) {
    return {
        shown: false,
        delay,

        init() {
            const observer = new IntersectionObserver(
                ([entry]) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => this.shown = true, this.delay);
                        observer.unobserve(this.$el);
                    }
                },
                {
                    threshold: 0.12,
                    rootMargin: '0px 0px -6% 0px',
                }
            );

            observer.observe(this.$el);
        },
    };
}

