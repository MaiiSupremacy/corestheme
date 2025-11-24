/**
 * Main JavaScript file for the CORES Theme
 *
 * This file handles all the interactive elements:
 * - Loader
 * - Custom Cursor
 * - Navigation (scrolling, mobile menu)
 * - Hero Slider
 * - Scroll Animations
 * - Forms
 * - Leaflet Map
 * - Chart.js Visualization
 * - Filtering for Research & Team
 * - Team Modal
 * - Gallery Carousel (Swiper.js)
 */

// Global error handler to prevent script execution from stopping
window.addEventListener('error', function(e) {
    console.error('JavaScript error:', e.error);
});

// Initialize variables
let currentSlide = 0;
let slideInterval;
let map;
let aoiLayer;
let currentZoom = 12;

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functions with error handling
    try {
        initLoader();
        initCursor();
        initNavigation();
        initSlider();
        initScrollAnimations();
        initForms();
        initMap(); // Initializes Leaflet map
        initCoastalChangeChart(); // Initializes Chart.js
        initGalleryCarousel(); // *** NEW: Initializes Swiper.js gallery ***
        
        // Memastikan filter awal sudah aktif saat load
        // Ini adalah perbaikan untuk Improvement #4 (konten tidak muncul)
        filterResearch('all'); 
        filterTeam('all'); 
    } catch (error) {
        console.error('Initialization error:', error);
        // Ensure loader is hidden even if initialization fails
        hideLoader();
    }
});

// Loader functions
function initLoader() {
    const loader = document.getElementById('loader');
    if (loader) {
        // Show loader first, then hide
        loader.style.display = 'flex'; 
    }
    
    // Hide loader after a minimum time
    // We wait for window.load to ensure all images/assets are loaded
    window.addEventListener('load', () => {
        setTimeout(function() {
            hideLoader();
        }, 500); // Short delay after everything is loaded
    });

    // Failsafe: if window.load takes too long, hide it anyway
    setTimeout(function() {
        hideLoader();
    }, 4000); 
}

function hideLoader() {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.classList.add('hidden');
        // After transition, set display to none
        setTimeout(() => {
            if (loader) loader.style.display = 'none';
        }, 500);
    }
}

// Custom Cursor - Only initialize on non-touch devices
function initCursor() {
    // Check if device supports hover (non-touch device)
    if (window.matchMedia('(hover: hover)').matches) {
        const cursor = document.querySelector('.cursor');
        const cursorFollower = document.querySelector('.cursor-follower');
        
        if (cursor && cursorFollower) {
            document.addEventListener('mousemove', (e) => {
                cursor.style.left = e.clientX + 'px';
                cursor.style.top = e.clientY + 'px';
                
                setTimeout(() => {
                    cursorFollower.style.left = e.clientX + 'px';
                    cursorFollower.style.top = e.clientY + 'px';
                }, 100);
            });
        }
    }
}

// Navigation functions
function initNavigation() {
    const hamburger = document.getElementById('hamburger');
    const slideMenu = document.getElementById('slideMenu');
    const menuClose = document.getElementById('menuClose');
    const navbar = document.getElementById('navbar');

    if (hamburger && slideMenu && menuClose) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            slideMenu.classList.toggle('active');
        });

        menuClose.addEventListener('click', () => {
            hamburger.classList.remove('active');
            slideMenu.classList.remove('active');
        });

        // Close menu when clicking on links inside it
        const menuLinks = document.querySelectorAll('.slide-menu a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Check if it's an anchor link for the same page
                if (link.hash) {
                    hamburger.classList.remove('active');
                    slideMenu.classList.remove('active');
                    // Smooth scroll logic is handled by a separate function
                }
            });
        });
    }

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        if (navbar) {
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        
        // Update active navigation link based on scroll position
        // This is a fallback for the WordPress 'current-menu-item'
        const navLinks = document.querySelectorAll('nav ul a');
        const sections = document.querySelectorAll('section[id]');
        const scrollPosition = window.scrollY + (navbar ? navbar.offsetHeight : 80) + 50;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') && link.getAttribute('href').includes(`#${sectionId}`)) {
                        link.classList.add('active');
                    }
                });
            }
        });
    });

    // Back to top button
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Smooth scrolling for all anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            // Ensure it's not just a standalone "#"
            if (href.length > 1) {
                e.preventDefault();
                const targetId = href.substring(href.indexOf('#') + 1);
                const target = document.getElementById(targetId);
                if (target) {
                    scrollToSection(targetId);
                }
            }
        });
    });
}

