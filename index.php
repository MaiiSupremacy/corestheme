<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when 'Settings' > 'Reading' > 'Your homepage displays' is set to 'Your latest posts'.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <section class="hero-section" id="home">
            <div class="slider-container">
                <div class="slide active">
                    <div class="slide-bg" style="background-image: url('https://picsum.photos/seed/coastal-horizon/1920/1080.jpg');"></div>
                    <div class="slide-overlay"></div>
                    <div class="vignette"></div>
                    <div class="slide-content">
                        <h1>Welcome to Our Coastal Horizon</h1>
                        <p>Exploring the dynamics of coastal ecosystems through innovative research and technology</p>
                        <button class="cta-button" onclick="scrollToSection('research')">Explore Our Research</button>
                    </div>
                </div>

                <div class="slide">
                    <div class="slide-bg" style="background-image: url('https://picsum.photos/seed/coastal-research/1920/1080.jpg');"></div>
                    <div class="slide-overlay"></div>
                    <div class="vignette"></div>
                    <div class="slide-content">
                        <h1>What We Research For?</h1>
                        <p>Understanding coastal processes to protect our shorelines and communities</p>
                        <button class="cta-button" onclick="scrollToSection('research')">Discover Our Work</button>
                    </div>
                </div>

                <div class="slide">
                    <div class="slide-bg" style="background-image: url('https://picsum.photos/seed/cores-team/1920/1080.jpg');"></div>
                    <div class="slide-overlay"></div>
                    <div class="vignette"></div>
                    <div class="slide-content">
                        <h1>Meet Our Team</h1>
                        <p>Passionate researchers dedicated to advancing coastal science</p>
                        <button class="cta-button" onclick="scrollToSection('team')">Get to Know Us</button>
                    </div>
                </div>
            </div>

            <div class="slider-nav">
                <div class="slider-arrow" id="prevSlide">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="slider-arrow" id="nextSlide">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <div class="slider-dots">
                <span class="dot active" onclick="goToSlide(0)"></span>
                <span class="dot" onclick="goToSlide(1)"></span>
                <span class="dot" onclick="goToSlide(2)"></span>
            </div>

            <div class="progress-bar" id="progressBar"></div>

            <!-- === OLD SCROLL INDICATOR (NOW HIDDEN BY CSS) === -->
            <!-- This is the one you circled in red. We will hide it with CSS -->
            <!-- but leave it here just in case. -->
            <div class="scroll-indicator" id="old-scroll-indicator">
                <i class="fas fa-chevron-down"></i>
                <span>Scroll to explore</span>
            </div>
        </section>

        <!-- 
          *** FIX #7: NEW ANIMATED WAVE SECTION ***
          This completely replaces the old .spacer-section.
          It contains the multi-layered SVG for the wave animation
          and the NEW "Scroll to explore" text that will be
          positioned on top of the wave.
        -->
        <div class="wave-transition-container">
            <!-- The new, correct scroll cue, positioned relative to the wave container -->
            <div class="scroll-indicator-on-wave" onclick="scrollToSection('research')">
                <i class="fas fa-chevron-down"></i>
                <span>Scroll to explore</span>
            </div>
            
            <!-- Animated SVG Waves -->
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#F5F5F5" />
                </g>
            </svg>
        </div>
        <!-- === END OF NEW WAVE SECTION === -->


        <section class="research-section" id="research">
            <h2 class="section-title fade-in">Our Research Focus</h2>
            
            <div class="research-filters fade-in">
                <button class="filter-btn active" data-category="all" onclick="filterResearch('all')">All Research</button>
                <button class="filter-btn" data-category="monitoring" onclick="filterResearch('monitoring')">Coastal Monitoring</button>
                <button class="filter-btn" data-category="analysis" onclick="filterResearch('analysis')">Data Analysis</button>
                <button class="filter-btn" data-category="ecosystem" onclick="filterResearch('ecosystem')">Ecosystem Studies</button>
            </div>

            <div class="cards-container">
                <div class="card fade-in" data-category="monitoring">
                    <div class="card-icon"><i class="fas fa-water"></i></div>
                    <h3>Coastal Dynamics</h3>
                    <p>Advanced monitoring of wave patterns, tidal movements, and coastal processes using state-of-the-art equipment including wave gauges and GNSS rovers.</p>
                    <a href="#" class="card-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="analysis">
                    <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>Data Analysis</h3>
                    <p>Computational modeling and statistical analysis of coastal processes, climate change impacts, and erosion patterns using advanced software tools.</p>
                    <a href="#" class="card-link">View Projects <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="monitoring">
                    <div class="contour-icon">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <!-- Drone Body -->
                            <ellipse cx="50" cy="50" rx="12" ry="6" class="drone-body"/>
                            
                            <!-- Drone Arms -->
                            <line x1="38" y1="50" x2="25" y2="35" class="drone-arms"/>
                            <line x1="62" y1="50" x2="75" y2="35" class="drone-arms"/>
                            <line x1="38" y1="50" x2="25" y2="65" class="drone-arms"/>
                            <line x1="62" y1="50" x2="75" y2="65" class="drone-arms"/>
                            
                            <!-- Propellers -->
                            <circle cx="25" cy="35" r="6" class="drone-propellers"/>
                            <circle cx="75" cy="35" r="6" class="drone-propellers"/>
                            <circle cx="25" cy="65" r="6" class="drone-propellers"/>
                            <circle cx="75" cy="65" r="6" class="drone-propellers"/>
                            
                            <!-- Camera/Gimbal -->
                            <circle cx="50" cy="54" r="3" fill="#05BFDB"/>
                            <rect x="48" y="56" width="4" height="5" fill="#0A4D68"/>
                            
                            <!-- Topographic Contour Lines -->
                            <path d="M 15 80 Q 35 75, 50 80 T 85 80" class="topographic-lines"/>
                            <path d="M 15 85 Q 35 80, 50 85 T 85 85" class="topographic-lines"/>
                            <path d="M 15 90 Q 35 85, 50 90 T 85 90" class="topographic-lines"/>
                        </svg>
                    </div>
                    <h3>Drone Topography</h3>
                    <p>High-precision coastal mapping using drone photogrammetry with WebODM software for detailed terrain analysis and contour mapping.</p>
                    <a href="#" class="card-link">See Technology <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="ecosystem">
                    <div class="card-icon"><i class="fas fa-tree"></i></div>
                    <h3>Mangrove Studies</h3>
                    <p>Comprehensive mangrove ecosystem research including parameterization, carbon sequestration studies, and coastal protection analysis.</p>
                    <a href="#" class="card-link">Explore Research <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="analysis">
                    <div class="card-icon"><i class="fas fa-flask"></i></div>
                    <h3>Sediment Analysis</h3>
                    <p>Laboratory and field-based sediment composition analysis to understand coastal evolution and transport patterns.</p>
                    <a href="#" class="card-link">View Methods <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="monitoring">
                    <div class="card-icon"><i class="fas fa-satellite"></i></div>
                    <h3>Remote Sensing</h3>
                    <p>Satellite imagery and aerial photography analysis for large-scale coastal monitoring and change detection.</p>
                    <a href="#" class="card-link">Discover More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="data-viz fade-in">
                <h3 style="text-align: center; margin-bottom: 2rem; color: var(--primary);">Coastal Change Analysis</h3>
                <!-- 
                  *** FIX #8: CHART.JS CANVAS ***
                  This <canvas> element replaces the old CSS bar chart.
                  js/main.js will find this ID and draw the chart here.
                -->
                <div class="chart-container">
                    <canvas id="coastalChangeChart"></canvas>
                </div>
                <p style="text-align: center; color: var(--dark); margin-top: 1rem;">Annual coastal erosion rates (cm/year) at monitoring stations</p>
            </div>

            <h3 style="text-align: center; margin: 3rem 0 2rem; color: var(--primary); font-size: 2rem;" class="fade-in">Our Research Equipment</h3>
            <div class="equipment-showcase">
                <div class="equipment-card fade-in">
                    <div class="equipment-image" style="background-image: url('https://picsum.photos/seed/wavegauge/400/300.jpg');"></div>
                    <div class="equipment-info">
                        <div class="equipment-name">Wave Gauge System</div>
                        <div class="equipment-desc">High-precision wave monitoring equipment for real-time coastal dynamics analysis</div>
                    </div>
                </div>
                <div class="equipment-card fade-in">
                    <div class="equipment-image" style="background-image: url('https://picsum.photos/seed/gnss/400/300.jpg');"></div>
                    <div class="equipment-info">
                        <div class="equipment-name">GNSS Rover</div>
                        <div class="equipment-desc">Advanced positioning system for precise coastal topography measurements</div>
                    </div>
                </div>
                <div class="equipment-card fade-in">
                    <div class="equipment-image" style="background-image: url('https://picsum.photos/seed/drone/400/300.jpg');"></div>
                    <div class="equipment-info">
                        <div class="equipment-name">Research Drone</div>
                        <div class="equipment-desc">UAV equipped with multispectral sensors for coastal ecosystem monitoring</div>
                    </div>
                </div>
                <div class="equipment-card fade-in">
                    <div class="equipment-image" style="background-image: url('https://picsum.photos/seed/sediment/400/300.jpg');"></div>
                    <div class="equipment-info">
                        <div class="equipment-name">Sediment Sampler</div>
                        <div class="equipment-desc">Specialized equipment for collecting and analyzing coastal sediment samples</div>
                    </div>
                </div>
            </div>

            <!-- 
              *** FIX #5: "Research Gallery" section has been MOVED from here ***
              It is now located between News and Contact.
            -->

            <h3 style="text-align: center; margin: 3rem 0 2rem; color: var(--primary); font-size: 2rem;" class="fade-in">Research Milestones</h3>
            <div class="timeline fade-in">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">6 September 2025</div>
                        <!-- *** FIX #3: Title is no longer a link *** -->
                        <h4>Clungup Fieldwork 1</h4>
                        <p>Deployment of 4 wave gauges at designated monitoring points. Field sampling concluded with the acquisition of 14 sediment samples and 5 water quality samples. Drone Mapping</p>
                        <!-- *** FIX #3: Added "View Milestone" link *** -->
                        <a href="#" class="milestone-link">View Milestone <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">14 September 2025</div>
                        <!-- *** FIX #3: Title is no longer a link *** -->
                        <h4>Clungup Fieldwork 2</h4>
                        <p>Retrieved optical sensor video logs, completed mangrove biophysical parameterization, successfully collected wave gauge data, and acquired 17 additional sediment samples.</p>
                        <!-- *** FIX #3: Added "View Milestone" link *** -->
                        <a href="#" class="milestone-link">View Milestone <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">Coming Soon</div>
                        <h4>-</h4>
                        <p>-</p>
                        <a href="#" class="milestone-link">View Milestone <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">Coming Soon</div>
                        <h4>-</h4>
                        <p>-</p>
                        <a href="#" class="milestone-link">View Milestone <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <h3 style="text-align: center; margin: 3rem 0 2rem; color: var(--primary); font-size: 2rem;" class="fade-in">Our Impact</h3>
            <div class="stats-container">
                <div class="stat-card fade-in">
                    <div class="stat-number">-</div>
                    <div class="stat-label">Research Projects</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number">-</div>
                    <div class="stat-label">Publications</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number">15</div>
                    <div class="stat-label">Team Members</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number">1</div>
                    <div class="stat-label">Partner Institutions</div>
                </div>
            </div>

            <h3 style="text-align: center; margin: 3rem 0 2rem; color: var(--primary); font-size: 2rem;" class="fade-in">Research Locations</h3>
            <div class="osm-container fade-in">
                <div id="map" class="osm-map"></div>
                <div class="osm-controls">
                    <button class="osm-control-btn" onclick="zoomIn()">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="osm-control-btn" onclick="zoomOut()">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="osm-zoom-level">Zoom: 12</div>
                </div>
            </div>
        </section>

        <section class="team-section" id="team">
            <h2 class="section-title fade-in">Meet Our Team</h2>
            
            <div class="team-filters fade-in">
                <button class="filter-btn active" data-category="all" onclick="filterTeam('all')">All Members</button>
                <button class="filter-btn" data-category="Lecture" onclick="filterTeam('Lecture')">Lecturers</button>
                <button class="filter-btn" data-category="researchers" onclick="filterTeam('researchers')">Researchers</button>
            </div>

            <!-- 
              *** FIX #1 (Alignment) ***
              The H3 titles will be given a fixed margin in style.css
              to stop them from jumping.
            -->
            <h3 id="lecturersTitle" class="team-subtitle fade-in">Dosen Pembimbing (Lecturers)</h3>
            <div class="team-grid">
                <div class="team-member fade-in" data-category="Lecture" onclick="openTeamModal('supervisor1')">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Dr. Ir. Runi Asmaranto, ST., MT.,IPM., ASEAN Eng.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Dam Expert</span>
                        <span class="team-tag">Reservoir and Dam Conservation</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="Lecture" onclick="openTeamModal('supervisor2')">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Dr. Ir. Very Dermawan, ST., MT.,IPM., ASEAN Eng.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Hydraulics</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="Lecture" onclick="openTeamModal('supervisor3')">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Dr. Sebrian Mirdeklis Beselly Putra., ST., MT., M.Eng.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Coastal Engineering</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="Lecture" onclick="openTeamModal('supervisor4')">
                    <div class="team-avatar"><i class="fas fa-user-tie"></i></div>
                    <h4>Muhammad Amar Sajali, ST., MT., M. Eng., Ph.D.</h4>
                    <p>Lecture</p>
                    <div class="team-tags">
                        <span class="team-tag">Numerical Modeling</span>
                    </div>
                </div>
            </div>

            <h3 id="researchersTitle" class="team-subtitle fade-in">Research Team</h3>
            <div class="team-grid">
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher1')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Shareef Abdurrahim Yulianto</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Mangrove Studies</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher2')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Aan Mustaqim</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Mangrove Studies</span>
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher3')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Bilan Ayu Ardita</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Mangrove Studies</span>
                        <span class="team-tag">Coastal Dynamics</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher4')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Maharani Dewi Ayu Maulana Sinatria</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Mangrove Studies</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher5')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Laode Almay Fi Ahsany Taqwim</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Mangrove Studies</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher6')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Lhefiardo Syajidan Taqyuddin</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Mangrove Studies</span>
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Drone Topography</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher7')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Juan Carlos Tambunan</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher8')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Rafi Satria Sofriansyah</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Drone Topography</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher9')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Arwanda Maulana Rijal Al Fatah</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Drone Topography</span>
                        <span class="team-tag">Data Analysis</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher10')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Khalifa Firza Khafif Ar Razi</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                        <span class="team-tag">Drone Topography</span>
                    </div>
                </div>
                <div class="team-member fade-in" data-category="researchers" onclick="openTeamModal('researcher11')">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <h4>Muhammad Azzikri Aditya Gama</h4>
                    <p>Researcher</p>
                    <div class="team-tags">
                        <span class="team-tag">Data Analysis</span>
                        <span class="team-tag">Coastal Dynamics</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="team-modal" id="teamModal">
            <div class="modal-content">
                <div class="modal-close" onclick="closeTeamModal()">
                    <i class="fas fa-times"></i>
                </div>
                <div class="modal-body" id="modalBody">
                    </div>
            </div>
        </div>

        <!-- 
          The old "Lightbox" div for the gallery is removed,
          as the new carousel doesn't use it.
        -->

        <section class="publications-section" id="publications">
            <h2 class="section-title fade-in">Recent Publications</h2>
            <div class="publication-list">
                <div class="publication fade-in">
                    <h4>Coastal Erosion Patterns in Southeast Asia: A Decade of Analysis</h4>
                    <p>Comprehensive analysis of erosion trends across Southeast Asian coastlines, revealing critical patterns and providing predictive models for future coastal management strategies.</p>
                    <div class="publication-meta">
                        <span>2023</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                <div class="publication fade-in">
                    <h4>Drone-Based Topographic Mapping of Mangrove Ecosystems</h4>
                    <p>Novel approaches to high-resolution mangrove ecosystem mapping using consumer-grade drones and open-source photogrammetry software for conservation monitoring.</p>
                    <div class="publication-meta">
                        <span>2023</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                <div class="publication fade-in">
                    <h4>Sediment Transport Modeling in Tropical Estuaries</h4>
                    <p>Development of improved computational models for predicting sediment transport patterns in tropical estuarine environments under climate change scenarios.</p>
                    <div class="publication-meta">
                        <span>2022</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                <div class="publication fade-in">
                    <h4>Wave Dynamics and Coastal Infrastructure Resilience</h4>
                    <p>Analysis of wave patterns and their impact on coastal infrastructure, with recommendations for improved design standards in vulnerable coastal regions.</p>
                    <div class="publication-meta">
                        <span>2022</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                <div class="publication fade-in">
                    <h4>Mangrove Carbon Sequestration: Measurement and Modeling</h4>
                    <p>Quantitative assessment of carbon storage in mangrove ecosystems using field measurements and remote sensing data for climate mitigation strategies.</p>
                    <div class="publication-meta">
                        <span>2022</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                <div class="publication fade-in">
                    <h4>Community-Based Coastal Adaptation Strategies</h4>
                    <p>Evaluation of community-led coastal adaptation initiatives and their effectiveness in building resilience to climate change impacts.</p>
                    <div class="publication-meta">
                        <span>2021</span>
                        <a href="#" class="publication-link">View Publication <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="news-section" id="news">
            <h2 class="section-title fade-in">Latest News & Events</h2>
            <div class="news-grid">
                <div class="news-item fade-in">
                    <div class="news-image" style="background-image: url('https://picsum.photos/seed/news1/600/400.jpg');"></div>
                    <div class="news-content">
                        <div class="news-date">June 15, 2023</div>
                        <h4>CORES Receives Major Research Grant for Coastal Protection Study</h4>
                        <p>Our team has been awarded a significant grant to study innovative approaches to coastal protection in vulnerable regions across Southeast Asia.</p>
                        <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="news-item fade-in">
                    <div class="news-image" style="background-image: url('https://picsum.photos/seed/news2/600/400.jpg');"></div>
                    <div class="news-content">
                        <div class="news-date">May 28, 2023</div>
                        <h4>Advanced Drone Technology Enhances Topographic Mapping Capabilities</h4>
                        <p>New drone equipment significantly improves resolution and accuracy of coastal mapping projects, enabling detailed terrain analysis.</p>
                        <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="news-item fade-in">
                    <div class="news-image" style="background-image: url('https://picsum.photos/seed/news3/600/400.jpg');"></div>
                    <div class="news-content">
                        <div class="news-date">May 10, 2023</div>
                        <h4>Student Research Symposium Showcases Innovative Coastal Studies</h4>
                        <p>Annual symposium highlights groundbreaking student projects on coastal dynamics, mangrove ecosystems, and sediment analysis.</p>
                        <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="news-item fade-in">
                    <div class="news-image" style="background-image: url('https://picsum.photos/seed/news4/600/400.jpg');"></div>
                    <div class="news-content">
                        <div class="news-date">April 22, 2023</div>
                        <h4>International Collaboration on Mangrove Conservation Launched</h4>
                        <p>CORES partners with international research institutions to study mangrove conservation strategies across different climate zones.</p>
                        <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="news-item fade-in">
                    <div class="news-image" style="background-image: url('https://picsum.photos/seed/news5/600/400.jpg');"></div>
                    <div class="news-content">
                        <div class="news-date">April 5, 2023</div>
                    <h4>New Wave Monitoring System Deployed in Coastal Waters</h4>
                        <p>State-of-the-art wave monitoring equipment installed to provide real-time data for coastal management and early warning systems.</p>
                        <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="news-item fade-in">
                    <div class="news-image" style="background-image: url('https://picsum.photos/seed/news6/600/400.jpg');"></div>
                    <div class="news-content">
                        <div class="news-date">March 18, 2023</div>
                        <h4>Community Workshop on Coastal Resilience Held Successfully</h4>
                        <p>Local communities participate in workshop to learn about coastal protection strategies and sustainable resource management.</p>
                        <a href="#" class="news-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 
          *** FIX #5 & #6: NEW GALLERY SECTION ***
          The gallery has been MOVED here and is REBUILT as a Swiper carousel.
        -->
        <section class="gallery-section" id="gallery">
            <h2 class="section-title fade-in">Research Gallery</h2>
            
            <!-- This is the Swiper.js carousel structure -->
            <div class="gallery-carousel-container fade-in">
                <!-- Slider main container -->
                <div class="swiper gallery-carousel">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/research1/800/600.jpg" alt="Field Research" />
                            <div class="gallery-caption">Field research at coastal monitoring station</div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/research2/800/600.jpg" alt="Drone Survey" />
                            <div class="gallery-caption">Aerial survey using research drone</div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/research3/800/600.jpg" alt="Sediment Analysis" />
                            <div class="gallery-caption">Laboratory sediment analysis</div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/research4/800/600.jpg" alt="Mangrove Study" />
                            <div class="gallery-caption">Mangrove ecosystem parameterization</div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/research5/800/600.jpg" alt="Wave Measurement" />
                            <div class="gallery-caption">Wave gauge deployment and measurement</div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/research6/800/600.jpg" alt="Team Meeting" />
                            <div class="gallery-caption">Research team planning session</div>
                        </div>
                    </div>
                    
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                
                <!-- Navigation Arrows -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </section>
        <!-- === END OF NEW GALLERY SECTION === -->


        <section class="contact-section" id="contact">
            <h2 class="section-title fade-in">Get In Touch</h2>
            <div class="contact-container">
                <div class="contact-info fade-in">
                    <h3 style="font-size: 2rem; margin-bottom: 2rem;">Contact Information</h3>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h4>Address</h4>
                            <p>Water Resources Engineering Department<br>Brawijaya University<br>Jl. MT. Haryono No.167, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur<br>65145</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h4>Phone</h4>
                            <p>+62 821 4279 3179<br>+62 896 6579 9413</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h4>Email</h4>
                            <p>coastalresearchers@gmail.com<br>coastalresearchers@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <h4>Office Hours</h4>
                            <p>Monday - Thursday: 8:00 AM - 5:00 PM<br>Friday: 8:00 AM - 3:00 PM</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form fade-in">
                    <h3 style="font-size: 2rem; margin-bottom: 2rem;">Send Us a Message</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="cta-button" style="width: 100%;">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
        
    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>