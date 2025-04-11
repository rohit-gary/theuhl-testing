<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('./uhladmin/uhl-management/include/autoloader.inc.php');
include("./uhladmin/uhl-management/include/db-connection.php");
$conf = new Conf();
$dbh = new Dbh();
$core = new Core();
$masterconn = $dbh->_connectodb();
$test_obj = new Test($conn);
$all_test = $test_obj->GetAllTestName();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/meta.php") ?>
    <?php include("includes/links1.php") ?>
    <title>United Health Lumina New health plan for new Times</title>
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./project-assets/css/index.css">
    <link rel="stylesheet" type="text/css" href="./project-assets/css/all_test.css">
</head>
<style>
.single-person-image,
.family-image,
.full-family-image {
    position: relative;
    padding: 30px;
    border-radius: 0 !important;
    color: #fff;
    min-height: 320px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
    z-index: 1;
    cursor: pointer;
}

.single-person-image:hover,
.family-image:hover,
.full-family-image:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgb(0 0 0 / 58%) !important;
}

.single-person-image::before,
.family-image::before,
.full-family-image::before {
    content: "";
    position: absolute;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 0;
}

.single-person-image>*,
.family-image>*,
.full-family-image>* {
    position: relative;
    z-index: 1;
}

.single-person-image h3,
.family-image h3,
.full-family-image h3 {
    font-weight: 700;
    color: #eceef1;
    font-size: 1.8rem;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
    /* strong readability */
}

.single-person-image p,
.family-image p,
.full-family-image p,
.single-person-image li,
.family-image li,
.full-family-image li {
    font-size: 1rem;
    color: #f8f8f8;
    line-height: 1.6;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
}

.card-text ul li {
    font-weight: 600;
    line-height: 2.2;
}


.single-person-image {
    background-image: url('https://www.unitedhealthlumina.com/uhladmin/uhl-management/project-assets/plan/REGULAR%20MAGNIT%202.02870_item.jpg');
}

.family-image,
.full-family-image {
    background-image: url('https://www.unitedhealthlumina.com/uhladmin/uhl-management/project-assets/plan/REGULAR%20FAMILY%20FLOATER%203.09225_item.jpg');
}

table td,
table th {
    padding-top: 1.5rem !important;
    padding-bottom: 1.5rem !important;
}

.health-container {
    padding: 1rem;
    color: grey;
    max-width: 100%;
}

.health-container h2 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1rem;
}

.health-container p {
    font-size: 1.1rem;
    line-height: 1.7;
}




/*--------------new css-----------*/

.section-full {
    padding: 64px 0;
    overflow: hidden;
}

.letter-spacing-2 {
    letter-spacing: 2px;
}

.animation-block {
    animation: fadeInUp 0.8s ease-out;
}

.image-wrapper {
    position: relative;
}

.floating-shape {
    position: absolute;
    width: 200px;
    height: 200px;
    background: rgba(227, 240, 247, 0.5);
    border-radius: 50%;
    z-index: -1;
    right: -50px;
    bottom: -50px;
}

.feature-list li {
    transition: transform 0.3s ease;
}

.feature-list li:hover {
    transform: translateX(10px);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Carousel Styles */
.hero-carousel {
    position: relative;
}

.carousel-item {
    height: 100vh;
    min-height: 600px;
}

.carousel-item img {
    object-fit: cover;
    height: 100%;
}

.overlay-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.6));
    z-index: 1;
}

.carousel-caption {
    bottom: 50%;
    transform: translateY(50%);
    z-index: 2;
}

.caption-content {
    max-width: 800px;
    margin: 0 auto;
}