// Slider functions
function initSlider() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const progressBar = document.getElementById('progressBar');
    const prevSlideBtn = document.getElementById('prevSlide');
    const nextSlideBtn = document.getElementById('nextSlide');

    if (slides.length === 0) return;

    function showSlide(n) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        currentSlide = (n + slides.length) % slides.length;
        
        slides[currentSlide].classList.add('active');
        if (dots[currentSlide]) {
            dots[currentSlide].classList.add('active');
        }
        
        // Reset and start progress bar
        if (progressBar) {
            progressBar.style.transition = 'none';
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.transition = 'width 7s linear';
                progressBar.style.width = '100%';
            }, 50);
        }
    }

    // Make goToSlide global for dot onclick
    window.goToSlide = (n) => {
        clearInterval(slideInterval);
        showSlide(n);
        startSlideShow();
    };

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    function startSlideShow() {
        // Clear existing interval to prevent duplicates
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 7000);
    }

    // Slider controls
    if (nextSlideBtn) {
        nextSlideBtn.addEventListener('click', () => {
            clearInterval(slideInterval);
            nextSlide();
            startSlideShow();
        });
    }

    if (prevSlideBtn) {
        prevSlideBtn.addEventListener('click', () => {
            clearInterval(slideInterval);
            prevSlide();
            startSlideShow();
        });
    }

    // Pause on hover
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });

        heroSection.addEventListener('mouseleave', () => {
            startSlideShow();
        });

        // Touch support
        let touchStartX = 0;
        let touchEndX = 0;

        heroSection.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        heroSection.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                clearInterval(slideInterval);
                nextSlide();
                startSlideShow();
            }
            if (touchEndX > touchStartX + 50) {
                clearInterval(slideInterval);
                prevSlide();
                startSlideShow();
            }
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA') {
            return; // Don't interfere with form typing
        }
        if (e.key === 'ArrowLeft') {
            clearInterval(slideInterval);
            prevSlide();
            startSlideShow();
        } else if (e.key === 'ArrowRight') {
            clearInterval(slideInterval);
            nextSlide();
            startSlideShow();
        }
    });

    // Start slideshow
    showSlide(0); // Show first slide immediately
    startSlideShow();
}

// Scroll animations
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Stop observing once visible
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in').forEach(el => {
        observer.observe(el);
    });
}

// Form functions
function initForms() {
    // Contact form
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Here you would normally send the form data to a server
            // For WordPress, this would be an AJAX call to admin-ajax.php
            console.log('Form submitted (simulation):', data);
            
            // Show success message
            this.reset(); // Clear the form
            
            // Create success message
            const successMessage = document.createElement('div');
            successMessage.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: linear-gradient(135deg, var(--primary), var(--accent));
                color: white;
                padding: 2rem;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                z-index: 10000;
                text-align: center;
                animation: fadeInUp 0.5s ease;
            `;
            successMessage.innerHTML = `
                <h3 style="margin-bottom: 1rem;">Message Sent Successfully!</h3>
                <p>Thank you for contacting us. We will get back to you soon.</p>
            `;
            
            document.body.appendChild(successMessage);
            
            setTimeout(() => {
                successMessage.remove();
            }, 3000);
        });
    }

    // Newsletter form
    const newsletterForm = document.querySelector('footer form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            console.log('Newsletter submitted (simulation):', email);
            
            // Create success message
            const successMessage = document.createElement('div');
            successMessage.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: linear-gradient(135deg, var(--primary), var(--accent));
                color: white;
                padding: 2rem;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                z-index: 10000;
                text-align: center;
                animation: fadeInUp 0.5s ease;
            `;
            successMessage.innerHTML = `
                <h3 style="margin-bottom: 1rem;">Successfully Subscribed!</h3>
                <p>Thank you for subscribing to our newsletter.</p>
            `;
            
            document.body.appendChild(successMessage);
            
            setTimeout(() => {
                successMessage.remove();
            }, 3000);
            
            this.reset();
        });
    }
}

