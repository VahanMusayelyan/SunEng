<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/fav-32.svg" type="image/x-icon">
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"--}}
{{--          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>--}}
    <link rel="stylesheet" type="text/css"
          href="//fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,600,700,800,900%7CBaloo">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
          integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</head>
<body>

@yield("content")

<footer class="section footer-classic footer-classic-md">
    <div class="footer-classic-main">
        <div class="container">
            <div class="footer-classic-layout justify-content-sm-around justify-content-md-between">
                <div class="footer-classic-layout-item"><a class="brand" href="index.html"><img class="brand-logo-dark"
                                                                                                src="/images/logo-default-195x39.png"
                                                                                                alt="" width="195"
                                                                                                height="39"/><img
                            class="brand-logo-light" src="/images/logo-inverse-195x39.png" alt="" width="195"
                            height="39"/></a>
                    <div class="footer-classic-item-block footer-classic-item-block-1">
                        <h6>10000+ Satisfied Students</h6>
                        <div class="owl-carousel-quote-light">
                            <!-- Owl Carousel-->
                            <div class="owl-carousel" data-items="1" data-dots="false" data-nav="false"
                                 data-stage-padding="0" data-loop="true" data-margin="30"
                                 data-nav-custom="#footer-owl-nav" data-animation-in="fadeIn"
                                 data-animation-out="fadeOut" data-mouse-drag="false">
                                <blockquote class="quote-light quote-light-sm">
                                    <div class="icon linearicons-quote-open text-primary icon-md"></div>
                                    <div class="quote-light-main">
                                        <div class="quote-light-text">
                                            <q>The staff here is really supportive, teachers are great, the school has a
                                                good structure. Thank you!</q>
                                        </div>
                                        <cite class="quote-light-cite">Jane Smith</cite>
                                    </div>
                                </blockquote>
                                <blockquote class="quote-light quote-light-sm">
                                    <div class="icon linearicons-quote-open text-primary icon-md"></div>
                                    <div class="quote-light-main">
                                        <div class="quote-light-text">
                                            <q>I am really enjoying my experience here. Teachers are very friendly and
                                                there is a friendly atmosphere.</q>
                                        </div>
                                        <cite class="quote-light-cite">Peter McMillan</cite>
                                    </div>
                                </blockquote>
                                <blockquote class="quote-light quote-light-sm">
                                    <div class="icon linearicons-quote-open text-primary icon-md"></div>
                                    <div class="quote-light-main">
                                        <div class="quote-light-text">
                                            <q>I like that it has a busy atmosphere but it’s never stressful. Everyone
                                                is very nice and you can ask anything at any time.</q>
                                        </div>
                                        <cite class="quote-light-cite">Kate Wilson</cite>
                                    </div>
                                </blockquote>
                            </div>
                            <div class="owl-nav" id="footer-owl-nav">
                                <button class="owl-arrow owl-arrow-prev" aria-label="Prev">
                                    <svg width="20" height="16" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.7,15.1c0.4,0.4,1,0.4,1.4,0c0.4-0.4,0.4-1,0-1.4L2.4,8l5.7-5.7c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L0.3,7.3										c-0.4,0.4-0.4,1,0,1.4L6.7,15.1z M20,7H1v2h19V7z"></path>
                                    </svg>
                                </button>
                                <div class="owl-nav-divider"></div>
                                <button class="owl-arrow owl-arrow-next" aria-label="Next">
                                    <svg width="20" height="16" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.7071 8.70711C20.0976 8.31658 20.0976 7.68342 19.7071 7.29289L13.3431 0.928932C12.9526 0.538408 12.3195 0.538408 11.9289 0.928932C11.5384 1.31946 11.5384 1.95262 11.9289 2.34315L17.5858 8L11.9289 13.6569C11.5384 14.0474 11.5384 14.6805 11.9289 15.0711C12.3195 15.4616 12.9526 15.4616 13.3431 15.0711L19.7071 8.70711ZM0 9H19V7L0 7L0 9Z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-classic-layout-item">
                    <h6 class="footer-classic-title inset-3">Popular Courses</h6>
                    <div class="footer-classic-item-block footer-classic-item-block-3">
                        <ul class="list-pricing">
                            <li><a href="#"><span class="list-pricing-title">English for Kids</span><span>$45</span></a>
                            </li>
                            <li><a href="#"><span class="list-pricing-title">Online Learning</span><span>$15</span></a>
                            </li>
                            <li><a href="#"><span class="list-pricing-title">German Club</span><span>$36</span></a></li>
                            <li><a href="#"><span class="list-pricing-title">Personal Lessons</span><span>$21</span></a>
                            </li>
                            <li><a href="#"><span class="list-pricing-title">Group Lessons</span><span>$35</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-classic-layout-item">
                    <h6 class="footer-classic-title inset-3">Get in Touch</h6>
                    <div class="footer-classic-item-block">
                        <ul class="list list-1">
                            <li><a class="cursor-pointer" data-toggle="modal" data-target="#sendMessage">Send a
                                    Message</a></li>
                            <li><a href="contact-us.html">Contacts</a></li>
                            <li><a href="#">Request a Callback</a></li>
                        </ul>
                        <ul class="list-inline list-inline-md">
                            <li><a class="link-2" target="_blank" href="https://www.instagram.com/suneng.school/"><i
                                        class="fa-instagram"></i></a></li>
                            <li><a class="link-2" href="#"><i class="fa-facebook"></i></a></li>
                            <li><a class="link-2" href="#"><i class="fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($errors->first() && $errors->first() != "")
{{--        ToDo Toast Notification--}}
        <h1>Toast Notification</h1>
    @endif

    {{--    //start modal--}}
    <div class="modal fade" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/contact-us" method="POST">
                    <div class="backgroundImg position-absolute"></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Contact us</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" placeholder="Enter Message" rows="3"
                                      required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnModal" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnModal">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--    end modal--}}
    <div class="container mt-0">
        <div class="divider-2"></div>
    </div>
    <div class="footer-classic-aside">
        <div class="container">
            <p class="rights"><span>&copy;&nbsp; </span><span class="copyright-year"></span><span>&nbsp;</span><span>SunEng</span><span>. All rights reserved.</span>
            </p>
        </div>
    </div>
</footer>
</body>
</html>
