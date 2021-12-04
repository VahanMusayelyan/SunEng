<template>
    <div>
        <a class="text-img">
        <div id="particleJs">

                <number
                    class="lessonsNumber"
                    ref="number1"
                    :from="100"
                    :to="4561"
                    :format="theFormat"
                    :duration="5"
                    :delay="2"
                    easing="Power1.easeOut">
                </number>

        </div>
        </a>
    </div>

</template>

<script>
import particles from 'particles.js'
import Vue from 'vue'
import VueNumber from 'vue-number-animation'

Vue.use(VueNumber)

export default {
    name: 'app',
    methods: {
        theFormat(number) {
            return number.toFixed(0);
        },
        completed() {
            console.log('Animation ends!');
        },
        playAnimation() {
            this.$refs.number2.play()
        }
    },
    mounted()
    {
        particlesJS('particleJs', {
            "particles": {
                "number": {
                    "value": 480,
                    "density": {
                        "enable": true,
                        "value_area": 500
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 140,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    }
}




/* eslint-disable */

</script>



<style>
#appA {
    position: absolute;
    background-color: #000000;
    width: 350px;
    height: 350px;
}
canvas {
    display: block;
    vertical-align: bottom;
}

.lessonsNumber{
    font-size: 120px;
    color: #ed6506;
    position: absolute;
    z-index: 1000000;
    font-weight: 600;
}

#particles-js {
    min-width: 360px;
    min-height: 360px;
}
.text-img {
    -webkit-text-fill-color: transparent;
    background: -webkit-linear-gradient(transparent, transparent);
    background: -o-linear-gradient(transparent, transparent);
    background: linear-gradient(
        -62deg, #45476f, #6689ff);
    -webkit-background-clip: text;
}

.text-img > span {
    pointer-events: none;
}

</style>
