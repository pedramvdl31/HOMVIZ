@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
  
  <script type="text/javascript" src="/assets/js/pages/resources.js"></script>

@stop

@section('content')

    <style>
      .blog_post img{
        padding: 40px;
      }
      .blog_details {
        padding-top: 0 !important; 
      }
      .blog_details h4:hover {
          color: black;
      }

      .blog_details h4 {
          color: #f61b55;
      }
    </style>

    <!-- Banner Area Starts -->
    <section class="banner-area banner-bg about-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-text">
                        <h3>Resources</h3>
                        <a href="/">home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->
  
    <!--================Blog Categorie Area =================-->
    <section class="blog_categorie_area">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 _atag" link="https://www.youtube.com/channel/UCloSZSaqkRAEKQEWIsQWoCw" type="_blank">
                    <div class="categories_post">
                        <img src="assets/images/pam/pexels-photo-601177.jpeg" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="#"><h5>Youtube</h5></a>
                                <div class="border_line"></div>
                                <p>Exercise Videos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 _atag" link="/blog" type="">
                    <div class="categories_post">
                        <img src="assets/images/pam/pexels-photo-209968.jpeg" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="#"><h5>Blog</h5></a>
                                <div class="border_line"></div>
                                <p>Science and Stories</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 _atag" link="/schedule" type="">
                    <div class="categories_post">
                        <img src="assets/images/pam/pexels-photo-1332189.jpeg" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="#"><h5>Apply Here</h5></a>
                                <div class="border_line"></div>
                                <p>Train With Me</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Blog Categorie Area =================-->
    
    <!--================Blog Area =================-->
    <section class="blog_area">
        <div class="container">
            <div class="row">


                
                <div class="col-lg-12">

                    <div class="blog_left_sidebar">

                      <div class="row">
                        <div class="col-md-12">
                          <center>
                            <h3 class="text-heading title_color">TRAINING AND RESOURCES</h3>
                          </center>
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/new-resources/rvc.png" alt="">
                                      <div class="blog_details">
                                          <a href="http://rivervalleyclub.com/"><h4>River Valley Club (RVC)</h4></a>
                                          <p>Join us in welcoming Pam Crandall to our Personal Training team, and celebrating Matt MacLean's 20th year at the Club - book a demo session with Pam or Matt in September, FREE for members</p>
                                          <a target="_blank" href="http://rivervalleyclub.com/" class="template-btn">View More</a>
                                          <a target="_blank" href="http://rivervalleyclub.com/pam-crandall/?fbclid=IwAR1HxygL9anG1YNpmyjgzIchmPs3aNhjJcCFbLk8mndLTWBs-bq7rnOf8ao" class="template-btn">Read Bio</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/stravalogo.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.strava.com/"><h4>Strava</h4></a>
                                          <p>Designed by athletes, for athletes, Strava's mobile app and website connect millions of runners and cyclists through the sports they love.</p>
                                          <a target="_blank" href="https://www.strava.com/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/trainingpeakslogo.jpeg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.trainingpeaks.com/"><h4>Training Peaks</h4></a>
                                          <p>Achieve your goals with training apps and services designed for triathlon, cycling and running.</p>
                                          <a target="_blank" href="https://www.trainingpeaks.com/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/ylm.png" alt="">
                                      <div class="blog_details">
                                          <a href="https://ylmsportscience.com/"><h4>YLM Sports Science App</h4></a>
                                          <a target="_blank" href="https://ylmsportscience.com/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/blackburnpt.jpeg" alt="">
                                      <div class="blog_details">
                                          <a href="http://www.blackburnphysicaltherapy.com/"><h4>Blackburn Physical Therapy</h4></a>
                                          <p>Specializing in manual therapy for spine and joint pain</p>
                                          <a target="_blank" href="http://www.blackburnphysicaltherapy.com/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
         


                      </div>
                    </div>
                </div>


                <div class="col-lg-12">

                    <div class="blog_left_sidebar">

                      <div class="row">
                        <div class="col-md-12">
                          <center>
                            <h3 class="text-heading title_color">APPAREL</h3>
                          </center>
                        </div>
                      </div>

                      <div class="row">
                        
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/brooks-adrenaline-gts-19-navy-aqua-tan-womens-running-shoes.jpeg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.brooksrunning.com/en_us/search?q=Adrenalines"><h4>Brooks Adrenalines</h4></a>
                                          <p>The Brooks Women's Adrenaline GTS 18 features an innovative GuideRails support system, soft cushioning & smooth heel-to-toe transitions.</p>
                                          <a target="_blank" href="https://www.brooksrunning.com/en_us/search?q=Adrenalines" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/kandb.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.kbswimandsports.com/store"><h4>K&B</h4></a>
                                          <p>K & B Sports - Sportswear for women & men</p>
                                          <a target="_blank" href="https://www.kbswimandsports.com/store" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
              
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/cw_xlogo.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://cw-x.com/"><h4>CWX</h4></a>
                                          <p>CW-X Compression Gear is designed for targeted muscle and joint support.</p>
                                          <a target="_blank" href="https://cw-x.com/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
              
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/lululemonlogo.png" alt="">
                                      <div class="blog_details">
                                          <a href="https://shop.lululemon.com/"><h4>Lululemon</h4></a>
                                          <p>Lululemon makes technical athletic clothes for yoga, running, working out, and most other sweaty pursuits</p>
                                          <a target="_blank" href="https://shop.lululemon.com/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
              
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/speedologo.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.speedousa.com"><h4>Speedo</h4></a>
                                          <p>The world's leading swimwear brand.</p>
                                          <a target="_blank" href="https://www.speedousa.com" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
              
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/afSiG6RW_400x400.jpeg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.2xu.com/us"><h4>2XU</h4></a>
                                          <p>Triathlon, Workout & Compression Clothing offering superior technology & fabrics to multiply your performance.</p>
                                          <a target="_blank" href="https://www.2xu.com/us" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
              


                      </div>


                    </div>
                </div>

                <div class="col-lg-12">

                    <div class="blog_left_sidebar">

                      <div class="row">
                        <div class="col-md-12">
                          <center>
                            <h3 class="text-heading title_color">TRAINING TOOLS</h3>
                          </center>
                        </div>
                      </div>

                      <div class="row">
                        
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/roll1.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.performbetter.com/The-Grid-Foam-Roller"><h4>PERFORM BETTER Foam Rollers</h4></a>
                                          <a target="_blank" href="https://www.performbetter.com/The-Grid-Foam-Roller" class="template-btn">View Link</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/f1_e-3.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.optp.com/PRO-ROLLER-Soft?cat_id=204"><h4>OPTP.com Foam Rollers and Physio Balls</h4></a>
                                          <a target="_blank" href="https://www.optp.com/PRO-ROLLER-Soft?cat_id=204" class="template-btn">View Link 1</a>
                                          <a target="_blank" href="https://www.optp.com/search_results.cfm?kw=Physio+ball" class="template-btn">View Link 2</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>


                        

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/triggerpoint.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.amazon.com/TriggerPoint-Performance-Collection-Tissue-Self-Massage/dp/B013E37Z98/ref=redir_mobile_desktop?_encoding=UTF8&psc=1&ref=ppx_pop_tab_ap_asin_title"><h4>Trigger Point Performance Collection</h4></a>
                                          <a target="_blank" href="https://www.amazon.com/TriggerPoint-Performance-Collection-Tissue-Self-Massage/dp/B013E37Z98/ref=redir_mobile_desktop?_encoding=UTF8&psc=1&ref=ppx_pop_tab_ap_asin_title" class="template-btn">View Link</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>


                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/lgtr_093-600x573.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.kbswimandsports.com/store/swim-goggles/tyr-tracer-racing-adult-goggles/"><h4>TYR Tracer Racing Goggles</h4></a>
                                          <a target="_blank" href="https://www.kbswimandsports.com/store/swim-goggles/tyr-tracer-racing-adult-goggles/" class="template-btn">View Link</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/snorkel.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.kbswimandsports.com/store/swim-accessoriesequipment/finis-swimmers-snorkel/"><h4>FINIS Swimmer’s Snorkel</h4></a>
                                          <a target="_blank" href="https://www.kbswimandsports.com/store/swim-accessoriesequipment/finis-swimmers-snorkel/" class="template-btn">View Link</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/lfcross_group_10.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.kbswimandsports.com/store/swim-accessoriesequipment/tyr-cross-blade-training-fin/"><h4>TYR Cross Blade Training Fins</h4></a>
                                          <a target="_blank" href="https://www.kbswimandsports.com/store/swim-accessoriesequipment/tyr-cross-blade-training-fin/" class="template-btn">View Link</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>


                      </div>
                    </div>
                </div>


                
                <div class="col-lg-12">

                    <div class="blog_left_sidebar">

                      <div class="row">
                        <div class="col-md-12">
                          <center>
                            <h3 class="text-heading title_color">Blogs</h3>
                          </center>
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/Joe_Head_07a_400x400.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.joefrielsblog.com/"><h4>Joe Friel</h4></a>
                                          <a target="_blank" href="https://www.joefrielsblog.com/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/AC_head.JPG" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.alancouzens.com/"><h4>Alan Couzens</h4></a>
                                          <a target="_blank" href="https://www.alancouzens.com/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/paullarsenimg.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.plewsandprof.com/blog"><h4>Paul Laursen</h4></a>
                                          <a target="_blank" href="https://www.plewsandprof.com/blog" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                      </div>
                    </div>
                </div>

                
                <div class="col-lg-12">

                    <div class="blog_left_sidebar">

                      <div class="row">
                        <div class="col-md-12">
                          <center>
                            <h3 class="text-heading title_color">Podcasts</h3>
                          </center>
                        </div>
                      </div>

                      <div class="row">


                        


                        
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/eric.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://ericcressey.com/tag/podcast"><h4>Eric Cressey</h4></a>
                                          <!-- <p>A no holds barred exploration of what life is for and why we’re all here</p> -->
                                          <a target="_blank" href="https://ericcressey.com/tag/podcast" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/paulchek.png" alt="">
                                      <div class="blog_details">
                                          <a href="https://chekinstitute.com/podcast/"><h4>Paul Chek</h4></a>
                                          <p>A no holds barred exploration of what life is for and why we’re all here</p>
                                          <a target="_blank" href="https://chekinstitute.com/podcast/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
         
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/smcg.jpeg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.backfitpro.com/podcasts/"><h4>Stuart McGill</h4></a>
                                          <p>Evidence-based information that helps prevent and rehabilitate back pain.</p>
                                          <a target="_blank" href="https://www.backfitpro.com/podcasts/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                      </div>
                    </div>
                </div>