.hindi-slogan {
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.company-name {
    color: #e3f0f7;
    font-weight: 600;
}

.feature-badges {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.feature-badges .badge {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 12px 24px;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.feature-badges .badge:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}

.feature-badges .badge i {
    margin-right: 8px;
    color: #e3f0f7;
}

.btn-primary {
    padding: 15px 40px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    background: #007bff;
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
}

.carousel-indicators {
    bottom: 40px;
}

.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin: 0 8px;
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
    transition: all 0.3s ease;
}

.carousel-indicators button.active {
    background-color: #fff;
    transform: scale(1.2);
}

.carousel-control-prev,
.carousel-control-next {
    width: 5%;
    opacity: 0;
    transition: all 0.3s ease;
}

.carousel:hover .carousel-control-prev,
.carousel:hover .carousel-control-next {
    opacity: 1;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .carousel-item {
        height: 80vh;
        min-height: 500px;
    }

    .hindi-slogan {
        font-size: 2rem;
    }

    .feature-badges .badge {
        padding: 8px 16px;
        font-size: 0.9rem;
    }
}


.benefits-section {
    background: linear-gradient(135deg, #367eb7 0%, #196dad 100%);
    padding: 64px 0;
    position: relative;
    overflow: hidden;
}

.benefits-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('path-to-pattern.png') repeat;
    opacity: 0.05;
}

/* Section Header Styles */
.section-header {
    color: white;
    margin-bottom: 60px;
}

.subtitle {
    display: inline-block;
    background: rgba(255, 255, 255, 0.1);
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 0.9rem;
    margin-bottom: 20px;
    backdrop-filter: blur(5px);

}

.title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 20px;
}

.highlight {
    color: #a8d5ff;
}

.section-description {
    font-size: 1.1rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
    color: white;
}

/* Benefits Grid */
.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Benefit Card Styles */
.benefit-card {
    perspective: 1000px;
    height: 400px;
}

.card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.benefit-card:hover .card-inner {
    transform: rotateY(180deg);
}

.card-front,
.card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 20px;
    overflow: hidden;
}

.card-front {
    background-size: cover;
    background-position: center;
}

.single-person-bg {
    background-image: url('path-to-single-person-image.jpg');
}

.family-bg {
    background-image: url('path-to-family-image.jpg');
}

.senior-bg {
    background-image: url('path-to-senior-image.jpg');
}

.content-overlay {
    /* background: linear-gradient(to top, rgb(104 179 218), transparent);
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 30px;
    color: white; */

    background: linear-gradient(to top, rgb(104 179 218), #86e5f378);
    /* position: absolute; */
    bottom: 0;
    left: 0;
    right: 0;
    padding: 49px;
    text-align: center;
    color: white;
    border-radius: 16px;
}

.card-back {
    background: white;
    transform: rotateY(180deg);
    padding: 30px;
}

/* Benefit Content Styles */
.benefit-content {
    color: #333;
}

.benefit-content h3 {
    color: #367eb7;
    margin-bottom: 20px;
    font-size: 1.5rem;
}

.benefit-features {
    list-style: none;
    padding: 0;
    margin: 0;
}

.benefit-features li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
}

.benefit-features i {
    color: #367eb7;
    margin-right: 10px;
    margin-top: 5px;
}

