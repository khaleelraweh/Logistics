@extends('layouts.app')

@section('content')

    <!-- Start Landing Section -->
    @include('frontend.home.landing')
    <!-- End Landing Section -->


    <!-- start Services section  -->
    <div class="services" id="services">
      <div class="container">
        <div class="main-heading wow fadeIn" data-wow-duration="2s">
          <h2>Services</h2>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
            numquam doloremque error! In amet optio eum fugiat iusto

          </p>
        </div>
        <div class="services-container">
          <div
            class="srv-box wow bounceInLeft"
            data-wow-duration="1s"
            data-wow-delay="0.5s"
          >
            <i class="fas fa-desktop fa-3x"></i>
            <div class="text">
              <h3>Vorem Amet intutive</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam
                error, maxime consectetur nostrum rem beatae quisquam mollitia
              </p>
            </div>
          </div>
          <div
            class="srv-box wow bounceInRight"
            data-wow-duration="1s"
            data-wow-delay="0.5s"
          >
            <i class="fas fa-pencil-ruler fa-3x"></i>
            <div class="text">
              <h3>Vorem Amet intutive</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam
                error, maxime consectetur nostrum rem beatae quisquam mollitia
              </p>
            </div>
          </div>
          <div
            class="srv-box wow bounceInLeft"
            data-wow-duration="1s"
            data-wow-delay="0.5s"
          >
            <i class="fas fa-camera fa-3x"></i>
            <div class="text">
              <h3>Vorem Amet intutive</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam
                error, maxime consectetur nostrum rem beatae quisquam mollitia
              </p>
            </div>
          </div>
          <div
            class="srv-box wow bounceInRight"
            data-wow-duration="1s"
            data-wow-delay="0.5s"
          >
            <i class="fas fa-cog fa-3x"></i>
            <div class="text">
              <h3>Vorem Amet intutive</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam
                error, maxime consectetur nostrum rem beatae quisquam mollitia
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Services section  -->
    <!-- Start Design section  -->
    <div class="design" id="project">
      <div class="image wow fadeInUp">
        <img src="{{asset('frontend/images/mobile.png')}}" alt="phone image" />
      </div>
      <div class="text wow fadeInRight">
        <h2>our design comes with</h2>
        <ul>
          <li>responsive design</li>
          <li>modern and clean design</li>
          <li>clean code</li>
          <li>brwoser friendly</li>
        </ul>
      </div>
    </div>
    <!-- End Design section  -->
    <!-- start portfolio section  -->
    <div class="portfolio" id="portfolio">
      <div class="container">
        <div class="main-heading">
          <h2>Portfolio</h2>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
            numquam doloremque error! In amet optio eum fugiat iusto
          </p>
        </div>
        <ul class="shuffle Portfolio-filter wow bounceIn">
          <li class="active" data-filter="all">All</li>
          <li data-filter="app">App</li>
          <li data-filter="photo">Photo</li>
          <li data-filter="web">Web</li>
          <li data-filter="print">Print</li>
        </ul>
      </div>

      <div class="imgs-container wow bounceIn">
        <div class="box Portfolio-item" data-category="app">
          <img src="{{asset('frontend/images/shuffle-01.jpg')}}" alt="" />
          <div class="caption">
            <h3>Awesome Image</h3>
            <p>Photography</p>
          </div>
        </div>
        <div class="box Portfolio-item" data-category="app">
          <img src="{{asset('frontend/images/shuffle-02.jpg')}}" alt="" />
          <div class="caption">
            <h3>Awesome Image</h3>
            <p>Photography</p>
          </div>
        </div>
        <div class="box Portfolio-item" data-category="photo">
          <img src="{{asset('frontend/images/shuffle-03.jpg')}}" alt="" />
          <div class="caption">
            <h3>Awesome Image</h3>
            <p>Photography</p>
          </div>
        </div>
        <div class="box Portfolio-item" data-category="web">
          <img src="{{asset('frontend/images/shuffle-04.jpg')}}" alt="" />
          <div class="caption">
            <h3>Awesome Image</h3>
            <p>Photography</p>
          </div>
        </div>
        <div class="box Portfolio-item" data-category="web">
          <img src="{{asset('frontend/images/shuffle-05.jpg')}}" alt="" />
          <div class="caption">
            <h3>Awesome Image</h3>
            <p>Photography</p>
          </div>
        </div>
        <div class="box Portfolio-item" data-category="print">
          <img src="{{asset('frontend/images/shuffle-06.jpg')}}" alt="" />
          <div class="caption">
            <h3>Awesome Image</h3>
            <p>Photography</p>
          </div>
        </div>
        <div class="box Portfolio-item" data-category="print">
          <img src="{{asset('frontend/images/shuffle-07.jpg')}}" alt="" />
          <div class="caption">
            <h3>Awesome Image</h3>
            <p>Photography</p>
          </div>
        </div>
        <div class="box Portfolio-item" data-category="print">
          <img src="{{asset('frontend/images/shuffle-08.jpg')}}" alt="" />
          <div class="caption">
            <h3>Awesome Image</h3>
            <p>Photography</p>
          </div>
        </div>
      </div>
      <a
        href="#"
        class="more wow fadeInUp"
        data-wow-duration="1s"
        data-wow-delay="1s"
        >More</a
      >
    </div>
    <!-- End portfolio section  -->
    <!-- start video section  -->
    <div class="video">
      <video
        autoplay
        muted
        loop
        src="{{asset('frontend/images/awesome-video.mp4')}}"
        type="video/mp4"
      ></video>
      <div
        class="text wow backInLeft"
        data-wow-duration="1s"
        data-wow-delay="0.5"
      >
        <h2>super awesome video here</h2>
        <p>it's all you need</p>
        <div class="video-more-info">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae aperiam
          adipisci aut magnam, suscipit sint rem dignissimos veritatis, facilis
          recusandae amet, aspernatur quod expedita ipsam fuga consequatur modi.
          Sit, provident.
        </div>
        <button id="video_more">see more</button>
      </div>
    </div>
    <!-- End video section  -->
    <!-- start about section  -->
    <div class="about" id="about">
      <div class="container">
        <div class="main-heading">
          <h2>About Us</h2>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
            numquam doloremque error! In amet optio eum fugiat iusto
          </p>
        </div>
        <img
          class="wow fadeInUp"
          data-wow-duration="1s"
          src="{{asset('frontend/images/about.png')}}"
          alt=""
        />
      </div>
    </div>
    <!-- End about section  -->
    <!-- Start statistics section  -->
    <div class="stats">
      <div class="container wow bounceInLeft" data-wow-duration="1s">
        <div class="box">
          <i class="fas fa-mug-hot"></i>
          <div class="number">1,263</div>
          <p>coffie drinks</p>
        </div>
        <div class="box">
          <i class="fas fa-folder"></i>
          <div class="number">256</div>
          <p>complete project</p>
        </div>
        <div class="box">
          <i class="fas fa-envelope"></i>
          <div class="number">1,743</div>
          <p>mail sent</p>
        </div>
        <div class="box">
          <i class="fas fa-trophy"></i>
          <div class="number">17</div>
          <p>aware received</p>
        </div>
      </div>
    </div>
    <!-- End statistics section  -->

    <!-- Start out skills section  -->
    <div class="our-skill">
      <div class="main-heading wow fadeIn" data-wow-duration="1s">
        <h2>Our Skills</h2>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
          numquam doloremque error! In amet optio eum fugiat iusto
        </p>
      </div>
      <div class="container">
        <div class="testimonials wow fadeInLeft" data-wow-duration="1s">
          <h2>Testimonials</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque
            minus alias
          </p>
          <div class="main-content">
            <div class="popular">
              <div class="bx-content">
                <!-- Testimonial Content 1 -->
                <!-- wow bounceInLeft  data-wow-duration="1s" data-wow-delay="0.5s" -->
                <div class="content wow fadeInUp" data-wow-delay="0.5s">
                  <img src="{{asset('frontend/images/skills-01.jpg')}}" alt="imoge one" />
                  <div class="text">
                    Lorem ipsum dolor, ipsum dolor sit amet consectetur
                    adipisicing elit.
                    <p>Jone Done , CEO</p>
                  </div>
                </div>
                <!-- Testimonial Content 2 -->
                <div class="content wow fadeInUp" data-wow-delay="1s">
                  <img src="{{asset('frontend/images/skills-02.jpg')}}" alt="imoge one" />
                  <div class="text">
                    Lorem ipsum dolor, ipsum dolor sit amet consectetur
                    adipisicing elit.
                    <p>Jone Done , CEO</p>
                  </div>
                </div>
              </div>
              <div class="bx-content">
                <!-- Testimonial Content 3 -->
                <!-- wow bounceInLeft  data-wow-duration="1s" data-wow-delay="0.5s" -->
                <div class="content" data-wow-delay="0.5s">
                  <img src="{{asset('frontend/images/skills-01.jpg')}}" alt="imoge one" />
                  <div class="text">
                    Lorem ipsum dolor, ipsum dolor sit amet consectetur
                    adipisicing elit.
                    <p>Jone Done , CEO</p>
                  </div>
                </div>
                <!-- Testimonial Content 4 -->
                <div class="content" data-wow-delay="1s">
                  <img src="{{asset('frontend/images/skills-02.jpg')}}" alt="imoge one" />
                  <div class="text">
                    Lorem ipsum dolor, ipsum dolor sit amet consectetur
                    adipisicing elit.
                    <p>Jone Done , CEO</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="skills wow fadeInRight" data-wow-duration="1s">
          <h2>Skills</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque
            minus alias
          </p>
          <div
            class="prog-holder wow bounceInUp"
            data-wow-duration="1s"
            data-wow-delay="0.5s"
          >
            <h4>Adobe</h4>
            <div class="prog">
              <span style="width: 90%" data-progress="90%"></span>
            </div>
          </div>
          <div
            class="prog-holder wow bounceInUp"
            data-wow-duration="1.1s"
            data-wow-delay="0.5s"
          >
            <h4>HTML &amp; CSS</h4>
            <div class="prog">
              <span style="width: 85%" data-progress="85%"></span>
            </div>
          </div>
          <div
            class="prog-holder wow bounceInUp"
            data-wow-duration="1.2s"
            data-wow-delay="0.5s"
          >
            <h4>Javascript</h4>
            <div class="prog">
              <span style="width: 80%" data-progress="80%"></span>
            </div>
          </div>
          <div
            class="prog-holder wow bounceInUp"
            data-wow-duration="1.3s"
            data-wow-delay="0.5s"
          >
            <h4>php</h4>
            <div class="prog">
              <span style="width: 90%" data-progress="90%"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End out skills section  -->
    <!-- Start qoute section  -->
    <div class="qoute">
      <div class="container wow bounceInDown">
        <q
          >Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio,
          perspiciatis atque?
        </q>
        <span>Jone Done</span>
      </div>
    </div>
    <!-- End qoute section  -->
    <!-- Start Pricing -->
    <div class="pricing" id="project">
      <div class="container">
        <div class="main-heading">
          <h2>Pricing</h2>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
            numquam doloremque error! In amet optio eum fugiat iusto
          </p>
        </div>
        <div class="plans">
          <div class="plan wow fadeInLeft">
            <div class="head">
              <h3>basic</h3>
              <span>19</span>
            </div>
            <ul>
              <li>Feature No 1</li>
              <li>Extra feature</li>
              <li>Feature No 2</li>
              <li>Feature</li>
            </ul>
            <div class="foot">
              <a href="#">Buy Now</a>
            </div>
          </div>
          <div class="plan wow fadeInLeft">
            <div class="head">
              <h3>premium</h3>
              <span>29</span>
            </div>
            <ul>
              <li>Feature No 1</li>
              <li>Extra feature</li>
              <li>Feature No 2</li>
              <li>Feature</li>
            </ul>
            <div class="foot">
              <a href="#">Buy Now</a>
            </div>
          </div>
          <div class="plan wow fadeInLeft">
            <div class="head">
              <h3>pro</h3>
              <span>39</span>
            </div>
            <ul>
              <li>Feature No 1</li>
              <li>Extra feature</li>
              <li>Feature No 2</li>
              <li>Feature</li>
            </ul>
            <div class="foot">
              <a href="#">Buy Now</a>
            </div>
          </div>
          <div class="plan wow fadeInLeft">
            <div class="head">
              <h3>plitinum</h3>
              <span>49</span>
            </div>
            <ul>
              <li>Feature No 1</li>
              <li>Extra feature</li>
              <li>Feature No 2</li>
              <li>Feature</li>
            </ul>
            <div class="foot">
              <a href="#">Buy Now</a>
            </div>
          </div>
        </div>
        <div class="price-contact wow fadeInUp">
          <p>contact us if you have special request</p>
          <a href="#contact">contact us</a>
        </div>
      </div>
    </div>
    <!-- End Pricing -->
    <!-- start subscribe section  -->
    <div class="subscribe">
      <div class="container">
        <form action="#" class="wow fadeInLeft">
          <i class="fas fa-envelope"></i>
          <input type="email" placeholder="You Email" name="email" />
          <input type="submit" value="submit" />
        </form>
        <p class="wow fadeInRight">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ea
          deserunt error sed
        </p>
      </div>
    </div>
    <!-- End subscribe section  -->
    <!-- Start contact section  -->
    <div class="contact" id="contact">
      <div class="container">
        <div class="main-heading wow fadeIn" data-wow-duration="1s">
          <h2>Contact Us</h2>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
            numquam doloremque error! In amet optio eum fugiat iusto
          </p>
        </div>
        <div class="content wow bounceIn" data-wow-duration="1s">
          <form action="">
            <input
              class="main-input"
              placeholder="Your Name"
              type="text"
              name="name"
            />
            <input
              class="main-input"
              placeholder="Your Email"
              type="email"
              name="email"
            />
            <textarea
              class="main-input"
              placeholder="Your Message"
              name="message"
            ></textarea>
            <input type="submit" value="Send Message" />
          </form>
          <div class="info">
            <h4>Get in touch</h4>
            <span>+00 123.456.789</span>
            <span>+00 123.456.789</span>
            <h4>where we are</h4>
            <address>
              awesome address 17<br />
              new yourk ,NYC <br />
              123.456.789<br />
              UST
            </address>
          </div>
        </div>
      </div>
    </div>
    <!-- End contact section  -->
    @endsection