<!--                 <div class="col-lg-12">

                    <div class="blog_left_sidebar">

                      <div class="row">
                        <div class="col-md-12">
                          <center>
                            <h3 class="text-heading title_color">Instagram</h3>
                          </center>
                        </div>
                      </div>

                      <div class="row">
                        
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/new-resources/Kayla Itsines.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.instagram.com/kayla_itsines/"><h4>Kayla Itsines</h4></a>
                                          <a target="_blank" href="https://www.instagram.com/kayla_itsines/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                      </div>
                    </div>
                </div> -->

                <div class="col-lg-12">

                    <div class="blog_left_sidebar">

                      <div class="row">
                        <div class="col-md-12">
                          <center>
                            <h3 class="text-heading title_color">Books</h3>
                          </center>
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/ericcresseybook.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://ericcressey.com/tag/maximum-strength"><h4>Eric Cressey - Maximum Strength</h4></a>
                                          <a target="_blank" href="https://ericcressey.com/tag/maximum-strength" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/fastafter50.jpeg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.amazon.com/Fast-After-50-Race-Strong/dp/1937715264"><h4>Joe Friel</h4></a>
                                          <p>Fast After 50</p>
                                          <a target="_blank" href="https://www.amazon.com/Fast-After-50-Race-Strong/dp/1937715264" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/thecycliststrainingbible.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.amazon.com/Cyclists-Training-Bible-Joe-Friel/dp/1934030201"><h4>The Cyclists Training Bible</h4></a>
                                          <a target="_blank" href="https://www.amazon.com/s?k=cyclists+training+bible&i=stripbooks&crid=1CK7CK3B0P720&sprefix=Cyclists+%2Csporting%2C147&ref=nb_sb_ss_fb_1_9 " class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/thetriathletestrainingbible.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.amazon.com/Triathletes-Training-Bible-Joe-Friel/dp/1934030198"><h4>The Triathletes Training Bible</h4></a>
                                          <a target="_blank" href="https://www.amazon.com/Triathletes-Training-Bible-Joe-Friel/dp/1934030198" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/totalheartratetraining.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.amazon.com/Total-Heart-Rate-Training-Customize/dp/1569755620"><h4>Total Heart Rate Training</h4></a>
                                          <a target="_blank" href="https://www.amazon.com/Total-Heart-Rate-Training-Customize/dp/1569755620" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/danielsrunningformula.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.amazon.com/Daniels-Running-Formula-Jack-Tupper/dp/1450431836"><h4>Daniels' Running Formula</h4></a>
                                          <a target="_blank" href="https://www.amazon.com/Daniels-Running-Formula-Jack-Tupper/dp/1450431836" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>


                      </div>
                    </div>
                </div>


                <div class="col-lg-12">

                    <div class="blog_left_sidebar">

                      <div class="row">
                        <div class="col-md-12">
                          <center>
                            <h3 class="text-heading title_color">ORGANIZATIONS</h3>
                          </center>
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-lg-3 col-md-3 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/nasm.png" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.nasm.org/"><h4>National Academy of Sports Medicine</h4></a>
                                          <a target="_blank" href="https://www.nasm.org/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
                        