.learn-more {
    display: inline-flex;
    align-items: center;
    color: #367eb7;
    text-decoration: none;
    margin-top: 20px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.learn-more i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.learn-more:hover {
    color: #196dad;
}

.learn-more:hover i {
    transform: translateX(5px);
}

/* Animation Classes */
.reveal-fade {
    opacity: 0;
    animation: fadeIn 1s ease forwards;
}

.reveal-slide-left {
    opacity: 0;
    transform: translateX(-50px);
    animation: slideIn 1s ease forwards;
}

.reveal-slide-right {
    opacity: 0;
    transform: translateX(50px);
    animation: slideIn 1s ease forwards;
}

.reveal-slide-up {
    opacity: 0;
    transform: translateY(50px);
    animation: slideIn 1s ease forwards;
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

@keyframes slideIn {
    to {
        opacity: 1;
        transform: translate(0);
    }
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .benefits-section {
        padding: 60px 0;
    }

    .title {
        font-size: 2rem;
    }

    .benefits-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 0 20px;
    }

    .benefit-card {
        height: 350px;
    }
}

.health-plan-section {
    padding: 72px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

/* Section Header Styles */
.section-header {
    margin-bottom: 60px;
}

.main-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    line-height: 1.4;
}

.highlight {
    display: block;
    color: white;
    margin-top: 10px;
}

/* Features Styles */
.features-container {
    max-width: 1000px;
    margin: 0 auto 80px;
}

.feature-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.feature-item {
    align-items: center;
    text-align: center;
    flex-direction: column;
    display: flex;
    align-items: center;
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    background: #4aa4d3;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    flex-shrink: 0;
}

.feature-icon i {
    font-size: 1.5rem;
}

.feature-text {
    font-size: 1rem;
    color: #555;
    line-height: 1.6;
}

/* Pricing Table Styles */
.pricing-section {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.pricing-title {
    color: #333;
    font-size: 2rem;
    font-weight: 600;
}

.pricing-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 15px;
    overflow: hidden;
}

.pricing-table th,
.pricing-table td {
    padding: 20px;
    border: 1px solid #e9ecef;
}

.pricing-table thead th {
    background: #4aa4d3;
    color: white;
    font-weight: 600;
    text-align: left;
}

.plan-column {
    min-width: 200px;
}

.plan-name {
    font-size: 1.2rem;
    margin-bottom: 5px;
}

.plan-price {
    font-size: 1rem;
    opacity: 0.8;
}

.pricing-table tbody th {
    background: #f8f9fa;
    font-weight: 600;
    color: #333;
}

.pricing-table tbody td {
    color: #555;
}

/* Animation Classes */
.reveal-fade {
    opacity: 0;
    animation: fadeIn 1s ease forwards;
}

.reveal-slide-up {
    opacity: 0;
    transform: translateY(30px);
    animation: slideUp 1s ease forwards;
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .health-plan-section {
        padding: 60px 0;
    }

    .main-title {
        font-size: 2rem;
    }

    .feature-list {
        grid-template-columns: 1fr;
    }

    .pricing-section {
        padding: 20px;
    }

    .pricing-table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

.healthcare-features {
    background: linear-gradient(135deg, #e3f0f7 0%, #f0f7fb 100%);
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.healthcare-features::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.4) 0%, rgba(255, 255, 255, 0) 70%);
    border-radius: 50%;
    transform: translate(50%, -50%);
}

.features-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}

.feature-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
}

.feature-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4aa4d3, #367eb7);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.feature-card:hover::after {
    transform: scaleX(1);
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #4aa4d3 0%, #367eb7 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
}

.feature-icon i {
    font-size: 2.5rem;
    color: white;
}

.feature-content h2 {
    color: #333;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.tagline {
    color: #4aa4d3;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.feature-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 25px;
}

.learn-more {
    display: inline-flex;
    align-items: center;
    color: #4aa4d3;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.learn-more i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.learn-more:hover {
    color: #367eb7;
}

.learn-more:hover i {
    transform: translateX(5px);
}

/* Animations */
.pulse-animation {
    animation: pulse 2s infinite;
}

.bounce-animation {
    animation: bounce 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.1);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes bounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}

.reveal-slide-right {
    opacity: 0;
    transform: translateX(-30px);
    animation: slideRight 0.8s ease forwards;
}

.reveal-slide-left {
    opacity: 0;
    transform: translateX(30px);
    animation: slideLeft 0.8s ease forwards;
}

