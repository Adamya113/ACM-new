<!-- //comment -->
<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include("head.php")
	?>
	<title>USICT ACM</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" /> -->
	<link rel="stylesheet" href="./assets/CSS/newStyle.css" />
	<link rel="stylesheet" href="./assets/CSS/header.css">
	<link rel="stylesheet" href="./assets/CSS/footer.css">
</head>

<body>
	<!-- nav bar -->
	<?php
	include("header.php")
	?>
	<!-- nav-bar end -->
	<!-- hero Section -->
	<section class="hero-slider hero-style">
		<div class="swiper-container" id="myCarousel">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="slide-inner slide-bg-image" data-swiper-parallax="0" data-background-small="./assets/images/banner-high-mobile.png" data-background="./assets/images/banner-high.png"></div>
				</div>
				<div class="swiper-slide">
					<div class="slide-inner slide-bg-image" data-swiper-parallax="0" data-background-small="./assets/images/img1-mobile.png" data-background="./assets/images/img1.jpg"></div>
				</div>
				<div class="swiper-slide">
					<div class="slide-inner slide-bg-image" data-swiper-parallax="0" data-background-small="./assets/images/img3-mobile.png" data-background="./assets/images/img3.jpg"></div>
				</div>
				<div class="swiper-slide">
					<div class="slide-inner slide-bg-image" data-swiper-parallax="0" data-background-small="./assets/images/img2-mobile.png" data-background="./assets/images/img2.jpg"></div>
				</div>

				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
			<div id="typewriter">
				<span class="typewriter-box" data-wait="200" data-content='["USICT ACM STUDENT CHAPTER"]'> </span>
				<!-- end swiper-slide -->
			</div>
			<!-- end swiper-wrapper -->

			<!-- swipper controls -->

			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
		<!-- <div id="typewriter">
			<span class="typewriter-box" data-wait="400" data-content='["USICT ACM STUDENT CHAPTER"]'> </span>
		</div> -->
	</section>
	<!-- end of hero slider -->

	<!-- begin of about section -->
	<div class="tag d-sm-flex about-us">
		<div class="col-sm-6 align-self-center p-md-5 p-sm-3">
			<div class="image text-center w-75 mx-auto">
				<img src="./assets/images/aboutUs-icon.png" alt="" class="w-100" />
			</div>
		</div>
		<div class="col-sm-6 col-9 mx-auto mt-3 pe-sm-5 align-self-center">
			<div class="text">
				<h2 class="mb-4 display-4 fw-bolder text-center text-md-start">
					About <span class="text-blue">Our Chapter</span>
				</h2>
				<p class="text-secondary about-text">
					ACM Student Chapter, USICT is an official student body incepted in 2019 under the University
					School USICT, GGSIPU. The chapter will conduct events including programming contests, talks by
					renowned speakers, workshops etc.which give the students an exposure to the competitive
					computing world as well as allow them to understand the advancements going on in the computing
					sphere worldwide.
				</p>
				<div class="py-3 mt-2 d-lg-flex justify-content-sm-center">
					<div class="col mb-2">
						<a href="./about.php" class="about-button">Know More</a>
					</div>
					<div class="col">
						<div class="drop-down about-button">
							<p>ACM Newsletter</p>
							<i class="fas fa-chevron-down arrow"></i>
						</div>
						<div class="dropdown">
							<a href="./assets/newsletter2.pdf" id="adobeXd">2021
								<span></span>
							</a>
							<a href="./assets/newsletter.pdf" id="sketch">2020
								<span></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end of about section -->
	<!-- announcement section begins-->
	<?php
	require_once "./announcement.php";
	?>

	<!-- announcement section ends-->
	<!--***********************blog section***************************************** -->
	<section class="blogs">
		<div class="blogs-sticker-holder">
			<span class="fas fa-book  sticker"></span>
			<span class="fas fa-pencil-alt sticker"></span>
			<span class="fas fa-file-alt  sticker"></span>
			<span class="far fa-bookmark sticker"></span>
		</div>
		<div class="tag">
			<div class="bloghead">
				<h2 class="my-4 display-4 fw-bolder text-center">Recent<span class="text-blue"> Blogs</span></h2>
			</div>
			<div class="b-container" id="threeBlogsRow"></div>
			<div class="py-3 mt-2 d-sm-flex justify-content-sm-center">
				<div class="col-lg-3 col-md-6 col-9 mb-2 mx-auto">
					<a href="./blogs.php" class="about-button blog-mobile-btn">Read More Blogs</a>
				</div>
			</div>
		</div>
	</section>

	<script>
		function readMoreRedirection(id) {
			console.log(id);
			window.document.location = './singleBlog.php?Id=' + id; //Connecting Second page
		}
		var rwBlogs = document.getElementById('threeBlogsRow');
		rwBlogs.innerHTML = '';

		let url1 = './admin/blogAdmin/api.php/?q=readHome';

		$(document).ready(function() {
			$.ajax({
				url: url1,
				method: 'GET',
				dataType: 'JSON',
				success: function(data) {
					var i;
					for (i = 1; i < 4; i++) {
						myFunc(data[i - 1], i);
					}

					function myFunc(row, index) {
						var desc = row.Content;
						var descSub = desc.substring(0, 70) + '...';

						rwBlogs.innerHTML +=
							'<div class="b-card-container">\
				<div class="b-card">\
				<div class="b-infos">\
					<p class="b-text text-center">' +
							row.Title +
							'</p>\
					<p class="b-text text-center">By ' +
							row.Author +
							'</p>\
					<span class="b-text" style="display:flex; align-items:center; justify-content:center;"><a href="javascript:readMoreRedirection(' +
							row.Sno +
							')" class="b-button" style="text-decoration:none; cursor:pointer; font-size: 14px;padding: 12px; margin-top:5px">Read Blog <i class="fas fa-long-arrow-alt-right"></i></a></span>\
				</div>\
				<img src="./' +
							row.Image +
							'" class="blog-img"/>\
			</div>\
			<div>';
					}
				},
			});
		});
	</script>
	<!-- ******************************blog section end***************************************** -->
	<!-- *******************************************our team************* -->
	<section class="tag team">
		<div class="teamhead">
			<h2 class="my-4 display-4 fw-bolder text-center">Office<span class="text-blue"> Bearers</span></h2>
		</div>
		<div class="our-team-area my-5">
			<div class="container">
				<div class="row margin-media">
					<div class="col-md-4">
						<div class="our-team-sir row">
							<div class="our-team col-lg-4">
								<div class="our-team-left">
									<div class="name">
										<h5 class="text-center">Prof. Pravin Chandra</h5>
										<p class="text-center">Dean, USICT</p>
									</div>
									<img src="./assets/images/team/deanSir.jpeg" alt="">
								</div>
							</div>
							<div class="our-team col-lg-4">
								<div class="our-team-left">
									<div class="name">
										<h5 class="text-center">Dr. Rahul Johari</h5>
										<p class="text-center">Branch Head, ACM USICT</p>
									</div>
									<img src="./assets/images/team/rahulsir.jpg" alt="">
								</div>
							</div>
						</div>
					</div>


					<div class="col-md-8 webTeam">
						<div class="our-team-row row">
							<div class="our-team col-6 col-md-6 col-lg-4">
								<div class="our-team-right">
									<a class="social" class="social" href="https://www.linkedin.com/in/harsh-goyal-195255b9/" target="_blank">
										<i class="fab fa-linkedin" arial-hidden="true"></i>
									</a>
									<div class="name">
										<h5 class="text-center">Harsh Goyal</h5>
										<p class="text-center">Chair</p>
									</div>
									<img src="./assets/images/team/harshGoyal.png" alt="">
								</div>
							</div>

							<div class="our-team col-6 col-md-6 col-lg-4">
								<div class="our-team-right">
									<a class="social" href="https://www.linkedin.com/in/anuj-talwar/" target="_blank">
										<i class="fab fa-linkedin" arial-hidden="true"></i>
									</a>
									<div class="name">
										<h5 class="text-center">Anuj Talwar</h5>
										<p class="text-center">Vice Chair</p>
									</div>
									<img src="./assets/images/team/Anuj.jpg" alt="">
								</div>
							</div>

							<div class="our-team col-6 col-md-6 col-lg-4">
								<div class="our-team-right">
									<a class="social" href="https://www.linkedin.com/in/tarun-shekhawat-037091194/" target="_blank">
										<i class="fab fa-linkedin" arial-hidden="true"></i>
									</a>
									<div class="name">
										<h5 class="text-center">Tarun</h5>
										<p class="text-center">Secretary</p>
									</div>
									<img src="./assets/images/team/Tarun.jpg" alt="">
								</div>
							</div>

							<div class="our-team col-6 col-md-6 col-lg-4">
								<div class="our-team-right">
									<a class="social" href="https://www.linkedin.com/in/karan-deep/" target="_blank">
										<i class="fab fa-linkedin" arial-hidden="true"></i>
									</a>
									<div class="name">
										<h5 class="text-center">Karan Deep Singh</h5>
										<p class="text-center">Treasurer</p>
									</div>
									<img src="./assets/images/team/Karan.jpeg" alt="">
								</div>
							</div>

							<div class="our-team col-6 col-md-6 col-lg-4">
								<div class="our-team-right">
									<a class="social" href="https://www.linkedin.com/in/moulik-agrawal/" target="_blank">
										<i class="fab fa-linkedin" arial-hidden="true"></i>
									</a>
									<div class="name">
										<h5 class="text-center">Moulik Agrawal</h5>
										<p class="text-center">Web Chair</p>
									</div>
									<img src="./assets/images/team/Moulik.jpg" alt="">
								</div>
							</div>

							<div class="our-team col-6 col-md-6 col-lg-4">
								<div class="our-team-right">
									<a class="social" href="https://www.linkedin.com/in/anurag-parashar/" target="_blank">
										<i class="fab fa-linkedin" arial-hidden="true"></i>
									</a>
									<div class="name">
										<h5 class="text-center">Anurag Parashar</h5>
										<p class="text-center">Membership Chair</p>
									</div>
									<img src="./assets/images/team/anurag.jpg" alt="">
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="py-3 mt-2 d-flex justify-content-sm-center">
			<div class="col-lg-2 col-md-4 col mb-2 mt-4 mt-lg-0">
				<a href="./team.php" class="about-button team-mobile-btn">Meet the Team</a>
			</div>
		</div>
		</div>
	</section>
	<!-- *****************************our team end************************************************** -->
	<!-- socail bar******************************* -->
	<div class="social-btns tag">
		<div class="try1">
			<a class="btn facebook" href="https://facebook.com/acmusict" target="_blank"><i class="fa fa-facebook"></i></a>
			<div class="write" id="wrete">
				<h1 class="sob-heading">700</h1>
				<p class="gratext">Facebook Followers</p>
			</div>
		</div>
		<div class="try1">
			<a class="btn twitter" href="https://linkedin.com/company/acmusict" target="_blank"><i class="fab fa fa-linkedin"></i></a>
			<div class="write" id="wrete">
				<h1 class="sob-heading">1000</h1>
				<p class="gratext">LinkedIn Reach</p>
			</div>
		</div>
		<div class="try1">
			<a class="btn dribbble" href="https://instagram.com/acmusict/" target="_blank"><i class=" fa fa fa-instagram"></i></a>
			<div class="write" id="wrete">
				<h1 class="sob-heading">300+</h1>
				<p class="gratext">Instagram Followers</p>
			</div>
		</div>
		<div class="try1">
			<a class="btn skype"><i class="fa fa fa-child"></i></a>
			<div class="write" id="wrete">
				<h1 class="sob-heading">1000+</h1>
				<p class="gratext">Connected Students</p>
			</div>
		</div>

	</div>
	<!-- ****************************************************contact us ***************************** -->
	<div class="dsph" id="contact">
		<div class="d-flex justify-content-center mt-md-5">

			<img src="./assets/images/contact_us_img.webp" class="svg-media" alt="" />

			<div class="contactUs">
				<div class="closebtn">
					<button class="btn btn-primary s-form-group contact-btn" onclick="closecontact()"><i class="fas fa-times"></i></button>
				</div>
				<form class="s-form" name="contact" method="post" action="https://docs.google.com/forms/u/0/d/e/1FAIpQLSeW8dszRK5ynb6HS51X7fGrfW7su1_8JFL0Tm3hWfbfdpZiCQ/formResponse" onsubmit="return validateform();">
					<h2 class="my-4 display-4 fw-bolder text-center">Contact<span class="text-blue"> Us</span></h2>
					<div class="row form-row">
						<div class="form-group s-form-group col-md-5">
							<input type="text" name="name" class="form-control" placeholder="Name *" />
						</div>
						<div class="form-group s-form-group col-md-5">
							<input type="text" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Email *" />
						</div>
					</div>
					<div class="row form-row">
						<div class="form-group s-form-group col-md-5">
							<input type="text" name="phone" class="form-control" placeholder="Phone No." />
						</div>
						<div class="form-group s-form-group col-md-5">
							<input type="text" name="college" class="form-control" placeholder="College/ Organization" />
						</div>
					</div>
					<div class="contact-msg">
						<textarea type="text" name="message" rows="5" placeholder="Message *" class="form-control col-md-11 contact-message"></textarea>
					</div>
					<div class="row contact-msg">
						<button type="submit" class="btn btn-primary s-form-group contact-btn col-md-3 col-sm-2">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- ********************************contact_us end**************************************************** -->

	<!--  footer -->
	<?php
	include("footer.php")
	?>
	<!--  footer ends -->
	<!-- back to top -->
	<div class="scrolltop">
		<div class="scroll icon"><i class="fa fa-rocket" aria-hidden="true"></i></div>
	</div>
	<!-- contact us -->
	<div class="contact-bottom-btn">
		<a href="javascript:showcontact()">
			<div class="contact-icon"><i class="fas fa-comments" aria-hidden="true"></i></div>
		</a>
	</div>



	<!-- Swiper JS -->
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script src="assets\JS\home_new.js"></script>
</body>

</html>