// Map functions
function initMap() {
    // Check if Leaflet is loaded
    if (typeof L === 'undefined') {
        console.error('Leaflet.js is not loaded.');
        return;
    }

    const mapContainer = document.getElementById('map');
    if (!mapContainer) return; // Don't run if map container isn't on the page

    try {
        // Set the map to the exact coordinates
        map = L.map('map').setView([-8.4384848, 112.6678858], 12);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // *** FIX #6: Custom Map Pin Icon ***
        // Use Font Awesome icon for the marker
        const mapIcon = L.divIcon({
            html: '<i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: var(--accent);"></i>',
            className: 'custom-map-icon', // for potential future styling
            iconSize: [30, 42],
            iconAnchor: [15, 42], // Point of the marker
            popupAnchor: [0, -42] // Popup position relative to icon
        });

        // Add marker for the exact coordinates
        const marker = L.marker([-8.4384848, 112.6678858], {
            title: 'Clungup Research Location',
            icon: mapIcon
        }).addTo(map);
        
        // Add popup with coordinates
        marker.bindPopup(`<b>Clungup Research Location</b><br>Coordinates: (-8.4384848, 112.6678858)`).openPopup();
        
        // Add AOI rectangle for the mangrove conservation area
        const aoiCoords = [
            [-8.469486, 112.616077], // bottom-left
            [-8.469486, 112.717667], // bottom-right
            [-8.415691, 112.717667], // top-right
            [-8.415691, 112.616077], // top-left
            [-8.469486, 112.616077]  // back to start
        ];
        
        aoiLayer = L.polygon(aoiCoords, {
            color: 'rgba(5, 191, 219, 0.3)',
            weight: 2,
            fillOpacity: 0.2
        }).addTo(map);
        
        // Add zoom controls listener
        map.on('zoomend', function() {
            currentZoom = map.getZoom();
            updateZoomLevel();
        });
        updateZoomLevel(); // Initial call
    } catch (error) {
        console.error('Map setup error:', error);
    }
}

function updateZoomLevel() {
    const zoomLevelElement = document.querySelector('.osm-zoom-level');
    if (zoomLevelElement) {
        zoomLevelElement.textContent = `Zoom: ${currentZoom}`;
    }
}

// Make map controls global
window.zoomIn = () => {
    if (map) {
        map.zoomIn();
    }
};

window.zoomOut = () => {
    if (map) {
        map.zoomOut();
    }
};

