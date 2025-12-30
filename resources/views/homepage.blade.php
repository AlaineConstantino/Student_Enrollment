<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Minds Kindergarten - Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --phthalo-green: #1a4d0a;
            --mustard-green: #7a9c3a;
            --light-gray: #e8e6df;
            --space-sparkle: #4a8284;
            --moonstone-blue: #7dbdd1;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--mustard-green) 0%, var(--space-sparkle) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="rgba(255,255,255,0.1)"></path></svg>');
            background-repeat: no-repeat;
            background-position: bottom;
            opacity: 0.3;
            pointer-events: none;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--phthalo-green) !important;
        }

        .login-btn {
            color: var(--phthalo-green) !important;
            border-color: var(--phthalo-green) !important;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background-color: var(--phthalo-green) !important;
            color: white !important;
        }

        .feature-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .btn-enroll {
            background-color: var(--light-gray);
            color: var(--phthalo-green);
            font-weight: bold;
            padding: 12px 40px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-enroll:hover {
            background-color: var(--moonstone-blue);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .stats-section {
            background-color: var(--light-gray);
            padding: 60px 0;
        }

        .stat-box {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--space-sparkle);
        }

        .testimonial-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: var(--phthalo-green);
            color: white;
            padding: 40px 0 20px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('homepage') }}">
                <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i> Bright Minds Kindergarten
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#programs">Programs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary ms-2 login-btn" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold mb-4">Where Learning Begins with Joy</h1>
                    <p class="lead mb-4">Enroll your child in a nurturing environment designed to spark curiosity, creativity, and a lifelong love of learning.</p>
                    <a href="{{ route('login') }}" class="btn btn-enroll btn-lg">
                        <i class="bi bi-pencil-square me-2"></i>Start Enrollment
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-box">
                        <div class="stat-number">500+</div>
                        <p class="text-muted">Happy Students</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-box">
                        <div class="stat-number">25+</div>
                        <p class="text-muted">Qualified Teachers</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-box">
                        <div class="stat-number">15+</div>
                        <p class="text-muted">Years Experience</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-box">
                        <div class="stat-number">100%</div>
                        <p class="text-muted">Parent Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5" id="about">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Why Choose Bright Minds?</h2>
                <p class="lead text-muted">We provide the best early childhood education experience</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon" style="color: var(--space-sparkle);">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h4>Experienced Teachers</h4>
                            <p class="text-muted">Our certified educators are passionate about early childhood development and dedicated to your child's success.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon" style="color: var(--mustard-green);">
                                <i class="bi bi-book-fill"></i>
                            </div>
                            <h4>Creative Curriculum</h4>
                            <p class="text-muted">Our play-based learning approach combines fun activities with educational goals to foster holistic development.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon" style="color: var(--moonstone-blue);">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h4>Safe Environment</h4>
                            <p class="text-muted">Your child's safety is our priority with secure facilities, health protocols, and caring supervision.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="py-5 bg-light" id="programs">
        <div class="container text-center">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Our Programs</h2>
                <p class="lead text-muted">Tailored programs for every age group</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-palette-fill" style="font-size: 3rem; color: var(--mustard-green);"></i>
                            <h5 class="mt-3">Nursery</h5>
                            <p class="text-muted">Ages 3-4 years</p>
                            <p>Creative exploration and foundational learning experiences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-puzzle-fill" style="font-size: 3rem; color: var(--moonstone-blue);"></i>
                            <h5 class="mt-3">Kindergarten 1</h5>
                            <p class="text-muted">Ages 4-5 years</p>
                            <p>Building cognitive skills and preparing for formal education.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-trophy-fill" style="font-size: 3rem; color: var(--phthalo-green);"></i>
                            <h5 class="mt-3">Kindergarten 2</h5>
                            <p class="text-muted">Ages 5-6 years</p>
                            <p>Advanced learning and school readiness preparation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">What Parents Say</h2>
                <p class="lead text-muted">Real stories from our community</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="mb-3">
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                        </div>
                        <p class="mb-3">"Bright Minds has been amazing for my daughter. She's developed so much confidence and loves going to school every day!"</p>
                        <strong>- Sarah Johnson</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="mb-3">
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                        </div>
                        <p class="mb-3">"The teachers are wonderful and truly care about each child. The curriculum is engaging and well-structured."</p>
                        <strong>- Michael Chen</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="mb-3">
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                            <i class="bi bi-star-fill" style="color: var(--mustard-green);"></i>
                        </div>
                        <p class="mb-3">"Best decision we made for our son's early education. He's thriving socially and academically!"</p>
                        <strong>- Emily Rodriguez</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Bright Minds Kindergarten</h5>
                    <p>Nurturing young minds and building bright futures through quality early childhood education.</p>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 Bright Minds Kindergarten. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>