<!--                         <div class="col-lg-3 col-md-3 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/djgCaMph_400x400.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.usacycling.org/"><h4>USA Cycling</h4></a>
                                          <a target="_blank" href="https://www.usacycling.org/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>
          -->

                        <div class="col-lg-3 col-md-3 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/ZK6in934_400x400.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.teamusa.org/usa-triathlon"><h4>USA Triathlon </h4></a>
                                          <a target="_blank" href="https://www.teamusa.org/usa-triathlon" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>


                        <div class="col-lg-3 col-md-3 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/unnamed.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.usms.org/"><h4>US Masters Swimming</h4></a>
                                          <a target="_blank" href="https://www.usms.org/" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>


                        <div class="col-lg-3 col-md-3 col-xs-12">
                          <article class="row blog_item">
                              <div class="col-md-12">
                                  <div class="blog_post">
                                      <img src="/assets/images/pam/usaw_logo.jpg" alt="">
                                      <div class="blog_details">
                                          <a href="https://www.teamusa.org/usa-weightlifting"><h4>USA Weightlifiting</h4></a>
                                          <a target="_blank" href="https://www.teamusa.org/usa-weightlifting" class="template-btn">View More</a>
                                      </div>
                                  </div>
                              </div>
                          </article>
                        </div>

                      </div>
                    </div>
                </div>




            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

@stop