// *** FIX #8: Chart.js Initialization ***
function initCoastalChangeChart() {
    // Check if Chart.js is loaded
    if (typeof Chart === 'undefined') {
        console.error('Chart.js is not loaded.');
        return;
    }

    const ctx = document.getElementById('coastalChangeChart');
    if (!ctx) return; // Don't run if chart canvas isn't on the page

    try {
        // Gradient fill for the bars
        const chartCtx = ctx.getContext('2d');
        const gradient = chartCtx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(5, 191, 219, 0.8)');   // --accent
        gradient.addColorStop(1, 'rgba(10, 77, 104, 0.8)'); // --primary

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Station 1', 'Station 2', 'Station 3', 'Station 4', 'Station 5', 'Station 6'],
                datasets: [{
                    label: 'Coastal Erosion (cm/year)',
                    data: [60, 80, 45, 70, 90, 55],
                    backgroundColor: gradient,
                    borderColor: 'rgba(10, 77, 104, 1)',
                    borderWidth: 2,
                    borderRadius: 5,
                    hoverBackgroundColor: 'rgba(5, 191, 219, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Erosion (cm/year)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Monitoring Station'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Hide legend as it's self-explanatory
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.dataset.label}: ${context.raw} cm/year`;
                            }
                        }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Chart.js setup error:', error);
    }
}

// Filter functions
window.filterResearch = (category) => {
    const cards = document.querySelectorAll('.research-section .card');
    const buttons = document.querySelectorAll('.research-filters .filter-btn');
    
    buttons.forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.category === category) {
            btn.classList.add('active');
        }
    });
    
    cards.forEach(card => {
        if (category === 'all' || card.dataset.category === category) {
            card.style.display = 'block';
            // Use a short delay to allow 'display: block' to register
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 10);
        } else {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.display = 'none';
            }, 300); // Wait for transition to finish
        }
    });
};

window.filterTeam = (category) => {
    const members = document.querySelectorAll('.team-section .team-member');
    const buttons = document.querySelectorAll('.team-filters .filter-btn');
    
    const lecturersTitle = document.getElementById('lecturersTitle');
    const researchersTitle = document.getElementById('researchersTitle');

    buttons.forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.category === category) {
            btn.classList.add('active');
        }
    });

    // Show/hide titles based on filter
    if (lecturersTitle) {
        lecturersTitle.style.display = (category === 'all' || category === 'Lecture') ? 'block' : 'none';
    }
    if (researchersTitle) {
        researchersTitle.style.display = (category === 'all' || category === 'researchers') ? 'block' : 'none';
    }
    
    members.forEach(member => {
        if (category === 'all' || member.dataset.category === category) {
            member.style.display = 'block';
            setTimeout(() => {
                member.style.opacity = '1';
                member.style.transform = 'translateY(0)';
            }, 10);
        } else {
            member.style.opacity = '0';
            member.style.transform = 'translateY(20px)';
            setTimeout(() => {
                member.style.display = 'none';
            }, 300);
        }
    });
};

// Modal functions
const teamData = {
    supervisor1: {
        name: 'Dr. Ir. Runi Asmaranto ST., MT., IPM., ASEAN Eng.',
        title: 'Lecture',
        bio: 'Dr. Ir. Runi Asmaranto ST., MT., IPM., ASEAN Eng. is a renowned expert in coastal dynamics with over 20 years of experience in wave analysis and coastal engineering.',
        expertise: ['Dam Expert', 'Reservoir and Dam Conservation'],
        publications: 45,
        email: 'ahmad@cores-research.org'
    },
    supervisor2: {
        name: 'Dr. Ir. Very Dermawan, ST., MT.,IPM., ASEAN Eng.',
        title: 'Lecture',
        bio: 'Dr. Ir. Very Dermawan, ST., MT.,IPM., ASEAN Eng. specializes in marine ecology and sedimentology with extensive field experience in tropical coastal environments.',
        expertise: ['Hydraulics', 'Marine Ecology', 'Sedimentology', 'Field Research'],
        publications: 38,
        email: 'sarah@cores-research.org'
    },
    supervisor3: {
        name: 'Dr. Sebrian Mirdeklis Beselly Putra., ST., MT., M.Eng.',
        title: 'Lecture',
        bio: 'Dr. Sebrian Mirdeklis Beselly Putra., ST., MT., M.Eng. is a distinguished physical oceanographer with expertise in climate impact studies and coastal processes.',
        expertise: ['Coastal Engineering', 'Physical Oceanography', 'Climate Impact', 'Coastal Modeling'],
        publications: 52,
        email: 'john@cores-research.org'
    },
    supervisor4: {
        name: 'Muhammad Amar Sajali, ST., MT., M. Eng., Ph.D.',
        title: 'Lecture',
        bio: 'Muhammad Amar Sajali, ST., MT., M. Eng., Ph.D. focuses on mangrove ecology and conservation, with a passion for community-based restoration projects.',
        expertise: ['Numerical Modeling', 'Mangrove Ecology', 'Conservation', 'Community Engagement'],
        publications: 31,
        email: 'lisa@cores-research.org'
    },
    researcher1: {
        name: 'Shareef Abdurrahim Yulianto',
        title: 'Researcher',
        bio: 'Shareef specializes in wave analysis and field research, with expertise in coastal monitoring equipment and data collection.',
        expertise: ['Coastal Dynamics', 'Mangrove Studies', 'Field Research', 'Data Collection'],
        publications: 8,
        email: 'budi@cores-research.org'
    },
    researcher2: {
        name: 'Aan Mustaqim',
        title: 'Researcher',
        bio: 'Aan is an expert in laboratory analysis and geochemistry, focusing on sediment composition and transport mechanisms.',
        expertise: ['Mangrove Studies', 'Data Analysis', 'Coastal Dynamics', 'Lab Analysis', 'Geochemistry'],
        publications: 6,
        email: 'siti@cores-research.org'
    },
    researcher3: {
        name: 'Bilan Ayu Ardita',
        title: 'Researcher',
        bio: 'Bilan combines GIS expertise with drone piloting skills to create comprehensive mapping solutions for coastal research.',
        expertise: ['Mangrove Studies', 'Coastal Dynamics', 'GIS Specialist', 'Remote Sensing'],
        publications: 7,
        email: 'andi@cores-research.org'
    },
    researcher4: {
        name: 'Maharani Dewi Ayu Maulana Sinatria',
        title: 'Researcher',
        bio: 'Maharani specializes in data science and modeling, transforming complex coastal data into actionable insights.',
        expertise: ['Coastal Dynamics', 'Mangrove Studies', 'Data Science', 'Modeling', 'Statistical Analysis'],
        publications: 5,
        email: 'dewi@cores-research.org'
    },
    researcher5: {
        name: 'Laode Almay Fi Ahsany Taqwim',
        title: 'Researcher',
        bio: 'Laode is an expert in UAV operations and photogrammetry, creating detailed topographic maps of coastal areas.',
        expertise: ['Data Analysis', 'Coastal Dynamics', 'Mangrove Studies', 'UAV Operations', 'Photogrammetry'],
        publications: 4,
        email: 'rizal@cores-research.org'
    },
    researcher6: {
        name: 'Lhefiardo Syajidan Taqyuddin',
        title: 'Researcher',
        bio: 'Lhefiardo focuses on field ecology and biodiversity studies in mangrove ecosystems, with a passion for conservation.',
        expertise: ['Mangrove Studies', 'Data Analysis', 'Drone Topography', 'Field Ecology', 'Biodiversity'],
        publications: 3,
        email: 'maya@cores-research.org'
    },
    researcher7: {
        name: 'Juan Carlos Tambunan',
        title: 'Researcher',
        bio: 'Juan specializes in coastal structures and hydrodynamics, designing solutions for coastal protection and resilience.',
        expertise: ['Data Analysis', 'Coastal Dynamics', 'Coastal Structures', 'Hydrodynamics'],
        publications: 6,
        email: 'fajar@cores-research.org'
    },
    researcher8: {
        name: 'Rafi Satria Sofriansyah',
        title: 'Researcher',
        bio: 'Rafi focuses on environmental impact assessment and sustainability, ensuring research aligns with conservation goals.',
        expertise: ['Coastal Dynamics', 'Drone Topography', 'Environmental Impact', 'Sustainability'],
        publications: 4,
        email: 'nina@cores-research.org'
    },
    researcher9: {
        name: 'Arwanda Maulana Rijal Al Fatah',
        title: 'Researcher',
        bio: 'Arwanda develops web applications and data visualization tools to make coastal research data accessible to stakeholders.',
        expertise: ['Drone Topography', 'Data Analysis', 'Web Development', 'Data Visualization'],
        publications: 2,
        email: 'rio@cores-research.org'
    },
    researcher10: {
        name: 'Khalifa Firza Khafif Ar Razi',
        title: 'Researcher',
        bio: 'Khalifa assists with field work and sample collection, ensuring high-quality data for our research projects.',
        expertise: ['Data Analysis', 'Coastal Dynamics', 'Drone Topography', 'Field Work', 'Sample Collection'],
        publications: 1,
        email: 'lisa@cores-research.org'
    },
    researcher11: {
        name: 'Muhammad Azzikri Aditya Gama',
        title: 'Researcher',
        bio: 'Muhammad manages our laboratory equipment and ensures proper maintenance and calibration of all research instruments.',
        expertise: ['Data Analysis', 'Coastal Dynamics', 'Lab Management', 'Equipment Maintenance'],
        publications: 1,
        email: 'dimas@cores-research.org'
    }
};

window.openTeamModal = (memberId) => {
    const modal = document.getElementById('teamModal');
    const modalBody = document.getElementById('modalBody');
    
    if (!modal || !modalBody) return;
    
    const member = teamData[memberId] || {
        name: 'Team Member',
        title: 'Researcher',
        bio: 'Detailed information about this team member will be available soon.',
        expertise: ['Research'],
        publications: 0,
        email: 'coastalresearchers@gmail.com'
    };
    
    modalBody.innerHTML = `
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: white;">
                <i class="fas fa-user"></i>
            </div>
            <h2 style="color: var(--primary); margin-bottom: 0.5rem; font-size: 1.5rem;">${member.name}</h2>
            <p style="color: var(--accent); font-size: 1.2rem;">${member.title}</p>
        </div>
        <div style="margin-bottom: 2rem;">
            <h3 style="color: var(--primary); margin-bottom: 1rem;">About</h3>
            <p style="line-height: 1.6;">${member.bio}</p>
        </div>
        <div style="margin-bottom: 2rem;">
            <h3 style="color: var(--primary); margin-bottom: 1rem;">Expertise</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                ${member.expertise.map(skill => `<span class="team-tag">${skill}</span>`).join('')}
            </div>
        </div>
        <div style="margin-bottom: 2rem;">
            <h3 style="color: var(--primary); margin-bottom: 1rem;">Academic Profile</h3>
            <p>Publications: ${member.publications}</p>
            <p>Email: <a href="mailto:${member.email}" style="color: var(--accent);">${member.email}</a></p>
        </div>
        <div style="text-align: center;">
            <button class="cta-button" onclick="closeTeamModal()">Close</button>
        </div>
    `;
    
    modal.classList.add('active');
};

window.closeTeamModal = () => {
    const modal = document.getElementById('teamModal');
    if (modal) {
        modal.classList.remove('active');
    }
};

// Close modal when clicking outside
const teamModal = document.getElementById('teamModal');
if (teamModal) {
    teamModal.addEventListener('click', (e) => {
        if (e.target === teamModal) {
            closeTeamModal();
        }
    });
}

// *** FIX #6: NEW GALLERY CAROUSEL (SWIPER.JS) ***
function initGalleryCarousel() {
    // Check if Swiper is loaded
    if (typeof Swiper === 'undefined') {
        console.error('Swiper.js is not loaded.');
        return;
    }

    const galleryCarousel = document.querySelector('.gallery-carousel');
    if (!galleryCarousel) return; // Don't run if carousel isn't on the page

    try {
        new Swiper('.gallery-carousel', {
            // Use 'coverflow' effect like the example
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto', // Let Swiper determine slides based on width
            loop: true, // Loop the slides
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            // Add pagination (dots)
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            // Add navigation (arrows)
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // Autoplay
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    } catch (error) {
        console.error('Swiper.js setup error:', error);
    }
}

// *** OLD Lightbox functions (REMOVED) ***
// window.openLightbox = (imageSrc) => { ... }
// window.closeLightbox = () => { ... }
// const lightbox = document.getElementById('lightbox'); ...


// Global smooth scroll function
window.scrollToSection = (sectionId) => {
    const section = document.getElementById(sectionId);
    const navbar = document.getElementById('navbar');
    
    if (section) {
        let offset = 0;
        if (navbar) {
            // Get computed style to check if navbar is fixed
            const navStyle = window.getComputedStyle(navbar);
            if (navStyle.position === 'fixed') {
                offset = navbar.offsetHeight;
            }
        }
        
        const targetPosition = section.offsetTop - offset;
        
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }
};