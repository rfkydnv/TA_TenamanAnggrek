<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/all.min.css') }}"> <!-- https://fontawesome.com/ -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/ -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-video-catalog.css') }}">
</head>
<!--

TemplateMo 552 Video Catalog

https://templatemo.com/tm-552-video-catalog

-->
<body>
	<div class="tm-page-wrap mx-auto">
		<div class="position-relative">
			<div class="potition-absolute tm-site-header">
				<div class="container-fluid position-relative">
					<div class="row">
                        <div class="col-5 col-md-8 ml-auto mr-0">
                            <div class="tm-site-nav">
                                <nav class="navbar navbar-expand-lg mr-0 ml-auto" id="tm-main-nav">
                                    <button class="navbar-toggler tm-bg-black py-2 px-3 mr-0 ml-auto collapsed" type="button"
                                        data-toggle="collapse" data-target="#navbar-nav" aria-controls="navbar-nav"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span>
                                            <i class="fas fa-bars tm-menu-closed-icon"></i>
                                            <i class="fas fa-times tm-menu-opened-icon"></i>
                                        </span>
                                    </button>
                                    <div class="collapse navbar-collapse tm-nav" id="navbar-nav">
                                        <ul class="navbar-nav text-uppercase">
                                            <li class="nav-item">
                                                <a class="nav-link tm-nav-link" href="{{ route('home.index') }}">Beranda</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link tm-nav-link" href="{{ route('home.contact') }}">About</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
					</div>
				</div>
			</div>
			<div class="tm-welcome-container tm-fixed-header-3">
				<div class="text-center">
					<p class="pt-5 px-3 tm-welcome-text tm-welcome-text-2 mb-1 mt-lg-0 mt-5 text-white mx-auto">
                        Talk to Us<br>about any question you have
                    </p>                	
				</div>                
            </div>

            <div >
                
                <div class="parallax-window" data-parallax="scroll" data-image-src="pictures/tn-04.jpg"></div>
            </div> <!-- Header image -->
		</div>

		<!-- Page content -->
		<main>
			<div class="container-fluid px-0">
				<div class="mx-auto tm-content-container">	
                    <div class="row mt-3 mb-5 pb-3">
                        <div class="col-12">
                            <div class="mx-auto tm-about-text-container px-3">
                                <div class="col-lg-12 mb-5 pt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="tm-page-title mb-5 tm-text-primary">Tentang Saya</h2>    
                                        </div>                        
                                    </div>				
                                    <div class="media tm-testimonial">
                                        <img class="mr-4 rounded-circle img-fluid" src="pictures/testimonial-1.jpg" alt="Generic placeholder image">
                                        <p class="media-body pt-3 tm-testimonial-text">
                                            Vestibulum non lectus id lacus aliquet porttitor in non nulla. Aenean urna diam, finibys id lorem nec, feugiat convallis dolor. Integer aliquam, eros eget rutrum iaculis.    
                                        </p>                              
                                    </div>              
                                </div>
                                <div class="col-12">
                                    <div class="mx-auto tm-about-text-container px-3">
                                        <h2 class="tm-page-title mb-4 tm-text-primary">Mengapa Anggrek ?</h2>
                                        <p class="mb-4">
                                            Integer sit amet odio id libero tincidunt dignissim in eget arcu. Aliquam tristique ut magna sit amet tincidunt. Sed tempor tellus nulla, molestie luctus lectus tincidunt id. You are <u>not allowed</u> to re-distribute the template ZIP file on any template collection website.
                                        </p>
                                        <p class="mb-4">Video Catalog is a free website template for your business. This is 100% free Bootstrap v4.4.1 layout. You can modify and adapt this template for your CMS websites. You can use it for commercial or non-commercial work. If you wish to suport <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-text-primary">TemplateMo</a>, please contact us.</p>
                                    </div>							
                                </div>		
							</div>							
						</div>						
                    </div>
                    
                                                      			
				</div>

                <div class="parallax-window parallax-window-2" data-parallax="scroll" data-image-src="pictures/contact-2.jpg"></div>
                <br>
                
                {{-- <div class="mx-auto pb-3 tm-about-text-container px-3">
                    <div class="row">
                        <div class="col-lg-6 mb-5">
                            <form id="contact-form" action="" method="POST" class="tm-contact-form">
                              <div class="form-group">
                                <input type="text" name="name" class="form-control rounded-0" placeholder="Name" required="" />
                              </div>
                              <div class="form-group">
                                <input type="email" name="email" class="form-control rounded-0" placeholder="Email" required="" />
                              </div>
                              <div class="form-group">
                                <select class="form-control" id="contact-select" name="inquiry">
                                  <option value="-">Subject</option>
                                  <option value="sales">Sales &amp; Marketing</option>
                                  <option value="creative">Creative Design</option>
                                  <option value="uiux">UI / UX</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <textarea rows="8" name="message" class="form-control rounded-0" placeholder="Message"
                                          required=""></textarea>
                              </div>

                              <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit"><span>Submit</span></button>
                              </div>
                            </form>    
                        </div>
                        <div class="col-lg-6">
                            <div class="mapouter mb-60">
                                <div class="gmap_canvas">
                                    <iframe width="100%" height="520" id="gmap_canvas"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2821.226280741766!2d109.34685940966736!3d-0.05519936171431352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x209695fee6b07761!2sPoliteknik%20Negeri%20Pontianak!5e0!3m2!1sid!2sid!4v1611204030335!5m2!1sid!2sid"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>     --}}

			</div>
		</main>
        <div class="container-fluid tm-content-container mx-auto pt-4">
			<!-- Subscribe form and footer links -->
            <div class="row pt-3">
                <div class="col-lg-6">
                    <div class="mapouter mb-60">
                        <div class="gmap_canvas">
                            <iframe width="100%" height="255" id="gmap_canvas"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2821.226280741766!2d109.34685940966736!3d-0.05519936171431352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x209695fee6b07761!2sPoliteknik%20Negeri%20Pontianak!5e0!3m2!1sid!2sid!4v1611204030335!5m2!1sid!2sid"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="p-5 tm-bg-gray">
                        <h3 class="tm-text-primary mb-4">Contact Person</h3>
                        <ul class="list-unstyled tm-footer-links">
                            <li><img src="pictures/email.png" height='20px' width='30px'><a href="#"> rfkydnvi22@gmail.com</a></li>
                            <li><img src="pictures/phone.png" height='30px' width='30px'><a href="#"> +62 895-2757-6430</a></li>
                        </ul>    
                    </div>                        
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="p-5 tm-bg-gray ">
                        <h3 class="tm-text-primary mb-4">Our Media Social</h3>
                        <ul class="list-unstyled tm-footer-links">
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Instagram</a></li>
                        </ul>
                    </div>                        
                </div>
            </div> <!-- row -->

            <footer class="row pt-5">
                <div class="col-12">
                    <p class="text-right">Copyright 2020 The Video Catalog Company 
                        
                        - Designed by <a href="https://templatemo.com" rel="nofollow" target="_parent">TemplateMo</a></p>
                </div>
            </footer>
		</div>		
	</div>

	<script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/parallax.min.js"></script>    
</body>
</html>