@keyframes slideRight {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideLeft {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .healthcare-features {
        padding: 60px 20px;
    }

    .features-wrapper {
        grid-template-columns: 1fr;
    }

    .feature-card {
        padding: 30px;
    }

    .feature-content h2 {
        font-size: 1.5rem;
    }
}

/* Main carousel container fix */
.hero-carousel .carousel,
.hero-carousel .carousel-inner,
.hero-carousel .carousel-item {
    height: auto !important;
}

/* Ensure image fits naturally */
.hero-carousel .carousel-item img {
    width: 100%;
    height: auto;
    display: block;
}

/* Optional: Remove Bootstrap default min-height */
.carousel-item {
    min-height: auto !important;
}

/* Position controls properly */
.carousel-control-prev,
.carousel-control-next {
    top: 50%;
    transform: translateY(-50%);
}

/* Indicators styling */
.carousel-indicators {
    bottom: 10px;
}
</style>

<body id="bg">

    <div class="page-wraper" style="background:#fff">
        <div id="loading-area"></div>
        <!-- header -->
        <?php include('includes/header1.php'); ?>
        <!-- Content -->


    </div>



    <div class="section-full content-inner position-relative"
        style="background: linear-gradient(135deg, #e3f0f7 0%, #f5f9fb 100%);">
        <div class="container">
            <div class="section-content">
                <div class="row align-items-center">
                    <!-- Left Content Column -->
                    <div class="col-lg-7 col-md-12 pe-lg-5 mb-5 mb-lg-0">
                        <div class="content-bx1 animation-block">
                            <span
                                style="background: linear-gradient(to right, #1e3c72, #2a5298, #00b4db); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"
                                class="d-block mb-3 fw-semibold text-uppercase letter-spacing-2">Healthcare
                                Solutions</span>
                            <h2 class="mb-4 display-4" style="font-size: 2.5rem; font-weight: 500;">
                                UNITED HEALTH LUMINA
                                <span
                                    style="background: linear-gradient(to right, #1e3c72, #2a5298, #00b4db); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"
                                    class="d-block mt-2">IS YOUR IDEAL FINANCIAL PARTNER</span>
                            </h2>

                            <div class="mb-4">
                                <p class="lead fw-normal text-dark">
                                    Comprehensive protection against healthcare expenses including:
                                </p>
                                <ul class="list-unstyled text-dark" style=" cursor: pointer; margin-bottom: 0px;">
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="fas fa-check-circle text-primary me-3"></i>
                                        <span>OPP Consultation & Diagnosis Coverage</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="fas fa-check-circle text-primary me-3"></i>
                                        <span>Complete Protection for Medical Expenses</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-primary me-3"></i>
                                        <span>Comprehensive Primary Healthcare Plan</span>
                                    </li>
                                    <p class="mt-2">It is a Comprehensive Preimany
                                        healthomere plan that Provides Complete Protection against a wide eange of
                                        Perinary
                                        medical expenses.</p>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <!-- Right Image Column -->
                    <div class="col-lg-5 col-md-12">
                        <div class="image-wrapper position-relative">
                            <div class="shadow-lg rounded-4" style="background: white; padding: 26px;">
                                <div class="card-body">
                                    <h4 class="card-title text-center mb-4">Your Enquiry</h4>
                                    <style>

                                    </style>
                                    <form>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter your name" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter your email" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="option" class="form-label">Plan</label>
                                            <select class="form-control" id="option" name="option" required>
                                                <option value="" selected disabled>Select plan</option>
                                                <option value="family-cover">Primary Health Care Cover for Family
                                                </option>
                                                <option value="family-protection">Family Health Protection</option>
                                                <option value="senior-healthcare">Primary Healthcare for Senior Citizens
                                                </option>
                                            </select>
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btnhover13"
                                                style="border-radius: 8px;">Submit
                                                Enquiry</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel Section -->
    <section class="hero-carousel">
        <div id="healthCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#healthCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#healthCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#healthCarousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <!-- Main Banner -->
                <div class="carousel-item active">
                    <div class="overlay-gradient"></div>
                    <picture>
                        <!-- <source media="(min-width: 1200px)" srcset="project-assets/images/banner/nb-2101.png"> -->
                        <img src="project-assets/images/uhl.png" class="w-100" alt="Health Care Banner">
                    </picture>
                </div>
                <!-- Health Plans Slide -->
                <div class="carousel-item">
                    <div class="overlay-gradient"></div>
                    <picture>
                        <!-- <source media="(min-width: 1200px)" srcset="project-assets/images/banner/nb2-2502.png"> -->
                        <img src="project-assets/images/uhl.png" class="w-100" alt="Health Care Banner">
                    </picture>
                </div>
                <!-- Health Tests Slide -->
                <div class="carousel-item">
                    <div class="overlay-gradient"></div>
                    <picture>
                        <!-- <source media="(min-width: 1200px)" srcset="project-assets/images/banner/nb3-2502.png"> -->
                        <img src="project-assets/images/uhl.png" class="w-100" alt="Health Care Banner">
                    </picture>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#healthCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#healthCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Card Section -->
    <section class="benefits-section">
        <div class="container">
            <div class="section-header text-center mb-5 reveal-fade">
                <span class="subtitle text-primary"> <b>Why Choose Us</b></span>
                <h2 class="title text-white"> <span class="">Benefits of </span><span class="highlight ">Our Health
                        Services</span></h2>
                <p class="section-description">Comprehensive healthcare solutions designed for your peace of mind</p>
            </div>

            <div class="benefits-grid">
                <!-- Individual Health Cover Card -->
                <div class="benefit-card reveal-slide-left">
                    <div class="card-inner">
                        <div class="card-front single-person-bg">
                            <div class="content-overlay">
                                <h3>Primary Health Cover for Individuals</h3>
                                <div class="icon-wrapper">
                                    <!-- <i class="fas fa-user-shield"></i> -->
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-back">
                            <div class="benefit-content">
                                <h3>Individual Health Coverage</h3>
                                <ul class="benefit-features">
                                    <li>
                                        <i class="fas fa-check-circle text-primary"></i>
                                        <span>Coverage for unexpected primary medical expenses</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-primary"></i>
                                        <span>Holistic Benefits - United Health Care Plan</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Health Cover Card -->
                <div class="benefit-card reveal-slide-right">
                    <div class="card-inner">
                        <div class="card-front family-bg">
                            <div class="content-overlay">
                                <h3>Primary Health Care Cover for Family</h3>
                                <div class="icon-wrapper">
                                    <!-- <i class="fas fa-users"></i> -->
                                    <i class="fas fa-people-roof"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-back">
                            <div class="benefit-content">
                                <h3>Family Health Protection</h3>
                                <ul class="benefit-features">
                                    <li>
                                        <i class="fas fa-check-circle text-primary"></i>
                                        <span>Primary Coverage for entire family</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-primary"></i>
                                        <span>Well-being and financial safety ensured</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Senior Citizen Health Cover Card -->
                <div class="benefit-card reveal-slide-up">
                    <div class="card-inner">
                        <div class="card-front senior-bg">
                            <div class="content-overlay">
                                <h3>Primary Healthcare for Senior Citizens</h3>
                                <div class="icon-wrapper">
                                    <!-- <i class="fas fa-heart"></i> -->
                                    <i class="fas fa-person-cane"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-back">
                            <div class="benefit-content">
                                <h3>Senior Citizen Care</h3>
                                <ul class="benefit-features">
                                    <li>
                                        <i class="fas fa-check-circle text-primary"></i>
                                        <span>Well-being and financial safety assured</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-primary"></i>
                                        <span>Primary Coverage for Pre-existing conditions</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="health-plan-section">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center reveal-fade">
                <h2 class="main-title">
                    What Does a Primary Health Plan Mean
                    <span class="highlight"
                        style="background: linear-gradient(to right, #1e3c72, #2a5298, #00b4db); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">and
                        How Does it Work?</span>
                </h2>
            </div>

            <!-- Features List -->
            <div class="features-container reveal-slide-up">
                <div class="feature-list">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="feature-text">
                            UHL Healthcare Doctor creates a health profile for you and designs specialized programs with
                            in-house experts to address your health risks and wellness goals.
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="feature-text">
                            Once your membership is active, you will get Standard Preventive health check-ups and are
                            available
                            at a fee of up to ₹1,500.
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <div class="feature-text">
                            Getting better begins When the problem is diagnosed at its root.
                            You Can get any lab tests (X-Ray, Blood test, MRI, Etc) done at any medical
                            facility Suggested by UHL Healthcare team.
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="feature-text">
                            If the list Can be done at home, we will aveange for a lab
                            Partnere to come to you. </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="feature-text">
                            UHL Speciaties Suggested by the doctor or personal Consultation
                            with your expest doctor are covered, all we say is that before embarking on Such
                            a jouwerwey, you must talk to us.
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-laptop-medical"></i>
                        </div>
                        <div class="feature-text">
                            you Can get access to better healthear Senures from the comfort of
                            your Couch (Sofa), you Coan get unlimited consultation from our in-house dodom
                            and erepent nutritionists, psychologists, phyrusotherapists and others.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing Table -->
            <div class="pricing-section reveal-fade">
                <h3 class="pricing-title text-center mb-4">Coverage Plans Comparison</h3>
                <div class="pricing-table-wrapper table-responsive">
                    <table class="pricing-table">
                        <thead>
                            <tr>
                                <th>Coverage Plan Variant</th>
                                <th class="plan-column">
                                    <div class="plan-name">UHL Secure Lite</div>
                                    <div class="plan-price">₹25,000</div>
                                </th>
                                <th class="plan-column">
                                    <div class="plan-name">UHL Secure Plus</div>
                                    <div class="plan-price">₹50,000</div>
                                </th>
                                <th class="plan-column">
                                    <div class="plan-name">UHL Secure Prime</div>
                                    <div class="plan-price">₹1,00,000</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows remain the same but with updated styling -->
                            <!-- ... existing table rows ... -->
                            <tr>
                                <td><b>Personlised Health Care</b></td>
                                <td>24×7</td>
                                <td>24×7</td>
                                <td>24×7</td>

                            </tr>
                            <tr>
                                <td><b>Cover for OPD</b></td>
                                <td>2.5 LAKH A YEAR<br><small>(top-up plan, not main base)</small></td>
                                <td>5 LAKH A YEAR<br><small>(top-up plan, not main base)</small></td>
                                <td>10 LAKH A YEAR<br><small>(top-up plan, not main base)</small></td>
                            </tr>
                            <tr>
                                <td><b>Claim Process</b></td>
                                <td>Cashless / Reimbursement</td>
                                <td>Cashless / Reimbursement</td>
                                <td>Cashless / Reimbursement</td>

                            </tr>
                            <tr>
                                <td><b>Age Limit</b></td>
                                <td>1 to 65 years</td>
                                <td>1 to 75 years</td>
                                <td>1 to 75 years</td>
                            </tr>
                            <tr>
                                <td><b>Service Ability</b></td>
                                <td>Anywhere in India</td>
                                <td>Anywhere in India</td>
                                <td>Anywhere in India</td>
                            </tr>
                            <tr>
                                <td><b>Online Consultation</b></td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>
                                <td>Unlimited</td>

                            </tr>
                            <tr>
                                <td><b>Co-pay</b></td>
                                <td>50%</td>
                                <td>40%</td>
                                <td>30%</td>

                            </tr>
                            <tr>
                                <td><b>Subscription Membership</b></td>
                                <td>1, 2 & 3 Year</td>
                                <td>1, 2 & 3 Year</td>
                                <td>1, 2, & 3 Year</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <section class="healthcare-features">
        <div class="container">
            <div class="features-wrapper">
                <!-- Personalized Healthcare Card -->
                <div class="feature-card reveal-slide-right">
                    <div class="feature-icon">
                        <i class="fas fa-heartbeat pulse-animation"></i>
                    </div>
                    <div class="feature-content">
                        <h2>Personalised Healthcare</h2>
                        <div class="tagline">In Sickness and in Health Too!</div>
                        <p class="feature-description">
                            We create your unique health profile and design professionally crafted programs
                            to improve your health and reduce your chances of hospitalization.
                        </p>

                    </div>
                </div>

                <!-- OPD Coverage Card -->
                <div class="feature-card reveal-slide-left">
                    <div class="feature-icon">
                        <i class="fas fa-user-md bounce-animation"></i>
                    </div>
                    <div class="feature-content">
                        <h2>Cover for OPD</h2>
                        <div class="tagline">Comprehensive Outpatient Care</div>
                        <p class="feature-description">
                            Get unlimited consultations with uhl doctors and access UHL approved lab consultations
                            at recommended facilities and doctor's practices.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content END-->

    </div>
    <?php include("includes/footer1.php") ?>
    <?php include("includes/script1.php") ?>

    <script type="text/javascript" src="project-assets/js/index.js"></script>
    <script type="text/javascript" src="project-assets/js/common-test.js"></script>
</body>

</html>