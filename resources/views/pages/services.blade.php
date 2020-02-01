@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')

<section class="fsection">
  <div class="container">
    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
        <h2 class="lead-blue _header">SERVICES</h2>
        <hr>
        <h3 class="lead-blue _title">Business Strategy & Innovation - Coaching</h3>
        <p class="_body _line_height_1">We understand you’re experts in your business. We coach you on how to ‘enhance’ your current state of functioning to accomplish your business goals. Strategy is most effective when developed with long-term perspective in mind. In-depth strategy coaching includes collecting present data, identifying business challenges, needs & desires; allowing a greater outcome for desirable results.</p>
      </div>

    </div>

  </div>
</section><!--/#team-->

<section  id="about-uscc" class="parallax ser">
  <div class="layer"></div>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="about-info wow fadeInUp" data-wow-duration="500ms" data-wow-delay="100ms">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 sec-cont">
                <h2 class="_sec sec-title lead-blue">Business Strategy & Innovation - Project Management</h2>
                <h3 class="_sec sec-par">For this approach we work with our clients to understand the complexities of their current situation. We work with clients to figure out needs in regards to project management. We understand when managing client projects that there is no ‘one-size fits all’ formula for solutions, so we pride ourselves on project management strategies customized for each client. We can take on a project entirely to free up your time, or we can manage pieces of a project to optimize our time & resources, saving you money. When you're able to free up more capital you can begin to expand your company’s growth opportunities.</h3>


              </div>
            </div>
          </div>
   
        </div>
      </div>
    </div>
  </div>
</section>


<section id="services">
  <div class="container">
    <div class="text-center our-services">
      <div class="row">
        <div class="ser-sec col-sm-4 col-md-4 wow fadeInDown" data-wow-duration="500ms" data-wow-delay="100ms">
          <div class="service-icon">
            <i class="fa fa-line-chart"></i>
          </div>
          <div class="service-info">
            <h3>GO TO MARKET STRATEGY</h3>
            <p>We create a comprehensive marketing strategy that includes all marketing goals.</p>
          </div>
        </div>
        <div class="ser-sec col-sm-4 col-md-4 wow fadeInDown" data-wow-duration="500ms" data-wow-delay="100ms">
          <div class="service-icon">
            <i class="fa fa-address-card-o"></i>
          </div>
          <div class="service-info">
            <h3>SEO Management</h3>
            <p>Search Engine Optimization is crucial to landing new clients. We work with you to create a website that will attract and retain new and existing customers.</p>
          </div>
        </div>
        <div class="ser-sec col-sm-4 col-md-4 wow fadeInDown" data-wow-duration="500ms" data-wow-delay="250ms">
          <div class="service-icon">
            <i class="fa fa-cogs"></i>
          </div>
          <div class="service-info">
            <h3>OPERATIONAL EFFICIENCY</h3>
            <p>We identify inefficiencies in management, product development and services, employee performance and consumer satisfaction.</p>
          </div>
        </div>
        <div class="ser-sec col-sm-6 col-md-6 wow fadeInDown" data-wow-duration="500ms" data-wow-delay="350ms">
          <div class="service-icon">
            <i class="fa fa-pie-chart"></i>
          </div>
          <div class="service-info">
            <h3>SOCIAL MEDIA MANAGEMENT</h3>
            <p>A vital aspect of business growth is a social media strategy that creates meaningful interactions.</p>
          </div>
        </div>
        <div class="ser-sec col-sm-6 col-md-6 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="450ms">
          <div class="service-icon">
            <i class="fa fa-clock-o"></i>
          </div>
          <div class="service-info">
            <h3>ROI</h3>
            <p>This is all about Return On Investment (ROI). Our team creates unique strategies tailored to your business goals focused on investment time & value return.</p>
          </div>
        </div>
      </div>
      <hr>

      <a href="/schedule" class="schedule-modal-view btn btn-primary btn-lg"><strong style="    font-size: 27px;
">Schedule With Us</strong>&nbsp;&nbsp;<i class="fa fa-calendar fa-2x" aria-hidden="true"></i></a>

    </div>
  </div>
</section><!--/#services-->

<div id="contact-us" class="parallax">
  <div class="container">
    <div class="row">
      <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="100ms">
        <h2 class="caps lead-blue _title" style="text-transform: capitalize;">do you have questions about our services?</h2>
        <p class="_body">KPike Consulting Solutions specializes in Business Strategy and Innovation. We strive to engage and retain our clients in professional business relationships along with delivering 100% client satisfaction.</p>
      </div>
    </div>
    <div class="contact-form wow fadeIn" data-wow-duration="500ms" data-wow-delay="400ms">
      <div class="row">
        <div class="col-sm-6">
          <form id="main-contact-formx" name="contact-form" method="post" action="#">
            <div class="row  wow fadeInUp" data-wow-duration="500ms" data-wow-delay="100ms">
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Name" required="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Email Address" required="required">
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" name="subject" class="form-control" placeholder="Subject" required="required">
            </div>
            <div class="form-group">
              <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter your message" required="required"></textarea>
            </div>                        
            <div class="form-group">
              <button type="submit" class="btn-submit" id="send-email-btn">Send Now</button>
            </div>
          </form>   
        </div>
        <div class="col-sm-6">
          <div class="contact-info wow fadeInUp" data-wow-duration="500ms" data-wow-delay="100ms">
            <!-- <p><strong>OUR SERVICES</strong></br>GO MARKET STRATEGY
              OPERATIONAL EFFICIENCY
              SALES AND MARKETING
              INVESTMENT TIME & VALUE RETURN</p> -->
            <ul class="address">
              <li><i class="fa fa-map-marker"></i> <span> Address:</span> Norwich, VT 05055 </li>
              <li><i class="fa fa-phone"></i> <span> Call now :</span>  (802) 522-0158  </li>
              <li><i class="fa fa-envelope"></i> <span> Email:</span><a href="mailto:info@kpikeconsultingsolutions.com"> info@kpikeconsultingsolutions.com</a></li>
              <li><a href="https://www.google.com/maps?ll=43.693409,-72.318947&z=15&t=m&hl=en-US&gl=US&mapclient=embed&q=2727+Christian+St+White+River+Junction,+VT+05001">View larger map</a></li>
            </ul>
          </div>                            
        </div>
      </div>
    </div>
  </div>
</div>  

@stop